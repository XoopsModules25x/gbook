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
 *  Version : 1.00 Wed 2012/06/13 22:32:57 : Ingo H. de Boer Exp $
 * ****************************************************************************
 */

include(dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php');
include_once XOOPS_ROOT_PATH . '/Frameworks/art/functions.php';
include_once XOOPS_ROOT_PATH . '/Frameworks/art/functions.admin.php';

xoops_load('XoopsRequest');
xoops_loadLanguage('main', 'gbook');
xoops_loadLanguage('modinfo', 'gbook');

$newXoopsModuleGui = false;
if (file_exists($GLOBALS['xoops']->path('/Frameworks/moduleclasses/moduleadmin/moduleadmin.php'))) {
    include_once $GLOBALS['xoops']->path('/Frameworks/moduleclasses/moduleadmin/moduleadmin.php');
    $moduleInfo        =& $module_handler->get($xoopsModule->getVar('mid'));
    $pathIcon16        = XOOPS_URL . '/' . $moduleInfo->getInfo('icons16');
    $pathIcon32        = XOOPS_URL . '/' . $moduleInfo->getInfo('icons32');
    $newXoopsModuleGui = true;
    $indexAdmin        = new ModuleAdmin();
}
$myts = &MyTextSanitizer::getInstance();
