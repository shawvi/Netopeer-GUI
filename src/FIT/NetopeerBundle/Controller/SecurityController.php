<?php
/**
 * Handles pages for login and logout.
 *
 * @author David Alexa <alexa.david@me.com>
 *
 * Copyright (C) 2012-2015 CESNET
 *
 * LICENSE TERMS
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in
 *    the documentation and/or other materials provided with the
 *    distribution.
 * 3. Neither the name of the Company nor the names of its contributors
 *    may be used to endorse or promote products derived from this
 *    software without specific prior written permission.
 *
 * ALTERNATIVELY, provided that this notice is retained in full, this
 * product may be distributed under the terms of the GNU General Public
 * License (GPL) version 2 or later, in which case the provisions
 * of the GPL apply INSTEAD OF those given above.
 *
 * This software is provided ``as is'', and any express or implied
 * warranties, including, but not limited to, the implied warranties of
 * merchantability and fitness for a particular purpose are disclaimed.
 * In no event shall the company or contributors be liable for any
 * direct, indirect, incidental, special, exemplary, or consequential
 * damages (including, but not limited to, procurement of substitute
 * goods or services; loss of use, data, or profits; or business
 * interruption) however caused and on any theory of liability, whether
 * in contract, strict liability, or tort (including negligence or
 * otherwise) arising in any way out of the use of this software, even
 * if advised of the possibility of such damage.
 */
namespace FIT\NetopeerBundle\Controller;

use FIT\NetopeerBundle\Controller\BaseController;
use Symfony\Component\Security\Core\SecurityContext;
use FIT\NetopeerBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;


// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Controller for security pages.
 */
class SecurityController extends BaseController
{

	/**
	 * Login page action.
	 *
	 * @Route("/login/single", name="single_instance_login")
	 */
	public function singleInstanceLoginAction()
	{
		$token = new UsernamePasswordToken('localhostUser', null, "secured_area", array('ROLE_USER', 'ROLE_LOCALHOST'));
		$this->get("security.context")->setToken($token); //now the user is logged in

		//now dispatch the login event
		$request = $this->get("request");
		$event   = new InteractiveLoginEvent($request, $token);
		$this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

		return $this->forward('FITNetopeerBundle:Default:connections');
	}

	/**
	 * Login page action.
	 *
	 * @Route("/login", name="_login")
	 * @Template()
	 */
	public function loginAction()
	{
		$request = $this->getRequest();
		$session = $request->getSession();

		$securityContext = $this->get('security.context');
		if( $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
                        // authenticated REMEMBERED, FULLY will imply REMEMBERED (NON anonymous)
                        return $this->redirect($this->generateUrl('connections'));
                }

		// get the login error if there is one
		if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
			$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
		} else {
			$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
			$session->remove(SecurityContext::AUTHENTICATION_ERROR);
		}

		// last username entered by the user
		$this->assign('last_username', $session->get(SecurityContext::LAST_USERNAME));
		$this->assign('error', $error);

		if ($this->container->getParameter('fit_netopeer.single_instance') === true) {
			if ($this->container->hasParameter('fit_netopeer.single_instance.host')) {
				$this->assign('singleInstanceHost', $this->container->getParameter('fit_netopeer.single_instance.host'));
			}
			if ($this->container->hasParameter('fit_netopeer.single_instance.port')) {
				$this->assign('singleInstancePort', $this->container->getParameter('fit_netopeer.single_instance.port'));
			}


			if (isset($_COOKIE['singleInstanceLoginFailed']) && $_COOKIE['singleInstanceLoginFailed'] == true) {
				$this->getRequest()->getSession()->getFlashBag()->add('error', 'Could not connect to local device.<br/>Probably wrong username/password.');
			}

			setcookie("singleInstanceLoginFailed", false);
		}

		return $this->getTwigArr($this);
	}

	/**
	 * Logout page action.
	 *
	 * @Route("/logout/", name="_logout")
	 * @Template()
	 */
	public function logoutAction()
	{
		// The security layer will intercept this request
	}
}
