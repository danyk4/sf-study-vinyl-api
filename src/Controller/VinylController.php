<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function Symfony\Component\String\u;

class VinylController
{
  #[Route('/', name: 'homepage')]
  public function index(): Response
  {
    return new Response('Title: PB and Jams');
  }

  #[Route('/browse/{genre}', name: 'browse_genre')]
  public function browse(string $genre = null): Response
  {
    if ($genre) {
      $title = 'Genre: ' . u(str_replace('-', ' ', $genre))->title(true);
    } else {
      $title = 'All Genres';
    }

    return new Response($title);
  }
}