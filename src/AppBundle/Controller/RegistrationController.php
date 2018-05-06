<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\CustomerType;
use AppBundle\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="registration")
     */
    public function registerAction(Request $request)
    {

      $customer = new Customer();

      $form = $this->createForm(CustomerType::class, $customer, [

      ]);

      $form->handleRequest( $request );

      if( !$form->isValid()){
        return $this->render('registration/register.html.twig', [
          'registration_form' => $form->createView(),
        ]);
      }

      if($form->isSubmitted() && $form->isValid()){

        $password = $this->get('security.password_encoder')
                        ->encodePassword(
                          $customer,
                          $customer->getPlainPassword()
                        );

        $customer->setPassword($password);

        $em = $this->getDoctrine()->getManager();
        $em->persist($customer);
        $em->flush();

        $token = new UsernamePasswordToken(
                  $customer,
                  $password,
                  'main',
                  $customer->getRoles()
        );

        $this->get('security.token_storage')->setToken($token);

        $this->addFlash('success', 'Thank you for your registration!');

        return $this->redirectToRoute('flight');
      }

        return $this->render('registration/register.html.twig', [
          'registration_form' => $form->createView(),
        ]);
    }
}
