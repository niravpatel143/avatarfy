<?php

/**
 * Avatarfy - SVG Avatar Generator
 * 
 * @package Avatarfy
 * @author  <Avatarfy>
 * @copyright 2025 Avatarfy
 * @license MIT License
 * @version 1.0.0
 */

namespace Avatarfy\Services;

class SimpleSvgAvatarService
{
    protected $config;
    
    protected $skinTones = [
        'light' => '#FFDBAC',
        'medium_light' => '#F1C27D',
        'medium' => '#E0AC69',
        'medium_dark' => '#C68642',
        'dark' => '#8D5524'
    ];
    
    // Age-based characteristics
    protected $ageCharacteristics = [
        'child' => [
            'faceSize' => 1.7,
            'eyeSize' => 1.2,
            'noseSize' => 0.8,
            'mouthSize' => 0.9,
            'skinTones' => ['light', 'medium_light']
        ],
        'teen' => [
            'faceSize' => 1.75,
            'eyeSize' => 1.1,
            'noseSize' => 0.9,
            'mouthSize' => 1.0,
            'skinTones' => ['light', 'medium_light', 'medium']
        ],
        'adult' => [
            'faceSize' => 1.8,
            'eyeSize' => 1.0,
            'noseSize' => 1.0,
            'mouthSize' => 1.0,
            'skinTones' => ['light', 'medium_light', 'medium', 'medium_dark']
        ],
        'senior' => [
            'faceSize' => 1.85,
            'eyeSize' => 0.9,
            'noseSize' => 1.1,
            'mouthSize' => 0.95,
            'skinTones' => ['medium_light', 'medium', 'medium_dark']
        ]
    ];
    
    // Gender-based features
    protected $genderFeatures = [
        'male' => [
            'eyebrowThickness' => 5,
            'jawStructure' => 'angular',
            'hairStyles' => ['short', 'buzz', 'messy', 'formal'],
            'facialHair' => true
        ],
        'female' => [
            'eyebrowThickness' => 3,
            'jawStructure' => 'soft',
            'hairStyles' => ['long', 'bob', 'curly', 'ponytail'],
            'facialHair' => false
        ]
    ];
    
    // Country-based cultural features
    protected $countryFeatures = [
        'USA' => [
            'backgroundColor' => ['#F0F8FF', '#FFE4E1', '#F5F5DC'],
            'accessories' => ['baseball_cap', 'sunglasses'],
            'skinTonePreference' => ['light', 'medium_light', 'medium', 'medium_dark', 'dark']
        ],
        'India' => [
            'backgroundColor' => ['#FFF8DC', '#FFFACD', '#F0E68C'],
            'accessories' => ['headband', 'jewelry'],
            'skinTonePreference' => ['medium', 'medium_dark', 'dark']
        ],
        'China' => [
            'backgroundColor' => ['#FFE4E1', '#FDF5E6', '#FAF0E6'],
            'accessories' => ['glasses'],
            'skinTonePreference' => ['light', 'medium_light']
        ],
        'UK' => [
            'backgroundColor' => ['#E6E6FA', '#F0F8FF', '#F5F5DC'],
            'accessories' => ['glasses', 'hat'],
            'skinTonePreference' => ['light', 'medium_light', 'medium']
        ],
        'Germany' => [
            'backgroundColor' => ['#F5F5DC', '#FAF0E6', '#FDF5E6'],
            'accessories' => ['glasses'],
            'skinTonePreference' => ['light', 'medium_light']
        ],
        'Japan' => [
            'backgroundColor' => ['#FFE4E1', '#FFF0F5', '#F8F8FF'],
            'accessories' => ['glasses'],
            'skinTonePreference' => ['light', 'medium_light']
        ],
        'Brazil' => [
            'backgroundColor' => ['#FFFACD', '#F0E68C', '#DDA0DD'],
            'accessories' => ['headband', 'sunglasses'],
            'skinTonePreference' => ['medium_light', 'medium', 'medium_dark', 'dark']
        ],
        'Nigeria' => [
            'backgroundColor' => ['#F0E68C', '#DDA0DD', '#DA70D6'],
            'accessories' => ['headwrap', 'jewelry'],
            'skinTonePreference' => ['medium_dark', 'dark']
        ]
    ];
    
