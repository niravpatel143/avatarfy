# 🎨 Avatarfy - Laravel Avatar Generator

[![Avatar Gallery](https://img.shields.io/badge/🎨_Live-Avatar_Gallery-brightgreen?style=for-the-badge)](./test_output/index.html)
[![Laravel Package](https://img.shields.io/badge/Laravel-Package-red?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-blue?style=for-the-badge&logo=php)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](./LICENSE)

A comprehensive Laravel package for generating culturally-aware SVG avatars with expressions, age groups, and customizable features. Create beautiful, diverse avatars instantly with zero external dependencies!

## 🚀 **[View Complete Avatar Gallery](./test_output/index.html)** - 38+ Live Examples!

### 🌟 Quick Preview
<table>
  <tr>
    <td align="center">
      <img src="https://raw.githubusercontent.com/niravpatel143/avatarfy/main/test_output/avatar_expr_happy.svg" width="80"/><br>
      <small><strong>Happy Expression</strong></small>
    </td>
    <td align="center">
      <img src="https://raw.githubusercontent.com/niravpatel143/avatarfy/main/test_output/avatar_alice.svg" width="80"/><br>
      <small><strong>Female Avatar</strong></small>
    </td>
    <td align="center">
      <img src="https://raw.githubusercontent.com/niravpatel143/avatarfy/main/test_output/avatar_country_Japan.svg" width="80"/><br>
      <small><strong>Japan Style</strong></small>
    </td>
    <td align="center">
      <img src="https://raw.githubusercontent.com/niravpatel143/avatarfy/main/test_output/avatar_child1.svg" width="80"/><br>
      <small><strong>Child Age Group</strong></small>
    </td>
    <td align="center">
      <img src="https://raw.githubusercontent.com/niravpatel143/avatarfy/main/test_output/avatar_NiravGoriya.svg" width="80"/><br>
      <small><strong>Email Avatar</strong></small>
    </td>
  </tr>
</table>

### 🎯 **[→ Explore Full Gallery with All 38+ Avatars](./test_output/index.html)** 🎯

## ✨ Features & Capabilities

### 🎨 **Visual Features** ([See Live Gallery](./test_output/index.html))
- **🎭 8 Expressions**: Happy, Sad, Surprised, Angry, Wink, Neutral, Confused, Laughing
- **🌍 8 Countries**: USA, India, China, UK, Germany, Japan, Brazil, Nigeria  
- **👶 4 Age Groups**: Child, Teen, Adult, Senior (with age-appropriate characteristics)
- **⚡ 6 Personalities**: Confident, Energetic, Professional, Cheerful, Creative, Stylish
- **👤 Gender Aware**: Male/female specific traits (eyebrows, facial structure)
- **📧 Email Integration**: Smart avatar generation from email addresses with initials

### 🛠️ **Technical Features**
- **⚡ Zero Dependencies**: Pure PHP implementation - no external libraries required
- **📐 SVG-based**: Scalable vector graphics for crisp avatars at any size
- **🚀 Lightning Fast**: Generate avatars in ~50ms with minimal memory usage
- **🎯 Smart Defaults**: Intelligent parameter generation based on user ID
- **🔧 Fully Customizable**: Control skin tone, eye color, glasses, and more
- **📱 Modern Design**: Clean, contemporary look with rounded corners

### 🌍 **Cultural Features**
Each country includes:
- 🎨 **Unique Color Palettes**: Region-specific background colors
- 👤 **Skin Tone Preferences**: Culturally appropriate defaults  
- 🎪 **Cultural Accessories**: Glasses, headwear, jewelry variations

> 🎯 **[View All Features in Action →](./test_output/index.html)** - Interactive gallery with 38+ examples!

## 🚀 Super Easy Installation

### Step 1: Install Package
```bashUK
composer require avatarfy/avatarfy
```

### Step 2: Create Storage Directory
```bash
php artisan storage:link
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

## 🧪 Testing & Demo Gallery

### 🎨 **Interactive Demo Gallery**
**[Open Live Gallery](./test_output/index.html)** to see all generated avatars in a beautiful, responsive showcase!

### 🔬 **Run Tests Locally**
```bash
php test_all_features.php
```

### 📊 **Test Coverage**
Our comprehensive test suite generates **38+ avatars** demonstrating:

| Feature Category | Examples | Gallery Section |
|-----------------|----------|----------------|
| 🎭 **Expressions** | 8 variations | Happy, Sad, Surprised, Angry, Wink, Neutral, Confused, Laughing |
| 🌍 **Countries** | 8 cultures | USA, India, China, UK, Germany, Japan, Brazil, Nigeria |
| 👶 **Age Groups** | 4 stages | Child, Teen, Adult, Senior |
| ⚡ **Personalities** | 6 types | Confident, Energetic, Professional, Cheerful, Creative, Stylish |
| 📧 **Email Avatars** | 4 examples | Smart initials extraction and generation |
| 🎛️ **Custom Options** | Advanced | Custom colors, glasses, skin tones |

### 📈 **Performance Metrics**
- ⚡ **Generation Speed**: ~50ms per avatar
- 📦 **File Size**: 2-4KB per SVG  
- 🧠 **Memory Usage**: Minimal (no image processing)
- ♾️ **Scalability**: Infinite (vector-based)

**[→ View Performance in Action](./test_output/index.html)**

## 📁 Package Structure

```
📦 avatarfy/
├── 🎨 test_output/
│   ├── index.html                        # 🌟 INTERACTIVE DEMO GALLERY
│   └── *.svg                            # 38+ Generated avatar examples
├── 🛠️ src/
│   ├── AvatarServiceProvider.php        # Laravel service provider
│   ├── Facades/AvatarGenerator.php      # Laravel facade
│   └── Services/
│       └── SimpleSvgAvatarService.php   # Main avatar generation engine
├── ⚙️ config/
│   └── avatarfy.php                     # Configuration file
├── 📚 examples/
│   ├── AvatarController.php             # Laravel controller example
│   ├── avatar-form.blade.php            # Blade template example
│   └── routes-example.php               # Route examples
├── 🧪 tests/
│   └── AvatarServiceTest.php            # Test suite
├── 🚀 test_all_features.php             # Comprehensive test runner
├── 📖 README.md                         # Documentation
└── 📋 composer.json                     # Package definition
```

### 🌟 **Key Files**
- 🎨 **[test_output/index.html](./test_output/index.html)** - Interactive demo gallery
- 🛠️ **SimpleSvgAvatarService.php** - Core avatar generation logic
- 🚀 **test_all_features.php** - Run all tests and generate gallery
- ⚙️ **avatarfy.php** - Full configuration options

## 🏆 Why Choose Avatarfy?

### 🎯 **See It In Action**
**[Interactive Demo Gallery](./test_output/index.html)** - Browse 38+ real examples!

### ⚡ **Performance Excellence**
- **🚀 Lightning Fast**: Generate avatars in ~50ms
- **📦 Tiny Files**: 2-4KB SVG files (vs 50KB+ PNG)
- **🧠 Memory Efficient**: No image processing overhead
- **♾️ Infinitely Scalable**: Vector graphics scale perfectly
- **🌐 Cross-platform**: Works on any PHP environment

### 🎨 **Design Excellence**
- **🎭 Rich Expressions**: 8 distinct facial expressions
- **🌍 Cultural Awareness**: 8 countries with unique features
- **👶 Age Appropriate**: Realistic child to senior characteristics
- **📧 Smart Generation**: Email-to-avatar with initials
- **🎨 Modern Aesthetic**: Clean, contemporary design

### 🛠️ **Developer Experience**
- **📦 Zero Dependencies**: Pure PHP - no external libraries
- **🔧 Laravel Ready**: Service provider, facade, config included
- **🎯 Smart Defaults**: Works great out-of-the-box
- **🔒 Type Safe**: Full parameter validation
- **📚 Well Documented**: Comprehensive examples and docs

**[→ Try the Live Gallery](./test_output/index.html)**

## License

This project is open source. Feel free to use, modify, and distribute.
