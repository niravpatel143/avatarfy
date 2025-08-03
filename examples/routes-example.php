<?php

/**
 * Add these routes to your routes/web.php file
 */

use App\Http\Controllers\AvatarController;

// Simple avatar generation routes
Route::prefix('avatar')->group(function () {
    
    // Generate simple avatar
    Route::get('/generate/{userId}', [AvatarController::class, 'generate']);
    
    // Generate from email
    Route::post('/from-email', [AvatarController::class, 'fromEmail']);
    
    // Generate custom avatar
    Route::post('/custom/{userId}', [AvatarController::class, 'custom']);
    
    // Show form (optional)
    Route::get('/form', [AvatarController::class, 'showForm']);
});

/**
 * Example API calls:
 * 
 * 1. Generate simple avatar:
 *    GET /avatar/generate/user123
 * 
 * 2. Generate from email:
 *    POST /avatar/from-email
 *    { "email": "john@example.com" }
 * 
 * 3. Generate custom avatar:
 *    POST /avatar/custom/user456
 *    { 
 *      "age": 25, 
 *      "gender": "female", 
 *      "country": "Japan", 
 *      "expression": "happy" 
 *    }
 */
