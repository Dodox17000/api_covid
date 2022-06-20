<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getApi(string $var): array
    {
        try {
            $response = $this->client->request(
                'GET',
                'https://coronavirusapifr.herokuapp.com/data/'.$var
            );

        }catch (TransportExceptionInterface|ClientExceptionInterface|DecodingExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface $e) {
           echo $e->getMessage();
        }

        return $response->toArray();
    }

    public function getFranceData(): array
    {
        return $this->getApi('live/france');
    }

    public function getAllData(): array
    {
        return $this->getApi('live/departements');
    }

    public function getDepartmentData($departement): array
    {
        return $this->getApi('live/departement/' . $departement);
    }

    public function getAllDataByDate($date): array
    {
        return $this->getApi('departements-by-date/' . $date);
    }
}
