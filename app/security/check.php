<?php
require_once dirname(__FILE__).'/../../config.php';
use Smarty\Smarty;

session_start();

$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

if ( empty($role) ){
	include _ROOT_PATH.'/app/security/login.php';
	exit();
}