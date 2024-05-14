{extends file="main.tpl"}

{block name=top}
<form action="{$conf->action_root}addCard" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Dodaj kartę</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="id_name">Nazwa: </label>
			<input id="id_name" type="text" name="name" value="{$form->name}"/><br />
		</div>
        <div class="pure-control-group">
			<label for="id_price">Cena: </label>
			<input id="id_price" type="number" name="price" value="{$form->price}"/><br />
		</div>
		<div class="pure-controls">
			<input type="submit" value="dodaj" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>
<div><a class="go-back" href={$conf->app_root}\addUserCard>Wróć</a></div>
{/block}
