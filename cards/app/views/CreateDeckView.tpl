{extends file="main.tpl"}

{block name=top}
<form action="{$conf->action_root}createDeck" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Dodaj kartę</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="id_name">Nazwa: </label>
			<input id="id_name" type="text" name="name" value="{$form->name}"/><br />
		</div>
        <div class="pure-control-group">
			<label for="id_favorite">Ulubione: </label>
			<input id="id_favorite" type="checkbox" name="favorite" value="1"/><br />
		</div>
		<div class="pure-controls">
			<input type="submit" value="dodaj" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>	
{/block}
