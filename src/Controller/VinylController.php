<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class VinylController extends AbstractController
{
  #[Route('/', name: 'homepage')]
  public function homepage(): Response
  {
    $tracks = [
      ['song' => 'Gangsta\'s Paradise', 'artist' => 'Coolio'],
      ['song' => 'Waterfalls', 'artist' => 'TLC'],
      ['song' => 'Kiss from a Rose', 'artist' => 'Seal']
    ];

    return $this->render('vinyl/homepage.html.twig', [
      'title' => 'PB & Jams',
      'tracks' => $tracks
    ]);
  }

  #[Route('/browse/{slug}', name: 'browse_genre')]
  public function browse(string $slug = null): Response
  {
    $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;

    return $this->render('vinyl/browse.html.twig', [
      'genre' => $genre,
    ]);
  }
}