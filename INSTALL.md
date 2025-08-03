# 🚀 Quick Installation Guide - Avatarfy

## Step 1: Install Package

```bash
composer require avatarfy/avatarfy
```

## Step 2: Create Storage Directory

```bash
php artisan storage:link
mkdir -p storage/app/public/avatars
```

## Step 3: Start Using! (No config needed)

```php
<?php

use Avatarfy\Services\SimpleSvgAvatarService;

// Basic setup with default config
$service = new SimpleSvgAvatarService([
    'width' => 256,
    'height' => 256,
    'storage_path' => storage_path('app/public/avatars'),
    'personalities' => [
        'friendly' => ['primary' => '#4CAF50', 'secondary' => '#8BC34A']
    ]
]);

// Generate avatar - that's it!
$avatarPath = $service->generateAvatar('user123');

// Generate from email
$avatarPath = $service->generateFromEmail('john@example.com');
```

## Step 4: Access Your Avatar

```php
// Get the public URL
$avatarUrl = asset('storage/avatars/' . basename($avatarPath));

// Use in your blade template
<img src="{{ $avatarUrl }}" alt="Avatar" />
```

## Optional: Publish Config (Advanced Users)

```bash
php artisan vendor:publish --provider="Avatarfy\AvatarServiceProvider" --tag="config"
```

---

**That's it! You're ready to generate beautiful avatars! 🎨**

See `README.md` for advanced usage and customization options.
