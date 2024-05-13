{extends file="main.tpl"}

{block name=top}
<div>Admin page!</div>
<a href="{$conf->app_root}\generateTestCode">Utwórz testowy kod!</a>
<script>console.log({$users})</script>
<table class="pure-table pure-table-bordered">
    <thead>
        <tr>
            <th>id</th>
            <th>Login</th>
            <th>E-mail</th>
            <th>Role</th>
            <th>Usuń</th>
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
        </tr>
    {/strip}
    {/foreach}
    </tbody>
</table>
<a href="{$conf->app_root}\createUser">Dodaj użytkownika</a>
{/block}
