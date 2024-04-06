{if isset($messages)}
    {if count($messages) > 0}
        <h4>Wystąpiły błędy: </h4>
        <ol class="err">
        {foreach  $messages as $msg}
        {strip}
            <li>{$msg}</li>
        {/strip}
        {/foreach}
        </ol>
    {/if}
{/if}