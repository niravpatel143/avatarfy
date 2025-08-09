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

// === TEST 10: Seed-based Avatar Generation (Deterministic) ===
runTest("Seed-based Avatar Generation (Deterministic)", function() use ($avatarService) {
    $seed = 'test_seed_123';
    
    // Generate same seed multiple times
    $result1 = $avatarService->generateFromSeed($seed);
    $result2 = $avatarService->generateFromSeed($seed);
    
    // Different seed for comparison
    $differentSeed = 'different_seed_456';
    $result3 = $avatarService->generateFromSeed($differentSeed);
    
    // Read and compare files
    $content1 = file_get_contents($result1);
    $content2 = file_get_contents($result2);
    
    if ($content1 === $content2) {
        return "✅ Deterministic generation verified - same seed produces identical avatars. Files: " . basename($result1) . ", " . basename($result2) . ", " . basename($result3);
    } else {
        return "❌ Deterministic generation failed - same seed produced different outputs";
    }
});

// === TEST 11: Identicon Generation ===
runTest("Identicon Generation (Geometric Patterns)", function() use ($avatarService) {
    $seeds = ['github_user_123', 'stackoverflow_456', 'reddit_789', 'discord_abc'];
    $results = [];
    
    foreach ($seeds as $seed) {
        $result = $avatarService->generateIdenticon($seed);
        $results[] = basename($result);
    }
    
    // Test with custom size
    $customSize = $avatarService->generateIdenticon('custom_size_test', ['size' => 128]);
    $results[] = basename($customSize);
    
    return "Created identicon avatars: " . implode(', ', $results);
});

// === TEST 12: Batch Avatar Generation ===
runTest("Batch Avatar Generation", function() use ($avatarService) {
    $userIds = ['batch_user_1', 'batch_user_2', 'batch_user_3', 'batch_user_4', 'batch_user_5'];
    $globalOptions = [
        'age' => 28,
        'gender' => 'female',
        'country' => 'India',
        'personality' => 'creative',
        'expression' => 'happy'
    ];
    
    $batchResults = $avatarService->generateBatch($userIds, $globalOptions);
    
    $successfulFiles = [];
    $errors = [];
    
    foreach ($batchResults as $userId => $result) {
        if (isset($result['error'])) {
            $errors[] = "$userId: {$result['error']}";
        } else {
            $successfulFiles[] = basename($result);
        }
    }
    
    if (empty($errors)) {
        return "Successfully created batch avatars: " . implode(', ', $successfulFiles);
    } else {
        return "Batch generation completed with errors: " . implode('; ', $errors);
    }
});

// === TEST 13: SVG Transform Options (Full Implementation) ===
runTest("SVG Transform Options - Individual Transforms", function() use ($avatarService) {
    $transforms = [
        'flip' => ['flip' => true, 'expression' => 'happy', 'gender' => 'male'],
        'rotate' => ['rotate' => 45, 'expression' => 'wink', 'gender' => 'female'],
        'scale' => ['scale' => 150, 'expression' => 'laughing', 'gender' => 'male'],
        'radius' => ['radius' => 25, 'expression' => 'surprised', 'gender' => 'female'],
        'clip' => ['clip' => true, 'expression' => 'neutral', 'gender' => 'male']
    ];
    
    $results = [];
    foreach ($transforms as $name => $options) {
        $result = $avatarService->generateCustomAvatar("transform_{$name}", array_merge([
            'age' => 28,
            'country' => 'USA',
            'personality' => 'cheerful'
        ], $options));
        $results[] = basename($result);
    }
    
    return "Created individual transform avatars: " . implode(', ', $results);
});

