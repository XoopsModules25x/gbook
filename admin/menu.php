<?php

declare(strict_types=1);

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
 * ****************************************************************************
 */

use Xmf\Module\Admin;
use XoopsModules\Gbook;
/** @var Gbook\Helper $helper */

$moduleDirName = \basename(\dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

$helper = Gbook\Helper::getInstance();
$helper->loadLanguage('common');
$helper->loadLanguage('feedback');

$pathIcon32 = Admin::menuIconPath('');
$pathModIcon32 = XOOPS_URL .   '/modules/' . $moduleDirName . '/assets/images/icons/32/';
if (is_object($helper->getModule()) && false !== $helper->getModule()->getInfo('modicons32')) {
    $pathModIcon32 = $helper->url($helper->getModule()->getInfo('modicons32'));
}

$adminmenu[] = [
    'title' => _MI_GBOOK_HOME,
    'link'  => 'admin/index.php',
    'icon'  => $pathIcon32 . '/home.png',
];

$adminmenu[] = [
    'title' => _MI_GBOOK_MANAGE_ENTRIES,
    'link'  => 'admin/entries.php',
    'icon'  => $pathIcon32 . '/manage.png',
];

$adminmenu[] = [
    'title' => _MI_GBOOK_ABOUT,
    'link'  => 'admin/about.php',
    'icon'  => $pathIcon32 . '/about.png',
];
