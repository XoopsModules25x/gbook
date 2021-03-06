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

$moduleDirName = basename(__DIR__);

// ------------------- Informations ------------------- //
$modversion = array(
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
    //
    'release_info'        => 'Changelog',
    'release_file'        => XOOPS_URL . "/modules/$moduleDirName/docs/changelog file",
    //
    'manual'              => 'link to manual file',
    'manual_file'         => XOOPS_URL . "/modules/$moduleDirName/docs/install.txt",
    'min_php'             => '5.5',
    'min_xoops'           => '2.5.8',
    'min_admin'           => '1.2',
    'min_db'              => array('mysql' => '5.0.7', 'mysqli' => '5.0.7'),
    // images
    'image'               => 'assets/images/logoModule.png',
    'iconsmall'           => 'assets/images/iconsmall.png',
    'iconbig'             => 'assets/images/iconbig.png',
    'dirname'             => $moduleDirName,
    //Frameworks
    'dirmoduleadmin'      => 'Frameworks/moduleclasses/moduleadmin',
    'sysicons16'          => 'Frameworks/moduleclasses/icons/16',
    'sysicons32'          => 'Frameworks/moduleclasses/icons/32',
    // Local path icons
    'modicons16'          => 'assets/images/icons/16',
    'modicons32'          => 'assets/images/icons/32',
    //About
    'version'             => 1.11,
    'module_status'       => 'Final',
    'release_date'        => '2016/09/10', //yyyy/mm/dd
    //    'release'             => '2015-04-04',
    'demo_site_url'       => 'http://www.xoops.org',
    'demo_site_name'      => 'XOOPS Site',
    'support_url'         => 'http://xoops.org/modules/newbb',
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
    //Search & Comments
    //    'hasSearch'           => 1,
    //    'search'              => array(
    //        'file'   => 'include/search.inc.php',
    //        'func'   => 'XXXX_search'),
    //    'hasComments'         => 1,
    //    'comments'              => array(
    //        'pageName'   => 'index.php',
    //        'itemName'   => 'id'),

    // Install/Update
    'onInstall'           => 'include/oninstall.php',
    'onUpdate'            => 'include/onupdate.php'
    //  'onUninstall'         => 'include/onuninstall.php'

);

// ------------------- Mysql ------------------- //
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// Tables created by sql file (without prefix!)
$modversion['tables'] = array(
    $moduleDirName . '_' . 'entries'
);

// ------------------- Templates ------------------- //

$modversion['templates'] = array(
    array('file' => 'gbook_admin_entries.tpl', 'description' => 'Admin list to manage entries.'),
    array('file' => 'gbook_view_entries.tpl', 'description' => 'Shows entries of guestbook.'),
    array('file' => 'gbook_sign.tpl', 'description' => 'Sign the guestbook.')
);

// ------------------- Config Options ------------------- //
$modversion['config'][] = array(
    'name'        => 'num_entries',
    'title'       => '_MI_GBOOK_NUM_TITLE',
    'description' => '_MI_GBOOK_NUM_DESCRIPTION',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 5
);

$modversion['config'][] = array(
    'name'        => 'order_entries',
    'title'       => '_MI_GBOOK_ORDER_TITLE',
    'description' => '_MI_GBOOK_ORDER_DESCRIPTION',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'DESC',
    'options'     => array('_MI_GBOOK_ORDER_ASC' => 'ASC', '_MI_GBOOK_ORDER_DESC' => 'DESC')
);

$modversion['config'][] = array(
    'name'        => 'date_format',
    'title'       => '_MI_GBOOK_DFORMAT_TITLE',
    'description' => '_MI_GBOOK_DFORMAT_DESCRIPTION',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'Y-m-d',
    'options'     => array('Y-m-d' => 'Y-m-d', 'd-m-Y' => 'd-m-Y', 'Y/m/d' => 'Y/m/d')
);

xoops_load('XoopsEditorHandler');
$editorHandler = XoopsEditorHandler::getInstance();
$editorList    = array_flip($editorHandler->getList());

$modversion['config'][] = array(
    'name'        => 'editorAdmin',
    'title'       => '_MI_GBOOK_EDITOR_ADMIN',
    'description' => '_MI_GBOOK_EDITOR_ADMIN_DESC',

    'formtype'  => 'select',
    'valuetype' => 'text',
    'options'   => $editorList,
    'default'   => 'dhtmltextarea'
);

$modversion['config'][] = array(
    'name'        => 'editorUser',
    'title'       => '_MI_GBOOK_EDITOR_USER',
    'description' => '_MI_GBOOK_EDITOR_USER_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'options'     => $editorList,
    'default'     => 'dhtmltextarea'
);
