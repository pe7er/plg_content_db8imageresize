<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.Db8ImageResize
 *
 * @author     Peter Martin
 * @copyright  Copyright 2016 Peter Martin. All rights reserved.
 * @license    GNU Public License version 3 or later
 * @link       https://db8.nl
 */

defined('_JEXEC') or die;

require __DIR__ . '/vendor/autoload.php';
use \Eventviva\ImageResize;

/**
 * db8 Image Resize Content Plugin
 *
 * @since  3.6
 */
class PlgContentDb8ImageResize extends JPlugin
{
	/**
	 * @param $context
	 * @param $article
	 * @param $isNew
	 */
	public function onContentAfterSave($context, $article, $isNew)
	{
		if($context == 'com_media.file' AND (!empty($article) AND is_object($article)) AND $isNew == true)
		{

			if (!isset($article->type))
			{
				return;
			}

			$upload = pathinfo($article->filepath);
			$image  = new ImageResize($article->filepath);

			//thumbnail
			$tnw = $this->params->get('tn_width');
			$tnh = $this->params->get('tn_height');
			if ($tnw > 0 || $tnh > 0)
			{
				$image->resizeToBestFit($tnw, $tnh);
				$image->save($upload["dirname"] . '/' . $upload["filename"] . '-tn.' . $upload["extension"]);
			}

			//xs
			$xsw = $this->params->get('xs_width');
			$xsh = $this->params->get('xs_height');
			if ($xsw > 0 || $xsh > 0)
			{
				$image->resizeToBestFit($xsw, $xsh);
				$image->save($upload["dirname"] . '/' . $upload["filename"] . '-xs.' . $upload["extension"]);
			}

			//sm
			$smw = $this->params->get('sm_width');
			$smh = $this->params->get('sm_height');
			if ($smw > 0 || $smh > 0)
			{
				$image->resizeToBestFit($smw, $smh);
				$image->save($upload["dirname"] . '/' . $upload["filename"] . '-sm.' . $upload["extension"]);
			}

			//md
			$mdw = $this->params->get('md_width');
			$mdh = $this->params->get('md_height');
			if ($mdw > 0 || $mdh > 0)
			{
				$image->resizeToBestFit($mdw, $mdh);
				$image->save($upload["dirname"] . '/' . $upload["filename"] . '-md.' . $upload["extension"]);
			}

			//lg
			$lgw = $this->params->get('lg_width');
			$lgh = $this->params->get('lg_height');
			if ($lgw > 0 || $lgh > 0)
			{
				$image->resizeToBestFit($lgw, $lgh);
				$image->save($upload["dirname"] . '/' . $upload["filename"] . '-lg.' . $upload["extension"]);
			}
		}
	}
}