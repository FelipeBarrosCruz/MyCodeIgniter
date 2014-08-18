<?php

final class MainHook
{
	private $CI;

	public function __construct() {
		$this->CI = &get_instance();
	}

	public function post_controller() {

		$header_configuration = $this->CI->getHeaderConfiguration();
		$footer_configuration = $this->CI->getFooterConfiguration();
		$userdata = $this->CI->getUserData();

		$header = $this->CI->getHeader();
		$footer = $this->CI->getFooter();

		$file_header = APP_LAYOUT_PATH . '/' . $header;
		$file_footer = APP_LAYOUT_PATH . '/' . $footer;


		$file_request = APP_MODULE_PATH . '/' . get_active_class() . '/' . get_active_method() . '.php';


		if(!isset($header_configuration['title'], $header_configuration['subtitle'], $header_configuration['css_location'], $header_configuration['css'])) {
			show_error('Please set in $header_configuration, keys: title, subtitle, css_location and css');
		}

		if(!isset($footer_configuration['enterprise'], $footer_configuration['javascript_location'], $footer_configuration['javascript'])) {
			show_error('Please set in $footer_configuration, keys: enterprise and javascript_location and javascript');
		}

		if(!IS_AJAX) {
			$this->CI->load->view($file_header, $header_configuration);
			$this->CI->load->view($file_request, $userdata);
			$this->CI->load->view($file_footer, $footer_configuration);
		} else {
			$this->CI->load->view($file_request, $userdata);
		}
	}

}