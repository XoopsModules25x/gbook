<?php
/**
 * GBOOK module
 *
 * @File       modinfo.php
 * @copyright  Ingo H. de Boer (http://www.winshell.org)
 * @license    GNU General Public License (GPL)
 * @package    GBook
 * @author     Ingo H. de Boer (idb@winshell.org)
 * @lanuage    de
 * @author     Muki - http://www.myxoops.org
 * @date       2014/01/19
 */

define('_MI_GBOOK_NAME', 'Gästebuch');
define('_MI_GBOOK_DESC', 'Das GBook Modul ist für die Verwaltung des Gästebuchs zuständig.');

define('_MI_GBOOK_NUM_TITLE', 'Einträge je Seite');
define('_MI_GBOOK_NUM_DESCRIPTION', 'Die Anzahl der angezeigten Einträge je Seite.');

define('_MI_GBOOK_ORDER_TITLE', 'Sortierrichtung der Einträge');
define('_MI_GBOOK_ORDER_DESCRIPTION', 'Die Reihenfolge in der die Einträge angezeigt werden.');

define('_MI_GBOOK_ORDER_ASC', 'Aufsteigend');
define('_MI_GBOOK_ORDER_DESC', 'Absteigend');

define('_MI_GBOOK_DFORMAT_TITLE', 'Datumsformat');
define('_MI_GBOOK_DFORMAT_DESCRIPTION', 'Wie das Datum des Eintrags angezeigt wird.');

//1.10
define('_MI_GBOOK_EDITOR_ADMIN', 'Editor für Admin');
define('_MI_GBOOK_EDITOR_ADMIN_DESC', 'Wählen Sie bitte Editor für den Admin');
define('_MI_GBOOK_EDITOR_USER', 'Editor für Anwender');
define('_MI_GBOOK_EDITOR_USER_DESC', 'Wählen Sie bitte Editor für die Anwender');

define('_MI_GBOOK_MANAGE_ENTRIES', 'Eintäge Verwalten');
//Help
define('_MI_GBOOK_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_GBOOK_HELP_HEADER', __DIR__ . '/help/helpheader.html');
define('_MI_GBOOK_BACK_2_ADMIN', 'Zurück zum Admin von ');
define('_MI_GBOOK_HELP_OVERVIEW', 'Overview');
