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
  'cache_lifetime' => 3600,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54950820486875_18406017',
  'variables' => 
  array (
    'title' => 0,
    'APP_ACTION' => 0,
    'APP_VIEW' => 0,
    'result' => 0,
  ),
  'has_nocache_code' => false,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54950820486875_18406017')) {function content_54950820486875_18406017($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <title>一个调用smarty模板的例子</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <div>
            <p>一个调用smarty模板的例子</p>
            <p>APP_ACTION:index</p>
            <p>APP_VIEW:index</p>
            result:
            <pre><pre class='xdebug-var-dump' dir='ltr'>
<b>array</b> <i>(size=4)</i>
  0 <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'liming'</font> <i>(length=6)</i>
  1 <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>' who are you'</font> <i>(length=12)</i>
  2 <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'how can i help you'</font> <i>(length=18)</i>
  3 <font color='#888a85'>=&gt;</font> <small>string</small> <font color='#cc0000'>'yes,i do'</font> <i>(length=8)</i>
</pre></pre>
        </div>
    </body>
</html>
<?php }} ?>