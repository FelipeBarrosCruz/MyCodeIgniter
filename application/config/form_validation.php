<?php

$path = VALIDATION_FOLDER . get_active_class() . '.php';

if(file_exists($path)) {
	require_once($path);
}