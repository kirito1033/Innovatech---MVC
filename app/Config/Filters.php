<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    public array $aliases = [
        'cors' => \App\Filters\Cors::class,
    ];

    public array $globals = [
        'before' => [
            'cors',
        ],
        'after' => []
    ];
}
