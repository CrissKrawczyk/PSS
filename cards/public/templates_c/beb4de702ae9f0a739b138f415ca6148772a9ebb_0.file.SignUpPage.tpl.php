<?php
/* Smarty version 3.1.30, created on 2024-05-11 16:42:03
  from "C:\xampp\htdocs\PSS\cards\app\views\SignUpPage.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_663f83bb68f5d9_21187676',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'beb4de702ae9f0a739b138f415ca6148772a9ebb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PSS\\cards\\app\\views\\SignUpPage.tpl',
      1 => 1715438514,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
  ),
),false)) {
function content_663f83bb68f5d9_21187676 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1137903035663f83bb68ee13_09146243', 'top');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'top'} */
class Block_1137903035663f83bb68ee13_09146243 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>

			<?php if (isset($_smarty_tpl->tpl_vars['goTo']->value)) {?>
				<?php echo $_smarty_tpl->tpl_vars['goTo']->value;?>

			<?php } else { ?>
				signUp
			<?php }?>
			" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>
	<?php if (isset($_smarty_tpl->tpl_vars['title']->value)) {?>
		<?php echo $_smarty_tpl->tpl_vars['title']->value;?>

	<?php } else { ?>
		Rejestracja
	<?php }?>
	</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="id_email">E-mail: </label>
			<input id="id_email" type="text" name="email" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->email;?>
"/><br />
		</div>
        <div class="pure-control-group">
			<label for="id_login">Login: </label>
			<input id="id_login" type="text" name="login" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->login;?>
"/>
		</div>
        <div class="pure-control-group">
			<label for="id_pass">Hasło: </label>
			<input id="id_pass" type="password" name="pass" /><br />
		</div>
        <div class="pure-control-group">
			<label for="id_pass2">Powtórz hasło: </label>
			<input id="id_pass2" type="password" name="pass2" /><br />
		</div>
		<div class="pure-controls">
			<input type="submit" value="
			<?php if (isset($_smarty_tpl->tpl_vars['submitCaption']->value)) {?>
				<?php echo $_smarty_tpl->tpl_vars['submitCaption']->value;?>

			<?php } else { ?>
				zarejestruj się!
			<?php }?>
			" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>	
<?php
}
}
/* {/block 'top'} */
}
