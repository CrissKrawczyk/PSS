<?php

namespace app\controllers;

use core\App;
use core\RoleUtils;
use core\ParamUtils;
use app\forms\CreateDeckForm;
use core\Utils;

class AddToDeckCtrl {

    public function validateSessionUser() {
        $deckId = ParamUtils::getFromRequest('deckId');
        if (empty($deckId))
            return true;
        $userId = RoleUtils::getUserId();
        if (empty(App::getDB()->get("deck", ["id"], ["id" => $deckId,"user_id" => $userId])))
            return false;
        return true;

    }

    public function wrongSessionUserRedirect() {
        App::getRouter()->redirectTo('userPage');
    }

    public function getUsersDecksData() {
        $cardId = ParamUtils::getFromRequest('cardId');
        $userId = RoleUtils::getUserId();
        $query = "WITH having_cards as (SELECT COUNT(1) owned 
        FROM card JOIN user_card ON user_card.card_id = card.id WHERE user_id = $userId AND card.id = $cardId)
        select d.id, name, COUNT(uc.id) used, owned 
        FROM deck d JOIN having_cards ON 1=1 
        LEFT JOIN card_in_deck cid ON d.id = cid.deck_id 
        LEFT JOIN user_card uc ON uc.id = cid.card_id AND uc.card_id = $cardId
        WHERE d.user_id = $userId GROUP BY id, name, owned HAVING used < owned";
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
        $userId = RoleUtils::getUserId();
        if (isset($cardId) && isset($deckId)) {
            App::getDB()->query(
                "INSERT INTO card_in_deck (card_id, deck_id) 
                SELECT uc.id, $deckId 
                FROM user_card uc 
                WHERE uc.user_id = $userId AND uc.card_id = $cardId 
                AND NOT EXISTS(
                    SELECT 1 FROM card_in_deck cid WHERE cid.deck_id = $deckId AND cid.card_id = uc.id) 
                LIMIT 1");
        }
        App::getRouter()->redirectTo("userPage");
    }

}
