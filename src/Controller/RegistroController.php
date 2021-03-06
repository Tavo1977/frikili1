<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use phpDocumentor\Reflection\Types\Boolean;

class RegistroController extends AbstractController
{
    /**
     * @Route("/registro", name="registro")
     */
    public function index(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
 //           $user->setBaneado( baneado: false);
            $variable = false;
 //           $user->setBaneado(FALSE);
            $user->setRoles(['ROLE_USER']);
            $em->persist($user);
            $em->flush();
            $this->addFlash('exito','Se ha registrado exitosamente');
            return $this->redirectToRoute('registro');
        }


        return $this->render('registro/index.html.twig', [
            'controller_name' => 'Hola Mundo cruel',
            'formulario' => $form->createView(),
        ]);
    }
}
