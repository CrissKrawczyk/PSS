<?php

namespace app\controllers;

use core\App;
use core\Utils;

class CodeGeneratorCtrl {

    private $isTestCode;
    private $code;

    public function action_showCodeGenerator() {
        App::getSmarty()->assign('code', "");
        $this->generateView();
    }

    private function processPayment() {
        //No payment logic for now
        return false;
    }

    private function generateCode() {
        while(!isset($this->code)) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 16; $i++) {
                $randomString .= $characters[random_int(0, $charactersLength - 1)];
            }
            $exsistingCode = App::getDB()->select("premium_code", 
            [
                "code"
            ], [
                "code" => $randomString,
            ]);
            if (empty($exsistingCode))
                $this->code = $randomString;
        }
        App::getDB()->insert("premium_code", [
            "code" => $this->code,
            "test_code" => $this->isTestCode
        ]);
    }

    public function action_buyCode() {
        $isFreeCode = App::getConf()->free_codes;
        $this->isTestCode = false;
        if (!$isFreeCode && !$this->processPayment())
            Utils::addErrorMessage('Płatność nie udana');
        else {
            $this->generateCode();
        }
        App::getSmarty()->assign('code', $this->code);
        $this->generateView();
    }

    public function action_generateTestCode() {
        $this->isTestCode = true;
        $this->generateCode();
        App::getSmarty()->assign('code', $this->code);
        $this->generateView();
    }

    public function generateView() {
        App::getSmarty()->display('PremiumCodeGeneratorPage.tpl');
    }

}
