<?php
require_once 'core/Config.class.php';
$conf = new core\Config();
include dirname(__FILE__).'/config.php';

function &getConf(){ global $conf; return $conf; }

require_once 'core/Messages.class.php';
$msgs = new core\Messages();

function &getMessages(){ global $msgs; return $msgs; }

$smarty = null;	
function &getSmarty(){
	global $smarty;
	if (!isset($smarty)){
        require_once getConf()->root_path.'/lib/vendor/autoload.php';
		$smarty = new Smarty\Smarty();
		$smarty->assign('conf',getConf());
		$smarty->assign('msgs',getMessages());
		$smarty->setTemplateDir(array(
			'one' => getConf()->root_path.'/app/views',
			'two' => getConf()->root_path.'/app/views/templates'
		));
	}
	return $smarty;
}

require_once 'core/ClassLoader.class.php';
$cloader = new core\ClassLoader();
function &getLoader() {
    global $cloader;
    return $cloader;
}

require_once getConf()->root_path.'/core/functions.php';

$action = getFromRequest('action');