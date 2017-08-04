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

include_once __DIR__ . '/header.php';

//$GLOBALS['xoopsOption']['xoops_module_header'] = '<link rel="stylesheet" type="text/css" href="assets/css/gbook.css" >';

/** @var GbookEntriesHandler $entriesHandler */
$entriesHandler = xoops_getModuleHandler('entries');

$start = Request::getInt('start', 0);

$GLOBALS['xoopsOption']['template_main'] = 'gbook_view_entries.tpl';
include $GLOBALS['xoops']->path('header.php');

$criteria = new CriteriaCompo();
$criteria->setSort('id');
$criteria->setOrder($xoopsModuleConfig['order_entries']);

// $GLOBALS['xoopsTpl']->assign('entries', $entriesHandler->getObjects($criteria, true, false) );
$all_entries = $entriesHandler->getObjects($criteria, true, false);
$all_count   = count($all_entries);

$to = $start + $xoopsModuleConfig['num_entries'];

if ($to > $all_count) {
    $to = $all_count;
}

include_once $GLOBALS['xoops']->path('class/pagenav.php');
$nav = new XoopsPageNav($all_count, $xoopsModuleConfig['num_entries'], $start);
$xoopsTpl->assign('pagenav', $nav->renderNav());

$count = 0;
foreach ($all_entries as $entry) {
    if ($count >= $start && $count < $to) {
        $entry['date'] = formatTimestamp($entry['time'], $xoopsModuleConfig['date_format']);
        if ($xoopsUser && $xoopsUser->isAdmin($xoopsModule->getVar('mid'))) {
            $xoopsTpl->assign('isadmin', '1');
            $entry['admin'] = "<a href='http://whois.domaintools.com/" . $entry['ip']
                              . "' target='_blank'><img src='./assets/images/ip.png' border='0' ></a>&nbsp;"
                              . "<a href='admin/entries.php?id=" . $entry['id'] . "'><img src='" . $pathIcon16
                              . "/edit.png' border='0' ></a>&nbsp;" . "<a href='admin/entries.php?op=delete&id="
                              . $entry['id'] . "'><img src='" . $pathIcon16 . "/delete.png' border='0' ></a>&nbsp;";
        }
        $xoopsTpl->append('entries', $entry);
    }
    ++$count;
}

$xoopsTpl->assign('signgbook', _MD_GBOOK_SIGN);
$xoopsTpl->assign('totalentries', sprintf(_MD_GBOOK_TOTAL_ENTRIES, '<strong>' . $all_count . '</strong>'));

include $GLOBALS['xoops']->path('footer.php');
