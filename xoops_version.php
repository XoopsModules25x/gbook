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
 *
 * @copyright       Ingo H. de Boer (http://www.winshell.org)
 * @license         GNU General Public License (GPL)
 * @package         GBook
 * @author          Ingo H. de Boer (idb@winshell.org)
 *
 * ****************************************************************************
 */
require_once __DIR__ . '/preloads/autoloader.php';

$moduleDirName = basename(__DIR__);
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

// ------------------- Informations ------------------- //
$modversion = [
    'version'             => 1.13,
    'module_status'       => 'Final',
    'release_date'        => '2021/08/08', //yyyy/mm/dd
    'name'                => _MI_GBOOK_NAME,
    'description'         => _MI_GBOOK_DESC,
    'official'            => 0, //1 indicates supported by XOOPS Dev Team, 0 means 3rd party supported
    'author'              => 'Ingo H. de Boer',
    'author_mail'         => 'author-email',
    'author_website_url'  => 'www.winshell.org',
    'author_website_name' => 'WinShell',
    'credits'             => 'MyGuestbook (Narga), XOOPS Development Team',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'www.gnu.org/licenses/gpl-2.0.html/',
    'help'                => 'page=help',

    'release_info' => 'Changelog',
    'release_file' => XOOPS_URL . "/modules/$moduleDirName/docs/changelog file",

    'manual'              => 'link to manual file',
    'manual_file'         => XOOPS_URL . "/modules/$moduleDirName/docs/install.txt",
    'min_php'             => '7.3',
    'min_xoops'           => '2.5.10',
    'min_admin'           => '1.2',
    'min_db'              => ['mysql' => '5.5'],
    // images
    'image'               => 'assets/images/logoModule.png',
    'iconsmall'           => 'assets/images/iconsmall.png',
    'iconbig'             => 'assets/images/iconbig.png',
    'dirname'             => $moduleDirName,
    // Local path icons
    'modicons16'          => 'assets/images/icons/16',
    'modicons32'          => 'assets/images/icons/32',
    //    'release'             => '2015-04-04',
    'demo_site_url'       => 'https://xoops.org',
    'demo_site_name'      => 'XOOPS Site',
    'support_url'         => 'https://xoops.org/modules/newbb',
    'support_name'        => 'Support Forum',
    'module_website_url'  => 'www.xoops.org',
    'module_website_name' => 'XOOPS Project',
    // Admin system menu
    'system_menu'         => 1,
    // Admin menu
    'hasAdmin'            => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    // Main menu
    'hasMain'             => 1,
    // Install/Update
    'onInstall'           => 'include/oninstall.php',
    'onUpdate'            => 'include/onupdate.php',
    //  'onUninstall'         => 'include/onuninstall.php'
];

// ------------------- Mysql ------------------- //
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// Tables created by sql file (without prefix!)
$modversion['tables'] = [
    $moduleDirName . '_' . 'entries',
];

// ------------------- Templates ------------------- //
$modversion['templates'] = [
    ['file' => 'gbook_admin_entries.tpl', 'description' => 'Admin list to manage entries.'],
    ['file' => 'gbook_view_entries.tpl', 'description' => 'Shows entries of guestbook.'],
    ['file' => 'gbook_sign.tpl', 'description' => 'Sign the guestbook.'],
];

// ------------------- Config Options ------------------- //
$modversion['config'][] = [
    'name'        => 'num_entries',
    'title'       => '_MI_GBOOK_NUM_TITLE',
    'description' => '_MI_GBOOK_NUM_DESCRIPTION',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 5,
];

$modversion['config'][] = [
    'name'        => 'order_entries',
    'title'       => '_MI_GBOOK_ORDER_TITLE',
    'description' => '_MI_GBOOK_ORDER_DESCRIPTION',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'DESC',
    'options'     => ['_MI_GBOOK_ORDER_ASC' => 'ASC', '_MI_GBOOK_ORDER_DESC' => 'DESC'],
];

$modversion['config'][] = [
    'name'        => 'date_format',
    'title'       => '_MI_GBOOK_DFORMAT_TITLE',
    'description' => '_MI_GBOOK_DFORMAT_DESCRIPTION',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'Y-m-d',
    'options'     => ['Y-m-d' => 'Y-m-d', 'd-m-Y' => 'd-m-Y', 'Y/m/d' => 'Y/m/d'],
];

xoops_load('XoopsEditorHandler');
$editorHandler = XoopsEditorHandler::getInstance();
$editorList    = array_flip($editorHandler->getList());

$modversion['config'][] = [
    'name'        => 'editorAdmin',
    'title'       => '_MI_GBOOK_EDITOR_ADMIN',
    'description' => '_MI_GBOOK_EDITOR_ADMIN_DESC',

    'formtype'  => 'select',
    'valuetype' => 'text',
    'options'   => $editorList,
    'default'   => 'dhtmltextarea',
];

$modversion['config'][] = [
    'name'        => 'editorUser',
    'title'       => '_MI_GBOOK_EDITOR_USER',
    'description' => '_MI_GBOOK_EDITOR_USER_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'options'     => $editorList,
    'default'     => 'dhtmltextarea',
];

/**
 * Make Sample button visible?
 */
$modversion['config'][] = [
    'name'        => 'displaySampleButton',
    'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON',
    'description' => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];

/**
 * Show Developer Tools?
 */
$modversion['config'][] = [
    'name'        => 'displayDeveloperTools',
    'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS',
    'description' => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];
