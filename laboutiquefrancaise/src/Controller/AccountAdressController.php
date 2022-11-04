<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountAdressController extends AbstractController
{ 
    /**
     * @Route("/compte/adresses", name="account_adress")
     */
    public function index(): Response
    {
        
        return $this->render('account/adress.html.twig');
    }

     /**
     * @Route("/compte/ajouter-une-adresse", name="account_adress_add")
     */
    public function add(Request $request): Response
    {
        $address=new Address();
        $form= $this->createForm(AddressType::class,$address);
        $form->handleRequest($request);

        if($form -> isSubmitted() && $form ->isValid()){
            $address->setUser($this->getUser());
            dd($address);
        }
        return $this->render('account/adress_add.html.twig',[
            'form'=> $form->createView()
        ]);
    }
}
  