<form action="{$conf->action_root}addToDeck" method="post" class="pure-form pure-form-aligned bottom-margin">
	<fieldset>
        <div class="pure-control-group">
			<label for="id_deck">Talia: </label>
			<select id="id_deck" name='deckId'>
				{foreach $decks as $deck}
				{strip}
					<option value="{$deck['id']}">{$deck['name']}</option>
				{/strip}
    			{/foreach}
			</select>
            <input type="text" name="cardId" value="{$cardId}" />
		</div>
		<div class="pure-controls">
			<input type="submit" value="dodaj" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>	