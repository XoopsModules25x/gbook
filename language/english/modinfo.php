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

define('_MI_GBOOK_NAME', 'GBook');
define('_MI_GBOOK_DESC', 'The GBook module is for managing a guestbook.');

define('_MI_GBOOK_NUM_TITLE', 'Entries per page');
define('_MI_GBOOK_NUM_DESCRIPTION', 'The number of entries shown per page.');

define('_MI_GBOOK_ORDER_TITLE', 'Order of entries');
define('_MI_GBOOK_ORDER_DESCRIPTION', 'The order how the entries are shown.');

define('_MI_GBOOK_ORDER_ASC', 'Ascending');
define('_MI_GBOOK_ORDER_DESC', 'Descending');

define('_MI_GBOOK_DFORMAT_TITLE', 'Date format');
define('_MI_GBOOK_DFORMAT_DESCRIPTION', 'The format how the dates are shown.');

//1.10
define('_MI_GBOOK_EDITOR_ADMIN', 'Editor for Admin');
define('_MI_GBOOK_EDITOR_ADMIN_DESC', 'Select the editor that you would like to use');
define('_MI_GBOOK_EDITOR_USER', 'Editor for Users');
define('_MI_GBOOK_EDITOR_USER_DESC', 'Select the editor that you would the users to use');

define('_MI_GBOOK_MANAGE_ENTRIES', 'Manage Entries');
//Help
define('_MI_GBOOK_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_GBOOK_HELP_HEADER', __DIR__ . '/help/helpheader.html');
define('_MI_GBOOK_BACK_2_ADMIN', 'Back to Administration of ');
define('_MI_GBOOK_HELP_OVERVIEW', 'Overview');
