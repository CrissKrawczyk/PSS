<?php

namespace app\controllers;

use core\App;
use core\RoleUtils;
use core\ParamUtils;
use app\forms\CreateDeckForm;
use core\Utils;

class AddToDeckCtrl {

    public function getUsersDecksData() {
        $cardId = ParamUtils::getFromRequest('cardId');
        $userId = RoleUtils::getUserId();
        $query = "WITH having_cards as (SELECT COUNT(1) owned 
        FROM card JOIN user_card ON user_card.card_id = card.id WHERE user_id = $userId AND card.id = $cardId)
        select id, name, COUNT(card_in_deck.card_id) used, owned 
        FROM deck JOIN having_cards ON 1=1 LEFT JOIN card_in_deck ON deck.id = card_in_deck.deck_id 
        WHERE user_id = 9 GROUP BY id, name, owned HAVING used < owned";
        $decks = App::getDB()->query($query)->fetchAll();
        return $decks;
    }

    public function action_addToDeckList() {
        $cardId = ParamUtils::getFromRequest('cardId');
        App::getSmarty()->assign('decks', $this->getUsersDecksData());
        App::getSmarty()->assign('cardId', $cardId);
        App::getSmarty()->display('DecksList.tpl');
    }

    public function action_addToDeck() {
        $cardId = ParamUtils::getFromRequest('cardId');
        $deckId = ParamUtils::getFromRequest('deckId');
        if (isset($cardId) && isset($deckId)) {
            App::getDB()->insert("card_in_deck", [
                "card_id" => $cardId,
                "deck_id" => $deckId
            ]);
        }
        App::getRouter()->redirectTo("userPage");
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('CreateDeckView.tpl');
    }

}
