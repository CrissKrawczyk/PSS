<?php
/* Smarty version 3.1.30, created on 2024-05-11 18:58:41
  from "C:\xampp\htdocs\PSS\cards\app\views\AddUserCardView.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_663fa3c134a695_63675900',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7712d42bf6baed3345dfb01b0d54c0ca567f9c2e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PSS\\cards\\app\\views\\AddUserCardView.tpl',
      1 => 1715446717,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
  ),
),false)) {
function content_663fa3c134a695_63675900 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_795996320663fa3c134a258_35669145', 'top');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'top'} */
class Block_795996320663fa3c134a258_35669145 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>
  $(function () {
    $("select").selectize([]);
  });
<?php echo '</script'; ?>
>
<form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
addUserCard" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Dodaj kartę</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="id_card">Karta: </label>
			<select id="id_card" name='card_id'>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cards']->value, 'card');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['card']->value) {
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['card']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['card']->value['name'];?>
</option>
    			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

			</select>
		</div>
        <div class="pure-control-group">
			<label for="id_quantity">Ilość: </label>
			<input id="id_quantity" type="number" name="quantity" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->quantity;?>
"/><br />
		</div>
		<div class="pure-controls">
			<input type="submit" value="dodaj" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>	
<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->app_root;?>
\addCard">Dodaj nową kartę</a>
<?php
}
}
/* {/block 'top'} */
}
