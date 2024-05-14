{extends file="main.tpl"}

{block name=top}
<form action="{$conf->action_root}useCode" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Wykorzystanie kodu</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="id_code">Kod: </label>
			<input id="id_code" type="text" name="code" value="{$form->code}"/>
		</div>
		<div class="pure-controls">
			<input type="submit" value="Użyj kodu" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>	
<div><a class="go-back" href={$conf->app_root}\userPage>Wróć</a></div>
{/block}
