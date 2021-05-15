<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="security_register")
     */
    public function resgister(): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        return $this->render('security/index.html.twig', [
            'controller_name' => "Inscription",
            'form' => $form->createView()
        ]);
    }
}
