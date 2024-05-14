{extends file="main.tpl"}

{block name=top}
<h1>Panel admina</h1>
<a class="pure-button button-small"  href="{$conf->app_root}\generateTestCode">Utwórz testowy kod premium</a>
<br>
<br>
<h2>Lista użytkowników:</h2>
<table class="pure-table pure-table-bordered">
    <thead>
        <tr>
            <th>id</th>
            <th>Login</th>
            <th>E-mail</th>
            <th>Role</th>
            <th>Usuń</th>
            <th>Admin</th>
        </tr>
    </thead>
    <tbody>
    {foreach $users as $user}
    {strip}
        <tr>
            <td>{$user["id"]}</td>
            <td>{$user["login"]}</td>
            <td>{$user["email"]}</td>
            <td>
            {if $user["isPremium"]}
                premium
            {else}
                user
            {/if}
            {if $user["isAdmin"]}
                , admin
            {/if}</td>
            <td>
                <a class="button-small pure-button button-warning"
			    onclick="confirmLink('{$conf->action_url}deleteUser/{$user['id']}','Czy na pewno usunąć użytkownika {$user['login']}?')">Usuń</a>
              </td>
              <td>
                <a class="button-small pure-button button-warning"
			    onclick="confirmLink('{$conf->action_url}
                {if $user["isAdmin"]}
                    remove{else}give
                {/if}
                AdminRole/{$user['id']}','Czy na pewno chcesz{if $user["isAdmin"]} odebrać {else} nadać {/if}uprawnienia admina użytkownikowi {$user['login']}?')"
                >
                {if $user["isAdmin"]}Odbierz admina{else}Nadaj admina{/if}
                </a>
              </td>
        </tr>
    {/strip}
    {/foreach}
    </tbody>
</table>
<br>
<a class="pure-button button-small" href="{$conf->app_root}\createUser">Dodaj użytkownika</a>
<div><a class="go-back" href={$conf->app_root}\welcomeScreen>Wróć</a></div>
{/block}
