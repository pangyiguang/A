<?php /* Smarty version Smarty-3.1.14, created on 2014-12-20 13:24:48
         compiled from "D:\documentRoot\AHA_F\demo\view\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13756549507d730e523-70192777%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '67e3273929e4e8a3e3dc07a0e1d75d870cf09101' => 
    array (
      0 => 'D:\\documentRoot\\AHA_F\\demo\\view\\index.tpl',
      1 => 1419053085,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13756549507d730e523-70192777',
  'function' => 
  array (
  ),
  'cache_lifetime' => 3600,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_549507d732d935_94842399',
  'variables' => 
  array (
    'title' => 0,
    'APP_ACTION' => 0,
    'APP_VIEW' => 0,
    'result' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549507d732d935_94842399')) {function content_549507d732d935_94842399($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <div>
            <p><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</p>
            <p>APP_ACTION:<?php echo $_smarty_tpl->tpl_vars['APP_ACTION']->value;?>
</p>
            <p>APP_VIEW:<?php echo $_smarty_tpl->tpl_vars['APP_VIEW']->value;?>
</p>
            result:
            <pre><?php echo var_dump($_smarty_tpl->tpl_vars['result']->value);?>
</pre>
        </div>
    </body>
</html>
<?php }} ?>