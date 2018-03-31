<?php namespace XoopsModules\Gbook;

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
use XoopsModules\Gbook;

/**
 * @package   kernel
 * @copyright copyright &copy; 2000 XOOPS.org
 */
class Entries extends \XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('id', XOBJ_DTYPE_INT, null, true);
        $this->initVar('name', XOBJ_DTYPE_TXTBOX);
        $this->initVar('email', XOBJ_DTYPE_TXTBOX);
        $this->initVar('url', XOBJ_DTYPE_TXTBOX);
        $this->initVar('message', XOBJ_DTYPE_TXTAREA);
        $this->initVar('note', XOBJ_DTYPE_TXTAREA);
        $this->initVar('time', XOBJ_DTYPE_INT);
        $this->initVar('date', XOBJ_DTYPE_TXTBOX);
        $this->initVar('ip', XOBJ_DTYPE_TXTBOX);
        $this->initVar('admin', XOBJ_DTYPE_TXTBOX);

        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('dosmiley', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('doxcode', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('doimage', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('dobr', XOBJ_DTYPE_INT, 1, false);
    }

    /**
     * Get {@link XoopsThemeForm} for adding/editing categories
     *
     * @param mixed $action URL to submit to or false for $_SERVER['REQUEST_URI']
     *
     * @return \XoopsThemeForm
     */
    public function getForm($action = false)
    {
        if (false === $action) {
            $action = Request::getString('REQUEST_URI', '', 'SERVER');
        }
        $title   = _AM_GBOOK_ENTRY_EDIT;
        $helper  = Gbook\Helper::getInstance();
        $utility = new Gbook\Utility();

        require_once $GLOBALS['xoops']->path('class/xoopsformloader.php');

        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);

        $form->addElement(new \XoopsFormText(_AM_GBOOK_NAME, 'name', 35, 255, $this->getVar('name')));
        $form->addElement(new \XoopsFormText(_AM_GBOOK_EMAIL, 'email', 35, 255, $this->getVar('email')));
        $form->addElement(new \XoopsFormText(_AM_GBOOK_URL, 'url', 35, 255, $this->getVar('url')));

        //set Editor options
        $options['name']   = 'message';
        $options['value']  = $this->getVar('message', 'e');
        $options['rows']   = 25;
        $options['cols']   = '100%';
        $options['width']  = '100%';
        $options['height'] = '400px';

        $messageEditor = $utility::getEditor($helper, $options);
        $form->addElement($messageEditor);

        $options['name']  = 'note';
        $options['value'] = $this->getVar('note', 'e');

        $noteEditor = $utility::getEditor($helper, $options);
        $form->addElement($noteEditor);

        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }
}
