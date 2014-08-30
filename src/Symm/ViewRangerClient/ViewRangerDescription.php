<?php

namespace Symm\ViewRangerClient;

use GuzzleHttp\Command\Guzzle\Description;

/**
 * ViewRangerDescription
 */
final class ViewRangerDescription extends Description
{
    /**
     * @param string $baseUrl
     */
    public function __construct($baseUrl = 'http://api.viewranger.com/public/v1/')
    {
        parent::__construct([
                'baseUrl'    => $baseUrl,
                'operations' => [
                    'getLastBBPosition' => [
                        'httpMethod'    => 'GET',
                        'responseModel' => 'getResponse',
                        'parameters'    => [
                            'service'  => [
                                'required' => true,
                                'static'   => true,
                                'name'     => 'service',
                                'default'  => 'getLastBBPosition',
                                'location' => 'query',
                            ],
                            'username' => [
                                'type'     => 'string',
                                'required' => true,
                                'location' => 'query',
                            ],
                            'pin'      => [
                                'required' => true,
                                'type'     => 'integer',
                                'location' => 'query',
                            ],
                        ],
                    ],
                    'getBBPositions'    => [
                        'httpMethod'    => 'GET',
                        'responseModel' => 'getResponse',
                        'parameters'    => [
                            'service'    => [
                                'required' => true,
                                'static'   => true,
                                'name'     => 'service',
                                'default'  => 'getBBPositions',
                                'location' => 'query',
                            ],
                            'username'   => [
                                'required' => true,
                                'type'     => 'string',
                                'location' => 'query',
                            ],
                            'pin'        => [
                                'required' => true,
                                'type'     => 'integer',
                                'location' => 'query',
                            ],
                            'date_from'  => [
                                'type'     => 'string',
                                'location' => 'query',
                            ],
                            'date_until' => [
                                'type'     => 'string',
                                'location' => 'query',
                            ],
                            'limit'      => [
                                'type'     => 'integer',
                                'location' => 'query'
                            ]
                        ],
                    ],
                ],
                'models'     => [
                    'getResponse' => [
                        'type'                 => 'object',
                        'additionalProperties' => [
                            'location' => 'json',
                        ],
                    ],
                ],
            ]
        );
    }
}