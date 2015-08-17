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
 * @copyright       Ingo H. de Boer (http://www.winshell.org)
 * @license         GNU General Public License (GPL)
 * @package         GBook
 * @author          Ingo H. de Boer (idb@winshell.org)
 *
 *  Version : 1.00 Wed 2012/06/13 22:32:57 : Ingo H. de Boer Exp $
 * ****************************************************************************
 */

$moduleDirName = basename(dirname(__DIR__));

$moduleHandler = &xoops_gethandler('module');
$module        = $moduleHandler->getByDirname($moduleDirName);
$pathIcon32    = '../../' . $module->getInfo('sysicons32');
xoops_loadLanguage('modinfo', $module->dirname());

$xoopsModuleAdminPath = XOOPS_ROOT_PATH . '/' . $module->getInfo('dirmoduleadmin');
if (!file_exists($fileinc = $xoopsModuleAdminPath . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/' . 'main.php')) {
    $fileinc = $xoopsModuleAdminPath . '/language/english/main.php';
}
include_once $fileinc;

xoops_loadLanguage('admin', $moduleDirName);

$adminmenu[] = array(
    'title' => _GBOOK_AM_HOME,
    'link'  => 'admin/index.php',
    'icon'  => $pathIcon32 . '/home.png');

$adminmenu[] = array(
    'title' => _GBOOK_AM_MANAGE_ENTRIES,
    'link'  => 'admin/entries.php',
    'icon'  => $pathIcon32 . '/manage.png');

$adminmenu[] = array(
    'title' => _AM_MODULEADMIN_ABOUT,
    'link'  => 'admin/about.php',
    'icon'  => $pathIcon32 . '/about.png');

