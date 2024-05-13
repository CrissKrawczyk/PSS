<?php
/* Smarty version 3.1.30, created on 2024-05-12 12:00:30
  from "C:\xampp\htdocs\PSS\cards\app\views\CreateDeckView.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6640933e6e2009_69217817',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9b489f03dedc17a26b5778d7e9c8247a21dcfe0b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PSS\\cards\\app\\views\\CreateDeckView.tpl',
      1 => 1715508025,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
  ),
),false)) {
function content_6640933e6e2009_69217817 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14149700466640933e6d17b6_99794188', 'top');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'top'} */
class Block_14149700466640933e6d17b6_99794188 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
createDeck" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Dodaj kartę</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="id_name">Nazwa: </label>
			<input id="id_name" type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->name;?>
"/><br />
		</div>
        <div class="pure-control-group">
			<label for="id_favorite">Ulubione: </label>
			<input id="id_favorite" type="checkbox" name="favorite" value="1"/><br />
		</div>
		<div class="pure-controls">
			<input type="submit" value="dodaj" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>	
<?php
}
}
/* {/block 'top'} */
}
