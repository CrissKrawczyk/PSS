<?php
require_once dirname(__FILE__).'/../config.php';
require_once _ROOT_PATH.'/app/utils/base_utils.php';
include _ROOT_PATH.'/app/security/check.php';

function getParams(&$amount, &$time, &$interest){
    $amount = isset ($_REQUEST ['amount']) ? $_REQUEST ['amount'] : null;
    $time = isset ($_REQUEST ['time']) ? $_REQUEST ['time'] : null;
    $interest = isset ($_REQUEST ['interest']) ? $_REQUEST ['interest'] : null;
}

function validate(&$amount, &$time, &$interest, &$messages) {
    if ( ! (isset($amount) && isset($time) && isset($interest))) {
        return false;
    }

    if ( $amount == "") {
        $messages [] = 'Nie podano wartości kredytu';
    }
    if ( $time == "") {
        $messages [] = 'Nie podano liczby czasu spłaty kredytu';
    }
    if ( $interest == "") {
        $messages [] = 'Nie podano oprocentowania';
    }

    if (empty( $messages )) {
        $amount = str_replace(",", ".", $amount);
        $interest = str_replace(",", ".", $interest);
        if (! is_numeric( $amount )) {
            $messages [] = 'Kwota kredytu nie jest liczbą!';
        }

        if (! is_numeric( $time )) {
            $messages [] = 'Czas spłaty nie jest liczbą całkowitą!';
        }

        if (! is_numeric( $interest )) {
            $messages [] = 'Oprocentowanie nie jest liczbą!';
        }
    }

    if (empty ( $messages )) {

        $amount = floatval($amount);
        $time = intval($time);
        $interest = floatval($interest);

        if ($amount <= 0) {
            $messages [] = 'Kwota kredytu musi być większa od 0';
        }

        if ($time <= 0) {
            $messages [] = 'Czas spłaty musi wynosić przynajmniej rok';
        }
    }
    return empty ( $messages );
}

function validateSecurity(&$amount, $interest, &$messages) {
    global $role;
    if ($amount > 10000 && $role != 'admin') {
        $messages [] = 'Tylko admin może brać kredyt o kwocie większej niż 10 000';
    }
    if ($interest <= 0 && $role != 'admin') {
            $messages [] = 'Tylko admin może brać kredyt bez oprocentowania';
        }
    return empty ( $messages );
}

$amount = null;
$time = null;
$interest = null;
$result = null;
$messages = array();
getParams($amount, $time, $interest);

if (validate($amount, $time, $interest, $messages) && validateSecurity($amount, $interest, $messages)) {
	$timeInMonths = $time * 12;
	$result = ($amount / $timeInMonths) * (($interest / 100) + 1);
}

include 'calc_view.php';