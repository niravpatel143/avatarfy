<?php

namespace Avatarfy\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string generateAvatar(string $userId, int $age = null, string $gender = null, string $country = null, string $personality = null, string $expression = null)
 * @method static string generateFromEmail(string $email, array $options = [])
 * @method static string generateCustomAvatar(string $userId, array $options = [])
 * @method static string generateComprehensiveAvatar(string $userId, int $age = 25, string $gender = 'male', string $country = 'USA', string $personality = null, string $expression = null)
 *
 * @see \Avatarfy\Services\SimpleSvgAvatarService
 */
class AvatarGenerator extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'avatar-service';
    }
}