    // Define different facial expressions
    protected $expressions = [
        'happy' => [
            'eyeShape' => 'smile',
            'mouthShape' => 'big-smile',
            'eyebrowAngle' => 'raised'
        ],
        'sad' => [
            'eyeShape' => 'normal',
            'mouthShape' => 'frown',
            'eyebrowAngle' => 'down'
        ],
        'surprised' => [
            'eyeShape' => 'wide',
            'mouthShape' => 'open',
            'eyebrowAngle' => 'raised'
        ],
        'angry' => [
            'eyeShape' => 'narrow',
            'mouthShape' => 'frown',
            'eyebrowAngle' => 'angry'
        ],
        'wink' => [
            'eyeShape' => 'wink',
            'mouthShape' => 'smile',
            'eyebrowAngle' => 'normal'
        ],
        'neutral' => [
            'eyeShape' => 'normal',
            'mouthShape' => 'neutral',
            'eyebrowAngle' => 'normal'
        ],
        'confused' => [
            'eyeShape' => 'normal',
            'mouthShape' => 'wavy',
            'eyebrowAngle' => 'confused'
        ],
        'laughing' => [
            'eyeShape' => 'closed',
            'mouthShape' => 'laugh',
            'eyebrowAngle' => 'raised'
        ]
    ];
    
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->ensureDirectoryExists($this->config['storage_path']);
    }
    
    public function generateDynamicAvatar($userId, $expression = null, $skinTone = null, $extraParams = [])
    {
        // If old parameters are passed, handle them
        if (is_string($expression) && in_array($expression, ['child', 'teen', 'adult', 'senior'])) {
            // Old format: generateDynamicAvatar($userId, $ageGroup, $gender, $personality, $state)
            $personality = $extraParams[0] ?? 'neutral';
            $expression = $this->chooseExpressionFromPersonality($personality);
        }
        
        // Generate face attributes
        $attributes = $this->chooseFaceAttributes($expression, $skinTone);
        
        // Create SVG content as string
        $svgContent = $this->buildFaceOnlySvgString($attributes);
        
        // Save SVG file
        $outputPath = $this->config['storage_path'] . '/face_' . $userId . '.svg';
        file_put_contents($outputPath, $svgContent);
        
        return $outputPath;
    }
    
    /**
     * Generate avatar from email - extracts initials and creates avatar
     * Simple method: $service->generateFromemail('john@example.com')
     */
    public function generateFromEmail($email, $options = [])
    {
        // Extract name parts from email
        $emailParts = explode('@', $email);
        $namePart = $emailParts[0];
        
        // Create user ID from email
        $userId = preg_replace('/[^a-zA-Z0-9]/', '', $namePart);
        
        // Generate initials (max 2 characters)
        $initials = '';
        if (strpos($namePart, '.') !== false) {
            // Handle firstname.lastname format
            $parts = explode('.', $namePart);
            $initials = strtoupper(substr($parts[0], 0, 1) . substr($parts[1], 0, 1));
        } elseif (strpos($namePart, '_') !== false) {
            // Handle firstname_lastname format
            $parts = explode('_', $namePart);
            $initials = strtoupper(substr($parts[0], 0, 1) . substr($parts[1], 0, 1));
        } else {
            // Single name - take first 2 letters
            $initials = strtoupper(substr($namePart, 0, 2));
        }
        
        // Determine characteristics from email domain and initials
        $domain = isset($emailParts[1]) ? $emailParts[1] : 'example.com';
        $attributes = $this->generateAttributesFromEmail($email, $initials, $options);
        
        // Create SVG with initials overlay
        $svgContent = $this->buildEmailAvatarSvg($attributes, $initials);
        
        // Save with clean filename
        $filename = "avatar_{$userId}.svg";
        $outputPath = $this->config['storage_path'] . '/' . $filename;
        file_put_contents($outputPath, $svgContent);
        
        return $outputPath;
    }
    
    /**
     * Generate comprehensive avatar - ALL PARAMETERS NOW OPTIONAL with smart defaults
     * Simple usage: $service->generateAvatar('user123')
     * Full usage: $service->generateAvatar('user123', 25, 'female', 'Japan', 'cheerful', 'laughing')
     */
    public function generateAvatar($userId, $age = null, $gender = null, $country = null, $personality = null, $expression = null)
    {
        // Smart defaults based on user ID if parameters not provided
        if ($age === null) {
            $age = $this->generateDefaultAge($userId);
        }
        if ($gender === null) {
            $gender = $this->generateDefaultGender($userId);
        }
        if ($country === null) {
            $country = $this->generateDefaultCountry($userId);
        }
        if ($personality === null) {
            $personality = $this->generateDefaultPersonality($userId);
        }
        if ($expression === null) {
            $expression = $this->generateDefaultExpression($userId, $personality);
        }
        
        // Determine age group from age
        $ageGroup = $this->determineAgeGroup($age);
        
        // Choose attributes based on comprehensive parameters
        $attributes = $this->chooseComprehensiveAttributes($ageGroup, $gender, $country, $personality, $expression);
        
        // Create SVG content
        $svgContent = $this->buildFaceOnlySvgString($attributes);
        
        // Save SVG file with clean name
        $filename = "avatar_{$userId}.svg";
        $outputPath = $this->config['storage_path'] . '/' . $filename;
        file_put_contents($outputPath, $svgContent);
        
        return $outputPath;
    }
    
    /**
     * Generate comprehensive avatar based on age, gender, and country
     * DEPRECATED: Use generateAvatar() instead for cleaner API
     */
    public function generateComprehensiveAvatar($userId, $age = 25, $gender = 'male', $country = 'USA', $personality = null, $expression = null)
    {
        return $this->generateAvatar($userId, $age, $gender, $country, $personality, $expression);
    }
    
    /**
     * Generate avatar with full customization options
     */
    public function generateCustomAvatar($userId, array $options = [])
    {
        $defaults = [
            'age' => 25,
            'gender' => 'male',
            'country' => 'USA',
            'personality' => null,
            'expression' => null,
            'skinTone' => null,
            'eyeColor' => null,
            'hasGlasses' => null
        ];
        
        $options = array_merge($defaults, $options);
        
        // Determine age group
        $ageGroup = $this->determineAgeGroup($options['age']);
        
        // Choose comprehensive attributes
        $attributes = $this->chooseComprehensiveAttributes(
            $ageGroup, 
            $options['gender'], 
            $options['country'], 
            $options['personality'], 
            $options['expression']
        );
        
        // Override with custom options if provided
        if ($options['skinTone']) {
            $attributes['skinTone'] = $this->skinTones[$options['skinTone']] ?? $attributes['skinTone'];
        }
        if ($options['eyeColor']) {
            $attributes['eyeColor'] = $options['eyeColor'];
        }
        if ($options['hasGlasses'] !== null) {
            $attributes['hasGlasses'] = $options['hasGlasses'];
        }
        
        // Create SVG content
        $svgContent = $this->buildFaceOnlySvgString($attributes);
        
        // Save with custom filename
        $filename = "custom_avatar_{$userId}.svg";
        $outputPath = $this->config['storage_path'] . '/' . $filename;
        file_put_contents($outputPath, $svgContent);
        
        return $outputPath;
    }
    
    protected function buildFaceOnlySvgString($attributes)
    {
        $width = $this->config['width'] ?? 256;
        $height = $this->config['height'] ?? 256;
        $centerX = $width / 2;
        $centerY = $height / 2;
        
        $svg = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $svg .= "<svg width='{$width}' height='{$height}' xmlns='http://www.w3.org/2000/svg'>\n";
        
        // Simple background
        $svg .= "  <rect width='100%' height='100%' fill='{$attributes['backgroundColor']}' />\n";
        
        // Draw face only
        $svg .= $this->drawFaceHead($centerX, $centerY, $attributes);
        $svg .= $this->drawFaceEyes($centerX, $centerY, $attributes);
        $svg .= $this->drawFaceEyebrows($centerX, $centerY, $attributes);
        $svg .= $this->drawFaceNose($centerX, $centerY, $attributes);
        $svg .= $this->drawFaceMouth($centerX, $centerY, $attributes);
        
        // Add glasses if needed
        if ($attributes['hasGlasses']) {
            $svg .= $this->drawGlasses($centerX, $centerY, $attributes);
        }
        
        $svg .= "</svg>";
        
        return $svg;
    }
    
    protected function buildSvgString($attributes)
    {
        $width = $this->config['width'];
        $height = $this->config['height'];
        $centerX = $width / 2;
        $centerY = $height / 2;
        
        // Get personality colors
        $personalityColors = $this->config['personalities'][$attributes['personality']];
        
        $svg = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $svg .= "<svg width='{$width}' height='{$height}' xmlns='http://www.w3.org/2000/svg'>\n";
        
        // Background gradient
        $svg .= $this->createGradientBackground($personalityColors);
        
        // Body parts
        $svg .= $this->drawSvgBody($centerX, $centerY, $attributes);
        $svg .= $this->drawSvgHead($centerX, $centerY - 100, $attributes);
        $svg .= $this->drawSvgHair($centerX, $centerY - 100, $attributes);
        $svg .= $this->drawSvgFace($centerX, $centerY - 100, $attributes);
        $svg .= $this->drawSvgClothing($centerX, $centerY, $attributes);
        
        // Add personality effects
        $svg .= $this->addSvgPersonalityEffects($attributes);
        
        // Add state elements if specified
        if ($attributes['state']) {
            $svg .= $this->addSvgStateElements($attributes['state']);
        }
        
        $svg .= "</svg>";
        
        return $svg;
    }
    
    protected function createGradientBackground($colors)
    {
        $gradientId = 'bgGradient';
        $svg = "  <defs>\n";
        $svg .= "    <linearGradient id='{$gradientId}' x1='0%' y1='0%' x2='0%' y2='100%'>\n";
        $svg .= "      <stop offset='0%' style='stop-color:{$colors['primary']};stop-opacity:1' />\n";
        $svg .= "      <stop offset='100%' style='stop-color:{$colors['secondary']};stop-opacity:1' />\n";
        $svg .= "    </linearGradient>\n";
        $svg .= "  </defs>\n";
        $svg .= "  <rect width='100%' height='100%' fill='url(#{$gradientId})' />\n";
        
        return $svg;
    }
    
    protected function drawSvgBody($centerX, $centerY, $attributes)
    {
        $svg = "";
        
        // Body (torso)
        $svg .= "  <ellipse cx='{$centerX}' cy='{$centerY}' rx='50' ry='80' fill='{$attributes['skinTone']}' stroke='#000' stroke-width='2' />\n";
        
        // Arms
        $svg .= "  <ellipse cx='" . ($centerX - 60) . "' cy='" . ($centerY - 20) . "' rx='15' ry='50' fill='{$attributes['skinTone']}' stroke='#000' stroke-width='2' />\n";
        $svg .= "  <ellipse cx='" . ($centerX + 60) . "' cy='" . ($centerY - 20) . "' rx='15' ry='50' fill='{$attributes['skinTone']}' stroke='#000' stroke-width='2' />\n";
        
        // Legs
        $svg .= "  <ellipse cx='" . ($centerX - 25) . "' cy='" . ($centerY + 100) . "' rx='18' ry='60' fill='{$attributes['skinTone']}' stroke='#000' stroke-width='2' />\n";
        $svg .= "  <ellipse cx='" . ($centerX + 25) . "' cy='" . ($centerY + 100) . "' rx='18' ry='60' fill='{$attributes['skinTone']}' stroke='#000' stroke-width='2' />\n";
        
        return $svg;
    }
    
    protected function drawSvgHead($centerX, $centerY, $attributes)
    {
        $svg = "";
        
        // Head shape (adjust size based on age)
        $headRadius = $attributes['ageGroup'] === 'child' ? 40 : 45;
        if ($attributes['ageGroup'] === 'senior') $headRadius = 47;
        
        $svg .= "  <circle cx='{$centerX}' cy='{$centerY}' r='{$headRadius}' fill='{$attributes['skinTone']}' stroke='#000' stroke-width='2' />\n";
        
        return $svg;
    }
    
    protected function drawSvgHair($centerX, $centerY, $attributes)
    {
        $svg = "";
        
        // Hair style variations
        switch ($attributes['hairStyle']) {
            case 'long':
                $svg .= "  <ellipse cx='{$centerX}' cy='" . ($centerY - 10) . "' rx='50' ry='40' fill='{$attributes['hairColor']}' stroke='#000' stroke-width='1' />\n";
                $svg .= "  <ellipse cx='{$centerX}' cy='" . ($centerY + 20) . "' rx='55' ry='35' fill='{$attributes['hairColor']}' stroke='#000' stroke-width='1' />\n";
                break;
            case 'short':
            case 'buzz':
                $svg .= "  <ellipse cx='{$centerX}' cy='" . ($centerY - 15) . "' rx='48' ry='30' fill='{$attributes['hairColor']}' stroke='#000' stroke-width='1' />\n";
                break;
            case 'bob':
                $svg .= "  <ellipse cx='{$centerX}' cy='" . ($centerY - 5) . "' rx='50' ry='35' fill='{$attributes['hairColor']}' stroke='#000' stroke-width='1' />\n";
                break;
            default:
                $svg .= "  <ellipse cx='{$centerX}' cy='" . ($centerY - 10) . "' rx='47' ry='32' fill='{$attributes['hairColor']}' stroke='#000' stroke-width='1' />\n";
        }
        
        return $svg;
    }
    
    protected function drawSvgFace($centerX, $centerY, $attributes)
    {
        $svg = "";
        
        // Eyes
        $eyeY = $centerY - 10;
        $svg .= "  <ellipse cx='" . ($centerX - 15) . "' cy='{$eyeY}' rx='8' ry='6' fill='white' stroke='#000' stroke-width='1' />\n";
        $svg .= "  <ellipse cx='" . ($centerX + 15) . "' cy='{$eyeY}' rx='8' ry='6' fill='white' stroke='#000' stroke-width='1' />\n";
        
        // Pupils
        $svg .= "  <circle cx='" . ($centerX - 15) . "' cy='{$eyeY}' r='4' fill='{$attributes['eyeColor']}' />\n";
        $svg .= "  <circle cx='" . ($centerX + 15) . "' cy='{$eyeY}' r='4' fill='{$attributes['eyeColor']}' />\n";
        
        // Eye shine
        $svg .= "  <circle cx='" . ($centerX - 13) . "' cy='" . ($eyeY - 2) . "' r='2' fill='white' />\n";
        $svg .= "  <circle cx='" . ($centerX + 17) . "' cy='" . ($eyeY - 2) . "' r='2' fill='white' />\n";
        
        // Nose
        $noseY = $centerY + 5;
        $svg .= "  <ellipse cx='{$centerX}' cy='{$noseY}' rx='3' ry='5' fill='#D4A574' stroke='#000' stroke-width='0.5' />\n";
        
        // Mouth based on expression
        $mouthY = $centerY + 20;
        switch ($attributes['expression']) {
            case 'big-smile':
                $svg .= "  <path d='M " . ($centerX - 18) . " {$mouthY} Q {$centerX} " . ($mouthY + 12) . " " . ($centerX + 18) . " {$mouthY}' stroke='#000' stroke-width='2' fill='#FF6B6B' />\n";
                break;
            case 'happy':
                $svg .= "  <path d='M " . ($centerX - 15) . " {$mouthY} Q {$centerX} " . ($mouthY + 10) . " " . ($centerX + 15) . " {$mouthY}' stroke='#000' stroke-width='2' fill='#FF8C00' />\n";
                break;
            case 'smile':
                $svg .= "  <path d='M " . ($centerX - 10) . " {$mouthY} Q {$centerX} " . ($mouthY + 5) . " " . ($centerX + 10) . " {$mouthY}' stroke='#000' stroke-width='2' fill='none' />\n";
                break;
            case 'laughing':
                $svg .= "  <path d='M " . ($centerX - 15) . " " . ($mouthY + 2) . " Q {$centerX} " . ($mouthY + 20) . " " . ($centerX + 15) . " " . ($mouthY + 2) . " T " . ($centerX - 15) . " " . ($mouthY + 2) . " Z' fill='#FF4500' stroke-width='2' stroke='#000' />\n";
                break;
            case 'neutral':
                $svg .= "  <line x1='" . ($centerX - 8) . "' y1='{$mouthY}' x2='" . ($centerX + 8) . "' y2='{$mouthY}' stroke='#000' stroke-width='2' />\n";
                break;
            default:
                $svg .= "  <line x1='" . ($centerX - 5) . "' y1='" . ($mouthY + 2) . "' x2='" . ($centerX + 5) . "' y2='" . ($mouthY + 2) . "' stroke='#000' stroke-width='2' />\n";
        }
        
        // Eyebrows
        $browY = $centerY - 20;
        $browOffset = $attributes['gender'] === 'male' ? 1 : -1;
        $browThickness = $attributes['gender'] === 'male' ? 4 : 2;
        $svg .= "  <line x1='" . ($centerX - 20) . "' y1='" . ($browY + $browOffset) . "' x2='" . ($centerX - 10) . "' y2='" . ($browY + $browOffset) . "' stroke='{$attributes['hairColor']}' stroke-width='{$browThickness}' />\n";
        $svg .= "  <line x1='" . ($centerX + 10) . "' y1='" . ($browY + $browOffset) . "' x2='" . ($centerX + 20) . "' y2='" . ($browY + $browOffset) . "' stroke='{$attributes['hairColor']}' stroke-width='{$browThickness}' />\n";
        
        return $svg;
    }
    
    protected function drawSvgClothing($centerX, $centerY, $attributes)
    {
        $svg = "";
        
        // Simple shirt
        $outfitColor = $this->getOutfitColor($attributes['outfit']);
        $svg .= "  <rect x='" . ($centerX - 40) . "' y='" . ($centerY - 50) . "' width='80' height='100' fill='{$outfitColor}' stroke='#000' stroke-width='2' rx='10' />\n";
        
        // Add outfit details based on type
        if ($attributes['outfit'] === 'suit') {
            // Add tie
            $svg .= "  <rect x='" . ($centerX - 8) . "' y='" . ($centerY - 40) . "' width='16' height='60' fill='#8B0000' stroke='#000' stroke-width='1' />\n";
        }
        
        return $svg;
    }
    
    protected function addSvgPersonalityEffects($attributes)
    {
        $svg = "";
        
        switch ($attributes['personality']) {
            case 'energetic':
                // Add energy sparkles
                $svg .= "  <circle cx='50' cy='50' r='3' fill='#FFD700' />\n";
                $svg .= "  <circle cx='350' cy='80' r='2' fill='#FFD700' />\n";
                $svg .= "  <circle cx='70' cy='400' r='3' fill='#FFD700' />\n";
                break;
            case 'creative':
                // Add creative swirls
                $svg .= "  <path d='M 30 60 Q 50 40 70 60 Q 90 80 110 60' stroke='#FF69B4' stroke-width='2' fill='none' />\n";
                break;
        }
        
        return $svg;
    }
    
    protected function addSvgStateElements($state)
    {
        $svg = "";
        $x = 350;
        $y = 50;
        
        switch ($state) {
            case 'california':
                // California bear (simplified)
                $svg .= "  <circle cx='{$x}' cy='{$y}' r='15' fill='#FFD700' stroke='#000' stroke-width='1' />\n";
                $svg .= "  <text x='{$x}' y='" . ($y + 5) . "' font-family='Arial' font-size='10' text-anchor='middle' fill='#000'>CA</text>\n";
                break;
            case 'texas':
                // Texas star
                $svg .= "  <polygon points='{$x},{$y} " . ($x + 6) . "," . ($y + 18) . " " . ($x + 24) . "," . ($y + 18) . " " . ($x + 10) . "," . ($y + 30) . " " . ($x + 15) . "," . ($y + 48) . " {$x}," . ($y + 36) . " " . ($x - 15) . "," . ($y + 48) . " " . ($x - 10) . "," . ($y + 30) . " " . ($x - 24) . "," . ($y + 18) . " " . ($x - 6) . "," . ($y + 18) . "' fill='#DC143C' stroke='#000' stroke-width='1' />\n";
                break;
        }
        
        return $svg;
    }
    
    protected function chooseAvatarAttributes($ageGroup, $gender, $personality, $state)
    {
        return [
            'skinTone' => $this->chooseSkinTone($ageGroup),
            'hairStyle' => $this->chooseHairStyle($gender),
            'hairColor' => $this->chooseHairColor(),
            'eyeColor' => $this->chooseEyeColor(),
            'outfit' => $this->chooseOutfit($personality, $state),
            'expression' => $this->chooseExpression($personality),
            'ageGroup' => $ageGroup,
            'gender' => $gender,
            'personality' => $personality,
            'state' => $state
        ];
    }
    
    protected function chooseSkinTone($ageGroup)
    {
        $skinToneMap = [
            'child' => 'light',
            'teen' => 'medium_light',
            'adult' => 'medium',
            'senior' => 'medium_dark'
        ];
        
        $selectedTone = $skinToneMap[$ageGroup] ?? 'medium';
        return $this->skinTones[$selectedTone];
    }
    
    protected function chooseHairStyle($gender)
    {
        $styles = [
            'male' => ['short', 'buzz', 'messy'],
            'female' => ['long', 'bob', 'ponytail']
        ];
        
        $genderStyles = $styles[$gender] ?? $styles['male'];
        return $genderStyles[array_rand($genderStyles)];
    }
    
    protected function chooseHairColor()
    {
        $colors = array_keys($this->hairColors);
        $selectedColor = $colors[array_rand($colors)];
        return $this->hairColors[$selectedColor];
    }
    
    protected function chooseEyeColor()
    {
        $eyeColors = ['#654321', '#228B22', '#4682B4', '#8B4513', '#2F4F4F'];
        return $eyeColors[array_rand($eyeColors)];
    }
    
    protected function chooseOutfit($personality, $state)
    {
        if ($state && $state === 'california') return 'beach-wear';
        if ($personality === 'professional') return 'suit';
        return 't-shirt';
    }
    
    protected function chooseExpression($personality)
    {
        $expressions = [
            'confident' => 'smile',
            'energetic' => 'big-smile',
            'professional' => 'neutral',
            'cheerful' => 'happy'
        ];
        
        return $expressions[$personality] ?? 'smile';
    }
    
    protected function getOutfitColor($outfit)
    {
        $colors = [
            't-shirt' => '#6495ED',
            'suit' => '#191970',
            'beach-wear' => '#FFA500'
        ];
        
        return $colors[$outfit] ?? '#6495ED';
    }
    
    // New face-only avatar methods
    protected function chooseFaceAttributes($expression = null, $skinTone = null)
    {
        $expression = $expression ?: array_rand($this->expressions);
        $skinTone = $skinTone ?: array_rand($this->skinTones);
        
        return [
            'expression' => $expression,
            'skinTone' => $this->skinTones[$skinTone] ?? $this->skinTones['medium'],
            'eyeColor' => $this->chooseEyeColor(),
            'backgroundColor' => $this->chooseBackgroundColor(),
            'hasGlasses' => rand(0, 1) === 1,
            'expressionData' => $this->expressions[$expression] ?? $this->expressions['neutral']
        ];
    }
    
    protected function chooseExpressionFromPersonality($personality)
    {
        $personalityToExpression = [
            'confident' => 'neutral',
            'energetic' => 'happy',
            'professional' => 'neutral',
            'cheerful' => 'happy',
            'creative' => 'surprised',
            'stylish' => 'wink'
        ];
        
        return $personalityToExpression[$personality] ?? 'neutral';
    }
    
    protected function chooseBackgroundColor()
    {
        $colors = ['#FFB6C1', '#FFE4E1', '#E6E6FA', '#F0F8FF', '#F5F5DC', '#FFEFD5'];
        return $colors[array_rand($colors)];
    }
    
    protected function drawFaceHead($centerX, $centerY, $attributes)
    {
        $svg = "";
        $headRadius = 45; // Base size for all faces
        $expression = $attributes['expression'];
        
        // Head shape - ALL avatars now use square faces with rounded corners
        $headY = $centerY;
        
        // Different sizes based on expression for variety
        $size = $headRadius * 1.8; // Standard square size
        
        // Adjust size slightly for different expressions
        switch ($expression) {
            case 'laughing':
                $size = $headRadius * 1.9; // Slightly bigger for laughing
                break;
            case 'angry':
                $size = $headRadius * 1.75; // Slightly smaller, more intense
                break;
            case 'surprised':
                $size = $headRadius * 1.85; // Standard with slight increase
                break;
            default:
                $size = $headRadius * 1.8; // Standard size
        }
        
        $x = $centerX - ($size / 2);
        $y = $headY - ($size / 2);
        
        // All faces are now square with rounded corners
        $svg .= "  <rect x='{$x}' y='{$y}' width='{$size}' height='{$size}' rx='15' ry='15' fill='{$attributes['skinTone']}' stroke='#000' stroke-width='2' />\n";
        
        return $svg;
    }
    
    protected function drawFaceEyes($centerX, $centerY, $attributes)
    {
        $svg = "";
        $eyeY = $centerY - 10; // Adjusted for smaller head
        $eyeShape = $attributes['expressionData']['eyeShape'];
        
        switch ($eyeShape) {
            case 'wide':
                // Surprised wide eyes
                $svg .= "  <circle cx='" . ($centerX - 15) . "' cy='{$eyeY}' r='8' fill='white' stroke='#000' stroke-width='2' />\n";
                $svg .= "  <circle cx='" . ($centerX + 15) . "' cy='{$eyeY}' r='8' fill='white' stroke='#000' stroke-width='2' />\n";
                $svg .= "  <circle cx='" . ($centerX - 15) . "' cy='{$eyeY}' r='5' fill='{$attributes['eyeColor']}' />\n";
                $svg .= "  <circle cx='" . ($centerX + 15) . "' cy='{$eyeY}' r='5' fill='{$attributes['eyeColor']}' />\n";
                break;
            case 'narrow':
                // Angry narrow eyes
                $svg .= "  <ellipse cx='" . ($centerX - 15) . "' cy='{$eyeY}' rx='8' ry='4' fill='white' stroke='#000' stroke-width='2' />\n";
                $svg .= "  <ellipse cx='" . ($centerX + 15) . "' cy='{$eyeY}' rx='8' ry='4' fill='white' stroke='#000' stroke-width='2' />\n";
                $svg .= "  <ellipse cx='" . ($centerX - 15) . "' cy='{$eyeY}' rx='4' ry='2' fill='{$attributes['eyeColor']}' />\n";
                $svg .= "  <ellipse cx='" . ($centerX + 15) . "' cy='{$eyeY}' rx='4' ry='2' fill='{$attributes['eyeColor']}' />\n";
                break;
            case 'smile':
                // Happy smile eyes
                $svg .= "  <path d='M " . ($centerX - 20) . " {$eyeY} Q " . ($centerX - 15) . " " . ($eyeY + 4) . " " . ($centerX - 10) . " {$eyeY}' stroke='#000' stroke-width='3' fill='none' />\n";
                $svg .= "  <path d='M " . ($centerX + 10) . " {$eyeY} Q " . ($centerX + 15) . " " . ($eyeY + 4) . " " . ($centerX + 20) . " {$eyeY}' stroke='#000' stroke-width='3' fill='none' />\n";
                break;
            case 'closed':
                // Laughing closed eyes
                $svg .= "  <path d='M " . ($centerX - 20) . " {$eyeY} Q " . ($centerX - 15) . " " . ($eyeY + 4) . " " . ($centerX - 10) . " {$eyeY}' stroke='#000' stroke-width='4' fill='none' />\n";
                $svg .= "  <path d='M " . ($centerX + 10) . " {$eyeY} Q " . ($centerX + 15) . " " . ($eyeY + 4) . " " . ($centerX + 20) . " {$eyeY}' stroke='#000' stroke-width='4' fill='none' />\n";
                break;
            case 'wink':
                // One eye closed, one open
                $svg .= "  <path d='M " . ($centerX - 20) . " {$eyeY} Q " . ($centerX - 15) . " " . ($eyeY + 4) . " " . ($centerX - 10) . " {$eyeY}' stroke='#000' stroke-width='4' fill='none' />\n";
                $svg .= "  <circle cx='" . ($centerX + 15) . "' cy='{$eyeY}' r='8' fill='white' stroke='#000' stroke-width='2' />\n";
                $svg .= "  <circle cx='" . ($centerX + 15) . "' cy='{$eyeY}' r='5' fill='{$attributes['eyeColor']}' />\n";
                break;
            default:
                // Normal eyes
                $svg .= "  <ellipse cx='" . ($centerX - 15) . "' cy='{$eyeY}' rx='8' ry='6' fill='white' stroke='#000' stroke-width='2' />\n";
                $svg .= "  <ellipse cx='" . ($centerX + 15) . "' cy='{$eyeY}' rx='8' ry='6' fill='white' stroke='#000' stroke-width='2' />\n";
                $svg .= "  <circle cx='" . ($centerX - 15) . "' cy='{$eyeY}' r='4' fill='{$attributes['eyeColor']}' />\n";
                $svg .= "  <circle cx='" . ($centerX + 15) . "' cy='{$eyeY}' r='4' fill='{$attributes['eyeColor']}' />\n";
        }
        
        // Eye shine (only for open eyes)
        if (!in_array($eyeShape, ['closed', 'smile'])) {
            if ($eyeShape !== 'wink') {
                $svg .= "  <circle cx='" . ($centerX - 13) . "' cy='" . ($eyeY - 3) . "' r='2' fill='white' />\n";
            }
            $svg .= "  <circle cx='" . ($centerX + 17) . "' cy='" . ($eyeY - 3) . "' r='2' fill='white' />\n";
        }
        
        return $svg;
    }
    
    protected function drawFaceEyebrows($centerX, $centerY, $attributes)
    {
        $svg = "";
        $browY = $centerY - 25; // Adjusted to fit within larger face circle (45px radius)
        $eyebrowAngle = $attributes['expressionData']['eyebrowAngle'];
        
        switch ($eyebrowAngle) {
            case 'raised':
                // Happy/surprised raised eyebrows - shortened to fit within circle
                $svg .= "  <path d='M " . ($centerX - 30) . " " . ($browY + 5) . " Q " . ($centerX - 22) . " " . ($browY - 3) . " " . ($centerX - 14) . " " . ($browY + 2) . "' stroke='#654321' stroke-width='4' fill='none' />\n";
                $svg .= "  <path d='M " . ($centerX + 14) . " " . ($browY + 2) . " Q " . ($centerX + 22) . " " . ($browY - 3) . " " . ($centerX + 30) . " " . ($browY + 5) . "' stroke='#654321' stroke-width='4' fill='none' />\n";
                break;
            case 'angry':
                // Angry angled eyebrows - shortened to fit within circle
                $svg .= "  <line x1='" . ($centerX - 30) . "' y1='" . ($browY + 6) . "' x2='" . ($centerX - 14) . "' y2='" . ($browY - 2) . "' stroke='#654321' stroke-width='5' />\n";
                $svg .= "  <line x1='" . ($centerX + 14) . "' y1='" . ($browY - 2) . "' x2='" . ($centerX + 30) . "' y2='" . ($browY + 6) . "' stroke='#654321' stroke-width='5' />\n";
                break;
            case 'down':
                // Sad down eyebrows - shortened to fit within circle
                $svg .= "  <path d='M " . ($centerX - 30) . " " . ($browY - 2) . " Q " . ($centerX - 22) . " " . ($browY + 4) . " " . ($centerX - 14) . " " . ($browY + 2) . "' stroke='#654321' stroke-width='4' fill='none' />\n";
                $svg .= "  <path d='M " . ($centerX + 14) . " " . ($browY + 2) . " Q " . ($centerX + 22) . " " . ($browY + 4) . " " . ($centerX + 30) . " " . ($browY - 2) . "' stroke='#654321' stroke-width='4' fill='none' />\n";
                break;
            case 'confused':
                // One raised, one normal - shortened to fit within circle
                $svg .= "  <path d='M " . ($centerX - 30) . " " . ($browY + 4) . " Q " . ($centerX - 22) . " " . ($browY - 3) . " " . ($centerX - 14) . " " . ($browY + 2) . "' stroke='#654321' stroke-width='4' fill='none' />\n";
                $svg .= "  <line x1='" . ($centerX + 14) . "' y1='{$browY}' x2='" . ($centerX + 30) . "' y2='{$browY}' stroke='#654321' stroke-width='4' />\n";
                break;
            default:
                // Normal straight eyebrows - shortened to fit within circle
                $svg .= "  <line x1='" . ($centerX - 30) . "' y1='{$browY}' x2='" . ($centerX - 14) . "' y2='{$browY}' stroke='#654321' stroke-width='4' />\n";
                $svg .= "  <line x1='" . ($centerX + 14) . "' y1='{$browY}' x2='" . ($centerX + 30) . "' y2='{$browY}' stroke='#654321' stroke-width='4' />\n";
        }
        
        return $svg;
    }
    
    protected function drawFaceNose($centerX, $centerY, $attributes)
    {
        $svg = "";
        $noseY = $centerY + 5; // Adjusted for centered head
        $expression = $attributes['expression'];
        $mouthShape = $attributes['expressionData']['mouthShape'];
        
        // Different nose shapes based on expression
        switch ($expression) {
            case 'angry':
                // Flared nostrils for angry expression
                $svg .= "  <ellipse cx='{$centerX}' cy='{$noseY}' rx='5' ry='9' fill='#D4A574' stroke='#000' stroke-width='1' />\n";
                // Add nostril flares
                $svg .= "  <ellipse cx='" . ($centerX - 3) . "' cy='" . ($noseY + 4) . "' rx='2' ry='3' fill='#C68642' />\n";
                $svg .= "  <ellipse cx='" . ($centerX + 3) . "' cy='" . ($noseY + 4) . "' rx='2' ry='3' fill='#C68642' />\n";
                break;
            case 'surprised':
                // Slightly wider nose for surprise
                $svg .= "  <ellipse cx='{$centerX}' cy='{$noseY}' rx='5' ry='8' fill='#D4A574' stroke='#000' stroke-width='1' />\n";
                // Add highlight for surprise
                $svg .= "  <ellipse cx='" . ($centerX - 1) . "' cy='" . ($noseY - 2) . "' rx='1.5' ry='3' fill='#F1C27D' />\n";
                break;
            case 'laughing':
                // Crinkled nose for laughing
                $svg .= "  <ellipse cx='{$centerX}' cy='{$noseY}' rx='4.5' ry='7' fill='#D4A574' stroke='#000' stroke-width='1' />\n";
                // Add laugh lines around nose
                $svg .= "  <path d='M " . ($centerX - 8) . " " . ($noseY - 2) . " Q " . ($centerX - 6) . " " . ($noseY + 2) . " " . ($centerX - 4) . " " . ($noseY + 6) . "' stroke='#C68642' stroke-width='1' fill='none' />\n";
                $svg .= "  <path d='M " . ($centerX + 8) . " " . ($noseY - 2) . " Q " . ($centerX + 6) . " " . ($noseY + 2) . " " . ($centerX + 4) . " " . ($noseY + 6) . "' stroke='#C68642' stroke-width='1' fill='none' />\n";
                break;
            case 'sad':
                // Droopy nose for sad expression
                $svg .= "  <ellipse cx='{$centerX}' cy='" . ($noseY + 1) . "' rx='3.5' ry='9' fill='#D4A574' stroke='#000' stroke-width='1' />\n";
                break;
            case 'wink':
                // Slightly tilted nose for wink
                $svg .= "  <ellipse cx='" . ($centerX + 0.5) . "' cy='{$noseY}' rx='4' ry='8' fill='#D4A574' stroke='#000' stroke-width='1' transform='rotate(2 " . ($centerX + 0.5) . " {$noseY})' />\n";
                break;
            case 'confused':
                // Slightly crooked nose for confusion
                $svg .= "  <ellipse cx='" . ($centerX - 0.5) . "' cy='{$noseY}' rx='4' ry='8' fill='#D4A574' stroke='#000' stroke-width='1' transform='rotate(-1.5 " . ($centerX - 0.5) . " {$noseY})' />\n";
                break;
            default:
                // Enhanced nose for normal expressions
                $svg .= "  <ellipse cx='{$centerX}' cy='{$noseY}' rx='4.5' ry='8' fill='#E0AC69' stroke='#000' stroke-width='1' />\n";
                // Add nose highlight
                $svg .= "  <ellipse cx='" . ($centerX - 1) . "' cy='" . ($noseY - 2) . "' rx='1.5' ry='3' fill='#F1C27D' />\n";
                // Add subtle nostril definition
                $svg .= "  <ellipse cx='" . ($centerX - 2) . "' cy='" . ($noseY + 3) . "' rx='1' ry='2' fill='#C68642' opacity='0.7' />\n";
                $svg .= "  <ellipse cx='" . ($centerX + 2) . "' cy='" . ($noseY + 3) . "' rx='1' ry='2' fill='#C68642' opacity='0.7' />\n";
        }
        
        // Add blush on cheeks - only for female avatars
        if (isset($attributes['gender']) && $attributes['gender'] === 'female') {
            $blushColor = '#FF69B4';
            $blushRadius = 6;
            $svg .= "  <ellipse cx='" . ($centerX - 22) . "' cy='" . ($noseY + 12) . "' rx='{$blushRadius}' ry='4' fill='{$blushColor}' fill-opacity='0.6' />\n";
            $svg .= "  <ellipse cx='" . ($centerX + 22) . "' cy='" . ($noseY + 12) . "' rx='{$blushRadius}' ry='4' fill='{$blushColor}' fill-opacity='0.6' />\n";
        }

        return $svg;
    }

    protected function drawFaceMouth($centerX, $centerY, $attributes)
    {
        $svg = "";
        $mouthY = $centerY + 20; // Adjusted for centered head
        $mouthShape = $attributes['expressionData']['mouthShape'];
        
        switch ($mouthShape) {
            case 'big-smile':
                // Big happy smile with improved teeth
                $svg .= "  <path d='M " . ($centerX - 20) . " {$mouthY} Q {$centerX} " . ($mouthY + 12) . " " . ($centerX + 20) . " {$mouthY}' stroke='#000' stroke-width='3' fill='#FF6B6B' />\n";
                // Better teeth - individual rectangles with rounded corners
                $teethY = $mouthY + 3;
                $teethHeight = 5;
                $teethWidth = 4;
                for ($i = -3; $i <= 3; $i++) {
                    $teethX = $centerX + ($i * 5);
                    $svg .= "  <rect x='" . ($teethX - $teethWidth/2) . "' y='{$teethY}' width='{$teethWidth}' height='{$teethHeight}' fill='white' rx='1' />\n";
                }
                break;
            case 'smile':
                // Regular smile
                $svg .= "  <path d='M " . ($centerX - 15) . " {$mouthY} Q {$centerX} " . ($mouthY + 8) . " " . ($centerX + 15) . " {$mouthY}' stroke='#000' stroke-width='3' fill='none' />\n";
                break;
            case 'frown':
                // Sad frown
                $svg .= "  <path d='M " . ($centerX - 15) . " {$mouthY} Q {$centerX} " . ($mouthY - 8) . " " . ($centerX + 15) . " {$mouthY}' stroke='#000' stroke-width='3' fill='none' />\n";
                break;
            case 'open':
                // Surprised open mouth
                $svg .= "  <ellipse cx='{$centerX}' cy='{$mouthY}' rx='8' ry='12' fill='#8B0000' stroke='#000' stroke-width='2' />\n";
                break;
            case 'wavy':
                // Confused wavy mouth
                $svg .= "  <path d='M " . ($centerX - 15) . " {$mouthY} Q " . ($centerX - 5) . " " . ($mouthY - 5) . " " . ($centerX + 5) . " {$mouthY} Q " . ($centerX + 15) . " " . ($mouthY + 5) . " " . ($centerX + 20) . " {$mouthY}' stroke='#000' stroke-width='3' fill='none' />\n";
                break;
            case 'laugh':
                // Improved laughing mouth with a more appealing shape
                $svg .= "  <path d='M " . ($centerX - 25) . " {$mouthY} Q " . ($centerX - 12) . " " . ($mouthY + 20) . " " . $centerX . " " . ($mouthY + 10) . " Q " . ($centerX + 12) . " " . ($mouthY + 20) . " " . ($centerX + 25) . " {$mouthY}' stroke='#000' stroke-width='3' fill='#FF6B6B' />\n";

                // Inner mouth with a softer shape
                $svg .= "  <ellipse cx='{$centerX}' cy='" . ($mouthY + 7) . "' rx='16' ry='6' fill='#8B0000' />\n";
                
                // Simple upper teeth - just one clean rectangle
                $svg .= "  <rect x='" . ($centerX - 16) . "' y='" . ($mouthY + 2) . "' width='32' height='6' fill='white' rx='1' />\n";
                
                // Add cheek dimples for laughing
                $svg .= "  <ellipse cx='" . ($centerX - 32) . "' cy='" . ($mouthY - 3) . "' rx='3' ry='5' fill='#C68642' opacity='0.5' />\n";
                $svg .= "  <ellipse cx='" . ($centerX + 32) . "' cy='" . ($mouthY - 3) . "' rx='3' ry='5' fill='#C68642' opacity='0.5' />\n";
                break;
            default:
                // Neutral mouth
                $svg .= "  <line x1='" . ($centerX - 10) . "' y1='{$mouthY}' x2='" . ($centerX + 10) . "' y2='{$mouthY}' stroke='#000' stroke-width='3' />\n";
        }
        
        return $svg;
    }
    
    protected function drawGlasses($centerX, $centerY, $attributes)
    {
        $svg = "";
        $eyeY = $centerY - 10; // Aligned with eye position
        
        // Glasses frames - adjusted size for smaller head
        $svg .= "  <circle cx='" . ($centerX - 15) . "' cy='{$eyeY}' r='12' fill='none' stroke='#000' stroke-width='2' />\n";
        $svg .= "  <circle cx='" . ($centerX + 15) . "' cy='{$eyeY}' r='12' fill='none' stroke='#000' stroke-width='2' />\n";
        
        // Bridge
        $svg .= "  <line x1='" . ($centerX - 3) . "' y1='{$eyeY}' x2='" . ($centerX + 3) . "' y2='{$eyeY}' stroke='#000' stroke-width='2' />\n";
        
        // Temples - adjusted for smaller frame
        $svg .= "  <line x1='" . ($centerX - 27) . "' y1='{$eyeY}' x2='" . ($centerX - 32) . "' y2='{$eyeY}' stroke='#000' stroke-width='2' />\n";
        $svg .= "  <line x1='" . ($centerX + 27) . "' y1='{$eyeY}' x2='" . ($centerX + 32) . "' y2='{$eyeY}' stroke='#000' stroke-width='2' />\n";
        
        return $svg;
    }
    
    protected function ensureDirectoryExists($path)
    {
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }
    
    /**
     * Determine age group from numerical age
     */
    protected function determineAgeGroup($age)
    {
        if ($age < 13) return 'child';
        if ($age < 20) return 'teen';
        if ($age < 60) return 'adult';
        return 'senior';
    }
    
    /**
     * Choose comprehensive attributes based on all parameters
     */
    protected function chooseComprehensiveAttributes($ageGroup, $gender, $country, $personality = null, $expression = null)
    {
        // Get base characteristics for age group
        $ageChars = $this->ageCharacteristics[$ageGroup] ?? $this->ageCharacteristics['adult'];
        $genderFeatures = $this->genderFeatures[$gender] ?? $this->genderFeatures['male'];
        $countryFeatures = $this->countryFeatures[$country] ?? $this->countryFeatures['USA'];
        
        // Choose skin tone based on country preferences
        $skinToneOptions = $countryFeatures['skinTonePreference'];
        $availableTones = array_intersect($skinToneOptions, $ageChars['skinTones']);
        if (empty($availableTones)) {
            $availableTones = $ageChars['skinTones'];
        }
        $skinToneKey = $availableTones[array_rand($availableTones)];
        $skinTone = $this->skinTones[$skinToneKey];
        
        // Choose expression based on personality or random
        if (!$expression) {
            if ($personality) {
                $expression = $this->chooseExpressionFromPersonality($personality);
            } else {
                $expression = array_rand($this->expressions);
            }
        }
        
        // Choose background color from country preferences
        $backgroundColor = $countryFeatures['backgroundColor'][array_rand($countryFeatures['backgroundColor'])];
        
        // Determine glasses based on age and country
        $hasGlasses = false;
        if (in_array('glasses', $countryFeatures['accessories'])) {
            $glassesChance = [
                'child' => 0.1,
                'teen' => 0.2,
                'adult' => 0.3,
                'senior' => 0.6
            ];
            $hasGlasses = (rand(0, 100) / 100) < ($glassesChance[$ageGroup] ?? 0.3);
        }
        
        return [
            'expression' => $expression,
            'skinTone' => $skinTone,
            'eyeColor' => $this->chooseEyeColor(),
            'backgroundColor' => $backgroundColor,
            'hasGlasses' => $hasGlasses,
            'expressionData' => $this->expressions[$expression] ?? $this->expressions['neutral'],
            'ageGroup' => $ageGroup,
            'gender' => $gender,
            'country' => $country,
            'personality' => $personality,
            // Additional features based on comprehensive selection
            'eyebrowThickness' => $genderFeatures['eyebrowThickness'],
            'faceSize' => $ageChars['faceSize'],
            'eyeSize' => $ageChars['eyeSize'],
            'noseSize' => $ageChars['noseSize'],
            'mouthSize' => $ageChars['mouthSize']
        ];
    }
    
    /**
     * Hair colors for different demographics
     */
    protected $hairColors = [
        'black' => '#2C1B18',
        'dark_brown' => '#654321',
        'brown' => '#8B4513',
        'light_brown' => '#A0522D',
        'blonde' => '#F4A460',
        'red' => '#B22222',
        'gray' => '#808080',
        'white' => '#F5F5F5'
    ];
    
    // === SMART DEFAULTS METHODS ===
    
    /**
     * Generate default age based on user ID hash
     */
    protected function generateDefaultAge($userId)
    {
        $hash = crc32($userId);
        $ages = [18, 22, 25, 28, 30, 32, 35, 38, 40, 42, 45, 48, 50, 55, 60, 65];
        return $ages[abs($hash) % count($ages)];
    }
    
    /**
     * Generate default gender based on user ID hash
     */
    protected function generateDefaultGender($userId)
    {
        $hash = crc32($userId . 'gender');
        return (abs($hash) % 2) === 0 ? 'male' : 'female';
    }
    
    /**
     * Generate default country based on user ID hash
     */
    protected function generateDefaultCountry($userId)
    {
        $hash = crc32($userId . 'country');
        $countries = ['USA', 'India', 'China', 'UK', 'Germany', 'Japan', 'Brazil', 'Nigeria'];
        return $countries[abs($hash) % count($countries)];
    }
    
    /**
     * Generate default personality based on user ID hash
     */
    protected function generateDefaultPersonality($userId)
    {
        $hash = crc32($userId . 'personality');
        $personalities = ['confident', 'energetic', 'professional', 'cheerful', 'creative', 'stylish'];
        return $personalities[abs($hash) % count($personalities)];
    }
    
    /**
     * Generate default expression based on user ID and personality
     */
    protected function generateDefaultExpression($userId, $personality)
    {
        // First try to get expression from personality
        $expressionFromPersonality = $this->chooseExpressionFromPersonality($personality);
        if ($expressionFromPersonality !== 'neutral') {
            return $expressionFromPersonality;
        }
        
        // Otherwise use hash-based selection
        $hash = crc32($userId . 'expression');
        $expressions = ['happy', 'neutral', 'wink', 'surprised', 'laughing'];
        return $expressions[abs($hash) % count($expressions)];
    }
    
    // === EMAIL AVATAR METHODS ===
    
    /**
     * Generate attributes from email for simple avatar
     */
    protected function generateAttributesFromEmail($email, $initials, $options = [])
    {
        $hash = crc32($email);
        
        // Use hash to determine characteristics
        $age = $this->generateDefaultAge($email);
        $gender = $this->generateDefaultGender($email);
        $country = $this->generateDefaultCountry($email);
        $personality = $this->generateDefaultPersonality($email);
        $expression = $this->generateDefaultExpression($email, $personality);
        
        // Override with options if provided
        $age = $options['age'] ?? $age;
        $gender = $options['gender'] ?? $gender;
        $country = $options['country'] ?? $country;
        $personality = $options['personality'] ?? $personality;
        $expression = $options['expression'] ?? $expression;
        
        $ageGroup = $this->determineAgeGroup($age);
        return $this->chooseComprehensiveAttributes($ageGroup, $gender, $country, $personality, $expression);
    }
    
    /**
     * Build email avatar SVG with initials overlay
     */
    protected function buildEmailAvatarSvg($attributes, $initials)
    {
        $width = $this->config['width'] ?? 256;
        $height = $this->config['height'] ?? 256;
        $centerX = $width / 2;
        $centerY = $height / 2;
        
        $svg = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $svg .= "<svg width='{$width}' height='{$height}' xmlns='http://www.w3.org/2000/svg'>\n";
        
        // Background circle with color based on initials
        $bgColor = $this->getInitialsBackgroundColor($initials);
        $svg .= "  <circle cx='{$centerX}' cy='{$centerY}' r='" . ($width/2 - 10) . "' fill='{$bgColor}' stroke='#fff' stroke-width='4' />\n";
        
        // Add subtle face features in background
        $faceRadius = 60;
        $faceY = $centerY - 20;
        
        // Simple face outline
        $svg .= "  <circle cx='{$centerX}' cy='{$faceY}' r='{$faceRadius}' fill='none' stroke='#fff' stroke-width='2' opacity='0.3' />\n";
        
        // Simple eyes
        $eyeY = $faceY - 15;
        $svg .= "  <circle cx='" . ($centerX - 15) . "' cy='{$eyeY}' r='4' fill='#fff' opacity='0.4' />\n";
        $svg .= "  <circle cx='" . ($centerX + 15) . "' cy='{$eyeY}' r='4' fill='#fff' opacity='0.4' />\n";
        
        // Simple smile
        $mouthY = $faceY + 15;
        $svg .= "  <path d='M " . ($centerX - 15) . " {$mouthY} Q {$centerX} " . ($mouthY + 8) . " " . ($centerX + 15) . " {$mouthY}' stroke='#fff' stroke-width='2' fill='none' opacity='0.4' />\n";
        
        // Large initials text
        $fontSize = min($width, $height) * 0.35;
        $textY = $centerY + ($fontSize * 0.35);
        
        $svg .= "  <text x='{$centerX}' y='{$textY}' font-family='Arial, sans-serif' font-size='{$fontSize}' font-weight='bold' text-anchor='middle' fill='#fff' dominant-baseline='middle'>{$initials}</text>\n";
        
        $svg .= "</svg>";
        
        return $svg;
    }
    
    /**
     * Get background color based on initials
     */
    protected function getInitialsBackgroundColor($initials)
    {
        $colors = [
            '#FF6B6B', '#4ECDC4', '#45B7D1', '#96CEB4', '#FECA57',
            '#FF9FF3', '#54A0FF', '#5F27CD', '#00D2D3', '#FF9F43',
            '#10AC84', '#EE5A24', '#0652DD', '#9C88FF', '#FFC312'
        ];
        
        $hash = 0;
        for ($i = 0; $i < strlen($initials); $i++) {
            $hash += ord($initials[$i]);
        }
        
        return $colors[$hash % count($colors)];
    }
}
