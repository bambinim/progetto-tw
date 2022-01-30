<?php

namespace App;

use App\Database\Entities\User;
use App\Database\Database;

class SecurityManager
{

    public static function getUser(): ?User
    {
        if (isset($_SESSION['uid'])) {
            return Database::getRepository(User::class)->findOne(['id' => $_SESSION['uid']]);
        } else {
            return null;
        }
    }

    public static function isUserLogged(): bool
    {
        return isset($_SESSION['uid']);
    }

    public static function checkCredentials(string $email, string $password): ?User
    {
        $user = Database::getRepository(User::class)->findOne(['email' => $email]);
        if (is_null($user)) {
            return null;
        } else if (password_verify($password, $user->getPassword())) {
            return $user;
        } else {
            return null;
        }
    }

    public static function createPasswordHash(string $password, int $cost = 12): string
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => $cost]);
    }

    public static function openSession(User $user)
    {
        $_SESSION['uid'] = $user->getId();
    }

    public static function closeSession()
    {
        if (isset($_SESSION['uid'])) {
            unset($_SESSION['uid']);
        }
    }

    public static function authenticateUser(string $email, string $password): ?User
    {
        $user = self::checkCredentials($email, $password);
        if (!is_null($user)) {
            self::openSession($user);
        }
        return $user;
    }

    public static function generateCartCookie(): string
    {
        return hash('sha256', $_COOKIE['PHPSESSID'] . date_format(new \DateTime(), 'Y-m-dTH:i:s'));
    }
}