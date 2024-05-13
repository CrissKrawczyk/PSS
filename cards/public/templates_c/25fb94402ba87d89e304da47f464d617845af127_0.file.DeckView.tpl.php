<?php
/* Smarty version 3.1.30, created on 2024-05-13 12:07:59
  from "C:\xampp\htdocs\PSS\cards\app\views\DeckView.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6641e67f265885_99469395',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '25fb94402ba87d89e304da47f464d617845af127' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PSS\\cards\\app\\views\\DeckView.tpl',
      1 => 1715594839,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
  ),
),false)) {
function content_6641e67f265885_99469395 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_307234536641e67f265386_00625318', 'top');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'top'} */
class Block_307234536641e67f265386_00625318 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div>Talia <?php echo $_smarty_tpl->tpl_vars['deck']->value["name"];?>
!</div>
<?php if ($_smarty_tpl->tpl_vars['deck']->value["favorite"]) {?>
Ulubione!
<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->app_root;?>
\removeDeckFromFav\<?php echo $_smarty_tpl->tpl_vars['deck']->value["id"];?>
">Usuń z ulubionych</a>
<?php } else { ?>
<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->app_root;?>
\addDeckToFav\<?php echo $_smarty_tpl->tpl_vars['deck']->value["id"];?>
">Dodaj do ulubionych</a>
<?php }?>

<table class="pure-table pure-table-bordered">
    <thead>
        <tr>
            <th>Nazwa</th>
        </tr>
    </thead>
    <tbody>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cards']->value, 'card');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['card']->value) {
?>
    <tr><td><?php echo $_smarty_tpl->tpl_vars['card']->value["name"];?>
</td></tr>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </tbody>
</table>

<?php
}
}
/* {/block 'top'} */
}
