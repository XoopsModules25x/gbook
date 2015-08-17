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
 *  Version : 1.00 Wed 2012/06/13 22:32:57 : Ingo H. de Boer Exp $
 * ****************************************************************************
 */

// defined('XOOPS_ROOT_PATH') || exit('XOOPS Root Path not defined');

/**
 * @param $name_tmp
 * @param $email_tmp
 * @param $url_tmp
 * @param $message_tmp
 *
 * @return XoopsThemeForm
 */
function gbookSignForm($name_tmp, $email_tmp, $url_tmp, $message_tmp)
{
    $name      = new XoopsFormText(_GBOOK_NAME, 'Name', 43, 100, $name_tmp);
    $email     = new XoopsFormText(_GBOOK_EMAIL, 'Email', 43, 100, $email_tmp);
    $url       = new XoopsFormText(_GBOOK_URL, 'URL', 43, 100, $url_tmp);
    $message   = new XoopsFormTextArea(_GBOOK_MESSAGE, 'Message', $message_tmp);
    $submit    = new XoopsFormButton('', 'submit', _GBOOK_SUBMIT, 'submit');
    $gbookform = new XoopsThemeForm(_GBOOK_SIGN, 'gbookform', 'sign.php');

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
