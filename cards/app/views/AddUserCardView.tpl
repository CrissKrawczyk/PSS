{extends file="main.tpl"}

{block name=top}
<script>
  $(function () {
    $("select").selectize([]);
  });
</script>
<form action="{$conf->action_root}addUserCard" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Dodaj kartę</legend>
	<fieldset>
        <div class="pure-control-group">
			<div class="selectize-form-container">
				<label for="id_card">Karta: </label>
				<div class="selectize-field-container">
					<select id="id_card" name='card_id'>
						{foreach $cards as $card}
						{strip}
							<option value="{$card['id']}">{$card['name']}</option>
						{/strip}
						{/foreach}
					</select>
				</div>
			</div>
		</div>
        <div class="pure-control-group">
			<label for="id_quantity">Ilość: </label>
			<input min='1' id="id_quantity" type="number" name="quantity" value="{$form->quantity}"/><br />
		</div>
		<div class="pure-controls">
			<input type="submit" value="dodaj" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>	
<p>Brakuje twojej karty w systemie?</p><a class="pure-button button-small" href="{$conf->app_root}\addCard">Dodaj ją!</a>
<div><a class="go-back" href={$conf->app_root}\userPage>Wróć</a></div>
{/block}
