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

include __DIR__ . '/admin_header.php';
xoops_cp_header();

echo $adminObject->displayNavigation(basename(__FILE__));
echo $adminObject->renderButton('right', '');

$tempId = Request::getInt('id', 0, 'GET');
$tempOp = Request::getCmd('op', Request::getCmd('op', '', 'POST'), 'GET');

$template_main = '';
$op            = '' !== $tempOp ? $tempOp : (0 !== $tempId ? 'edit' : 'list');

/** @var GbookEntriesHandler $entriesHandler */
$entriesHandler = xoops_getModuleHandler('entries');

switch ($op) {
    default:
    case 'list':
        $criteria = new CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('DESC');
        $GLOBALS['xoopsTpl']->assign('entries', $entriesHandler->getObjects($criteria, true, false));
        $template_main = 'gbook_admin_entries.tpl';
        break;

    case 'edit':
        $obj  = $entriesHandler->get(Request::getInt('id', '', 'GET'));
        $form = $obj->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('entries.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $tempId = Request::getInt('id', 0, 'GET');
        if (0 !== $tempId) {
            $obj = $entriesHandler->get($tempId);
        } else {
            $obj = $entriesHandler->create();
        }
        $obj->setVar('name', Request::getString('name', '', 'POST'));
        $obj->setVar('email', Request::getString('email', '', 'POST'));
        $obj->setVar('url', Request::getString('url', '', 'POST'));
        $obj->setVar('message', Request::getText('message', '', 'POST'));
        $obj->setVar('note', Request::getText('note', '', 'POST'));
        if ($entriesHandler->insert($obj)) {
            redirect_header('entries.php', 3, _AM_GBOOK_ENTRY_EDITED);
        }
        include_once dirname(__DIR__) . '/include/forms.php';
        echo $obj->getHtmlErrors();
        $form = $obj->getForm();
        $form->display();
        break;

    case 'delete':
        $tempId = Request::getInt('id', 0, 'GET');
        $tempOk = Request::getInt('ok', 0, 'POST');
        $obj    = $entriesHandler->get($tempId);

        if (0 !== $tempOk && $tempOk === 1) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('entries.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($entriesHandler->delete($obj)) {
                redirect_header('entries.php', 3, sprintf(_AM_GBOOK_DELETE_SUCCESS, $obj->getVar('name')));
            } else {
                echo $obj->getHtmlErrors();
            }
        } else {
            xoops_confirm(array('ok' => 1, 'id' => Request::getInt('id', 0, 'GET'), 'op' => 'delete'),
                          Request::getString('REQUEST_URI', '', 'SERVER'),
                          sprintf(_AM_GBOOK_DELETE_SURE, $obj->getVar('name')));
        }
        break;
}

if ('' !== $template_main) {
    $GLOBALS['xoopsTpl']->display("db:{$template_main}");
}
include __DIR__ . '/admin_footer.php';
