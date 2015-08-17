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

$dirname = basename(dirname(dirname(__FILE__)));
$module_handler = xoops_gethandler('module');
$module = $module_handler->getByDirname($dirname);
$pathIcon32 = $module->getInfo('icons32');

xoops_loadLanguage('admin', $dirname);

$i = 0;

// Index
$adminmenu[$i]['title']	= _GBOOK_AM_HOME;
$adminmenu[$i]['link']	= 'admin/index.php';
$adminmenu[$i]['icon']	= '../../'.$pathIcon32.'/home.png';
$i++;

$adminmenu[$i]['title']	= _GBOOK_AM_MANAGE_ENTRIES;
$adminmenu[$i]['link']	= 'admin/entries.php';
$adminmenu[$i]['icon']	= '../../'.$pathIcon32.'/manage.png';

$i++;
$adminmenu[$i]['title']	= _GBOOK_AM_ABOUT;
$adminmenu[$i]['link']	=  'admin/about.php';
$adminmenu[$i]['icon']	= '../../'.$pathIcon32.'/about.png';
