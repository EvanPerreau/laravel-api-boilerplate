<?php

namespace App\Http\Controllers;


use OpenApi\Attributes\Components;
use OpenApi\Attributes\Flow;
use OpenApi\Attributes\Info;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\SecurityScheme;

use OpenApi\Attributes as OA;

#[Info(version: '0.1.0', title: 'WinaliaAPI')]
#[Components(
    schemas: [
        new Schema(
            schema: 'PaginationMeta',
            properties: [
                new Property(property: 'page', type: 'integer'),
                new Property(property: 'per_page', type: 'integer'),
                new Property(property: 'total', type: 'integer'),
            ],
        ),
        new Schema(
            schema: 'Game',
            properties: [
                new Property(property: 'id', type: 'integer'),
                new Property(property: 'name', type: 'string'),
                new Property(property: 'free', type: 'boolean'),
                new Property(property: 'bet', type: 'number'),
                new Property(property: 'host_id', type: 'integer'),
                new Property(property: 'first_to', type: 'integer'),
                new Property(property: 'epic_id', type: 'string'),
                new Property(property: 'game_mode_id', type: 'integer'),
                new Property(property: 'team_size_id', type: 'integer'),
                new Property(property: 'region_id', type: 'integer'),
                new Property(property: 'platform_id', type: 'integer'),
                new Property(property: 'status', type: 'string'),
                new Property(property: 'created_at', type: 'string', format: 'date-time'),
                new Property(property: 'updated_at', type: 'string', format: 'date-time'),
            ],
            type: 'object'
        )],
    securitySchemes: [
        new OA\SecurityScheme(
            securityScheme: 'bearerAuth',
            type: 'http',
            description: 'Token with auth ability',
            scheme: 'bearer'
        )
    ]
)]
abstract class Controller
{
    //
}
