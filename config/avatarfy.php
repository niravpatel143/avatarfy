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
    | Advanced Generation Options
    |--------------------------------------------------------------------------
    |
    | Advanced options for fine-tuning avatar generation
    |
    */
    'seed' => null, // Use specific seed for deterministic generation
    'flip' => true, // Flip avatar horizontally
    'rotate' => 34, // Rotate avatar (0-360 degrees)
    'scale' => 100, // Scale factor (50-200%)
    'radius' => 0, // Border radius (0-50px)
    'clip' => true, // Clip avatar to circular shape
    'randomize_ids' => true, // Randomize SVG element IDs to avoid conflicts
    'translate_x' => 0, // Horizontal translation (-100 to 100)
    'translate_y' => 0, // Vertical translation (-100 to 100)

    /*
    |--------------------------------------------------------------------------
    | Background Options
    |--------------------------------------------------------------------------
    |
    | Configure background appearance and gradients
    |
    */
    'background_type' => 'solid', // 'solid', 'gradient_linear', 'gradient_radial', 'transparent'
    'background_rotation' => [0, 360], // Gradient rotation range
    'background_colors' => [
        'transparent',
        'f0f0f0',
        'e0e0e0',
        'd0d0d0',
        'c0c0c0',
        'b0b0b0',
    ],

    /*
    |--------------------------------------------------------------------------
    | Export Formats
    |--------------------------------------------------------------------------
    |
    | Supported export formats and settings
    |
    */
    'formats' => ['svg', 'png', 'jpg', 'webp'],
    'sizes' => [64, 128, 256, 512],
    'quality' => 90, // For raster formats

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
