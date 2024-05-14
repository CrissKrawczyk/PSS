<?php

namespace app\controllers;

use core\App;
use core\RoleUtils;
use core\ParamUtils;

class DeckCtrl {

    public function validateSessionUser() {
        $deckId = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        $userId = RoleUtils::getUserId();
        if (empty(App::getDB()->get("deck", ["id"], ["id" => $deckId,"user_id" => $userId])))
            return false;
        return true;

    }

    public function wrongSessionUserRedirect() {
        App::getRouter()->redirectTo('userPage');
    }
    
    public function getCardsData() {
        $deckId = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        $cards = App::getDB()->query("SELECT c.name , uc.id
        FROM card_in_deck cid 
        JOIN user_card uc ON cid.card_id = uc.id 
        JOIN card c ON c.id = uc.card_id 
        WHERE cid.deck_id = $deckId")->fetchAll();
        return $cards;
    }
    
    public function getDeckData() {
        $deckId = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        $deckData = App::getDB()->get("deck", [
            "name",
            "id",
            "favorite",
        ], [
            "id" => $deckId
        ]);
        return $deckData;
    }

    public function action_deckPage() {
        $this->generateView();
    }

    public function action_deleteDeck() {
        App::getDB()->delete("card_in_deck", [
            "deck_id" => ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji')
        ]);
        App::getDB()->delete("deck", [
            "id" => ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji')
        ]);
        App::getRouter()->forwardTo('userPage');
    }

    public function action_addDeckToFav() {
        $deckId = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        App::getDB()->update("deck", [
            "favorite" => 1
        ],[
            "id" => $deckId
        ]);
        $this->generateView();
    }

    public function action_removeDeckFromFav() {
        $deckId = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        App::getDB()->update("deck", [
            "favorite" => 0
        ],[
            "id" => $deckId
        ]);
        $this->generateView();
    }

    public function action_removeUserCard() {
        $deckId = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        $cardId = ParamUtils::getFromCleanURL(2, true, 'Błędne wywołanie aplikacji');
        App::getDB()->delete("card_in_deck", [
            "card_id" => $cardId,
            "deck_id" => $deckId
        ]);
        App::getRouter()->redirectTo('deckPage/'.$deckId);
    }

    public function generateView() {
        App::getSmarty()->assign('cards', $this->getCardsData());
        App::getSmarty()->assign('deck', $this->getDeckData());
        App::getSmarty()->display('DeckView.tpl');
    }

}
