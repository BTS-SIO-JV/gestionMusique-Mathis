<?php

namespace App\Controller\Admin;

use App\Repository\ArtisteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ArtisteController extends AbstractController
{
    /**
     * @Route("/admin/artistes", name="admin_artistes", methods={"GET"})
     */
    public function listeArtistes(ArtisteRepository $repo,PaginatorInterface $paginator, Request $request): Response
    {
        $artistes=$paginator->paginate(
        $repo->listeArtistesComplete(),
        $request->query->getInt('page', 1), /*page number*/
        9 /*limit per page*/
        );
        return $this->render('artiste/listeArtistes.html.twig',[
            'lesArtistes' => $artistes
        ]);
    }
}
