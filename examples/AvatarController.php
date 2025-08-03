<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvatarForge\Services\AvatarGeneratorService;
use AvatarForge\Facades\AvatarForge;

class AvatarController extends Controller
{
    protected $avatarGenerator;

    public function __construct(AvatarGeneratorService $avatarGenerator)
    {
        $this->avatarGenerator = $avatarGenerator;
    }

    /**
     * Generate avatar for a user
     */
    public function generateAvatar(Request $request, $userId)
    {
        $request->validate([
            'age_group' => 'required|in:child,teen,adult,senior',
            'gender' => 'required|in:male,female,neutral',
            'personality' => 'required|in:cheerful,professional,calm,energetic,creative',
            'state' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('temp');
        }

        try {
            $avatarPath = $this->avatarGenerator->generateAvatar(
                $userId,
                $request->age_group,
                $request->gender,
                $request->personality,
                $request->state,
                $profilePicturePath ? storage_path('app/' . $profilePicturePath) : null
            );

            // Clean up temporary file
            if ($profilePicturePath) {
                unlink(storage_path('app/' . $profilePicturePath));
            }

            return response()->json([
                'success' => true,
                'avatar_path' => $avatarPath,
                'avatar_url' => $this->getAvatarUrl($userId)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display avatar generation form
     */
    public function showForm($userId)
    {
        $config = config('avatar-forge');
        
        return view('avatar-form', [
            'userId' => $userId,
            'ageGroups' => $config['age_groups'],
            'genders' => $config['genders'],
            'personalities' => array_keys($config['personalities']),
            'states' => array_keys($config['states']),
            'currentAvatar' => $this->getAvatarUrl($userId)
        ]);
    }

    /**
     * Get avatar URL for display
     */
    protected function getAvatarUrl($userId)
    {
        if ($this->avatarGenerator->avatarExists($userId)) {
            return asset('storage/avatars/user_' . $userId . '.png');
        }
        
        return null;
    }

    /**
     * Delete user avatar
     */
    public function deleteAvatar($userId)
    {
        $deleted = $this->avatarGenerator->deleteAvatar($userId);
        
        return response()->json([
            'success' => $deleted,
            'message' => $deleted ? 'Avatar deleted successfully' : 'Avatar not found'
        ]);
    }

    /**
     * Example using facade
     */
    public function generateWithFacade(Request $request, $userId)
    {
        try {
            $avatarPath = AvatarForge::generateAvatar(
                $userId,
                $request->age_group ?? 'adult',
                $request->gender ?? 'neutral',
                $request->personality ?? 'professional',
                $request->state,
                $request->profile_picture
            );

            return response()->json([
                'success' => true,
                'avatar_path' => $avatarPath
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
