<?php

namespace App\Controller;

use App\Entity\Livres;
use App\Repository\LivresRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
class LivresController extends AbstractController
{   //paramconverter
    #[Route('admin/livres/find/{id}', name: 'admin_livres_find_id')]
    public function find(Livres $livre): Response
    {
        dd($livre);


    }
    #[Route('admin/livres', name: 'app_livres')]
    public function findAll(LivresRepository $rep,PaginatorInterface $paginator, Request $request): Response
    {
         $livres=$rep->findAll();
        $pagination = $paginator->paginate(
            $livres, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            15 /*limit per page*/
        );
        //dd($livres);
        return $this->render('livres/findAll.html.twig',['livres'=>$pagination]);
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
    #[Route('admin/livres/delete/{id}', name: 'admin_livres_id_delete')]
    public function delete(Livres $livre,ManagerRegistry $doctrine): Response
    {
        $em=$doctrine->getManager();
        $em->remove($livre);
        $em->flush();
        //dd($livre);
        return $this->redirectToRoute('app_livres');
    }
}
