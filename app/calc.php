<?php
require_once dirname(__FILE__).'/../config.php';

$amount = $_REQUEST ['amount'];
$time = $_REQUEST ['time'];
$interest = $_REQUEST ['interest'];
if ( ! (isset($amount) && isset($time) && isset($interest))) {
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
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

if (empty ( $messages )) {
	$timeInMonths = $time * 12;
	$result = ($amount / $timeInMonths) * (($interest / 100) + 1);
}

include 'calc_view.php';