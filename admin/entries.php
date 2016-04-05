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

include __DIR__ . '/admin_header.php';
xoops_cp_header();
$indexAdmin = new ModuleAdmin();

echo $indexAdmin->addNavigation(basename(__FILE__));
echo $indexAdmin->renderButton('right', '');

$tempId = XoopsRequest::getInt('id', 0, 'GET');
$tempOp = XoopsRequest::getCmd('op', XoopsRequest::getCmd('op', '', 'POST'), 'GET');

$template_main = '';
$op = '' !== $tempOp ? $tempOp : (0 !== $tempId ? 'edit' : 'list');

$handler = xoops_getModuleHandler('entries');

switch ($op) {
    default:
    case 'list':
        $criteria = new CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('DESC');
        $GLOBALS['xoopsTpl']->assign('entries', $handler->getObjects($criteria, true, false));
        $template_main = 'gbook_admin_entries.tpl';
        break;

    case 'edit':
        $obj  = $handler->get(XoopsRequest::getInt('id', '', 'GET'));
        $form = $obj->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('entries.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $tempId = XoopsRequest::getInt('id', 0, 'GET');
        if (0 !== $tempId) {
            $obj =& $handler->get($tempId);
        } else {
            $obj =& $handler->create();
        }
        $obj->setVar('name', XoopsRequest::getString('name', '', 'POST'));
        $obj->setVar('email', XoopsRequest::getString('email', '', 'POST'));
        $obj->setVar('url', XoopsRequest::getString('url', '', 'POST'));
        $obj->setVar('message', XoopsRequest::getText('message', '', 'POST'));
        $obj->setVar('note', XoopsRequest::getText('note', '', 'POST'));
        if ($handler->insert($obj)) {
            redirect_header('entries.php', 3, _GBOOK_AM_ENTRY_EDITED);
        }
        include_once dirname(__DIR__) . '/include/forms.php';
        echo $obj->getHtmlErrors();
        $form =& $obj->getForm();
        $form->display();
        break;

    case 'delete':
        $tempId = XoopsRequest::getInt('id', 0, 'GET');
        $tempOk = XoopsRequest::getInt('ok', 0, 'POST');
        $obj    =& $handler->get($tempId);

        if (0 !== $tempOk && $tempOk === 1) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('entries.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($handler->delete($obj)) {
                redirect_header('entries.php', 3, sprintf(_GBOOK_AM_DELETE_SUCCESS, $obj->getVar('name')));
            } else {
                echo $obj->getHtmlErrors();
            }
        } else {
            xoops_confirm(array('ok' => 1, 'id' => XoopsRequest::getInt('id', 0, 'GET'), 'op' => 'delete'), XoopsRequest::getString('REQUEST_URI', '', 'SERVER'), sprintf(_GBOOK_AM_DELETE_SURE, $obj->getVar('name')));
        }
        break;
}

if ('' !== $template_main) {
    $GLOBALS['xoopsTpl']->display("db:{$template_main}");
}
include __DIR__ . '/admin_footer.php';
