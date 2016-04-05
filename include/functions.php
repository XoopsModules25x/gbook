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

// defined('XOOPS_ROOT_PATH') || exit('XOOPS Root Path not defined');

/**
 * @param $nameTmp
 * @param $emailTmp
 * @param $urlTmp
 * @param $messageTmp
 *
 * @return XoopsThemeForm
 */
function gbookSignForm($nameTmp, $emailTmp, $urlTmp, $messageTmp)
{
    $name      = new XoopsFormText(_GBOOK_NAME, 'Name', 43, 100, $nameTmp);
    $email     = new XoopsFormText(_GBOOK_EMAIL, 'Email', 43, 100, $emailTmp);
    $url       = new XoopsFormText(_GBOOK_URL, 'URL', 43, 100, $urlTmp);
    $message   = new XoopsFormTextArea(_GBOOK_MESSAGE, 'Message', $messageTmp);
    $submit    = new XoopsFormButton('', 'submit', _GBOOK_SUBMIT, 'submit');
    $gbookForm = new XoopsThemeForm(_GBOOK_SIGN, 'gbookform', 'sign.php');

    $gbookForm->addElement($name, true);
    $gbookForm->addElement($email);
    $gbookForm->addElement($url);
    $gbookForm->addElement($message, true);
    $gbookForm->addElement(new XoopsFormCaptcha(), true);
    $gbookForm->addElement($submit);

    return $gbookForm;
}

/**
 * @return string
 */
function gbookIP()
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
