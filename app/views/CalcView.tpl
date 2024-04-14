{extends file="main.html"}

{block name=header}
    <span class="title">Wpisz wartości i dowiedz się o racie kredytu!</span>
    <br>
    <span class="tagline">Zalogowano jako: {$user_login}</span>
{/block}

{block name=footer}Epic Loan Installment Calculator 2024 by Krzysztof Kolarczyk{/block}
{block name=underfooter}Using Initio template{/block}

{block name=navbar}
<li class="active">
	<a href="{$conf->action_url}logout" class="pure-button pure-button-active">Wyloguj</a>
</li>
{/block}
{block name=content}

<form action="{$conf->action_url}calcCompute" method="post">
	<label for="id_amount">Kwota kredytu: </label>
	<input id="id_amount" type="text" name="amount" value="{$form->amount}" /><br />
	<label for="id_time">Czas spłaty w latach: </label>
	<input id="id_time" type="text" name="time" value="{$form->time}" /><br />
	<label for="id_interest">Oprocentowanie [%]: </label>
	<input id="id_interest" type="text" name="interest" value="{$form->interest}" /><br />
	<input type="submit" value="Oblicz wysokość miesięsznej raty" />
</form>	

{include "ErrorView.tpl"}

{if isset($result->result)}
	<h4>Wynik</h4>
	<p class="res">
	{$result->result}
	</p>
{/if}

{/block}