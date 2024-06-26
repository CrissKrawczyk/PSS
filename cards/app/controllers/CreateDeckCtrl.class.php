<?php

namespace app\controllers;

use core\App;
use core\RoleUtils;
use core\ParamUtils;
use app\forms\CreateDeckForm;
use core\Utils;

class CreateDeckCtrl {
    
    private $form;

    public function __construct() {
        $this->form = new CreateDeckForm();
    }

    public function validatePremium() {
        if (!RoleUtils::inRole("premium")) {
            $existingDecksCount = App::getDB()->count("deck", [
                "user_id" => App::getConf()->user_id,
            ]);
            if ($existingDecksCount >= 5) {
                Utils::addErrorMessage('Aby dodać więcej niż 5 talii, ulepsz konto do wersji premium!');
                return false;
            }
        }
        return true;
    }

    public function validate() {
        $this->form->name = ParamUtils::getFromRequest('name');
        $this->form->favorite = ParamUtils::getFromRequest('favorite') ?? 0;

        if (!isset($this->form->name))
            return false;

        if (empty($this->form->name)) {
            Utils::addErrorMessage('Nie podano nazwy');
        }

        return !App::getMessages()->isError();
    }

    public function addDeck() {
        App::getDB()->insert("deck", [
            "name" => $this->form->name,
            "favorite" => $this->form->favorite,
            "user_id" => App::getConf()->user_id,
        ]);
    }

    public function action_createDeck() {
        if (!$this->validatePremium()) {
            App::getRouter()->forwardTo("userPage");
            return;
        }
        if ($this->validate()) {
            $this->addDeck();
            App::getRouter()->redirectTo("userPage");
        } else {
            $this->generateView();
        }
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('CreateDeckView.tpl');
    }

}
