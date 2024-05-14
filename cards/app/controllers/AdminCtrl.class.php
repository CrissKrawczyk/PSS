<?php

namespace app\controllers;

use core\App;
use core\ParamUtils;

class AdminCtrl {

    public function getUsersListData() {
        $users = App::getDB()->select("user", [
            "[>]user_role" => ["id" => "user_id"]
        ], [
            "user.id",
            "user.login",
            "user.email",
            "user_role.role_idn",
        ], [
            "archive" => 0
        ]);
        $parsedUsers = [];
        foreach  ($users as $user) {
            $parsedUserIndex = array_search($user["id"], array_column($parsedUsers, 'id'));
            $parsedUser = ($parsedUserIndex !== false ? $parsedUsers[$parsedUserIndex] : []);
            if (empty($parsedUser)) {
                $parsedUser = [
                    "id" => $user["id"],
                    "login" => $user["login"],
                    "email" => $user["email"],
                    "isAdmin" => $user["role_idn"] == "admin",
                    "isPremium" => $user["role_idn"] == "premium"];
                    $parsedUsers[] = $parsedUser;
            }
            else {
                if ($user["role_idn"] == "admin") {
                    $parsedUser["isAdmin"] = true;
                }
                if ($user["role_idn"] == "premium") {
                    $parsedUser["isPremium"] = true;
                }
                $parsedUsers = array_replace($parsedUsers, [$parsedUserIndex => $parsedUser]);
            }
        }
        return array_values($parsedUsers);
    }

    public function validateDelete() {
        $id = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        if (App::getConf()->user_id == $id)
            return false;
        return true;
    }

    public function action_adminPage() {
        $this->generateView();
    }

    public function action_deleteUser() {
        if ($this->validateDelete()) {
            App::getDB()->delete("user_role", [
                "user_id" => ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji')
            ]);
            App::getDB()->update("user", [
                "archive" => 1
            ],[
                "id" => ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji')
            ]);
        }
        App::getRouter()->forwardTo('adminPage');
    }

    public function action_giveAdminRole() {
        $userId = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        App::getDB()->insert("user_role", [
            "user_id" => $userId,
            "role_idn" => "admin"
        ]);
        App::getRouter()->forwardTo('adminPage');
    }

    public function action_removeAdminRole() {
        $userId = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        App::getDB()->delete("user_role", [
            "user_id" => $userId,
            "role_idn" => "admin"
        ]);
        App::getRouter()->forwardTo('adminPage');
    }

    public function generateView() {
        App::getSmarty()->assign("users", $this->getUsersListData());
        App::getSmarty()->display('AdminPage.tpl');
    }

}
