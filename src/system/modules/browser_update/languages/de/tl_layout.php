<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Torben Stoffer 2009 
 * @author     Torben Stoffer - torben@online.de
 * @package    browserUpdate 
 * @license    LGPL 
 */

 
/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_layout']['browserUpdate_legend'] = 'Browser-Update';


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_layout']['browserUpdateEnabled'] 	= array('Browser-Update-Benachrichtigung in die Seite einbinden', 'F&uuml;gt der Internetseite den die Browser-Update-Benachrichtigung (www.browser-update.org) hinzu.');
$GLOBALS['TL_LANG']['tl_module']['browserUpdateTest']		= array('Testmodus', 'Im Testmodus werden Ihnen die Benachrichtigungen immer angezeigt, sodass Sie die Benachrichtigung testen k&ouml;nnen.');
$GLOBALS['TL_LANG']['tl_module']['browserUpdateIE']			= array('Internet Explorer', 'Geben Sie an, wann die Benachrichtigung beim Internet Explorer erscheinen soll.');
$GLOBALS['TL_LANG']['tl_module']['browserUpdateFirefox']	= array('Firefox', 'Geben Sie an, wann die Benachrichtigung beim Mozilla Firefox erscheinen soll.');
$GLOBALS['TL_LANG']['tl_module']['browserUpdateOpera']		= array('Opera', 'Geben Sie an, wann die Benachrichtigung beim Opera erscheinen soll.');
$GLOBALS['TL_LANG']['tl_module']['browserUpdateSafari']		= array('Safari', 'Geben Sie an, wann die Benachrichtigung beim Safari erscheinen soll.');
$GLOBALS['TL_LANG']['tl_module']['browserUpdateDisplay']	= array('Anzeige', 'Geben Sie an, wie die Benachrichtigung eingebunden werden soll.');
$GLOBALS['TL_LANG']['tl_module']['browserUpdatePeriod']		= array('Wartezeit', 'Geben Sie an, wie lange die Benachrichtigung nicht erscheinen soll, nachdem der Besucher sie geschlossen hat.<br />Geben Sie 0 ein, um das Schlie&szlig;en zu deaktivieren.');
$GLOBALS['TL_LANG']['tl_module']['browserUpdatePeriod']		= array('Wartezeit in Minuten', 'Geben Sie in Minuten an, wie lange die Benachrichtigung nicht erscheinen soll, nachdem der Besucher sie geschlossen hat.<br />Geben Sie 0 ein, um das Schlie&szlig;en zu deaktivieren.');


/**
 * References
 */
$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['auto']			= 'Version automatisch anpassen (aktuell Version %s)';
$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['false']			= 'Benachrichtigung nie anzeigen';
$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['version']			= 'Bis einschlie&szlig;lich Version %s';
$GLOBALS['TL_LANG']['tl_module']['browserUpdateTestValues']['aktiviert']	= array('Aktiviert', 'Die Benachrichtigung wird jedem Besucher angezeigt. Diese Option sollten Sie nur zu Testzwecken verwenden.');
$GLOBALS['TL_LANG']['tl_module']['browserUpdateTestValues']['deaktiviert']	= array('Deaktiviert', 'Es werden Ihre Angaben verwendet. Hierbei haben Sie die Wahl zwischen einer konkreten Version, dem automatischen Versionsupdate, bei dem die Versionen gew&auml;hlt wird, die vom Hersteller nicht mehr unterst&uuml;tzt werden, Sicherheitsl&uuml;cken aufweisen oder sehr lange veraltet sind, oder der Option die Benachrichtigung bei keiner Version anzuzeigen.');

?>