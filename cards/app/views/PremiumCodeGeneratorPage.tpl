{extends file="main.tpl"}

{block name=top}
{if $code}
<div>Twój kod: {$code}</div>
{else}
<a href="{$conf->app_root}\buyCode">Kup kod!</a>
{/if}
<div><a class="go-back" href={$conf->app_root}\userPage>Wróć</a></div>
{/block}
