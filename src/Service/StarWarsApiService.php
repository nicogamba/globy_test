<?php

namespace App\Service;

use GuzzleHttp\Client;
use Psr\Cache\CacheItemPoolInterface;

class StarWarsApiService
{
    private const SWAPI_URL = 'https://swapi.dev/api/people/';
    private const CACHE_KEY = 'star_wars_people_page_';
    private $client;
    private $cache;

    public function __construct(Client $client, CacheItemPoolInterface $cache)
    {
        $this->client = $client;
        $this->cache = $cache;
    }

    public function fetchPeople(int $page): array
    {
        $cacheKey = self::CACHE_KEY . $page;
        $cacheItem = $this->cache->getItem($cacheKey);

        if (!$cacheItem->isHit()) {
            $response = $this->client->get(self::SWAPI_URL . "?page={$page}");
            $data = json_decode($response->getBody(), true);
            $cacheItem->set($data);
            $cacheItem->expiresAfter(60);
            $this->cache->save($cacheItem);
        } else {
            $data = $cacheItem->get();
        }

        return $data;
    }
}
