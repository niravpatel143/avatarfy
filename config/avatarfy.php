<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Avatar Storage Path
    |--------------------------------------------------------------------------
    |
    | Directory where generated avatar files will be stored.
    | Make sure this directory is writable by your web server.
    |
    */
    'storage_path' => storage_path('app/public/avatars'),

    /*
    |--------------------------------------------------------------------------
    | Avatar Dimensions
    |--------------------------------------------------------------------------
    |
    | Default width and height for generated avatars in pixels.
    | Since avatars are SVG-based, they can be scaled to any size.
    |
    */
    'width' => 256,
    'height' => 256,

    /*
    |--------------------------------------------------------------------------
    | Age Groups
    |--------------------------------------------------------------------------
    |
    | Available age groups for avatar generation.
    |
    */
    'age_groups' => [
        'child',
        'teen',
        'adult',
        'senior',
    ],

    /*
    |--------------------------------------------------------------------------
    | Genders
    |--------------------------------------------------------------------------
    |
    | Available genders for avatar generation.
    |
    */
    'genders' => [
        'male',
        'female',
        'neutral',
    ],

    /*
    |--------------------------------------------------------------------------
    | Personalities
    |--------------------------------------------------------------------------
    |
    | Available personality types with their associated color palettes.
    |
    */
    'personalities' => [
        'cheerful' => [
            'primary' => '#FFD700',
            'secondary' => '#FF6B6B',
            'accent' => '#4ECDC4',
        ],
        'professional' => [
            'primary' => '#2C3E50',
            'secondary' => '#3498DB',
            'accent' => '#95A5A6',
        ],
        'calm' => [
            'primary' => '#7FB3D3',
            'secondary' => '#B8E6B8',
            'accent' => '#F0E68C',
        ],
        'energetic' => [
            'primary' => '#E74C3C',
            'secondary' => '#F39C12',
            'accent' => '#9B59B6',
        ],
        'creative' => [
            'primary' => '#9B59B6',
            'secondary' => '#E67E22',
            'accent' => '#1ABC9C',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | US States
    |--------------------------------------------------------------------------
    |
    | Available US states with their associated colors and symbols.
    |
    */
    'states' => [
        'california' => [
            'color' => '#FFD700',
            'symbol' => 'bear',
        ],
        'texas' => [
            'color' => '#DC143C',
            'symbol' => 'star',
        ],
        'florida' => [
            'color' => '#FF8C00',
            'symbol' => 'palm',
        ],
        'new_york' => [
            'color' => '#000080',
            'symbol' => 'liberty',
        ],
        // Add more states as needed
    ],

    /*
    |--------------------------------------------------------------------------
    | Auto Generate
    |--------------------------------------------------------------------------
    |
    | Whether to automatically generate avatars on user creation.
    |
    */
    'auto_generate' => true,

    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | The user model to observe for avatar generation.
    |
    */
    'user_model' => \App\Models\User::class,
];
