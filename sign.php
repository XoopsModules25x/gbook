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
use Xmf\Request;

include_once __DIR__ . '/header.php';
include_once __DIR__ . '/class/utilities.php';
global $xoopsUser;
//Assign info
$myts = MyTextSanitizer::getInstance();
$nameTmp    = Request::getString('Name', '', 'POST') ?: (is_object($xoopsUser) ? $xoopsUser->getVar('uname', 'E') : '');
$emailTmp   = Request::getString('Email', '', 'POST') ?: (is_object($xoopsUser) ? $xoopsUser->getVar('email', 'E') : '');
$urlTmp     = Request::getString('URL', '', 'POST') ?: (is_object($xoopsUser) ? $xoopsUser->getVar('url', 'E') : '');
$messageTmp = Request::getText('Message', '', 'POST') ?: '';
$timeTmp    = time();
$ipTmp      = GbookUtilities::gbookIP();

$GLOBALS['xoopsOption']['template_main']       = 'gbook_sign.tpl';
$GLOBALS['xoopsOption']['xoops_module_header'] = '<link rel="stylesheet" type="text/css" href="assets/css/gbook.css" />';
include XOOPS_ROOT_PATH . '/header.php';
include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

//Assign data to smarty tpl
$xoopsTpl->assign('lang_back', _MD_GBOOK_BACK);
$xoopsTpl->assign('lang_desc', _MD_GBOOK_DESC);

if ('' == Request::getString('submit', '', 'POST')) {
    $gbookform = GbookUtilities::getSignForm($nameTmp, $emailTmp, $urlTmp, $messageTmp);
    $gbookform->assign($xoopsTpl);
} else {
    $stop = '';
    xoops_load('XoopsCaptcha');
    $xoopsCaptcha = xoopsCaptcha::getInstance();
    if (!$xoopsCaptcha->verify()) {
        $stop .= $xoopsCaptcha->getMessage();
    }
    if (!empty($emailTmp) && !checkEmail($emailTmp)) {
        $stop .= _MD_GBOOK_EMAIL_INVALID;
    }
    if ('' !== $stop) {
        $stop .= '<br />';
        $GLOBALS['xoopsTpl']->assign('stop', $stop);
        $gbookform = GbookUtilities::getSignForm($nameTmp, $emailTmp, $urlTmp, $messageTmp);
        $gbookform->assign($xoopsTpl);
    } else {
        /** @var GbookEntriesHandler $entriesHandler */
        $entriesHandler = xoops_getModuleHandler('entries');
        $obj     = $entriesHandler->create();
        $obj->setVar('name', $nameTmp);
        $obj->setVar('email', $emailTmp);
        $obj->setVar('url', formatURL($urlTmp));
        $obj->setVar('message', $messageTmp);
        $obj->setVar('time', $timeTmp);
        $obj->setVar('ip', $ipTmp);
        if ($entriesHandler->insert($obj)) {
            redirect_header('index.php', 3, _MD_GBOOK_SIGNED);
        }
//        include_once dirname(__DIR__) . '/include/forms.php';
        echo $obj->getHtmlErrors();
        $form = $obj->getForm();
        $form->display();
    }
}

include_once __DIR__ . '/footer.php';
