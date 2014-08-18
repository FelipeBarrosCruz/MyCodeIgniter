<?php
namespace models;

final class UserInformation extends \ActiveRecord\Model
{
	public static $table_name = 'user_informations';
	public static $belongs_to = [ ['user'] ];
}