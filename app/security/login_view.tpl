{extends file="`$root_path`/assets/main.html"}

{block name=header}
    <span class="title">Zaloguj się, abu skorzystać z kalkulatora!</span>
    <br>
    <span class="tagline">user: user<br>
{/block}
{block name=footer}Epic Loan Installment Calculator 2024 by Krzysztof Kolarczyk{/block}
{block name=underfooter}Using Initio template{/block}

{block name=content}

<div style="width:90%; margin: 2em auto;">

<form action="{$app_root}/app/security/login.php" method="post" class="pure-form pure-form-stacked">
	<legend>Logowanie</legend>
	<fieldset>
		<label for="id_login">login: </label>
		<input id="id_login" type="text" name="login" value="{$form && $form['login']}" />
		<label for="id_pass">pass: </label>
		<input id="id_pass" type="password" name="pass" />
	</fieldset>
	<input type="submit" value="zaloguj" class="pure-button pure-button-primary"/>
</form>	

{include "`$root_path`/app/utils/error_view.tpl"}

</div>
{/block}