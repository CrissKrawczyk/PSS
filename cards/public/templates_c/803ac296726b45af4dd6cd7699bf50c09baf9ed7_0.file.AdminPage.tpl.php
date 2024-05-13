<?php
/* Smarty version 3.1.30, created on 2024-05-13 11:48:13
  from "C:\xampp\htdocs\PSS\cards\app\views\AdminPage.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6641e1ddc685a6_10691420',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '803ac296726b45af4dd6cd7699bf50c09baf9ed7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PSS\\cards\\app\\views\\AdminPage.tpl',
      1 => 1715593689,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
  ),
),false)) {
function content_6641e1ddc685a6_10691420 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1118681786641e1ddc67bc2_74164376', 'top');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'top'} */
class Block_1118681786641e1ddc67bc2_74164376 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div>Admin page!</div>
<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->app_root;?>
\generateTestCode">Utwórz testowy kod!</a>
<?php echo '<script'; ?>
>console.log(<?php echo $_smarty_tpl->tpl_vars['users']->value;?>
)<?php echo '</script'; ?>
>
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
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'user');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
?>
    <tr><td><?php echo $_smarty_tpl->tpl_vars['user']->value["id"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['user']->value["login"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['user']->value["email"];?>
</td><td><?php if ($_smarty_tpl->tpl_vars['user']->value["isPremium"]) {?>premium<?php } else { ?>user<?php }
if ($_smarty_tpl->tpl_vars['user']->value["isAdmin"]) {?>, admin<?php }?></td><td><a class="button-small pure-button button-warning" onclick="confirmLink('<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
deleteUser/<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
','Czy na pewno usunąć użytkownika <?php echo $_smarty_tpl->tpl_vars['user']->value['login'];?>
?')">Usuń</a></td></tr>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </tbody>
</table>
<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->app_root;?>
\createUser">Dodaj użytkownika</a>
<?php
}
}
/* {/block 'top'} */
}
