<?php

namespace FIT\Bundle\ModuleDefaultBundle\Controller;

use FIT\NetopeerBundle\Controller\ModuleControllerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ModuleController extends \FIT\NetopeerBundle\Controller\ModuleController implements ModuleControllerInterface
{
	/**
	 * @inheritdoc
	 *
	 * @Route("/sections/{key}/", name="section")
	 * @Route("/sections/{key}/{module}/", name="module", requirements={"key" = "\d+"})
	 * @Route("/sections/{key}/{module}/{subsection}/", name="subsection")
	 * @Template("FITModuleDefaultBundle:Module:section.html.twig")
	 *
	 */
	public function moduleAction($key, $module = null, $subsection = null)
	{
		$this->prepareDataForModuleAction("FITModuleDefaultBundle", $key, $module, $subsection);

		return $this->getTwigArr();
	}

}
