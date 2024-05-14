{extends file="main.tpl"}

{block name=top}
<h1>Oto twoja talia <i>'{$deck["name"]}'</i>!</h1>
{if $deck["favorite"]}
<h3>Ulubione!</h3>
<a class="pure-button button-small" href="{$conf->app_root}\removeDeckFromFav\{$deck["id"]}">Usuń z ulubionych</a>
{else}
<a class="pure-button button-small" href="{$conf->app_root}\addDeckToFav\{$deck["id"]}">Dodaj do ulubionych</a>
{/if}

<table class="pure-table pure-table-bordered">
    <thead>
        <tr>
            <th>Nazwa</th>
            <th>Usuń</th>
        </tr>
    </thead>
    <tbody>
    {foreach $cards as $card}
    {strip}
        <tr>
            <td>{$card["name"]}</td>
            <td><a class="button-small pure-button button-warning" href={$conf->action_url}removeUserCard/{$deck["id"]}/{$card["id"]}>Usuń</td>
        </tr>
    {/strip}
    {/foreach}
    </tbody>
</table>
<div><a class="go-back" href={$conf->app_root}\userPage>Wróć</a></div>
{/block}
