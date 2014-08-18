<?php
/**
 *  @Class : ActiveRecord
 *  @Autor : FelipeBarros<felipe.barros.pt@gmail.com>
 *  @Description : Initialze library of database based in php active record: http://www.phpactiverecord.org/
 *  @Version : 1.0 [2014-08-11]
 *
*/

if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50300) {
	die('PHP ActiveRecord requires PHP 5.3 or higher');
}

require __DIR__.'/lib/Singleton.php';
require __DIR__.'/lib/Config.php';
require __DIR__.'/lib/Utils.php';
require __DIR__.'/lib/DateTime.php';
require __DIR__.'/lib/Model.php';
require __DIR__.'/lib/Table.php';
require __DIR__.'/lib/ConnectionManager.php';
require __DIR__.'/lib/Connection.php';
require __DIR__.'/lib/Serialization.php';
require __DIR__.'/lib/SQLBuilder.php';
require __DIR__.'/lib/Reflections.php';
require __DIR__.'/lib/Inflector.php';
require __DIR__.'/lib/CallBack.php';
require __DIR__.'/lib/Exceptions.php';
require __DIR__.'/lib/Cache.php';

final class DatabaseActiveRecord
{
	/*
	 * @constant: PHP_ACTIVERECORD_VERSION_ID;
	 * @descriptioon: Build to original package;
	*/
	const PHP_ACTIVERECORD_VERSION_ID = '1.0';
	/*
	 * @constant: PHP_ACTIVERECORD_AUTOLOAD_PREPEND;
	 * @descriptioon: Build to original package;
	*/
	const PHP_ACTIVERECORD_AUTOLOAD_PREPEND = true;
	
	/*
	 * @var: $model_path;
	 * @description: Cotains value of location path of models;
	*/
	private $model_path = 'application/models';

	/*
	 * @var: $database_data;
	 * @description: Contains configuration parameters to connection into databases;
	 */
	private $database_data;

	public function __construct() {

		$this->database_data = get_database_data();	

		spl_autoload_register(array($this, 'register'), false, self::PHP_ACTIVERECORD_AUTOLOAD_PREPEND);

		$default_connection = $this->get_default_connection();
		$connections = $this->get_connetions();
		$model_path = $this->get_model_path();

		$this->initialize($connections, $default_connection, $model_path);
	}

	private function get_connetions() {
		if(!isset($this->database_data['db'])) return FALSE;

		$connections = [];

		foreach($this->database_data['db'] as $connection => $data) {
			if(isset($data['hostname'], $data['username'], $data['password'], $data['database'], $data['dbdriver'])) {
				$connections[$connection] = "{$data['dbdriver']}://{$data['username']}:{$data['password']}@{$data['hostname']}/{$data['database']}";
			} else {
				show_error('Please, verify your database configuration, the fields are required: hostname, username, password, database, dbdriver.');
			}
		}

		return $connections;
	}

	private function get_default_connection() {
		if(!isset($this->database_data['active_group'])) return FALSE;

		return $this->database_data['active_group'];
	}

	private function get_model_path() {
		if(!isset($this->database_data['model_path']) && !empty($this->model_path)) return $this->model_path;

		return $this->model_path = $this->database_data['model_path'];
	}

	private function initialize($connections, $default_connection, $model_path) {
		
		ActiveRecord\Config::initialize(function($configuration) use ($connections, $default_connection, $model_path)
		{
		    $configuration->set_model_directory($model_path);
		    $configuration->set_connections($connections);
		    $configuration->set_default_connection($default_connection);
		});
	}

	public function register($class_name) {
		
		$path = ActiveRecord\Config::instance()->get_model_directory();
		$root = realpath(isset($path) ? $path : '.');

		if (($namespaces = ActiveRecord\get_namespaces($class_name))) {

			$class_name = array_pop($namespaces);
			$directories = array();

			foreach ($namespaces as $directory) {
				if(!in_array($directory, explode(DIRECTORY_SEPARATOR, $root))) {
					$directories[] = $directory;
				}
			}


			$root .= DIRECTORY_SEPARATOR . implode($directories, DIRECTORY_SEPARATOR);
		}

		$file = "$root/$class_name.php";

		if (file_exists($file))
			require_once $file;
	}
}