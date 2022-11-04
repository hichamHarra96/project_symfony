<?php

namespace App\Controller;

use App\Classes\Cart;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager =$entityManager;
    }

    /**
     * @Route("/mon-panier", name="app_cart")
     */
    public function index(Cart $cart): Response
    {
        // if($cart->get()) si n'est pas
        $cartComplet=[];
        if($cart->get()){
            foreach($cart->get() as $id => $quantity){
                $cartComplet[]=[
                    'product'=>$this->entityManager-> getRepository(Product::class)->findOneById($id),
                    'quantity'=>$quantity
                ];
            }
         }
        
        return $this->render('cart/index.html.twig',[
            'cart'=>$cartComplet
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="add_to_cart")
     */
    public function add( Cart $cart, $id): Response
    {
        $cart->add($id);
        return $this->redirectToRoute('app_cart');
    }

    /**
     * @Route("/cart/remove", name="remove_my_cart")
     */
    public function remove( Cart $cart): Response
    {
        $cart->remove();
        return $this->redirectToRoute('app_product');
    }

    /**
     * @Route("/cart/delete/{id}", name="delete_to_cart")
     */
    public function delete( Cart $cart,$id): Response
    {
        $cart->delete($id);
        return $this->redirectToRoute('app_cart');
    }

      /**
     * @Route("/cart/decrease/{id}", name="decrease_to_cart")
     */
    public function decrease( Cart $cart,$id): Response
    {
        $cart->decrease($id);
        return $this->redirectToRoute('app_cart');
    }

    
}

