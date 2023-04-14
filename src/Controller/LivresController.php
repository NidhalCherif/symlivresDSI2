<?php

namespace App\Controller;

use App\Entity\Livres;
use App\Repository\LivresRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivresController extends AbstractController
{   //paramconverter
    #[Route('/livres/{id}', name: 'app_livres_id')]
    public function find(Livres $livre): Response
    {
        dd($livre);


    }
    #[Route('/livres', name: 'app_livres')]
    public function findAll(LivresRepository $rep): Response
    {
         $livres=$rep->findAll();
        dd($livres);
   }
    #[Route('admin/livres/add', name: 'admin_livres_add')]
    public function add(ManagerRegistry $doctrine): Response
    {    $dateedition=new \DateTime('2022-01-01');
        $livre = new Livres();
        $livre->setLibelle('Réseau')
              ->setPrix(120)
              ->setDescription('bla bla bla bla ')
              ->setImage('https://via.placeholder.com/300')
              ->setEditeur('Eyrolles')
              ->setDateEdition($dateedition);

        $em=$doctrine->getManager();
        $em->persist($livre);
        $em->flush();

        dd($livre);    }

    #[Route('admin/livres/update/{id}', name: 'app_livres_id')]
    public function update(Livres $livre,ManagerRegistry $doctrine): Response
    {

        $livre->setPrix(110);
        $em=$doctrine->getManager();
        $em->flush();
        dd($livre);


    }

    #[Route('admin/livres/delete/{id}', name: 'admin_livres_id_dele')]
    public function delete(Livres $livre,ManagerRegistry $doctrine): Response
    {

        $em=$doctrine->getManager();
        $em->remove($livre);
        $em->flush();
        dd($livre);


    }

}
