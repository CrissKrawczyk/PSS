<?php

namespace app\controllers;

use core\App;
use core\RoleUtils;

class UserCtrl {
    
    public function getUsersCardsData() {
        $userId = RoleUtils::getUserId();
        return App::getDB()->query("SELECT card.id, name, price, COUNT(user_card.id) quantity 
        FROM card JOIN user_card ON card.id = user_card.card_id WHERE user_card.user_id = $userId 
        GROUP BY id, name, price")->fetchAll();
    }
    
    public function getUsersDecksData() {
        $userId = RoleUtils::getUserId();
        return App::getDB()->query("SELECT deck.id, name, favorite, COUNT(card_in_deck.card_id) cards_in 
        FROM deck LEFT JOIN card_in_deck ON deck.id = card_in_deck.deck_id WHERE deck.user_id = $userId 
        GROUP BY id, name, favorite")->fetchAll();
    }

    public function action_userPage() {
        $this->generateView();
    }

    public function generateView() {
        $hasPremium = RoleUtils::inRole("premium");
        $isTestPremium = $hasPremium ? App::getDB()->get("premium_code", "test_code", [
            "user_id" => RoleUtils::getUserId(),
        ]) : false;
        App::getSmarty()->assign('hasPremium', $hasPremium);
        App::getSmarty()->assign('isTestPremium', $isTestPremium);
        App::getSmarty()->assign('cards', $this->getUsersCardsData());
        App::getSmarty()->assign('decks', $this->getUsersDecksData());
        App::getSmarty()->display('UserPage.tpl');
    }

}
