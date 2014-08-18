<?php

function get_active_class() {
	$router = &load_class('Router');
	return $router->fetch_class();
}

function get_active_method() {
	$router = &load_class('Router');
	return $router->fetch_method();
}

function get_database_data() {
	if(file_exists($database_file = APPPATH . '/config/database.php')) {
		require $database_file;

		if(isset($active_group, $db)) {
			$database_data = ['active_group' => $active_group, 'db' => $db];
			if(isset($model_path)) $database_data['model_path'] = $model_path;
			
			return $database_data;
		}
	}
}

function register_css($location = NULL, $files = []) {

	if(is_null($location) || empty($location)) show_error('Set CSS Location Files in MainController!');

	if(!function_exists('link_tag')) show_error('Please enable HTML Helper in global autoload');
	
	if(empty($files)) return null;

	$css_files = array_map(function($file) use ($location) {
		return (preg_match('/\/$/', $location) ? $location : $location . '/') . $file;
	}, $files);

	$css_text = '';

	foreach($css_files as $file) {
		$css_text .= "\n<!-- CSS LINK -->\n" . link_tag($file);
	}

	echo trim($css_text);
}

function register_js($location, $files = []) {

	if(is_null($location) || empty($location)) show_error('Set JS Location Files in MainController!');

	if(empty($files)) return null;

	if(!function_exists('base_url')) show_error('Please enable URL helper in global autoload!');

	$javascript_files = array_map(function($file) use ($location) {
		$path = function($path) {
			return (preg_match('/\/$/', $path) ? $path : $path . '/');
		};

		$file_path = $path(base_url()) . $path($location) . $file;
		return  $file_path;
	}, $files);

	$javascript_text = '';

	foreach($javascript_files as $file) {
		$javascript_text .= "\n<!-- JAVASCRIPT FILE INCLUDE -->\n" . '<script type="text/javascript" src="' . $file .'"></script>';
	}

	echo trim($javascript_text);
}