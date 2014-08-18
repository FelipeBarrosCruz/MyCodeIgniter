<?php

interface IMainController
{
	public function getHeader();

	public function getFooter();

	public function getHeaderConfiguration();
	public function getFooterConfiguration();
	public function getUserData();
}