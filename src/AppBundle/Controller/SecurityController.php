<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {

      $authenticationUtils = $this->get('security.authentication_utils');

     return $this->render('security/login.html.twig', array(
       'error'         => $authenticationUtils->getLastAuthenticationError(),
     ));
    }

    /**
     * @Route("/logout")
     * @throws \RuntimeException
     */
    public function logoutAction()
    {

        throw new \RuntimeException("This should never be called directly");

    }

}
