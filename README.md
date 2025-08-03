# 🎨 Avatarfy - Laravel Avatar Generator

A comprehensive Laravel package for generating culturally-aware SVG avatars with expressions, age groups, and customizable features. Create beautiful, diverse avatars instantly with zero external dependencies!

## Features

- **Zero Dependencies**: Pure PHP implementation with no external libraries
- **SVG-based**: Scalable vector graphics for crisp avatars at any size
- **Demographic Awareness**: Age groups (child, teen, adult, senior) with appropriate characteristics
- **Cultural Diversity**: Support for 8 countries with region-specific features
- **Gender Features**: Male/female specific traits (eyebrow thickness, facial structure)
- **Rich Expressions**: 8 different facial expressions (happy, sad, surprised, angry, wink, neutral, confused, laughing)
- **Modern Design**: Square faces with rounded corners for contemporary look
- **Customizable**: Full control over skin tone, eye color, glasses, and more

## Supported Countries

- USA, India, China, UK, Germany, Japan, Brazil, Nigeria
- Each country has specific:
  - Background color palettes
  - Skin tone preferences
  - Cultural accessories (glasses, headwear, etc.)

## 🚀 Super Easy Installation

### Step 1: Install Package
```bash
composer require avatarfy/avatarfy
```

### Step 2: Create Storage Directory
```bash
php artisan storage:link
mkdir -p storage/app/public/avatars
```

### Step 3: Start Using! (No config needed)
```php
use Avatarfy\Services\SimpleSvgAvatarService;

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
```

### Optional: Advanced Setup
Publish config for advanced customization:
```bash
php artisan vendor:publish --provider="Avatarfy\AvatarServiceProvider" --tag="config"
```

## Quick Start

### Method 1: Simple Usage (Recommended)

```php
use Avatarfy\Services\SimpleSvgAvatarService;

// Initialize with basic config
$service = new SimpleSvgAvatarService([
    'width' => 256,
    'height' => 256,
    'storage_path' => storage_path('app/public/avatars'),
    'personalities' => [
        'friendly' => ['primary' => '#4CAF50', 'secondary' => '#8BC34A']
    ]
]);

// Generate simple avatar
$avatarPath = $service->generateAvatar('user123');

// Generate from email (with initials)
$avatarPath = $service->generateFromEmail('john.doe@example.com');

// Generate comprehensive avatar
$avatarPath = $service->generateAvatar(
    'user123',                 // User ID
    25,                        // Age (determines age group)
    'female',                  // Gender: 'male' or 'female'
    'Japan',                   // Country
    'cheerful',                // Personality
    'laughing'                 // Expression
);

// Get public URL
$avatarUrl = asset('storage/avatars/' . basename($avatarPath));
```

### Method 2: Using Laravel Config (Advanced)

```php
use Avatarfy\Services\SimpleSvgAvatarService;

class UserController extends Controller
{
    public function generateAvatar($userId)
    {
        // Use published config file
        $config = config('avatarfy');
        $service = new SimpleSvgAvatarService($config);
        
        $avatarPath = $service->generateAvatar($userId);
        $avatarUrl = asset('storage/avatars/' . basename($avatarPath));
        
        return response()->json(['avatar_url' => $avatarUrl]);
    }
}
```

### Method 3: Using the Facade

```php
use Avatarfy\Facades\AvatarGenerator;

// Generate simple avatar
$avatarPath = AvatarGenerator::generateAvatar('user123');

// Generate from email
$avatarPath = AvatarGenerator::generateFromEmail('jane@example.com');

// Generate custom avatar
$avatarPath = AvatarGenerator::generateCustomAvatar('user456', [
    'age' => 30,
    'gender' => 'male',
    'country' => 'Germany',
    'hasGlasses' => true,
    'expression' => 'wink'
]);
```

## Testing

Run the comprehensive test suite:

```bash
php run_tests.php
```

The test suite generates examples of:
- All expressions
- Different age groups
- Various countries
- Gender differences
- Custom configurations

## File Structure (After Cleanup)

```
├── src/
│   └── Services/
│       └── SimpleSvgAvatarService.php    # Main avatar generation service
├── tests/
│   ├── AvatarServiceTest.php             # Comprehensive test suite
│   └── output/                           # Generated test avatars
├── config/
│   └── avatarify.php                     # Configuration file
├── examples/
│   ├── AvatarController.php              # Laravel controller example
│   └── avatar-form.blade.php             # Blade template example
├── run_tests.php                         # Test runner script
└── README.md                             # This file
```

## Technical Features

- **Pure SVG Generation**: No image libraries required
- **Scalable**: Vector-based graphics scale perfectly
- **Lightweight**: Single file implementation
- **Fast**: Generates avatars in milliseconds
- **Memory Efficient**: No image processing overhead
- **Cross-platform**: Works on any PHP environment

## License

This project is open source. Feel free to use, modify, and distribute.
