<?php
/* Smarty version 3.1.30, created on 2024-05-11 16:32:54
  from "C:\xampp\htdocs\PSS\cards\app\views\WelcomeScreen.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_663f8196c20354_44292910',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dff3aa818d544775a0c09b71cb133f63852bed00' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PSS\\cards\\app\\views\\WelcomeScreen.tpl',
      1 => 1715100021,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
  ),
),false)) {
function content_663f8196c20354_44292910 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_347934380663f8196c1ff62_02035238', 'top');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'top'} */
class Block_347934380663f8196c1ff62_02035238 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div>Witamy!!!!</div>
<?php if ($_smarty_tpl->tpl_vars['isAdmin']->value) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->app_root;?>
\adminPage">Przejdź na stronę admina!</a>
<?php }?>
<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->app_root;?>
\userPage">Przejdź do swoich talii!</a>
<?php
}
}
/* {/block 'top'} */
}
