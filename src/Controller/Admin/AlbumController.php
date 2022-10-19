<?php

namespace App\Controller\Admin;

use App\Repository\AlbumRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AlbumController extends AbstractController
{
    /**
     * @Route("/admin/albums", name="admin_albums", methods={"GET"})
     */
    public function listeArtistes(AlbumRepository $repo,PaginatorInterface $paginator, Request $request): Response
    {
        $albums=$paginator->paginate(
        $repo->listeAlbumsCompletePaginee(),
        $request->query->getInt('page', 1), /*page number*/
        9 /*limit per page*/
        );
        return $this->render('admin/album/listeAlbums.html.twig',[
            'lesAlbums' => $albums
        ]);
    }

}
