<?php

require_once __DIR__ . '/../src/Services/SimpleSvgAvatarService.php';

use Avatarify\Services\SimpleSvgAvatarService;

class AvatarServiceTest
{
    private $service;
    private $testOutputDir;
    
    public function __construct()
    {
        // Create test output directory
        $this->testOutputDir = __DIR__ . '/output';
        if (!is_dir($this->testOutputDir)) {
            mkdir($this->testOutputDir, 0755, true);
        }
        
        // Initialize service with test configuration
        $config = [
            'width' => 256,
            'height' => 256,
            'storage_path' => $this->testOutputDir
        ];
        
        $this->service = new SimpleSvgAvatarService($config);
    }
    
    public function runAllTests()
    {
        echo "Starting Avatar Generation Tests...\n\n";
        
        $this->testBasicAvatarGeneration();
        $this->testComprehensiveAvatarGeneration();
        $this->testCustomAvatarGeneration();
        $this->testDifferentExpressions();
        $this->testDifferentCountries();
        $this->testDifferentAgeGroups();
        $this->testGenderDifferences();
        
        echo "All tests completed! Check the output folder for generated avatars.\n";
    }
    
    public function testBasicAvatarGeneration()
    {
        echo "Testing basic avatar generation...\n";
        
        $avatarPath = $this->service->generateDynamicAvatar('basic_test', 'happy');
        $this->assertFileExists($avatarPath, 'Basic avatar generation');
        
        echo "✓ Basic avatar generated: " . basename($avatarPath) . "\n\n";
    }
    
    public function testComprehensiveAvatarGeneration()
    {
        echo "Testing comprehensive avatar generation...\n";
        
        $testCases = [
            ['user1', 25, 'male', 'USA', 'confident', 'neutral'],
            ['user2', 16, 'female', 'Japan', 'cheerful', 'happy'],
            ['user3', 45, 'male', 'Germany', 'professional', 'neutral'],
            ['user4', 8, 'female', 'India', 'energetic', 'laughing'],
            ['user5', 65, 'male', 'UK', 'creative', 'wink']
        ];
        
        foreach ($testCases as [$userId, $age, $gender, $country, $personality, $expression]) {
            $avatarPath = $this->service->generateComprehensiveAvatar(
                $userId, $age, $gender, $country, $personality, $expression
            );
            $this->assertFileExists($avatarPath, "Comprehensive avatar for $userId");
            echo "✓ Generated comprehensive avatar: " . basename($avatarPath) . "\n";
        }
        
        echo "\n";
    }
    
    public function testCustomAvatarGeneration()
    {
        echo "Testing custom avatar generation...\n";
        
        $customOptions = [
            'age' => 30,
            'gender' => 'female',
            'country' => 'Brazil',
            'skinTone' => 'medium_dark',
            'eyeColor' => '#228B22',
            'hasGlasses' => true,
            'expression' => 'surprised'
        ];
        
        $avatarPath = $this->service->generateCustomAvatar('custom_test', $customOptions);
        $this->assertFileExists($avatarPath, 'Custom avatar generation');
        
        echo "✓ Custom avatar generated: " . basename($avatarPath) . "\n\n";
    }
    
    public function testDifferentExpressions()
    {
        echo "Testing different expressions...\n";
        
        $expressions = ['happy', 'sad', 'surprised', 'angry', 'wink', 'neutral', 'confused', 'laughing'];
        
        foreach ($expressions as $expression) {
            $avatarPath = $this->service->generateDynamicAvatar("expr_$expression", $expression);
            $this->assertFileExists($avatarPath, "Expression: $expression");
            echo "✓ Generated $expression expression: " . basename($avatarPath) . "\n";
        }
        
        echo "\n";
    }
    
    public function testDifferentCountries()
    {
        echo "Testing different countries...\n";
        
        $countries = ['USA', 'India', 'China', 'UK', 'Germany', 'Japan', 'Brazil', 'Nigeria'];
        
        foreach ($countries as $country) {
            $avatarPath = $this->service->generateComprehensiveAvatar(
                "country_$country", 30, 'male', $country, 'confident', 'neutral'
            );
            $this->assertFileExists($avatarPath, "Country: $country");
            echo "✓ Generated avatar for $country: " . basename($avatarPath) . "\n";
        }
        
        echo "\n";
    }
    
    public function testDifferentAgeGroups()
    {
        echo "Testing different age groups...\n";
        
        $ageTests = [
            ['child', 8],
            ['teen', 16],
            ['adult', 35],
            ['senior', 68]
        ];
        
        foreach ($ageTests as [$ageGroup, $age]) {
            $avatarPath = $this->service->generateComprehensiveAvatar(
                "age_$ageGroup", $age, 'male', 'USA', 'neutral', 'neutral'
            );
            $this->assertFileExists($avatarPath, "Age group: $ageGroup");
            echo "✓ Generated avatar for $ageGroup ($age years): " . basename($avatarPath) . "\n";
        }
        
        echo "\n";
    }
    
    public function testGenderDifferences()
    {
        echo "Testing gender differences...\n";
        
        $genders = ['male', 'female'];
        
        foreach ($genders as $gender) {
            $avatarPath = $this->service->generateComprehensiveAvatar(
                "gender_$gender", 25, $gender, 'USA', 'confident', 'neutral'
            );
            $this->assertFileExists($avatarPath, "Gender: $gender");
            echo "✓ Generated avatar for $gender: " . basename($avatarPath) . "\n";
        }
        
        echo "\n";
    }
    
    private function assertFileExists($filePath, $testName)
    {
        if (!file_exists($filePath)) {
            throw new Exception("Test failed: $testName - File not created: $filePath");
        }
        
        if (filesize($filePath) === 0) {
            throw new Exception("Test failed: $testName - File is empty: $filePath");
        }
    }
}

// Run the tests if this file is executed directly
if (basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'])) {
    try {
        $test = new AvatarServiceTest();
        $test->runAllTests();
    } catch (Exception $e) {
        echo "Test Error: " . $e->getMessage() . "\n";
        exit(1);
    }
}
