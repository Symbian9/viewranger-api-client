<?php

namespace Symm\ViewRangerClient;

use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Client;
use GuzzleHttp\Collection;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Command;

use GuzzleHttp\Command\Model;
use Symm\ViewRangerClient\Exception\ViewRangerClientException;
use Symm\ViewRangerClient\Model\Beacon;

/**
 * ViewRangerClient
 */
final class ViewRangerClient extends GuzzleClient implements ViewRangerClientInterface
{
    /**
     * Create a new ViewRangerClient
     *
     * @param string $apiKey
     * @param array  $config
     *
     * @return ViewRangerClientInterface
     * @throws \Exception
     */
    public static function create($apiKey, $config = [])
    {
        $defaults = [
            'base_url' => 'https://api.viewranger.com/public/v1',
            'defaults' => [
                'query' => [
                    'format'   => 'json',
                    'key'      => $apiKey,
                ],
                'headers' => [
                    'User-Agent' => 'ViewRangerClient'
                ]
            ]
        ];

        $config = Collection::fromConfig($config, $defaults, []);
        $config = $config->toArray();

        $client = new Client($config);

        return new static($client, new ViewRangerDescription());
    }

    /**
     * {@inheritdoc}
     */
    public function getLastBeaconPosition($username, $pin)
    {
        /** @var Command $command */
        $command = $this->getCommand('getLastBBPosition', [
            'username' => $username,
            'pin'      => $pin
        ]);

        $responseModel = $this->execute($command);
        $this->validateResponse($responseModel);

        return Beacon::fromArray($responseModel['VIEWRANGER']['LOCATION']);
    }

    /**
     * {@inheritdoc}
     */
    public function getBeaconPositions($username, $pin, \DateTime $start = null, \DateTime $end = null, $limit = null)
    {
        $params = [
            'username'   => $username,
            'pin'        => $pin
        ];

        if ($start) {
            $params['date_from']  = $start->format('Y-m-d H:i:s');
        }

        if ($end) {
            $params['date_until'] = $end->format('Y-m-d H:i:s');
        }

        if ($limit) {
            $params['limit'] = $limit;
        }

        $command = $this->getCommand('getBBPositions', $params);

        $responseModel = $this->execute($command);
        $this->validateResponse($responseModel);

        $response = $responseModel->toArray();

        $locations = new ArrayCollection([]);
        foreach ($response['VIEWRANGER']['LOCATIONS'] as $location) {
            $beacon = Beacon::fromArray($location);
            $locations->set($beacon->getDateTime()->format('U'), $beacon);
        }

        return $locations;
    }

    /**
     * The API helpfully replies with 200 OK for errors :(
     *
     * @param Model $response
     *
     * @throws ViewRangerClientException
     */
    private function validateResponse(Model $response)
    {
        if (array_key_exists('ERROR', $response['VIEWRANGER'])) {
            $error = $response['VIEWRANGER']['ERROR'];

            throw new ViewRangerClientException($error['MESSAGE'], $error['CODE']);
        }
    }
}