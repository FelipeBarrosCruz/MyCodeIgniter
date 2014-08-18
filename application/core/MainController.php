<?php
/**
 *  @Class : MainController
 *  @Autor : FelipeBarros<felipe.barros.pt@gmail.com>
 *  @Description : Must contain gneral rules of implementation by others controllers.
 *  @Version : 1.0 [2014-08-11]
 *
*/
abstract class MainController extends CI_Controller implements IMainController
{
	protected $data;
	private $template_data = ['header' => '', 'footer' => ''];
	private $header_configuration = [
										'title' 		=> '',
										'subtitle' 		=> '',
										'css_location'	=> 'assets/css/',
										'css' 			=> [],
									];
	private $footer_configuration = [
										'enterprise' 			=> '',
										'javascript_location' 	=> 'assets/js/',
										'javascript'			=> []
									];
	private $system_errors = [];

	public function __construct() {
		parent::__construct();
		$this->setHeader();
		$this->setFooter();
	}

	protected function setHeader($header = DEFAULT_APP_HEADER) {
		$this->template_data['header'] = $header; 
		
		return $this;
	}

	protected function setFooter($footer = DEFAULT_APP_FOOTER) {
		$this->template_data['footer'] = $footer;

		return $this;
	}

	protected function setTitle($title) {
		if(is_null($title)) return FALSE;
		$this->header_configuration['title'] = $title;
		
		return $this;
	}

	protected function setSubTitle($subtitle = NULL) {
		if(is_null($subtitle)) return FALSE;
		$this->header_configuration['subtitle'] = $subtitle;

		return $this;
	}

	protected function setCSS($css = NULL) {

		if (is_null($css) || !isset($this->header_configuration['css']) || !is_array($this->header_configuration['css'])) {
			array_push($this->system_errors, 'Include CSS, setCSS method.');
		} else {
			array_push($this->header_configuration['css'], $css);
		}

		return $this;
	}

	protected function setEnterprise($enterprise = NULL) {
		if(is_null($enterprise) && !isset($this->footer_configuration['enterprise'])) return FALSE;
		$this->footer_configuration['enterprise'] = $enterprise;

		return $this;
	}

	protected function setJS($javascript = NULL) {
		if(is_null($javascript) || !isset($this->footer_configuration['javascript']) || !is_array($this->footer_configuration['javascript'])) {
				array_push($this->system_errors, 'Include JS, setJS method.');
		} else {
			array_push($this->footer_configuration['javascript'], $javascript);		
		}

		return $this;
	}

	public function getHeader() {
		return $this->template_data['header'];
	}

	public function getFooter() {
		return $this->template_data['footer'];
	}

	public function getHeaderConfiguration() {
		return $this->header_configuration;
	}

	public function getFooterConfiguration() {
		return $this->footer_configuration;
	}

	public function getUserData() {
		return $this->data;
	}

}