<?php

namespace App\Controller;

use Psr\Cache\CacheItemInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

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
  public function browse(HttpClientInterface $httpClient, CacheInterface $cache, string $slug = null): Response
  {
    $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;

    $mixes = $cache->get('mixes_data', function (CacheItemInterface $cacheItem) use ($httpClient) {
      $cacheItem->expiresAfter(5);
      $response = $httpClient->request('GET', 'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json');
      return $response->toArray();
    });

    return $this->render('vinyl/browse.html.twig', [
      'genre' => $genre,
      'mixes' => $mixes
    ]);
  }

}