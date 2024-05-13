<?php

namespace app\controllers;

use core\App;
use core\RoleUtils;
use core\ParamUtils;

class DeckCtrl {
    
    public function getCardsData() {
        $deckId = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        $cards = App::getDB()->select("card_in_deck", [
            "[>]user_card" => ["card_id" => "id"],
            "[>]card" => ["card_id" => "id"]
        ], [
            "card.name",
        ], [
            "card_in_deck.deck_id" => $deckId
        ]);
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
    
    public function getUsersDecksData() {
        return App::getDB()->query("SELECT deck.id, name, favorite, COUNT(card_in_deck.card_id) cards_in 
        FROM deck LEFT JOIN card_in_deck ON deck.id = card_in_deck.deck_id GROUP BY id, name, favorite")->fetchAll();
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

    public function generateView() {
        App::getSmarty()->assign('cards', $this->getCardsData());
        App::getSmarty()->assign('deck', $this->getDeckData());
        App::getSmarty()->display('DeckView.tpl');
    }

}
