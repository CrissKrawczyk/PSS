<?php
require_once dirname(__FILE__).'/../../config.php';
require_once dirname(__FILE__).'/../utils/base_utils.php';
require_once _ROOT_PATH.'/lib/vendor/autoload.php';
use Smarty\Smarty;

function getParamsLogin(&$form){
    $fields = ['login', 'pass'];
    foreach ($fields as $field) {
	    $form[$field] = isset ($_REQUEST [$field]) ? $_REQUEST [$field] : null;
	   }
}

function validateLogin(&$form,&$messages){
	if ( ! (isset($form['login']) && isset($form['pass']))) {
		return false;
	}

	if ( $form['login'] == "") {
		$messages [] = 'Nie podano loginu';
	}
	if ( $form['pass'] == "") {
		$messages [] = 'Nie podano hasła';
	}
	if (count ( $messages ) > 0) return false;

	if ($form['login'] == "admin" && $form['pass'] == "admin") {
		session_start();
		$_SESSION['role'] = 'admin';
		return true;
	}
	if ($form['login'] == "user" && $form['pass'] == "user") {
		session_start();
		$_SESSION['role'] = 'user';
		return true;
	}
	
	$messages [] = 'Niepoprawny login lub hasło';
	return false; 
}

$form = array();
$messages = array();

getParamsLogin($form);
$smarty = new Smarty();
$smarty->assign('app_root',_APP_ROOT);
$smarty->assign('app_url',_APP_URL);
$smarty->assign('root_path',_ROOT_PATH);
if (!validateLogin($form,$messages)) {
    $smarty->assign('messages',$messages);
    $smarty->display(_ROOT_PATH.'/app/security/login_view.tpl');
} else {
	header("Location: "._APP_URL);
}