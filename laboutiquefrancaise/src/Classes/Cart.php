<?php
namespace App\Classes;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Cart{
    private $session;
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager,SessionInterface $session)
    {
        $this->entityManager=$entityManager;
        $this->session=$session;   
    }
    public function add($id){
        $cart=$this->session->get('cart',[]);
        if(!empty($cart[$id])){
            $cart[$id]++;
        }
        else{
            $cart[$id]=1;
        }
        $this->session->set('cart',$cart);
    }
    public function get(){
        return $this->session->get('cart');
    }
    public function remove(){
        return $this->session->remove('cart');
    }

    public function delete($id){
        $cart=$this->session->get('cart',[]);
        unset($cart[$id]);
      return  $this->session->set('cart',$cart);
    }

    public function decrease($id){
        $cart=$this->session->get('cart',[]);
        //verifier si quantity != 1
        if($cart[$id]>1){
            // retirer une quantité (-1)
            $cart[$id]--;
        }
        else{
            // supprimer le produit
            unset($cart[$id]);
        }
        return  $this->session->set('cart',$cart);
    }

    public function getFull(){
        // if($cart->get()) si n'est pas
        $cartComplet=[];
        if($this->get()){
            foreach($this->get() as $id => $quantity){
                $cartComplet[]=[
                    'product'=>$this->entityManager-> getRepository(Product::class)->findOneById($id),
                    'quantity'=>$quantity
                ];
            }
         }
         return $cartComplet;
    }
}
?>