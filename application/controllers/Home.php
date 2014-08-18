<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  @Class : Home
 *  @Autor : FelipeBarros<felipe.barros.pt@gmail.com>
 *  @Description : HomeController
 *  @Version : 1.0 [2014-08-11]
 *
*/
final class Home extends MainController {

	protected $data;
	private $models = [];

	public function __construct() {
		parent::__construct();

		$this->models['user'] = $this->load->ar_model('User'); //Get PHP ActiveRecordModel, support namespaces!;
		#$this->load->model('User', 'test'); //Get CodeIgniter ActiveRecord call, don't support namespaces!

		$this->setTitle('App Title Test')->setSubTitle('Sub-title Test');

		$this->setCSS('bootstrap.min.css')->setCSS('carousel.css');

		$this->setJS('jquery.min.js')->setJS('bootstrap.min.js')->setJS('docs.min.js');

		$this->setEnterprise('Felipe Barros');

		$this->setHeader('header.php')->setFooter('footer.php');
	}

	public function index() {
		$this->data['heading'][1] = ['title' => 'Heading One => 1'];
		$this->data['heading'][2] = ['title' => 'Heading Two => 2'];
		$this->data['heading'][3] = ['title' => 'Heading Tree => 3'];
	}

	public function login() {
		
		if($data = $this->input->post()) {
			
			if(isset($data['login'], $data['password'])) {
				$username = $data['login'];
				$password = $this->encrypt->sha1($data['password']);

				if($this->models['user']->login($username, $password)) {
					$this->data['msg_success'] = 'Login OK';

				}
			}
		}
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */