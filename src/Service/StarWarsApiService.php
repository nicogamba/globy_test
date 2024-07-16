<?php

namespace App\Service;

use GuzzleHttp\Client;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class StarWarsApiService
{
    private const SWAPI_URL = 'https://swapi.dev/api/people/';
    private const CACHE_KEY = 'star_wars_people_page_';
    private $client;
    private $cache;
    private $params;

    public function __construct(Client $client, CacheItemPoolInterface $cache, ParameterBagInterface $params)
    {
        $this->client = $client;
        $this->cache = $cache;
        $this->params = $params;
    }

    public function fetchPeople(int $page): array
    {
        $cacheKey = self::CACHE_KEY . $page;
        $cacheItem = $this->cache->getItem($cacheKey);
        $cacheTime = intval($this->params->get('cache_expiry'));

        if (!$cacheItem->isHit()) {
            $response = $this->client->get(self::SWAPI_URL . "?page={$page}");
            $data = json_decode($response->getBody(), true);
            $cacheItem->set($data);
            $cacheItem->expiresAfter($cacheTime);
            $this->cache->save($cacheItem);
        } else {
            $data = $cacheItem->get();
        }

        return $data;
    }
}
