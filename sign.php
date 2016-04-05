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
 *
 * @copyright       Ingo H. de Boer (http://www.winshell.org)
 * @license         GNU General Public License (GPL)
 * @package         GBook
 * @author          Ingo H. de Boer (idb@winshell.org)
 *
 * ****************************************************************************
 */

include_once __DIR__ . '/header.php';
include_once __DIR__ . '/class/utilities.php';

//Assign info
$myts = MyTextSanitizer::getInstance();
//$nameTmp0    = isset($_POST['Name']) ? $myts->stripSlashesGPC(trim($_POST['Name'])) : (null !== $xoopsUser ? $xoopsUser->getVar('uname', 'E') : '');
$nameTmp    = XoopsRequest::getString('Name', '', 'POST') ?: (null !== $xoopsUser ? $xoopsUser->getVar('uname', 'E') : '');
$emailTmp   = XoopsRequest::getString('Email', '', 'POST') ?: (null !== $xoopsUser ? $xoopsUser->getVar('email', 'E') : ''); //isset($_POST['Email']) ? $myts->stripSlashesGPC(trim($_POST['Email'])) : (null !== $xoopsUser ? $xoopsUser->getVar('email', 'E') : '');
$urlTmp     = XoopsRequest::getString('URL', '', 'POST') ?: (null !== $xoopsUser ? $xoopsUser->getVar('url', 'E') : ''); //isset($_POST['URL']) ? $myts->stripSlashesGPC(trim($_POST['URL'])) : (null !== $xoopsUser ? $xoopsUser->getVar('url', 'E') : '');
$messageTmp = XoopsRequest::getString('Message', '', 'POST') ?: ''; //isset($_POST['Message']) ? $myts->stripSlashesGPC(trim($_POST['Message'])) : '';
$timeTmp    = time();
$ipTmp      = GBookUtilities::gbookIP();

$xoopsOption['template_main']       = 'gbook_sign.tpl';
$xoopsOption['xoops_module_header'] = '<link rel="stylesheet" type="text/css" href="templates/gbook.css" />';
include XOOPS_ROOT_PATH . '/header.php';
include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

//Assign data to smarty tpl
$xoopsTpl->assign('lang_back', _GBOOK_BACK);
$xoopsTpl->assign('lang_desc', _GBOOK_DESC);

if (empty($_POST['submit'])) {
    $gbookform = GBookUtilities::gbookSignForm($nameTmp, $emailTmp, $urlTmp, $messageTmp);
    $gbookform->assign($xoopsTpl);
} else {
    $stop = '';
    xoops_load('XoopsCaptcha');
    $xoopsCaptcha = xoopsCaptcha::getInstance();
    if (!$xoopsCaptcha->verify()) {
        $stop .= $xoopsCaptcha->getMessage();
    }
    if (!empty($emailTmp) && !checkEmail($emailTmp)) {
            $stop .= _GBOOK_EMAIL_INVALID;
    }
    if ('' !== $stop) {
        $stop .= '<br />';
        $GLOBALS['xoopsTpl']->assign('stop', $stop);
        $gbookform = GBookUtilities::gbookSignForm($nameTmp, $emailTmp, $urlTmp, $messageTmp);
        $gbookform->assign($xoopsTpl);
    } else {
        $handler = xoops_getModuleHandler('entries');
        $obj     =& $handler->create();
        $obj->setVar('name', $nameTmp);
        $obj->setVar('email', $emailTmp);
        $obj->setVar('url', formatURL($urlTmp));
        $obj->setVar('message', $messageTmp);
        $obj->setVar('time', $timeTmp);
        $obj->setVar('ip', $ipTmp);
        if ($handler->insert($obj)) {
            redirect_header('index.php', 3, _GBOOK_SIGNED);
        }
        include_once dirname(__DIR__) . '/include/forms.php';
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
        $form->display();
    }
}

include_once __DIR__ . '/footer.php';
