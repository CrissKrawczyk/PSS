<?php
/* Smarty version 3.1.30, created on 2024-05-11 18:09:16
  from "C:\xampp\htdocs\PSS\cards\app\views\AddCardView.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_663f982c8b64f8_18804206',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4ea196068ff9fefd0ef50dba2f2f3cc628342883' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PSS\\cards\\app\\views\\AddCardView.tpl',
      1 => 1715443661,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
  ),
),false)) {
function content_663f982c8b64f8_18804206 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1984522932663f982c8b5f07_33007842', 'top');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'top'} */
class Block_1984522932663f982c8b5f07_33007842 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
addCard" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Dodaj kartę</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="id_name">Nazwa: </label>
			<input id="id_name" type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->name;?>
"/><br />
		</div>
        <div class="pure-control-group">
			<label for="id_price">Cena: </label>
			<input id="id_price" type="number" name="price" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->price;?>
"/><br />
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
