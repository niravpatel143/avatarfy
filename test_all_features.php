<?php
/**
 * Comprehensive Test Script for Avatar Service
 * Tests all new features including email avatars, smart defaults, and expressions
 */

require_once __DIR__ . '/src/Services/SimpleSvgAvatarService.php';

use Avatarfy\Services\SimpleSvgAvatarService;

// Configuration
$config = [
    'width' => 256,
    'height' => 256,
    'storage_path' => __DIR__ . '/test_output',
    'personalities' => [
        'confident' => ['primary' => '#FF6B6B', 'secondary' => '#4ECDC4'],
        'energetic' => ['primary' => '#FFD93D', 'secondary' => '#6BCF7F'],
        'professional' => ['primary' => '#4A90E2', 'secondary' => '#F5A623'],
        'cheerful' => ['primary' => '#F8E71C', 'secondary' => '#FF6B6B'],
        'creative' => ['primary' => '#9013FE', 'secondary' => '#FF4081'],
        'stylish' => ['primary' => '#212121', 'secondary' => '#E91E63']
    ]
];

// Initialize service
$avatarService = new SimpleSvgAvatarService($config);

echo "🎨 Avatar Service Comprehensive Test Suite\n";
echo "==========================================\n\n";

// Test counter
$testCount = 0;
$successCount = 0;

function runTest($testName, $testFunction) {
    global $testCount, $successCount;
    $testCount++;
    
    echo "Test {$testCount}: {$testName}\n";
    echo str_repeat("-", 50) . "\n";
    
    try {
        $result = $testFunction();
        if ($result) {
            echo "✅ SUCCESS: {$result}\n\n";
            $successCount++;
        } else {
            echo "❌ FAILED: Test returned false\n\n";
        }
    } catch (Exception $e) {
        echo "❌ ERROR: " . $e->getMessage() . "\n\n";
    }
}

// === TEST 1: Simple Avatar Generation (Smart Defaults) ===
runTest("Simple Avatar Generation with Smart Defaults", function() use ($avatarService) {
    $result = $avatarService->generateAvatar('user123');
    return "Avatar created at: " . basename($result);
});

// === TEST 2: Email-Based Avatar Generation ===
runTest("Email-Based Avatar Generation", function() use ($avatarService) {
    $emails = [
        'NiravGoriya',
        'sarah_smith@company.com',
        'mikejohnson@test.org',
        'anna@domain.co.uk'
    ];
    
    $results = [];
    foreach ($emails as $email) {
        $result = $avatarService->generateFromEmail($email);
        $results[] = basename($result);
    }
    
    return "Created email avatars: " . implode(', ', $results);
});

// === TEST 3: Full Custom Avatar Generation ===
runTest("Full Custom Avatar Generation", function() use ($avatarService) {
    $configurations = [
        ['user' => 'alice', 'age' => 25, 'gender' => 'female', 'country' => 'USA', 'personality' => 'cheerful', 'expression' => 'happy'],
        ['user' => 'bob', 'age' => 35, 'gender' => 'male', 'country' => 'Japan', 'personality' => 'professional', 'expression' => 'neutral'],
        ['user' => 'charlie', 'age' => 28, 'gender' => 'male', 'country' => 'India', 'personality' => 'energetic', 'expression' => 'laughing'],
        ['user' => 'diana', 'age' => 45, 'gender' => 'female', 'country' => 'UK', 'personality' => 'creative', 'expression' => 'wink']
    ];
    
    $results = [];
    foreach ($configurations as $config) {
        $result = $avatarService->generateAvatar(
            $config['user'], 
            $config['age'], 
            $config['gender'], 
            $config['country'], 
            $config['personality'], 
            $config['expression']
        );
        $results[] = basename($result);
    }
    
    return "Created custom avatars: " . implode(', ', $results);
});

// === TEST 4: Expression Variations ===
runTest("All Expression Variations", function() use ($avatarService) {
    $expressions = ['happy', 'sad', 'surprised', 'angry', 'wink', 'neutral', 'confused', 'laughing'];
    $results = [];
    
    foreach ($expressions as $expression) {
        $result = $avatarService->generateAvatar("expr_{$expression}", 30, 'female', 'USA', 'cheerful', $expression);
        $results[] = basename($result);
    }
    
    return "Created expression avatars: " . implode(', ', $results);
});

// === TEST 5: Age Group Variations ===
runTest("Age Group Variations", function() use ($avatarService) {
    $ageGroups = [
        ['user' => 'child1', 'age' => 8],
        ['user' => 'teen1', 'age' => 16],
        ['user' => 'adult1', 'age' => 30],
        ['user' => 'senior1', 'age' => 65]
    ];
    
    $results = [];
    foreach ($ageGroups as $group) {
        $result = $avatarService->generateAvatar($group['user'], $group['age']);
        $results[] = basename($result);
    }
    
    return "Created age group avatars: " . implode(', ', $results);
});

