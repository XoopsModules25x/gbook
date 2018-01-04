<?php namespace XoopsModules\Gbook;
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * GbookUtility Class
 *
 * @copyright   XOOPS Project (https://xoops.org)
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      XOOPS Development Team
 * @package     GBook
 * @since       1.03
 *
 */

//namespace GBook;

use Xmf\Request;
use XoopsModules\Gbook;
use XoopsModules\Gbook\Common;

/**
 * Class Utility
 */
class Utility
{
    use common\VersionChecks; //checkVerXoops, checkVerPhp Traits

    use common\ServerStats; // getServerStats Trait

    use common\FilesManagement; // Files Management Trait

    //--------------- Custom module methods -----------------------------

    /**
     * @param $name
     * @param $value
     * @return XoopsFormDhtmlTextArea|XoopsFormEditor
     */
    public static function getEditor($name, $value)
    {
        global $xoopsUser, $xoopsModule, $xoopsModuleConfig;
        $options = [];
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

}
