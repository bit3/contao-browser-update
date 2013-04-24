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
 * Variables
 */
$strVersionIE 		= '6';
$strVersionFirefox	= '2.0';
$strVersionOpera	= '9.25';
$strVersionSafari	= '2.0';
 

/**
 * Config
 */
$GLOBALS['TL_DCA']['tl_layout']['config']['onload_callback'][] = array('tl_browserUpdate_layout', 'changePalette');
 
 
 /**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_layout']['palettes']['__selector__'][] = 'browserUpdateEnabled';
 
foreach($GLOBALS['TL_DCA']['tl_layout']['palettes'] as $k => $v) {
	if($k != '__selector__') {		
		if(strstr($v, '{expert_legend'))
			$GLOBALS['TL_DCA']['tl_layout']['palettes'][$k]	= str_replace('{expert_legend', '{browserUpdate_legend},browserUpdateEnabled;{expert_legend', $v);
		elseif(strstr($v, 'urchinId;'))
			$GLOBALS['TL_DCA']['tl_layout']['palettes'][$k] = str_replace('urchinId;', 'urchinId;browserUpdateEnabled;', $v);
		else
			$GLOBALS['TL_DCA']['tl_layout']['palettes'][$k] = str_replace('urchinId,', 'urchinId;browserUpdateEnabled;', $v);
	}
}


/**
 * Subpalettes
 */
$GLOBALS['TL_DCA']['tl_layout']['subpalettes']['browserUpdateEnabled'] = 'browserUpdateTest,browserUpdateIE,browserUpdateFirefox,browserUpdateOpera,browserUpdateSafari,browserUpdateDisplay,browserUpdatePeriod';


/**
 * Fields
 */ 
$GLOBALS['TL_DCA']['tl_layout']['fields'] = array_merge(
	$GLOBALS['TL_DCA']['tl_layout']['fields'], array(
		'browserUpdateEnabled' => array(
			'label'         => &$GLOBALS['TL_LANG']['tl_layout']['browserUpdateEnabled'],
			'inputType'     => 'checkbox',
			'exclude'       => true,
			'eval'          => array('submitOnChange'=>true)
		),
		'browserUpdateTest' => array(
			'label'		=> &$GLOBALS['TL_LANG']['tl_module']['browserUpdateTest'],
			'default'	=> 'deaktiviert',
			'inputType'	=> 'radio',
			'options'	=> array('aktiviert', 'deaktiviert'),
			'reference'	=> &$GLOBALS['TL_LANG']['tl_module']['browserUpdateTestValues'],
			'eval'		=> array('helpwizard'=>true, 'mandatory'=>true, 'submitOnChange'=>true)
		),
		'browserUpdateIE' => array(
			'label' 	=> &$GLOBALS['TL_LANG']['tl_module']['browserUpdateIE'],
			'default'   => 'auto',
			'inputType'	=> 'select',
			'options'   => array('auto', 'false', '5.5', '6', '7'),
			'reference' => array(
				'auto'	=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['auto'], $strVersionIE),
				'false'	=> &$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['false'], 
				'5.5'	=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['version'], '5.5'), 
				'6'		=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['version'], '6'), 
				'7'		=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['version'], '7')
			),
			'eval'      => array('mandatory'=>true, 'tl_class'=>'w50')
		),
		'browserUpdateFirefox' => array(
			'label' 	=> &$GLOBALS['TL_LANG']['tl_module']['browserUpdateFirefox'],
			'default'   => 'auto',
			'inputType'	=> 'select',
			'options'   => array('auto', 'false', '1', '1.5', '2', '3'),
			'reference' => array(
				'auto'	=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['auto'], $strVersionFirefox),
				'false'	=> &$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['false'], 
				'1'		=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['version'], '1.0'), 
				'1.5'	=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['version'], '1.5'), 
				'2'		=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['version'], '2.5'), 
				'3'		=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['version'], '3.0')
			),
			'eval'      => array('mandatory'=>true, 'tl_class'=>'w50')
		),
		'browserUpdateOpera' => array(
			'label' 	=> &$GLOBALS['TL_LANG']['tl_module']['browserUpdateOpera'],
			'default'   => 'auto',
			'inputType'	=> 'select',
			'options'   => array('auto', 'false', '8', '9', '9.25', '9.64'),
			'reference' => array(
				'auto'	=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['auto'], $strVersionOpera),
				'false'	=> &$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['false'], 
				'8'		=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['version'], '8.0'), 
				'9'		=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['version'], '9.0'), 
				'9.25'	=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['version'], '9.25'), 
				'9.64'	=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['version'], '9.64')
			),
			'eval'      => array('mandatory'=>true, 'tl_class'=>'w50')
		),
		'browserUpdateSafari' => array(
			'label' 	=> &$GLOBALS['TL_LANG']['tl_module']['browserUpdateSafari'],
			'default'   => 'auto',
			'inputType'	=> 'select',
			'options'   => array('auto', 'false', '1', '1.2', '2', '3', '3.2'),
			'reference' => array(
				'auto'	=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['auto'], $strVersionSafari),
				'false'	=> &$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['false'], 
				'1'		=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['version'], '1.0'), 
				'1.2'	=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['version'], '1.2'), 
				'2'		=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['version'], '2.0'), 
				'3'		=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['version'], '3.0'), 
				'3.2'	=> sprintf(&$GLOBALS['TL_LANG']['tl_module']['browserUpdateVersion']['version'], '3.2')
			),
			'eval'      => array('mandatory'=>true, 'tl_class'=>'w50')
		),
		'browserUpdatePeriod' => array(
			'label'		=> &$GLOBALS['TL_LANG']['tl_module']['browserUpdatePeriod'],
			'default'	=> 60,
			'inputType'	=> 'text',
			'eval'		=> array('mandatory'=>true, 'rgxp'=>'digit', 'maxlength'=>4, 'tl_class'=>'w50',)
		)
	)
);


class tl_browserUpdate_layout extends Backend
{
    public function changePalette(DataContainer $dc) {
        if (!$dc->id)
        {
            return;
        }
        
        $objLayout = $this->Database->prepare("SELECT browserUpdateTest FROM tl_layout WHERE id=?")
                                     ->limit(1)
                                     ->execute($dc->id);
        
        if ($objLayout->numRows > 0 AND $objLayout->browserUpdateTest == 'aktiviert')
			$GLOBALS['TL_DCA']['tl_layout']['subpalettes']['browserUpdateEnabled'] = 'browserUpdateTest,browserUpdatePeriod';
    }
}  

?>