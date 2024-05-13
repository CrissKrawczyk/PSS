{extends file="main.tpl"}

{block name=top}
<div>Talia {$deck["name"]}!</div>
{if $deck["favorite"]}
Ulubione!
<a href="{$conf->app_root}\removeDeckFromFav\{$deck["id"]}">Usuń z ulubionych</a>
{else}
<a href="{$conf->app_root}\addDeckToFav\{$deck["id"]}">Dodaj do ulubionych</a>
{/if}

<table class="pure-table pure-table-bordered">
    <thead>
        <tr>
            <th>Nazwa</th>
        </tr>
    </thead>
    <tbody>
    {foreach $cards as $card}
    {strip}
        <tr>
            <td>{$card["name"]}</td>
        </tr>
    {/strip}
    {/foreach}
    </tbody>
</table>

{/block}
