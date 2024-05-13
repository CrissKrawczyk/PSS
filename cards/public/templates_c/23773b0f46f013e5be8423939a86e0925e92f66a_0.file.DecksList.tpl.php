<?php
/* Smarty version 3.1.30, created on 2024-05-12 21:10:03
  from "C:\xampp\htdocs\PSS\cards\app\views\DecksList.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6641140ba21697_50502674',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '23773b0f46f013e5be8423939a86e0925e92f66a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PSS\\cards\\app\\views\\DecksList.tpl',
      1 => 1715540998,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6641140ba21697_50502674 (Smarty_Internal_Template $_smarty_tpl) {
?>
<form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
addToDeck" method="post" class="pure-form pure-form-aligned bottom-margin">
	<fieldset>
        <div class="pure-control-group">
			<label for="id_deck">Talia: </label>
			<select id="id_deck" name='deckId'>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['decks']->value, 'deck');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['deck']->value) {
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['deck']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['deck']->value['name'];?>
</option>
    			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

			</select>
            <input type="text" name="cardId" value="<?php echo $_smarty_tpl->tpl_vars['cardId']->value;?>
" />
		</div>
		<div class="pure-controls">
			<input type="submit" value="dodaj" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>	<?php }
}