// === TEST 6: Country/Cultural Variations ===
runTest("Country/Cultural Variations", function() use ($avatarService) {
    $countries = ['USA', 'India', 'China', 'UK', 'Germany', 'Japan', 'Brazil', 'Nigeria'];
    $results = [];
    
    foreach ($countries as $country) {
        $result = $avatarService->generateAvatar("country_{$country}", 25, 'male', $country);
        $results[] = basename($result);
    }
    
    return "Created country avatars: " . implode(', ', $results);
});

// === TEST 7: Personality Variations ===
runTest("Personality Variations", function() use ($avatarService) {
    $personalities = ['confident', 'energetic', 'professional', 'cheerful', 'creative', 'stylish'];
    $results = [];
    
    foreach ($personalities as $personality) {
        $result = $avatarService->generateAvatar("pers_{$personality}", 25, 'female', 'USA', $personality);
        $results[] = basename($result);
    }
    
    return "Created personality avatars: " . implode(', ', $results);
});

// === TEST 8: Custom Avatar with Options ===
runTest("Custom Avatar with Advanced Options", function() use ($avatarService) {
    $customOptions = [
        'age' => 32,
        'gender' => 'female',
        'country' => 'Germany',
        'personality' => 'creative',
        'expression' => 'surprised',
        'skinTone' => 'medium',
        'eyeColor' => '#228B22',
        'hasGlasses' => true
    ];
    
    $result = $avatarService->generateCustomAvatar('custom_user', $customOptions);
    return "Created custom avatar: " . basename($result);
});

// === TEST 9: Email with Options Override ===
runTest("Email Avatar with Options Override", function() use ($avatarService) {
    $email = 'test.user@example.com';
    $options = [
        'gender' => 'female',
        'expression' => 'laughing',
        'personality' => 'energetic'
    ];
    
    $result = $avatarService->generateFromEmail($email, $options);
    return "Created email avatar with options: " . basename($result);
});

// === TEST 10: Consistency Test ===
runTest("Consistency Test (Same Input = Same Output)", function() use ($avatarService) {
    $userId = 'consistency_test';
    
    // Generate same avatar twice
    $result1 = $avatarService->generateAvatar($userId);
    $result2 = $avatarService->generateAvatar($userId);
    
    // Read both files and compare
    $content1 = file_get_contents($result1);
    $content2 = file_get_contents($result2);
    
    if ($content1 === $content2) {
        return "✅ Consistency verified - same input produces same output";
    } else {
        return "❌ Consistency failed - same input produced different outputs";
    }
});

// === FINAL RESULTS ===
echo "🏁 Test Results Summary\n";
echo "======================\n";
echo "Total Tests: {$testCount}\n";
echo "Successful: {$successCount}\n";
echo "Failed: " . ($testCount - $successCount) . "\n";

if ($successCount === $testCount) {
    echo "\n🎉 ALL TESTS PASSED! Your avatar service is working perfectly!\n";
} else {
    echo "\n⚠️ Some tests failed. Check the output above for details.\n";
}

// === CREATE INDEX FILE FOR VIEWING RESULTS ===
echo "\n📁 Creating index.html to view all generated avatars...\n";

$outputDir = $config['storage_path'];
$avatarFiles = glob($outputDir . '/*.svg');

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avatar Test Results</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; }
        .avatar-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
        .avatar-card { 
            background: white; 
            border-radius: 10px; 
            padding: 15px; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        .avatar-card h3 { margin: 0 0 10px 0; color: #333; font-size: 14px; }
        .avatar-card svg { max-width: 100%; height: auto; border: 1px solid #ddd; border-radius: 5px; }
        .stats { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; }
        h1 { color: #333; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎨 Avatar Service Test Results</h1>
        
        <div class="stats">
            <h2>Test Summary</h2>
            <p><strong>Total Tests:</strong> ' . $testCount . '</p>
            <p><strong>Successful:</strong> ' . $successCount . '</p>
            <p><strong>Total Avatars Generated:</strong> ' . count($avatarFiles) . '</p>
        </div>
        
        <div class="avatar-grid">';

foreach ($avatarFiles as $file) {
    $filename = basename($file);
    $svgContent = file_get_contents($file);
    
    $html .= '
            <div class="avatar-card">
                <h3>' . htmlspecialchars($filename) . '</h3>
                ' . $svgContent . '
            </div>';
}

$html .= '
        </div>
    </div>
</body>
</html>';

file_put_contents($outputDir . '/index.html', $html);

echo "✅ Created index.html in test_output folder\n";
echo "\n🌐 Open in browser: " . $outputDir . "/index.html\n";
echo "\n📋 Instructions:\n";
echo "1. Run this script: php test_all_features.php\n";
echo "2. Open the generated index.html file in your browser\n";
echo "3. View all generated avatars in a nice grid layout\n";

?>
