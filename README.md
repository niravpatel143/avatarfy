# Avatarfy - SVG Avatar Generator

[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![Tests](https://img.shields.io/badge/Tests-21%2F21-brightgreen.svg)](#testing)

A comprehensive PHP SVG avatar generator that creates diverse, customizable avatars and simple grid identicons with deterministic generation based on seeds.

## 🚀 **[View Complete Avatar Gallery](./test_output/index.html)** - 38+ Live Examples!

### 🌟 Quick Preview
<table>
  <tr>
    <td align="center">
      <img src="https://raw.githubusercontent.com/niravpatel143/avatarfy/main/test_output/avatar_expr_happy.svg" width="80" style="transform: rotate(5deg);"/><br>
      <small><strong>Happy Expression</strong></small>
    </td>
    <td align="center">
      <img src="https://raw.githubusercontent.com/niravpatel143/avatarfy/main/test_output/avatar_alice.svg" width="80" style="transform: rotate(-8deg);"/><br>
      <small><strong>Female Avatar</strong></small>
    </td>
    <td align="center">
      <img src="https://raw.githubusercontent.com/niravpatel143/avatarfy/main/test_output/avatar_country_Japan.svg" width="80" style="transform: rotate(12deg);"/><br>
      <small><strong>Japan Style</strong></small>
    </td>
    <td align="center">
      <img src="https://raw.githubusercontent.com/niravpatel143/avatarfy/main/test_output/avatar_child1.svg" width="80" style="transform: rotate(-15deg);"/><br>
      <small><strong>Child Age Group</strong></small>
    </td>
    <td align="center">
      <img src="https://raw.githubusercontent.com/niravpatel143/avatarfy/main/test_output/avatar_NiravGoriya.svg" width="80" style="transform: rotate(7deg);"/><br>
      <small><strong>Email Avatar</strong></small>
    </td>
  </tr>
</table>

### 🎯 **[→ Explore Full Gallery with All 38+ Avatars](./test_output/index.html)** 🎯

### 🔄 Transform Showcase - Unique Rotations

<table>
  <tr>
    <td align="center">
      <img src="https://raw.githubusercontent.com/niravpatel143/avatarfy/main/test_output/custom_avatar_transform_rotate.svg" width="70" style="transform: rotate(25deg); border-radius: 10px;"/><br>
      <small><strong>Rotated 25°</strong></small>
    </td>
    <td align="center">
      <img src="https://raw.githubusercontent.com/niravpatel143/avatarfy/main/test_output/custom_avatar_combined_flip_rotate.svg" width="70" style="transform: rotate(-18deg) scale(1.1); border-radius: 15px;"/><br>
      <small><strong>Flip + Rotate</strong></small>
    </td>
    <td align="center">
      <img src="https://raw.githubusercontent.com/niravpatel143/avatarfy/main/test_output/custom_avatar_transform_clip.svg" width="70" style="transform: rotate(12deg); border-radius: 50%;"/><br>
      <small><strong>Clipped Circle</strong></small>
    </td>
    <td align="center">
      <img src="https://raw.githubusercontent.com/niravpatel143/avatarfy/main/test_output/custom_avatar_combined_all_transforms.svg" width="70" style="transform: rotate(-22deg) scale(0.95); border-radius: 20px;"/><br>
      <small><strong>All Effects</strong></small>
    </td>
    <td align="center">
      <img src="https://raw.githubusercontent.com/niravpatel143/avatarfy/main/test_output/custom_avatar_transform_scale.svg" width="70" style="transform: rotate(8deg) scale(1.05); border-radius: 12px;"/><br>
      <small><strong>Scale + Rotate</strong></small>
    </td>
  </tr>
</table>

> **✨ NEW!** Each avatar can be uniquely rotated, scaled, flipped, and clipped for dynamic visual appeal!

### 🎯 Identicon Gallery - Simple Grid Patterns

<table>
  <tr>
    <td align="center">
      <img src="./test_output/identicon_user123.svg" width="70" style="border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"/><br>
      <small><strong>user123</strong></small>
    </td>
    <td align="center">
      <img src="./test_output/identicon_alice_smith.svg" width="70" style="border-radius: 12px; transform: rotate(3deg); box-shadow: 0 2px 4px rgba(0,0,0,0.1);"/><br>
      <small><strong>alice_smith</strong></small>
    </td>
    <td align="center">
      <img src="./test_output/identicon_john_doe.svg" width="70" style="border-radius: 6px; transform: rotate(-5deg); box-shadow: 0 2px 4px rgba(0,0,0,0.1);"/><br>
      <small><strong>john_doe</strong></small>
    </td>
    <td align="center">
      <img src="./test_output/identicon_github_user_123.svg" width="70" style="border-radius: 50%; transform: rotate(7deg); box-shadow: 0 2px 4px rgba(0,0,0,0.1);"/><br>
      <small><strong>GitHub Style</strong></small>
    </td>
    <td align="center">
      <img src="./test_output/identicon_developer_01.svg" width="70" style="border-radius: 10px; transform: rotate(-2deg); box-shadow: 0 2px 4px rgba(0,0,0,0.1);"/><br>
      <small><strong>developer_01</strong></small>
    </td>
  </tr>
</table>

> **🎨 Identicons:** Perfect for GitHub-style geometric avatars - same seed always generates identical patterns!

## ✨ Features & Capabilities

### 🎨 **Visual Features** ([See Live Gallery](./test_output/index.html))
- **🎭 8 Expressions**: Happy, Sad, Surprised, Angry, Wink, Neutral, Confused, Laughing
- **🌍 8 Countries**: USA, India, China, UK, Germany, Japan, Brazil, Nigeria  
- **👶 4 Age Groups**: Child, Teen, Adult, Senior (with age-appropriate characteristics)
- **⚡ 6 Personalities**: Confident, Energetic, Professional, Cheerful, Creative, Stylish
- **👤 Gender Aware**: Male/female specific traits (eyebrows, facial structure)
- **📧 Email Integration**: Smart avatar generation from email addresses with initials
- **🎨 SVG Transforms**: Flip, rotate, scale, border radius, circular clipping

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

## 🎨 SVG Transform System - NEW!

Avaterfy now includes a powerful SVG transform system that lets you apply visual effects to your generated avatars!

### 🔧 Available Transform Options

| Transform | Description | Example Value | Visual Effect |
|-----------|-------------|---------------|---------------|
| **`flip`** | Horizontal flip | `true` | Mirror the avatar horizontally |
| **`rotate`** | Rotation in degrees | `45` | Rotate avatar clockwise |
| **`scale`** | Scale percentage | `120` | Make avatar 120% larger |
| **`radius`** | Border radius in pixels | `20` | Rounded corners on background |
| **`clip`** | Circular clipping | `true` | Crop avatar to perfect circle |
| **`translate_x`** | Horizontal offset | `10` | Move avatar horizontally |
| **`translate_y`** | Vertical offset | `-5` | Move avatar vertically |

### 🎯 Transform Usage Examples

#### Basic Individual Transforms
```php
// Horizontally flipped avatar
$service->generateCustomAvatar('user1', [
    'expression' => 'happy',
    'flip' => true
]);

// Rotated avatar
$service->generateCustomAvatar('user2', [
    'expression' => 'wink', 
    'rotate' => 30  // 30 degrees clockwise
]);

// Scaled avatar
$service->generateCustomAvatar('user3', [
    'expression' => 'laughing',
    'scale' => 150  // 150% size
]);

// Circular avatar
$service->generateCustomAvatar('user4', [
    'expression' => 'surprised',
    'clip' => true  // Perfect circle
]);

// Rounded corners
$service->generateCustomAvatar('user5', [
    'expression' => 'neutral',
    'radius' => 25  // 25px border radius
]);
```

#### Combined Transform Effects
```php
// Multiple transforms together
$service->generateCustomAvatar('showcase_user', [
    'age' => 28,
    'gender' => 'female',
    'country' => 'Brazil',
    'expression' => 'laughing',
    'skinTone' => 'medium_dark',
    'hasGlasses' => true,
    // Transform effects
    'flip' => true,        // Mirror horizontally
    'rotate' => 15,        // Slight rotation
    'scale' => 110,        // 10% larger
    'radius' => 20,        // Rounded corners
    'clip' => true         // Circular shape
]);
```

#### Dynamic Transform Generation
```php
// Random transform showcase
for ($i = 1; $i <= 5; $i++) {
    $service->generateCustomAvatar("random_{$i}", [
        'age' => rand(20, 50),
        'gender' => ['male', 'female'][rand(0, 1)],
        'expression' => ['happy', 'wink', 'laughing'][rand(0, 2)],
        // Dynamic transforms
        'flip' => (bool)rand(0, 1),
        'rotate' => rand(-30, 30),
        'scale' => rand(80, 120),
        'radius' => rand(0, 25),
        'clip' => (bool)rand(0, 1)
    ]);
}
```

### 🎪 Transform Combinations

**Popular Transform Combinations:**

```php
// Profile Picture Style
'clip' => true,
'scale' => 95,
'radius' => 10

// Dynamic Showcase
'flip' => true,
'rotate' => 20,
'scale' => 110

// Elegant Card Style  
'radius' => 15,
'scale' => 105,
'translate_y' => -5

// Playful Style
'rotate' => rand(-15, 15),
'scale' => rand(95, 115),
'flip' => (bool)rand(0, 1)
```

### ⚡ Generated SVG Transform Code

The system automatically generates optimized SVG transform code:

```xml
<!-- Example: flip + rotate + scale -->
<g transform="rotate(15 128 128) scale(1.1) translate(-14.08,-14.08) scale(-1,1) translate(-256,0)">
  <!-- Avatar content -->
</g>

<!-- Example: circular clipping -->
<defs>
  <clipPath id="clip-unique-id">
    <circle cx="128" cy="128" r="118" />
  </clipPath>
</defs>
<g clip-path="url(#clip-unique-id)">
  <!-- Avatar content -->
</g>
```

### 🎨 Transform Test Gallery

**Run the transform test to see all effects:**
```bash
php test_transforms.php
```

This generates avatars showcasing:
- ✅ Individual transform effects
- ✅ Combined transform combinations  
- ✅ All expressions with transforms
- ✅ Random showcase generation
- ✅ SVG validation and verification

### 🔧 Technical Implementation

Transforms are applied via the `applyTransforms()` method which:
1. **Validates** all transform parameters
2. **Combines** multiple transforms efficiently
3. **Optimizes** SVG transform strings
4. **Preserves** avatar centering and positioning
5. **Generates** clean, standards-compliant SVG code

**Transform Order (automatically optimized):**
1. Translation → 2. Rotation → 3. Scale → 4. Flip → 5. Clipping → 6. Border Radius

## 🎯 Identicon System - Geometric Avatars

Generate GitHub-style geometric pattern avatars perfect for user profiles, comments, and placeholder images!

### 🔷 Identicon Features

| Feature | Description | Benefit |
|---------|-------------|---------|
| **🎲 Deterministic** | Same seed = same pattern | Consistent user avatars |
| **🎨 Symmetric** | 5x5 mirrored grid | Visually appealing patterns |
| **💸 No Storage** | Generated on-demand | Zero database overhead |
| **⚡ Lightning Fast** | ~25ms generation | Faster than face avatars |
| **🌈 Unique Colors** | Seeded color palettes | Distinctive visual identity |

### 🎯 Identicon Usage Examples

#### Basic Identicon Generation
```php
// Simple identicon from username
$service->generateIdenticon('github_user_123');

// From email address
$service->generateIdenticon('user@example.com');

// From user ID
$service->generateIdenticon('user_456789');

// Custom seed string
$service->generateIdenticon('my_custom_seed_2023');
```

#### Custom Size Identicons
```php
// Small size for comments
$service->generateIdenticon('commenter_123', ['size' => 64]);

// Medium size for profiles  
$service->generateIdenticon('profile_user', ['size' => 128]);

// Large size for headers
$service->generateIdenticon('header_logo', ['size' => 512]);

// Default size (256px)
$service->generateIdenticon('default_user');
```

#### Platform-Specific Identicons
```php
// GitHub-style identicons
foreach (['alice_dev', 'bob_coder', 'charlie_admin'] as $username) {
    $service->generateIdenticon("github_{$username}");
}

// Forum user identicons
foreach (['user_001', 'user_002', 'user_003'] as $userId) {
    $service->generateIdenticon("forum_{$userId}", ['size' => 48]);
}

// Discord-style round identicons (use with transforms)
$service->generateCustomAvatar('discord_user', [
    'clip' => true  // Makes it circular
]);
// Then convert to identicon pattern if needed
```

### 🔄 Deterministic Generation

**Same seed always produces identical patterns:**

```php
// These will be identical
$avatar1 = $service->generateIdenticon('john_doe_123');
$avatar2 = $service->generateIdenticon('john_doe_123');
// avatar1 === avatar2 (same visual pattern)

// Different seed = different pattern
$avatar3 = $service->generateIdenticon('jane_doe_456');
// avatar3 !== avatar1 (completely different pattern)
```

### 🌈 Color Generation

Colors are deterministically generated from seeds:

```php
// Each seed produces unique color combinations
$service->generateIdenticon('red_themed_user');    // Might generate red tones
$service->generateIdenticon('blue_themed_user');   // Might generate blue tones  
$service->generateIdenticon('green_themed_user');  // Might generate green tones

// Same seed = same colors (always)
$service->generateIdenticon('consistent_colors'); // Always same palette
```

### 🎨 Real-World Use Cases

#### GitHub-Style User Profiles
```php
class UserProfile {
    public function getAvatar($username) {
        // Try to get uploaded avatar first
        if ($this->hasUploadedAvatar($username)) {
            return $this->getUploadedAvatar($username);
        }
        
        // Fall back to identicon
        $service = new SimpleSvgAvatarService(config('avatarfy'));
        return $service->generateIdenticon($username);
    }
}
```

#### Comment System Avatars
```php
class CommentSystem {
    public function displayComment($comment) {
        $userId = $comment->user_id ?? 'anonymous_' . $comment->ip_hash;
        
        // Generate small identicon for comment avatar
        $service = new SimpleSvgAvatarService(config('avatarfy'));
        $avatarPath = $service->generateIdenticon($userId, ['size' => 40]);
        
        return [
            'comment' => $comment->text,
            'avatar' => asset('storage/avatars/' . basename($avatarPath)),
            'username' => $comment->username ?? 'Anonymous'
        ];
    }
}
```

#### Forum Signature Generation
```php
class ForumSignature {
    public function generateUserSignature($username, $postCount) {
        $service = new SimpleSvgAvatarService(config('avatarfy'));
        
        // Create identicon based on username + post count for uniqueness
        $seed = $username . '_posts_' . intval($postCount / 100); // Changes every 100 posts
        $avatarPath = $service->generateIdenticon($seed, ['size' => 64]);
        
        return $avatarPath;
    }
}
```

### 🎮 Gaming & Social Platforms

```php
// Gaming platform user avatars
$service->generateIdenticon('gamer_' . $playerId, ['size' => 128]);

// Social media fallback avatars
$service->generateIdenticon('social_' . $socialId, ['size' => 256]);

// Chat application avatars
$service->generateIdenticon('chat_' . $userId, ['size' => 48]);

// Anonymous user identification
$service->generateIdenticon('anon_' . hash('md5', $sessionId), ['size' => 64]);
```

### 🔍 Technical Implementation

Identicons use a **5x5 symmetric grid pattern:**

```
[■][□][■][□][■]  <- Row 1: Pattern mirrored
[□][■][□][■][□]  <- Row 2: Pattern mirrored  
[■][□][■][□][■]  <- Row 3: Center column + mirror
[□][■][□][■][□]  <- Row 4: Pattern mirrored
[■][□][■][□][■]  <- Row 5: Pattern mirrored
```

**Generation Process:**
1. **Hash Seed** → Generate CRC32 hash from seed string
2. **Create Pattern** → Use hash to determine 15 pattern cells (2.5 columns)
3. **Mirror Pattern** → Reflect left side to create symmetry
4. **Generate Colors** → Create background and foreground colors from seed
5. **Build SVG** → Construct clean SVG with geometric rectangles

### 📊 Performance Comparison

| Avatar Type | Generation Time | File Size | Use Case |
|-------------|----------------|-----------|----------|
| **Identicon** | ~25ms | 1-2KB | Anonymous users, fallbacks |
| **Face Avatar** | ~50ms | 2-4KB | Known users, profiles |
| **Email Avatar** | ~35ms | 2-3KB | Email-based systems |

**⚡ Identicons are 2x faster** than face avatars and perfect for high-volume anonymous user scenarios!

## 📚 Complete Usage Guide

### 🚀 1. Basic Avatar Generation

```php
// Simplest usage - smart defaults
$avatarPath = $service->generateAvatar('user123');

// With age only
$avatarPath = $service->generateAvatar('user456', 25);

// With age and gender
$avatarPath = $service->generateAvatar('user789', 30, 'female');
```

### 📧 2. Email-Based Avatars

```php
// Simple email avatar (extracts initials)
$avatarPath = $service->generateFromEmail('john.doe@company.com');
// Result: Circular avatar with "JD" initials

// Email avatar with custom options
$avatarPath = $service->generateFromEmail('sarah@example.com', [
    'gender' => 'female',
    'expression' => 'happy',
    'age' => 28
]);
```

### 🎭 3. Expression & Personality Avatars

```php
// Different expressions
foreach (['happy', 'wink', 'laughing', 'surprised'] as $expr) {
    $service->generateAvatar("user_${expr}", 25, 'female', 'USA', 'cheerful', $expr);
}

// Different personalities
foreach (['confident', 'energetic', 'professional', 'creative'] as $personality) {
    $service->generateAvatar("${personality}_user", 30, 'male', 'Germany', $personality);
}
```

### 🌍 4. Cultural & Demographic Avatars

```php
// Country-specific avatars
$countries = ['USA', 'India', 'Japan', 'Brazil', 'Nigeria'];
foreach ($countries as $country) {
    $service->generateAvatar("user_${country}", 25, 'female', $country);
}

// Age group examples
$service->generateAvatar('child', 8);     // Child characteristics
$service->generateAvatar('teen', 16);     // Teen characteristics  
$service->generateAvatar('adult', 35);    // Adult characteristics
$service->generateAvatar('senior', 70);   // Senior characteristics
```

### 🎨 5. Advanced Customization

```php
// Full customization
$service->generateCustomAvatar('premium_user', [
    'age' => 32,
    'gender' => 'female',
    'country' => 'Japan',
    'personality' => 'creative',
    'expression' => 'wink',
    'skinTone' => 'light',           // Specific skin tone
    'eyeColor' => '#2E8B57',         // Custom eye color
    'hasGlasses' => true,            // Add glasses
    // Transform effects
    'flip' => false,
    'rotate' => 10,
    'scale' => 105,
    'radius' => 15,
    'clip' => false
]);
```

### 🎲 6. Deterministic Generation

```php
// Same seed = same avatar (always)
$seed = 'github_user_123';
$avatar1 = $service->generateFromSeed($seed);
$avatar2 = $service->generateFromSeed($seed);
// avatar1 and avatar2 are identical

// Seed with custom options
$service->generateFromSeed('discord_user_456', [
    'flip' => true,
    'scale' => 110,
    'expression' => 'laughing'
]);
```

### 🏭 7. Batch Generation

```php
// Batch generate with same options
$userIds = ['alice', 'bob', 'charlie', 'diana', 'eve'];
$results = $service->generateBatch($userIds, [
    'age' => 25,
    'country' => 'USA',
    'personality' => 'cheerful'
]);

// Process results
foreach ($results as $userId => $avatarPath) {
    echo "Avatar for {$userId}: {$avatarPath}\n";
}
```

### 🎯 8. Identicon Generation

```php
// GitHub-style identicons
$service->generateIdenticon('github_user_123');
$service->generateIdenticon('stackoverflow_456');

// Custom size identicon
$service->generateIdenticon('discord_abc', ['size' => 128]);
```

### 🔄 9. Real-World Laravel Integration

```php
class UserController extends Controller
{
    public function generateUserAvatar(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        
        $service = new SimpleSvgAvatarService([
            'width' => 256,
            'height' => 256,
            'storage_path' => storage_path('app/public/avatars')
        ]);
        
        // Generate based on user preferences
        $avatarPath = $service->generateCustomAvatar($user->username, [
            'age' => $user->age ?? 25,
            'gender' => $user->gender ?? 'male',
            'country' => $user->country ?? 'USA',
            'expression' => $request->get('expression', 'happy'),
            // Transform options from request
            'flip' => $request->boolean('flip'),
            'rotate' => $request->get('rotate', 0),
            'scale' => $request->get('scale', 100),
            'clip' => $request->boolean('circular'),
            'radius' => $request->get('radius', 0)
        ]);
        
        // Save avatar URL to user
        $user->avatar_url = asset('storage/avatars/' . basename($avatarPath));
        $user->save();
        
        return response()->json([
            'success' => true,
            'avatar_url' => $user->avatar_url
        ]);
    }
    
    public function generateFromUserEmail($email)
    {
        $service = new SimpleSvgAvatarService(config('avatarfy'));
        $avatarPath = $service->generateFromEmail($email);
        
        return asset('storage/avatars/' . basename($avatarPath));
    }
}

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
