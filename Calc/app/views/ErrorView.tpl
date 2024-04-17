{if isset($messages)}
    {if $messages->hasError()}
        <h4>Wystąpiły błędy: </h4>
        <ol class="err">
        {foreach  $messages->getErrors() as $msg}
        {strip}
            <li>{$msg}</li>
        {/strip}
        {/foreach}
        </ol>
    {/if}
{/if}