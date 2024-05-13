{extends file="main.tpl"}

{block name=top}
{if $hasPremium}
<div>Jesteś premium!!!</div>
{/if}
{if $isTestPremium}
<div>(UWAGA KORZYSTASZ Z TESTOWEJ WERSJI PREMIUM!!)</div>
{/if}
<div>User page!</div>
{if !$hasPremium}
<a href="{$conf->app_root}\showCodeGenerator">Kup kod!</a>
<a href="{$conf->app_root}\useCode">Wykorzystaj kod!</a>
{/if}
<a href="{$conf->app_root}\addUserCard">Dodaj kartę!</a>
<a href="{$conf->app_root}\createDeck">Utwórz talię!</a>

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
                <fieldset>
                    <input type="text" name="cardId" value="{$card["id"]}" /><br />
                    <button type="submit" class="pure-button pure-button-primary">+</button>
                </fieldset>
            </form>
            <div id="add-to-deck{$card["id"]}">
            </div>
              </td>
        </tr>
    {/strip}
    {/foreach}
    </tbody>
</table>

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

{/block}
