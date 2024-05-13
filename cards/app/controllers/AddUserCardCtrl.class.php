<?php

namespace app\controllers;

use core\App;
use core\RoleUtils;
use app\forms\AddUserCardForm;
use core\ParamUtils;
use core\Utils;

class AddUserCardCtrl {
    
    private $form;

    public function __construct() {
        $this->form = new AddUserCardForm();
    }

    public function getCards() {
        $cards = App::getDB()->select("card", [
            "id",
            "name"
        ]);
        return  $cards;
    }

    public function validate() {
        $this->form->card_id = ParamUtils::getFromRequest('card_id');
        $this->form->quantity = ParamUtils::getFromRequest('quantity');

        if (!isset($this->form->card_id) || !isset($this->form->quantity))
            return false;

        if (empty($this->form->card_id)) {
            Utils::addErrorMessage('Nie podano karty');
        }
        if (empty($this->form->quantity)) {
            Utils::addErrorMessage('Nie podano ilości');
        }

        return !App::getMessages()->isError();
    }

    public function addCard() {
        for ($i = 0; $i < $this->form->quantity; $i++) {
            App::getDB()->insert("user_card", [
                "card_id" => $this->form->card_id,
                "user_id" => App::getConf()->user_id,
                "date_added" => date("Y-m-d")
            ]);
        }
    }

    public function action_addUserCard() {
        if ($this->validate()) {
            $this->addCard();
            App::getRouter()->redirectTo("userPage");
        } else {
            $this->form->quantity = 1;
            $this->generateView();
        }
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->assign('cards', $this->getCards());
        App::getSmarty()->display('AddUserCardView.tpl');
    }

}
