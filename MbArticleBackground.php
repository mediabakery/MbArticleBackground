<?php
if(!defined('TL_ROOT'))
	die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  mediabakery
 * @author     Sebastian Tilch <http://www.mediabakery.de>
 * @package
 * @license    LGPL
 * @filesource
 */

class MbArticleBackground extends Backend
{

	public function addBackgroundImage($strContent, $strTemplate)
	{
		if($strTemplate == 'mod_article')
		{
			global $objPage;
			$objArticles = $this->Database->prepare("SELECT alias,mb_articlebackground,mb_articlebackground_src,mb_articlebackground_position,mb_articlebackground_repeat FROM tl_article WHERE pid=?")->execute($objPage->id);
			while($objArticles->next())
			{
				if($objArticles->mb_articlebackground)
				{

					$strContent = preg_replace('/class="mod_article(.*) id="' . $objArticles->alias . '"/', 'class="mod_article articlebackground$1 id="' . $objArticles->alias . '"', $strContent);
					if(preg_match('/id="' . $objArticles->alias . '" style="(.*)"/', $strContent))
					{
						// This element has already a css inline-element
						$strContent = preg_replace('/id="' . $objArticles->alias . '" style="(.*)"/', 'id="' . $objArticles->alias . '" style="' . $this->getBackgroundStyle($objArticles) . '$1"', $strContent);
					}
					else
					{
						// This element has no css inline-element
						$strContent = preg_replace('/id="' . $objArticles->alias . '"/', 'id="' . $objArticles->alias . '" style="' . $this->getBackgroundStyle($objArticles) . '"', $strContent);
					}
				}
			}
		}
		else
		if($strTemplate == 'fe_page')
		{
			if(count($this->arrStyles) > 0)
			{
				$GLOBALS['TL_HEAD'][] = '<style type="text/css">' . implode('', $this->arrStyles) . '</style>';
			}
		}
		return $strContent;
	}

	private function getBackgroundStyle($obj)
	{
		$strStyle = 'background-image:url(' . $obj->mb_articlebackground_src . ');';
		if(strlen($obj->mb_articlebackground_position))
			$strStyle .= 'background-position:' . $obj->mb_articlebackground_position . ';';
		if(strlen($obj->mb_articlebackground_repeat))
			$strStyle .= 'background-repeat:' . $obj->mb_articlebackground_repeat . ';';
		return $strStyle;

		$strStyle = '#' . $obj->alias . '{background-image:url(' . $obj->mb_articlebackground_src . ');';
		if(strlen($obj->mb_articlebackground_position))
			$strStyle .= 'background-position:' . $obj->mb_articlebackground_position . ';';
		if(strlen($obj->mb_articlebackground_repeat))
			$strStyle .= 'background-repeat:' . $obj->mb_articlebackground_repeat . ';';
		$strStyle .= '}';
		return $strStyle;
	}

}
?>