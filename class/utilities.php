<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * GbookUtilities Class
 *
 * @copyright   XOOPS Project (https://xoops.org)
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      XOOPS Development Team
 * @package     GBook
 * @since       1.03
 *
 */

//namespace GBook;

/**
 * Class GbookUtilities
 */
class GbookUtilities
{
    /**
     * Function responsible for checking if a directory exists, we can also write in and create an index.html file
     *
     * @param string $folder The full path of the directory to check
     *
     * @return void
     */
    public static function createFolder($folder)
    {
        try {
            if (!@mkdir($folder) && !is_dir($folder)) {
                throw new \RuntimeException(sprintf('Unable to create the %s directory', $folder));
            } else {
                file_put_contents($folder . '/index.html', '<script>history.go(-1);</script>');
            }
        }
        catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n", '<br>';
        }
    }

    /**
     * @param $file
     * @param $folder
     * @return bool
     */
    public static function copyFile($file, $folder)
    {
        return copy($file, $folder);
        //        try {
        //            if (!is_dir($folder)) {
        //                throw new \RuntimeException(sprintf('Unable to copy file as: %s ', $folder));
        //            } else {
        //                return copy($file, $folder);
        //            }
        //        } catch (Exception $e) {
        //            echo 'Caught exception: ', $e->getMessage(), "\n", "<br>";
        //        }
        //        return false;
    }

    /**
     * @param $src
     * @param $dst
     */
    public static function recurseCopy($src, $dst)
    {
        $dir = opendir($src);
        //    @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file !== '.') && ($file !== '..')) {
                if (is_dir($src . '/' . $file)) {
                    self::recurseCopy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    /**
     * @param $name
     * @param $value
     * @return XoopsFormDhtmlTextArea|XoopsFormEditor
     */
    public static function getEditor($name, $value)
    {
        global $xoopsUser, $xoopsModule, $xoopsModuleConfig;
        $options = array();
        $isAdmin = $xoopsUser->isAdmin($xoopsModule->getVar('mid'));

        if (class_exists('XoopsFormEditor')) {
            $options['name']   = $name;
            $options['value']  = $value;
            $options['rows']   = 5;
            $options['cols']   = '100%';
            $options['width']  = '100%';
            $options['height'] = '200px';
            if ($isAdmin) {
                $descEditor = new XoopsFormEditor(ucfirst($name), $xoopsModuleConfig['editorAdmin'], $options, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new XoopsFormEditor(ucfirst($name), $xoopsModuleConfig['editorUser'], $options, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new XoopsFormDhtmlTextArea(ucfirst($name), $name, $value, '100%', '100%');
        }

        //        $form->addElement($descEditor);

        return $descEditor;
    }

    /**
     * @param $nameTmp
     * @param $emailTmp
     * @param $urlTmp
     * @param $messageTmp
     * @return XoopsThemeForm
     */
    public static function getSignForm($nameTmp, $emailTmp, $urlTmp, $messageTmp)
    {
        $name      = new XoopsFormText(_MD_GBOOK_NAME, 'Name', 43, 100, $nameTmp);
        $email     = new XoopsFormText(_MD_GBOOK_EMAIL, 'Email', 43, 100, $emailTmp);
        $url       = new XoopsFormText(_MD_GBOOK_URL, 'URL', 43, 100, $urlTmp);
        $message   = new XoopsFormTextArea(_MD_GBOOK_MESSAGE, 'Message', $messageTmp);
        $submit    = new XoopsFormButton('', 'submit', _MD_GBOOK_SUBMIT, 'submit');
        $gbookform = new XoopsThemeForm(_MD_GBOOK_SIGN, 'gbookform', 'sign.php');

        $gbookform->addElement($name, true);
        $gbookform->addElement($email);
        $gbookform->addElement($url);
        $gbookform->addElement($message, true);
        $gbookform->addElement(new XoopsFormCaptcha(), true);
        $gbookform->addElement($submit);

        return $gbookform;
    }

    /**
     * @return string
     */
    public static function gbookIP()
    {
        $ip = 'UNKNOWN';
        if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $ip = getenv('HTTP_X_FORWARDED_FOR');
            } else {
                if (getenv('REMOTE_ADDR')) {
                    $ip = getenv('REMOTE_ADDR');
                }
            }
        }

        return $ip;
    }
    /**
     *
     * Verifies XOOPS version meets minimum requirements for this module
     * @static
     * @param XoopsModule $module
     *
     * @return bool true if meets requirements, false if not
     */
    public static function checkXoopsVer(XoopsModule $module)
    {
        xoops_loadLanguage('admin', $module->dirname());
        //check for minimum XOOPS version
        $currentVer  = substr(XOOPS_VERSION, 6); // get the numeric part of string
        $currArray   = explode('.', $currentVer);
        $requiredVer = '' . $module->getInfo('min_xoops'); //making sure it's a string
        $reqArray    = explode('.', $requiredVer);
        $success     = true;
        foreach ($reqArray as $k => $v) {
            if (isset($currArray[$k])) {
                if ($currArray[$k] > $v) {
                    break;
                } elseif ($currArray[$k] == $v) {
                    continue;
                } else {
                    $success = false;
                    break;
                }
            } else {
                if ((int)$v > 0) { // handles versions like x.x.x.0_RC2
                    $success = false;
                    break;
                }
            }
        }

        if (!$success) {
            $module->setErrors(sprintf(_AM_GBOOK_ERROR_BAD_XOOPS, $requiredVer, $currentVer));
        }

        return $success;
    }

    /**
     *
     * Verifies PHP version meets minimum requirements for this module
     * @static
     * @param XoopsModule $module
     *
     * @return bool true if meets requirements, false if not
     */
    public static function checkPhpVer(XoopsModule $module)
    {
        xoops_loadLanguage('admin', $module->dirname());
        // check for minimum PHP version
        $success = true;
        $verNum  = phpversion();
        $reqVer  =& $module->getInfo('min_php');
        if (false !== $reqVer && '' !== $reqVer) {
            if (version_compare($verNum, $reqVer, '<')) {
                $module->setErrors(sprintf(_AM_GBOOK_ERROR_BAD_PHP, $reqVer, $verNum));
                $success = false;
            }
        }

        return $success;
    }
}
