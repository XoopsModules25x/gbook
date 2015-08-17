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

include 'admin_header.php';
xoops_cp_header();
$indexAdmin = new ModuleAdmin();

echo $indexAdmin->addNavigation('entries.php');	
echo $indexAdmin->renderButton('right', '');

$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : (isset($_REQUEST['id']) ? "edit" : "list");

$handler =& xoops_getmodulehandler('entries');

switch($op ) {
default:
case "list":
    $criteria = new CriteriaCompo();
    $criteria->setSort('id');
    $criteria->setOrder('DESC');
    $GLOBALS['xoopsTpl']->assign('entries', $handler->getObjects($criteria, true, false) );
    $template_main = "gbook_admin_entries.html";
    break;

case "edit":
    $obj = $handler->get($_REQUEST['id']);
    $form = $obj->getForm();
    $form->display();
    break;

case "save":
    if ( !$GLOBALS['xoopsSecurity']->check()  ) {
        redirect_header('entries.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors() ));
    }
    if ( isset($_REQUEST['id'])  ) {
        $obj =& $handler->get($_REQUEST['id']);
    } else {
        $obj =& $handler->create();
    }
    $obj->setVar('name', $_REQUEST['name']);
    $obj->setVar('email', $_REQUEST['email']);
    $obj->setVar('url', $_REQUEST['url']);
    $obj->setVar('message', $_REQUEST['message']);
    $obj->setVar('note', $_REQUEST['note']);
    if ( $handler->insert($obj)  ) {
        redirect_header('entries.php', 3, _GBOOK_AM_ENTRY_EDITED );
    }
    include_once '../include/forms.php';
    echo $obj->getHtmlErrors();
    $form =& $obj->getForm();
    $form->display();
    break;

case "delete":
    $obj =& $handler->get($_REQUEST['id']);
    if ( isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1 ) {
        if ( !$GLOBALS['xoopsSecurity']->check()  ) {
            redirect_header('entries.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors() ));
        }
        if ( $handler->delete($obj)  ) {
            redirect_header('entries.php', 3, sprintf(_GBOOK_AM_DELETE_SUCCESS, $obj->getVar('name')) );
        } else {
            echo $obj->getHtmlErrors();
        }
    } else {
        xoops_confirm(array('ok' => 1, 'id' => $_REQUEST['id'], 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_GBOOK_AM_DELETE_SURE, $obj->getVar('name') ));
    }
    break;
}

if ( isset($template_main)  ) {
    $GLOBALS['xoopsTpl']->display("db:{$template_main}");
}
include 'admin_footer.php';