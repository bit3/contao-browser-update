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


class browserUpdate extends Backend
{
	protected $intVersionIE 		= 6;
	protected $intVersionFirefox	= 2;
	protected $intVersionOpera		= 9.25;
	protected $intVersionSafari		= 2;

	/**
     * Get a page layout and return it as database result object.
     * This is a copy from PageRegular, see comments in parseFrontendTemplate() below for the reason why this is here.
     */
    protected function getPageLayout($intId)
    {
        $objLayout = $this->Database->prepare("SELECT * FROM tl_layout WHERE id=?")
                                    ->limit(1)
                                    ->execute($intId);
		
        // Fallback layout
        if ($objLayout->numRows < 1)
        {
            $objLayout = $this->Database->prepare("SELECT * FROM tl_layout WHERE fallback=?")
                                        ->limit(1)
                                        ->execute(1);
        }
        
        // Die if there is no layout at all
        if ($objLayout->numRows < 1)
        {
            $this->log('Could not find layout ID "' . $intId . '"', 'PageRegular getPageLayout()', TL_ERROR);

            header('HTTP/1.1 501 Not Implemented');
            die('No layout specified');
        }

        return $objLayout;
    } 

       
    public function outputFrontendTemplate($strContent, $strTemplate) {
        global $objPage;
		
		$objLayout = $this->getPageLayout($objPage->layout);
		
		if($objLayout->browserUpdateEnabled)
		{
			$booShowNotification 	= false;
			$strPeriod 				= $objLayout->browserUpdatePeriod;
			$strTest				= $objLayout->browserUpdateTest;
			$strRequest 			= ampersand($this->Environment->request, true);
			$arrBrowser 			= $this->getBrowser();
			
			if($strTest == 'deaktiviert')
			{
				if(!$this->Input->cookie('browserUpdate'))
				{
					if(	($arrBrowser['msie'] AND 
							(($objLayout->browserUpdateIE == 'auto' AND $arrBrowser['msie'] <= $this->intVersionIE)
							OR (is_numeric($objLayout->browserUpdateIE) AND $arrBrowser['msie'] <= $objLayout->browserUpdateIE)))
						OR ($arrBrowser['firefox'] AND 
							(($objLayout->browserUpdateFirefox == 'auto' AND $arrBrowser['firefox'] <= $this->intVersionFirefox) 
							OR (is_numeric($objLayout->browserUpdateFirefox) AND $arrBrowser['firefox'] <= $objLayout->browserUpdateFirefox)))
						OR ($arrBrowser['opera'] AND 
							(($objLayout->browserUpdateOpera == 'auto' AND $arrBrowser['opera'] <= $this->intVersionOpera)
							OR (is_numeric($objLayout->browserUpdateOpera) AND $arrBrowser['opera'] <= $objLayout->browserUpdateOpera)))
						OR ($arrBrowser['safari'] AND 
							(($objLayout->browserUpdateSafari == 'auto' AND $arrBrowser['safari'] <= $this->intVersionSafari)
							OR (is_numeric($objLayout->browserUpdateSafari) AND $arrBrowser['safari'] <= $objLayout->browserUpdateSafari)))
						OR $arrBrowser['netscape'])
					{
						$booShowNotification = true;
						$this->setCookie('browserUpdate', 'true', time() + 60 * 60 * 24);
					}
					else
						$this->setCookie('browserUpdate', 'false', time() + 60 * 60 * 24);
				}
			
				if($this->Input->get('browserUpdate') == 'close')
				{
					$this->setCookie('browserUpdate', 'false', time() + 60 * $strPeriod);
					$this->redirect(str_replace(((strpos($strRequest, '?browserUpdate=close') === false) ? '&amp;' : '?') . 'browserUpdate=close', '', $strRequest));
				}
			}
			
			if($strTest == 'aktiviert' OR $this->Input->cookie('browserUpdate') == 'true' OR $booShowNotification) 
			{			
				$strHead  = "	<link rel=\"stylesheet\" href=\"system/modules/browser_update/html/browserUpdate.css\" type=\"text/css\" media=\"screen\" />\n";
				
				if($strPeriod != 0)
					$strHead .= "	<script type=\"text/javascript\" src=\"system/modules/browser_update/html/browserUpdate.js.php?duration=" . ($strPeriod / (60 * 24)) . "&amp;test=" . $strTest . "\"></script>\n";
				
				$strHead .= "</head>";
				
				preg_match('/<body(.*)>/U', $strContent, $strInnerBody);
			
				$strBody  = "<body" . $strInnerBody[1] . ">\n";
				$strBody .= "	<div id=\"browserUpdate\">\n";
				
				if($strPeriod != 0)
				{
					$strBody .= "		<div>\n";
					$strBody .= "			<a href=\"" . $strRequest . ((strpos($strRequest, '?') === false) ? '?' : '&amp;') . "browserUpdate=close\" id=\"browserUpdateClose\">X</a>\n";
					$strBody .= "		</div>\n";
				}
				
				$strBody .= "		<p>\n";
				$strBody .= "			" . sprintf($GLOBALS['TL_LANG']['MSC']['browserUpdate']['text'], $arrBrowser['browser'], $arrBrowser['version']) ." <a href=\"" . $GLOBALS['TL_LANG']['MSC']['browserUpdate']['href'] . "\"  onclick=\"window.open(this.href); return false;\">" . $GLOBALS['TL_LANG']['MSC']['browserUpdate']['link'] . "</a>.\n";
				
				$strBody .= "		</p>\n";
				$strBody .= "	</div>\n";
				
				$strContent = str_replace('</head>', $strHead, $strContent);
				$strContent = str_replace('<body' . $strInnerBody[1] . '>', $strBody, $strContent);
			}
		}
		
        return $strContent;
    }
	
	protected function getBrowser($agent=null) 
	{
	
		$known = array('msie', 'firefox', 'safari', 'opera', 'netscape');
		$names = array('msie' => 'Internet Explorer', 'firefox' => 'Firefox', 'safari' => 'Safari', 'opera' => 'Opera', 'netscape' => 'Netscape Navigator');

		$agent = strtolower($agent ? $agent : $_SERVER['HTTP_USER_AGENT']);
		$pattern = '#(?P<browser>' . join('|', $known) . ')[/ ]+(?P<version>[0-9]+(?:\.[0-9]+)?)#';

		if(!preg_match_all($pattern, $agent, $matches)) 
			return array();
			
		$i = count($matches['browser'])-1;
		
		return array(
			$matches['browser'][$i] => $matches['version'][$i],
			'browser'				=> $names[$matches['browser'][$i]],
			'version'				=> $matches['version'][$i]
		);
	}
}

?>