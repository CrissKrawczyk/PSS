<?php

namespace core;

class RoleUtils {

    public static function addRole($role) {
        App::getConf()->roles [$role] = true;
        $_SESSION['_amelia_roles'] = serialize(App::getConf()->roles);
    }

    public static function removeRole($role) {
        if (isset(App::getConf()->roles [$role])) {
            unset(App::getConf()->roles [$role]);
            $_SESSION['_amelia_roles'] = serialize(App::getConf()->roles);
        }
    }

    public static function inRole($role) {
        return isset(App::getConf()->roles[$role]);
    }

    public static function requireRole($role, $fail_action = null) {
        if (!self::inRole($role)) {
            if (isset($fail_action))
                App::getRouter()->forwardTo($fail_action);
            else
                App::getRouter()->forwardTo(App::getRouter()->getLoginRoute());
        }
    }

    public static function setUserId($user_id) {
        App::getConf()->user_id = $user_id;
        $_SESSION['_amelia_user_id'] = serialize($user_id);
    }

    public static function getUserId() {
        return App::getConf()->user_id;
    }

}
