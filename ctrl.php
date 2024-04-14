<?php
require_once 'init.php';

session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
if ( empty($role) ){
	$ctrl = new app\controllers\LoginCtrl();
    $ctrl->process();
	exit();
}

switch ($action) {
	default :
		$ctrl = new app\controllers\CalcCtrl ();
		$ctrl->generateView();
	break;
	case 'calcCompute' :
		$ctrl = new app\controllers\CalcCtrl ();
		$ctrl->process();
	break;
	case 'logout' :
		$ctrl = new app\controllers\LoginCtrl ();
		$ctrl->logout();
	break;
	case 'login' :
		$ctrl = new app\controllers\LoginCtrl();
        $ctrl->process();
	break;
}
