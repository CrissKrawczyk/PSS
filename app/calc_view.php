<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator raty kredytu</title>
</head>
<body>

<div style="width:90%; margin: 2em auto;">
	<a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>

<form action="<?php print(_APP_URL);?>/app/calc.php" method="post">
	<label for="id_amount">Kwota kredytu: </label>
	<input id="id_amount" type="text" name="amount" value="<?php out($amount); ?>" /><br />
	<label for="id_time">Czas spłaty w latach: </label>
	<input id="id_time" type="text" name="time" value="<?php out($time); ?>" /><br />
	<label for="id_interest">Oprocentowanie [%]: </label>
	<input id="id_interest" type="text" name="interest" value="<?php out($interest); ?>" /><br />
	<input type="submit" value="Oblicz wysokość miesięsznej raty" />
</form>	

<?php
    include _ROOT_PATH.'/app/utils/error_view.php';
?>

<?php if (isset($result)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
<?php echo 'Wynik: '.$result; ?>
</div>
<?php } ?>

</body>
</html>