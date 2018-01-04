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
 * @copyright    XOOPS Project https://xoops.org/
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package
 * @author       XOOPS Development Team
 */

if ((!defined('XOOPS_ROOT_PATH')) || !($GLOBALS['xoopsUser'] instanceof XoopsUser)
    || !$GLOBALS['xoopsUser']->IsAdmin()
) {
    exit('Restricted access' . PHP_EOL);
}

/**
 * @param string $tablename
 *
 * @return bool
 */
function tableExists($tablename)
{
    $result = $GLOBALS['xoopsDB']->queryF("SHOW TABLES LIKE '$tablename'");

    return $GLOBALS['xoopsDB']->getRowsNum($result) > 0;
}

/**
 *
 * Prepares system prior to attempting to install module
 * @param XoopsModule $module {@link XoopsModule}
 *
 * @return bool true if ready to install, false if not
 */
function xoops_module_pre_update_gbook(XoopsModule $module)
{
    /** @var Gbook\Helper $helper */
    /** @var Gbook\Utility $utility */
    $moduleDirName = basename(dirname(__DIR__));
    $helper       = Gbook\Helper::getInstance();
    $utility      = new Gbook\Utility();

    $xoopsSuccess = $utility::checkVerXoops($module);
    $phpSuccess   = $utility::checkVerPhp($module);
    return $xoopsSuccess && $phpSuccess;
}

/**
 *
 * Performs tasks required during update of the module
 * @param XoopsModule $module {@link XoopsModule}
 * @param null        $previousVersion
 *
 * @return bool true if update successful, false if not
 */

function xoops_module_update_gbook(XoopsModule $module, $previousVersion = null)
{
    global $xoopsDB;

    $moduleDirName = basename(dirname(__DIR__));
    $capsDirName   = strtoupper($moduleDirName);

    /** @var Gbook\Helper $helper */
    /** @var Gbook\Utility $utility */
    /** @var Gbook\Configurator $configurator */
    $helper  = Gbook\Helper::getInstance();
    $utility = new Gbook\Utility();
    $configurator = new Gbook\Configurator();

   
    if ($previousVersion < 111) {
        // delete old HTML template files ============================
        $templateDirectory = $GLOBALS['xoops']->path('modules/' . $module->getVar('dirname', 'n') . '/templates/');
        if (is_dir($templateDirectory)) {
            $templateList = array_diff(scandir($templateDirectory, SCANDIR_SORT_NONE), ['..', '.']);
            foreach ($templateList as $k => $v) {
                $fileInfo = new SplFileInfo($templateDirectory . $v);
                if ('html' === $fileInfo->getExtension() && 'index.html' !== $fileInfo->getFilename()) {
                    if (file_exists($templateDirectory . $v)) {
                        unlink($templateDirectory . $v);
                    }
                }
            }
        }
        // delete old block html template files ============================
        $templateDirectory = $GLOBALS['xoops']->path('modules/' . $module->getVar('dirname', 'n')
                                                     . '/templates/blocks/');
        if (is_dir($templateDirectory)) {
            $templateList = array_diff(scandir($templateDirectory, SCANDIR_SORT_NONE), ['..', '.']);
            foreach ($templateList as $k => $v) {
                $fileInfo = new SplFileInfo($templateDirectory . $v);
                if ('html' === $fileInfo->getExtension() && 'index.html' !== $fileInfo->getFilename()) {
                    if (file_exists($templateDirectory . $v)) {
                        unlink($templateDirectory . $v);
                    }
                }
            }
        }
        //delete old files: ===================
        $oldFiles = [
            '/assets/images/logo_module.png',
            '/templates/gbook.css'
        ];

        foreach (array_keys($oldFiles) as $file) {
            if (is_file($file)) {
                unlink($GLOBALS['xoops']->path('modules/' . $module->getVar('dirname', 'n') . $oldFiles[$file]));
            }
        }

        //delete .html entries from the tpl table
        $sql = 'DELETE FROM ' . $xoopsDB->prefix('tplfile') . " WHERE `tpl_module` = '" . $module->getVar(
            'dirname',
                                                                                                          'n'
        )
               . "' AND `tpl_file` LIKE '%.html%'";
        $xoopsDB->queryF($sql);

        // Load class XoopsFile ====================
        xoops_load('XoopsFile');

        //delete /images directory ============
        $imagesDirectory = $GLOBALS['xoops']->path('modules/' . $module->getVar('dirname', 'n') . '/images/');
        $folderHandler   = XoopsFile::getHandler('folder', $imagesDirectory);
        $folderHandler->delete($imagesDirectory);
    }

    $gpermHandler = xoops_getHandler('groupperm');

    return $gpermHandler->deleteByModule($module->getVar('mid'), 'item_read');
}
