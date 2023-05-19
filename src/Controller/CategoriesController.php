<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategorieType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    #[Route('/admin/categories/add', name: 'categories_add')]
    public function add(ManagerRegistry $doctrine, Request $request): Response
    {
        $cat=new Categories();
        $form=$this->createForm(CategorieType::class,$cat);
        $form->handleRequest($request);

         if($form->isSubmitted()&&$form->isValid())
         { $cat=$form->getData();
             $em=$doctrine->getManager();
             $em->persist($cat);
             $em->flush();

          return new Response("La catégorie a été ajoutée dans la base");
         }

        return $this->render("Categories/add.html.twig",['f'=>$form]);
    }

    #[Route('/livreByCat/{id}', name: 'Livre_By_categorie')]
    public function livreByCategrie(Categories $categorie): Response
    {
       $livres=$categorie->getLivres();


        return $this->render("home/findAll.html.twig",['livres'=>$livres]);
    }
}
