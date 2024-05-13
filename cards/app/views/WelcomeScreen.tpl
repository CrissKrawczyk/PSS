{extends file="main.tpl"}

{block name=top}
<div>Witamy!!!!</div>
{if $isAdmin}
<a href="{$conf->app_root}\adminPage">Przejdź na stronę admina!</a>
{/if}
<a href="{$conf->app_root}\userPage">Przejdź do swoich talii!</a>
{/block}
