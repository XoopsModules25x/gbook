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

$dirname = basename( dirname( __FILE__ ) ) ;

$modversion = array();
$modversion['name']     = _GBOOK_MI_NAME;
$modversion['version']			= "1.0";
$modversion['description']		= _GBOOK_MI_DESC;
$modversion['author']			= "Ingo H. de Boer";
$modversion['help']			= 'page=help';
$modversion['license']			= 'GNU GPL 2.0';
$modversion['license_url']		= "www.gnu.org/licenses/gpl-2.0.html/";
$modversion['image']			= "images/gbook.png";
$modversion['dirname']			= $dirname;
$modversion['dirmoduleadmin']		= 'Frameworks/moduleclasses';
$modversion['icons16']			= 'Frameworks/moduleclasses/icons/16';
$modversion['icons32']			= 'Frameworks/moduleclasses/icons/32';
$modversion['credits']			= "MyGuestbook (Narga)";

//about
$modversion['demo_site_url']		= "www.winshell.org";
$modversion['demo_site_name']		= "WinShell";
$modversion["author_website_url"]	= "www.winshell.org";
$modversion["author_website_name"]	= "WinShell";
$modversion["module_website_url"]	= "www.winshell.org";
$modversion["module_website_name"]	= "WinShell";
$modversion['release_date']		= "2012/06/17";
$modversion['module_status'] 		= "Final";
$modversion['min_php']			= "5.2";
$modversion['min_xoops']		= "2.5.5";

// Admin menu
$modversion['system_menu']		= 1;

// Admin things
$modversion['hasAdmin']			= 1;
$modversion['adminindex']		= "admin/index.php";
$modversion['adminmenu']		= "admin/menu.php";

// Menu
$modversion['hasMain']			= 1;

// Mysql file
$modversion['sqlfile']['mysql']		= "sql/mysql.sql";

// Tables created by sql file (without prefix!)
$modversion['tables'][1]		= "gbook_entries";

// Config items
$modversion['config'][1]['name']	= 'num_entries';
$modversion['config'][1]['title']	= '_GBOOK_MI_NUM_TITLE';
$modversion['config'][1]['description']	= '_GBOOK_MI_NUM_DESCRIPTION';
$modversion['config'][1]['formtype']	= 'textbox';
$modversion['config'][1]['valuetype']	= 'int';
$modversion['config'][1]['default']	= 5;

$modversion['config'][2]['name']	= 'order_entries';
$modversion['config'][2]['title']	= '_GBOOK_MI_ORDER_TITLE';
$modversion['config'][2]['description']	= '_GBOOK_MI_ORDER_DESCRIPTION';
$modversion['config'][2]['formtype']	= 'select';
$modversion['config'][2]['valuetype']	= 'text';
$modversion['config'][2]['default']	= 'DESC';
$modversion['config'][2]['options']	= array('_GBOOK_MI_ORDER_ASC' => 'ASC', '_GBOOK_MI_ORDER_DESC' => 'DESC');

$modversion['config'][3]['name']	= 'date_format';
$modversion['config'][3]['title']	= '_GBOOK_MI_DFORMAT_TITLE';
$modversion['config'][3]['description']	= '_GBOOK_MI_DFORMAT_DESCRIPTION';
$modversion['config'][3]['formtype']	= 'select';
$modversion['config'][3]['valuetype']	= 'text';
$modversion['config'][3]['default']	= 'Y-m-d';
$modversion['config'][3]['options']	= array('Y-m-d' => 'Y-m-d', 'd-m-Y' => 'd-m-Y', 'Y/m/d' => 'Y/m/d');

// Templates
$i = 0;

$i++;
$modversion['templates'][$i]['file']		= 'gbook_admin_entries.html';
$modversion['templates'][$i]['description']	= 'Admin list to manage entries.';

$i++;
$modversion['templates'][$i]['file']		= 'gbook_view_entries.html';
$modversion['templates'][$i]['description']	= 'Shows entries of guestbook.';

$i++;
$modversion['templates'][$i]['file']		= 'gbook_sign.html';
$modversion['templates'][$i]['description']	= 'Sign the guestbook.';

unset($i);
?>
