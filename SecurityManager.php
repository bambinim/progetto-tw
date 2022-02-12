<?php

namespace App;

use App\Database\Entities\User;
use App\Database\Database;
use App\Database\Entities\AuthToken;

class SecurityManager
{

    public static function generateRandomString(int $length = 32): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#+-';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

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

    public static function generateAuthToken(): string
    {
        $flag = false;
        $token = '';
        while (!$flag) {
            $token = self::generateRandomString();
            $flag = is_null(Database::getRepository(AuthToken::class)->findOne(['token' => $token]));
        }
        return $token;
    }

    public static function createRememberMeCookie(User $user)
    {
        $tokenString = self::generateAuthToken();
        $expiring = new \DateTime();
        $expiring->add(new \DateInterval('P30D'));
        $token = new AuthToken();
        $token->setToken($tokenString);
        $token->setExpiringDate(date_format($expiring, 'Y-m-d H:i:s'));
        $token->setUserId($user->getId());
        $token->save();
        setcookie('AUTHTOKEN', $tokenString, time()+60*60*24*30, '/');
    }

    public static function deleteRememberMeCookie()
    {
        if (isset($_COOKIE['AUTHTOKEN'])) {
            $tokenString = $_COOKIE['AUTHTOKEN'];
            setcookie('AUTHTOKEN', null, -1, '/');
            $token = Database::getRepository(AuthToken::class)->findOne(['token' => $tokenString]);
            if (!is_null($token)) {
                $token->delete();
            }
        }
    }

    public static function authenticateUserWithAuthToken(): ?User
    {
        if (isset($_COOKIE['AUTHTOKEN'])) {
            $token = Database::getRepository(AuthToken::class)->findOne(['token' => $_COOKIE['AUTHTOKEN']]);
            if (!is_null($token) && $token->getExpiringDate() > date_format(new \DateTime(), 'Y-m-d H:i:s')) {
                $user = $token->getUser();
                self::openSession($user);
                return $user;
            }
        }
        return null;
    }
}