{extends file="main.tpl"}

{block name=top}
{if $code}
<div>Twój kod: {$code}</div>
{else}
<a href="{$conf->app_root}\buyCode">Kup kod!</a>
{/if}
{/block}
