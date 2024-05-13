<?php

namespace app\controllers;

use core\App;
use core\RoleUtils;

class WelcomeScreenCtrl {
    public function action_welcomeScreen() {
        App::getSmarty()->assign('isAdmin', RoleUtils::inRole("admin"));
        App::getSmarty()->display('WelcomeScreen.tpl');
    }
}
