<?php

return [
    'football_data_org' => [
        'apiUrl' => 'https://api.football-data.org/',
        'version' => 'v4',
        'credentials' => [
            'X-Auth-Token' => '798cfa1d1be34e1ebebfc4acd5968fb3',
        ],
        'methods' => [
            'getMatches' => 'matches',
        ],
        'timeout' => 10,
        'retry' => 3,
    ]
];