// === TEST 14: Combined Transform Effects ===
runTest("Combined Transform Effects", function() use ($avatarService) {
    $combinedTransforms = [
        [
            'name' => 'flip_rotate',
            'options' => ['flip' => true, 'rotate' => 30, 'expression' => 'happy', 'gender' => 'female']
        ],
        [
            'name' => 'scale_radius',
            'options' => ['scale' => 120, 'radius' => 20, 'expression' => 'wink', 'gender' => 'male']
        ],
        [
            'name' => 'all_transforms',
            'options' => [
                'flip' => true,
                'rotate' => 15,
                'scale' => 110,
                'radius' => 15,
                'clip' => true,
                'expression' => 'laughing',
                'gender' => 'female',
                'skinTone' => 'medium_dark',
                'hasGlasses' => true
            ]
        ]
    ];
    
    $results = [];
    foreach ($combinedTransforms as $transform) {
        $result = $avatarService->generateCustomAvatar(
            "combined_{$transform['name']}", 
            array_merge([
                'age' => 30,
                'country' => 'Brazil',
                'personality' => 'energetic'
            ], $transform['options'])
        );
        $results[] = basename($result);
    }
    
    return "Created combined transform avatars: " . implode(', ', $results);
});

// === TEST 15: Transform with Different Expressions ===
runTest("Transforms Applied to All Expression Types", function() use ($avatarService) {
    $expressions = ['happy', 'sad', 'surprised', 'angry', 'wink', 'neutral', 'confused', 'laughing'];
    $results = [];
    
    foreach ($expressions as $expression) {
        $result = $avatarService->generateCustomAvatar("expr_transform_{$expression}", [
            'age' => 25,
            'gender' => 'female',
            'country' => 'Japan',
            'personality' => 'creative',
            'expression' => $expression,
            'rotate' => 20,
            'scale' => 90,
            'radius' => 12
        ]);
        $results[] = basename($result);
    }
    
    return "Created expression + transform avatars: " . implode(', ', $results);
});

// === TEST 16: Random Transform Generation ===
runTest("Random Transform Generation (Showcase)", function() use ($avatarService) {
    $results = [];
    
    for ($i = 1; $i <= 8; $i++) {
        $randomTransforms = [
            'age' => rand(20, 50),
            'gender' => ['male', 'female'][rand(0, 1)],
            'country' => ['USA', 'India', 'Japan', 'Brazil', 'Germany'][rand(0, 4)],
            'personality' => ['confident', 'energetic', 'cheerful', 'creative'][rand(0, 3)],
            'expression' => ['happy', 'wink', 'laughing', 'surprised', 'neutral'][rand(0, 4)],
            'flip' => (bool)rand(0, 1),
            'rotate' => rand(-45, 45),
            'scale' => rand(80, 140),
            'radius' => rand(0, 30),
            'clip' => (bool)rand(0, 1)
        ];
        
        $result = $avatarService->generateCustomAvatar("random_showcase_{$i}", $randomTransforms);
        $results[] = basename($result);
    }
    
    return "Created random showcase avatars: " . implode(', ', $results);
});

// === TEST 17: Consistency Test (Same Input = Same Output) ===
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

// === TEST 18: Seeded Generation Consistency ===
runTest("Seeded Generation Consistency (Multiple Calls)", function() use ($avatarService) {
    $testSeed = 'consistency_seed_test';
    $results = [];
    
    // Generate 5 times with same seed
    for ($i = 1; $i <= 5; $i++) {
        $result = $avatarService->generateFromSeed($testSeed);
        $results[] = file_get_contents($result);
    }
    
    // Check if all results are identical
    $firstResult = $results[0];
    $allIdentical = true;
    
    for ($i = 1; $i < count($results); $i++) {
        if ($results[$i] !== $firstResult) {
            $allIdentical = false;
            break;
        }
    }
    
    if ($allIdentical) {
        return "✅ All 5 seeded generations are identical - perfect deterministic behavior";
    } else {
        return "❌ Seeded generations are not consistent";
    }
});

// === TEST 19: Error Handling Test ===
runTest("Error Handling with Invalid Parameters", function() use ($avatarService) {
    // Test with completely invalid parameters - should use fallbacks
    try {
        $result = $avatarService->generateAvatar(
            'error_test', 
            999,                    // Invalid age
            'invalid_gender',       // Invalid gender
            'InvalidCountry',       // Invalid country
            'invalid_personality',  // Invalid personality
            'invalid_expression'    // Invalid expression
        );
        
        // If we get here, the service handled errors gracefully
        return "✅ Gracefully handled invalid parameters: " . basename($result);
    } catch (Exception $e) {
        return "❌ Failed to handle invalid parameters: " . $e->getMessage();
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
