<?php
/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright    XOOPS Project http://xoops.org/
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author     XOOPS Development Team
 */


/**
 *
 * Prepares system prior to attempting to install module
 * @param XoopsModule $module {@link XoopsModule}
 *
 * @return bool true if ready to install, false if not
 */
function xoops_module_pre_install_gbook(XoopsModule $module)
{
    $moduleDirName = basename(dirname(__DIR__));
    $className = ucfirst($moduleDirName) . 'Utilities';
    if (!class_exists($className)) {
        xoops_load('utilities', $moduleDirName);
    }
    //check for minimum XOOPS version
    if (!$className::checkXoopsVer($module)) {
        return false;
    }

    // check for minimum PHP version
    if (!$className::checkPhpVer($module)) {
        return false;
    }

    $mod_tables =& $module->getInfo('tables');
    foreach ($mod_tables as $table) {
        $GLOBALS['xoopsDB']->queryF('DROP TABLE IF EXISTS ' . $GLOBALS['xoopsDB']->prefix($table) . ';');
    }

    return true;
}

/**
 *
 * Performs tasks required during installation of the module
 * @param XoopsModule $module {@link XoopsModule}
 *
 * @return bool true if installation successful, false if not
 */
function xoops_module_install_gbook(XoopsModule $module)
{
    return true;
}
