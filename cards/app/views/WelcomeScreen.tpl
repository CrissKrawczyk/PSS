{extends file="main.tpl"}

{block name=top}
<div class="welcome-container">
    <h1>Witamy na stronie Gry karcianej "The Card Game"</h1>
    {if $isAdmin}
    <a class="pure-button" href="{$conf->app_root}\adminPage">Przejdź do konfiguracji systemu</a>
    {/if}
    <a class="pure-button" href="{$conf->app_root}\userPage">Przejdź do kreatora talii!</a>
</div>
{/block}
