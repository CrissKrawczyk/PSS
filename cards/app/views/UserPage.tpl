{extends file="main.tpl"}

{block name=top}
<h1>Panel użytkownika:</h1>
{if $hasPremium}
<div class="premium-text">Jesteś premium!!!</div>
{/if}
{if $isTestPremium}
<div class="test-premium-text">(UWAGA KORZYSTASZ Z TESTOWEJ WERSJI PREMIUM!!)</div>
{/if}
{if !$hasPremium}
<div class="no-premium-text">nie jesteś premium... Kup kod i ulepsz swoje konto!</div>
<a class="pure-button button-small" href="{$conf->app_root}\showCodeGenerator">Kup kod!</a>
<a class="pure-button button-small" href="{$conf->app_root}\useCode">Wykorzystaj kod!</a>
{/if}
<br>

<div class="user-tables-container">
<div>
<a class="pure-button button-xlarge" href="{$conf->app_root}\addUserCard">Dodaj kartę!</a>
{if count($cards) > 0}
<table class="pure-table pure-table-bordered">
    <thead>
        <tr>
            <th>Nazwa</th>
            <th>Wartość</th>
            <th>Ilość</th>
            <th>Dodaj do talii</th>
        </tr>
    </thead>
    <tbody>
    {foreach $cards as $card}
    {strip}
        <tr>
            <td>{$card["name"]}</td>
            <td>{$card["price"]}</td>
            <td>{$card["quantity"]}</td>
            <td>
            <form id="add-to-deck-form{$card["id"]}" class="pure-form pure-form-stacked" onsubmit="ajaxPostForm('add-to-deck-form{$card["id"]}','{$conf->action_root}addToDeckList','add-to-deck{$card["id"]}'); return false;">
                    <input type="hidden" name="cardId" value="{$card["id"]}" />
                    <button type="submit" class="pure-button pure-button-primary">+</button>
            </form>
            <div id="add-to-deck{$card["id"]}">
            </div>
              </td>
        </tr>
    {/strip}
    {/foreach}
    </tbody>
</table>
{else}
<h3>Nie posiadasz żadnych kart... Dodaj nową przyciskiem powyżej!</h3>
{/if}
</div>

<div>
<a class="pure-button button-xlarge" href="{$conf->app_root}\createDeck">Utwórz talię!</a>
{if count($decks) > 0}
<table class="pure-table pure-table-bordered">
    <thead>
        <tr>
            <th>Nazwa</th>
            <th>Ilość kart</th>
            <th>Ulubione</th>
            <th>Otwórz</th>
            <th>Usuń</th>
        </tr>
    </thead>
    <tbody>
    {foreach $decks as $deck}
    {strip}
        <tr>
            <td>{$deck["name"]}</td>
            <td>{$deck["cards_in"]}</td>
            <td>{if $deck["favorite"]}*{/if}</td>
            <td><a href="{$conf->app_root}\deckPage\{$deck["id"]}">Przejdź</a></td>
            <td>
            <a class="button-small pure-button button-warning"
			    onclick="confirmLink('{$conf->action_url}deleteDeck/{$deck['id']}','Czy na pewno usunąć talię {$deck['name']}?')">Usuń</a>
            </td>
        </tr>
    {/strip}
    {/foreach}
    </tbody>
</table>
{else}
<h3>Nie posiadasz żadnych talii... Dodaj nową przyciskiem powyżej!</h3>
{/if}
</div>

</div>
<div><a class="go-back" href={$conf->app_root}\welcomeScreen>Wróć</a></div>
{/block}
