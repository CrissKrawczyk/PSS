<div class="decks-list-container">
	<div class="decks-list-shadow"></div>
	<div class="decks-list-window">
		<div class="dialog-window-close" onClick="document.getElementById('add-to-deck{$cardId}').innerHTML = ''">x</div>
		<form class="decks-list-form" action="{$conf->action_root}addToDeck" method="post" class="pure-form pure-form-aligned bottom-margin">
			<div class="pure-control-group">
				<label for="id_deck">Talia: </label>
				<select id="id_deck" name='deckId'>
					{foreach $decks as $deck}
					{strip}
						<option value="{$deck['id']}">{$deck['name']}</option>
					{/strip}
					{/foreach}
				</select>
				<input type="hidden" name="cardId" value="{$cardId}" />
			</div>
			<div class="pure-controls">
				<input type="submit" value="dodaj" class="pure-button pure-button-primary"/>
			</div>
		</form>	
	</div>
</div>