{extends file="main.tpl"}

{block name=top}
<form action="{$conf->action_root}
			{if isset($goTo)}
				{$goTo}
			{else}
				signUp
			{/if}
			" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>
	{if isset($title)}
		{$title}
	{else}
		Rejestracja
	{/if}
	</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="id_email">E-mail: </label>
			<input id="id_email" type="text" name="email" value="{$form->email}"/><br />
		</div>
        <div class="pure-control-group">
			<label for="id_login">Login: </label>
			<input id="id_login" type="text" name="login" value="{$form->login}"/>
		</div>
        <div class="pure-control-group">
			<label for="id_pass">Hasło: </label>
			<input id="id_pass" type="password" name="pass" /><br />
		</div>
        <div class="pure-control-group">
			<label for="id_pass2">Powtórz hasło: </label>
			<input id="id_pass2" type="password" name="pass2" /><br />
		</div>
		<div class="pure-controls">
			<input type="submit" value="
			{if isset($submitCaption)}
				{$submitCaption}
			{else}
				zarejestruj się!
			{/if}
			" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>	
{/block}
