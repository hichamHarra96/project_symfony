<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{ 
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }
    /**
     * @Route("/inscription", name="app_register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    //on porte l'objet Request et on le passe à $request (appeler Request)
    //mtn le formulaire capable d'ecouter la requete
    {
        $user =new User();    

        
        $form =$this->createForm(RegisterType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user=$form->getData(); // injecter les data du formulaire dans l'objet user
            $password=$encoder->encodePassword($user,$user->getPassword());
           
            $user->setPassword($password);
            $this->entityManager->persist($user);
            $this->entityManager->flush();

           
        }
         
        return $this->render('register/index.html.twig',['form'=>$form->createView()]);
    }
}
