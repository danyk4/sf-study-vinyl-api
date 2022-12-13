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
    $mixes = $this->getMixes();

    return $this->render('vinyl/browse.html.twig', [
      'genre' => $genre,
      'mixes' => $mixes
    ]);
  }

  private function getMixes()
  {
    // temporary data
    return [
      [
        'title' => 'PB & Jams',
        'trackCount' => 14,
        'genre' => 'Rock',
        'createdAt' => new \DateTime('2021-10-02')
      ],
      [
        'title' => 'Put a Hex on your Ex',
        'trackCount' => 8,
        'genre' => 'Heavy Metal',
        'createdAt' => new \DateTime('2022-04-28')
      ],
      [
        'title' => 'Spice Girls - Summer Tunes',
        'trackCount' => 10,
        'genre' => 'Pop',
        'createdAt' => new \DateTime('2019-06-20')
      ],
    ];
  }
}