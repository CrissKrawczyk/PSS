<?php

namespace app\controllers;

use core\App;
use core\RoleUtils;
use core\ParamUtils;
use app\forms\AddCardForm;
use core\Utils;

class AddCardCtrl {
    
    private $form;

    public function __construct() {
        $this->form = new AddCardForm();
    }

    public function validate() {
        $this->form->name = ParamUtils::getFromRequest('name');
        $this->form->price = ParamUtils::getFromRequest('price');

        if (!isset($this->form->name) || !isset($this->form->price))
            return false;

        if (empty($this->form->name)) {
            Utils::addErrorMessage('Nie podano nazwy');
        }

        return !App::getMessages()->isError();
    }

    public function addCard() {
        App::getDB()->insert("card", [
            "name" => $this->form->name,
            "price" => $this->form->price
        ]);
    }

    public function action_addCard() {
        if ($this->validate()) {
            $this->addCard();
            App::getRouter()->redirectTo("addUserCard");
        } else {
            $this->generateView();
        }
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('AddCardView.tpl');
    }

}
