<?php
/* Smarty version 3.1.30, created on 2024-05-13 11:53:04
  from "C:\xampp\htdocs\PSS\cards\app\views\UserPage.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6641e30030c983_58770757',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ec1836001569a60ea52392e377496051a5af3c2f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\PSS\\cards\\app\\views\\UserPage.tpl',
      1 => 1715593962,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
  ),
),false)) {
function content_6641e30030c983_58770757 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6392664616641e30030c306_99622690', 'top');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'top'} */
class Block_6392664616641e30030c306_99622690 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php if ($_smarty_tpl->tpl_vars['hasPremium']->value) {?>
<div>Jesteś premium!!!</div>
<?php }
if ($_smarty_tpl->tpl_vars['isTestPremium']->value) {?>
<div>(UWAGA KORZYSTASZ Z TESTOWEJ WERSJI PREMIUM!!)</div>
<?php }?>
<div>User page!</div>
<?php if (!$_smarty_tpl->tpl_vars['hasPremium']->value) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->app_root;?>
\showCodeGenerator">Kup kod!</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->app_root;?>
\useCode">Wykorzystaj kod!</a>
<?php }?>
<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->app_root;?>
\addUserCard">Dodaj kartę!</a>
<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->app_root;?>
\createDeck">Utwórz talię!</a>

<table class="pure-table pure-table-bordered">
    <thead>
        <tr>
            <th>Nazwa</th>
            <th>Wartość</th>
            <th>Ilość</th>
            <th>Dodaj do talii</th>
        </tr>
    </thead>
    <tbody>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cards']->value, 'card');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['card']->value) {
?>
    <tr><td><?php echo $_smarty_tpl->tpl_vars['card']->value["name"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['card']->value["price"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['card']->value["quantity"];?>
</td><td><form id="add-to-deck-form<?php echo $_smarty_tpl->tpl_vars['card']->value["id"];?>
" class="pure-form pure-form-stacked" onsubmit="ajaxPostForm('add-to-deck-form<?php echo $_smarty_tpl->tpl_vars['card']->value["id"];?>
','<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
addToDeckList','add-to-deck<?php echo $_smarty_tpl->tpl_vars['card']->value["id"];?>
'); return false;"><fieldset><input type="text" name="cardId" value="<?php echo $_smarty_tpl->tpl_vars['card']->value["id"];?>
" /><br /><button type="submit" class="pure-button pure-button-primary">+</button></fieldset></form><div id="add-to-deck<?php echo $_smarty_tpl->tpl_vars['card']->value["id"];?>
"></div></td></tr>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </tbody>
</table>

<table class="pure-table pure-table-bordered">
    <thead>
        <tr>
            <th>Nazwa</th>
            <th>Ilość kart</th>
            <th>Ulubione</th>
            <th>Otwórz</th>
            <th>Usuń</th>
        </tr>
    </thead>
    <tbody>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['decks']->value, 'deck');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['deck']->value) {
?>
    <tr><td><?php echo $_smarty_tpl->tpl_vars['deck']->value["name"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['deck']->value["cards_in"];?>
</td><td><?php if ($_smarty_tpl->tpl_vars['deck']->value["favorite"]) {?>*<?php }?></td><td><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->app_root;?>
\deckPage\<?php echo $_smarty_tpl->tpl_vars['deck']->value["id"];?>
">Przejdź</a></td><td><a class="button-small pure-button button-warning" onclick="confirmLink('<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
deleteDeck/<?php echo $_smarty_tpl->tpl_vars['deck']->value['id'];?>
','Czy na pewno usunąć talię <?php echo $_smarty_tpl->tpl_vars['deck']->value['name'];?>
?')">Usuń</a></td></tr>
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
