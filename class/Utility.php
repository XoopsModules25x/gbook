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
 * Gbook\Utility Class
 *
 * @copyright   XOOPS Project (https://xoops.org)
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      XOOPS Development Team
 * @package     GBook
 * @since       1.03
 *
 */

//namespace GBook;

use XoopsModules\Gbook;
use XoopsModules\Gbook\Common;

/**
 * Class Utility
 */
class Utility
{
    use Common\VersionChecks; //checkVerXoops, checkVerPhp Traits

    use Common\ServerStats; // getServerStats Trait

    use Common\FilesManagement; // Files Management Trait

    //--------------- Custom module methods -----------------------------

    /**
     * @param \Xmf\Module\Helper $helper
     * @param array|null         $options
     * @return \XoopsFormDhtmlTextArea|\XoopsFormEditor
     */
    public static function getEditor($helper = null, $options = null)
    {
        /** @var Gbook\Helper $helper */
        if (null === $options) {
            $options           = [];
            $options['name']   = 'Editor';
            $options['value']  = 'Editor';
            $options['rows']   = 10;
            $options['cols']   = '100%';
            $options['width']  = '100%';
            $options['height'] = '400px';
        }

        $isAdmin = $helper->isUserAdmin();

        if (class_exists('XoopsFormEditor')) {

            if ($isAdmin) {
                $descEditor = new \XoopsFormEditor($options['name'], $helper->getConfig('editorAdmin'), $options, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new \XoopsFormEditor($options['name'], $helper->getConfig('editorUser'), $options, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new \XoopsFormDhtmlTextArea($options['name'], $options['name'], $options['value'], '100%', '100%');
        }

        //        $form->addElement($descEditor);

        return $descEditor;
    }

    /**
     * @param $nameTmp
     * @param $emailTmp
     * @param $urlTmp
     * @param $messageTmp
     * @return \XoopsThemeForm
     */
    public static function getSignForm($nameTmp, $emailTmp, $urlTmp, $messageTmp)
    {
        $name      = new \XoopsFormText(_MD_GBOOK_NAME, 'Name', 43, 100, $nameTmp);
        $email     = new \XoopsFormText(_MD_GBOOK_EMAIL, 'Email', 43, 100, $emailTmp);
        $url       = new \XoopsFormText(_MD_GBOOK_URL, 'URL', 43, 100, $urlTmp);
        $message   = new \XoopsFormTextArea(_MD_GBOOK_MESSAGE, 'Message', $messageTmp);
        $submit    = new \XoopsFormButton('', 'submit', _MD_GBOOK_SUBMIT, 'submit');
        $gbookform = new \XoopsThemeForm(_MD_GBOOK_SIGN, 'gbookform', 'sign.php');

        $gbookform->addElement($name, true);
        $gbookform->addElement($email);
        $gbookform->addElement($url);
        $gbookform->addElement($message, true);
        $gbookform->addElement(new \XoopsFormCaptcha(), true);
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
