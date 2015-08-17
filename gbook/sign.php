<?php
/**
 * ****************************************************************************
 *  GBOOK - MODULE FOR XOOPS
 *  Copyright (c) 2007 - 2012
 *  Ingo H. de Boer (http://www.winshell.org)
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  You may not change or alter any portion of this comment or credits
 *  of supporting developers from this source code or any supporting
 *  source code which is considered copyrighted (c) material of the
 *  original comment or credit authors.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  ---------------------------------------------------------------------------
 *  @copyright       Ingo H. de Boer (http://www.winshell.org)
 *  @license         GNU General Public License (GPL)
 *  @package         GBook
 *  @author          Ingo H. de Boer (idb@winshell.org)
 *
 *  Version : 1.00 Wed 2012/06/13 22:32:57 : Ingo H. de Boer Exp $
 * ****************************************************************************
 */

include_once "header.php";
include_once "./include/functions.php";

//Assign info
$myts =& MyTextSanitizer::getInstance();
$name_tmp    = isset($_POST['Name']) ? $myts->stripSlashesGPC(trim($_POST['Name']) ) : (!empty($xoopsUser) ? $xoopsUser->getVar("uname", "E") : "");
$email_tmp   = isset($_POST['Email']) ? $myts->stripSlashesGPC(trim($_POST['Email']) ) : (!empty($xoopsUser) ? $xoopsUser->getVar("email", "E") : "");
$url_tmp     = isset($_POST['URL']) ? $myts->stripSlashesGPC(trim($_POST['URL']) ) : (!empty($xoopsUser) ? $xoopsUser->getVar("url", "E") : "");
$message_tmp = isset($_POST['Message']) ? $myts->stripSlashesGPC(trim($_POST['Message']) ) : "";
$time_tmp    = time();
$ip_tmp      = gbookIP();

$xoopsOption['template_main'] = "gbook_sign.html";
$xoopsOption['xoops_module_header'] = '<link rel="stylesheet" type="text/css" href="templates/gbook.css" />';
include XOOPS_ROOT_PATH."/header.php";
include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";

//Assign data to smarty tpl
$xoopsTpl->assign('lang_back', _GBOOK_BACK);
$xoopsTpl->assign('lang_desc', _GBOOK_DESC);

if ( empty($_POST['submit']) ) {
   $gbookform = gbookSignForm($name_tmp, $email_tmp, $url_tmp, $message_tmp);
   $gbookform->assign($xoopsTpl);
} else {
    $stop = '';
    xoops_load('XoopsCaptcha');
    $xoopsCaptcha = XoopsCaptcha::getInstance();
    if (!$xoopsCaptcha->verify()) {
       $stop .= $xoopsCaptcha->getMessage();
    }
    if (!empty($email_tmp)) {
       if (!checkEmail($email_tmp)) {
          $stop .= _GBOOK_EMAIL_INVALID;
       }
    }
    if (!empty($stop)) {
       $stop .= '<br />';
       $GLOBALS['xoopsTpl']->assign('stop', $stop);
       $gbookform = gbookSignForm($name_tmp, $email_tmp, $url_tmp, $message_tmp);
       $gbookform->assign($xoopsTpl);
    } else {
        $handler =& xoops_getmodulehandler('entries');
        $obj =& $handler->create();
        $obj->setVar('name', $name_tmp);
        $obj->setVar('email', $email_tmp);
        $obj->setVar('url', formatURL($url_tmp));
        $obj->setVar('message', $message_tmp);
        $obj->setVar('time', $time_tmp);
        $obj->setVar('ip', $ip_tmp);
        if ( $handler->insert($obj)  ) {
            redirect_header('index.php', 3, _GBOOK_SIGNED );
        }
        include_once '../include/forms.php';
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
        $form->display();
    }
}

include_once "footer.php";
?>