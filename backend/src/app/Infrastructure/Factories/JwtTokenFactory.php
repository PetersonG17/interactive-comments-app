<?php

namespace App\Infrastructure\Factories;

use Firebase\JWT\JWT;
use App\Infrastructure\Exceptions\UndefinedTokenTypeException;
use App\Domain\User;
use App\Infrastructure\Token;
use App\Infrastructure\AccessToken;
use App\Infrastructure\RefreshToken;
use Carbon\Carbon;

class JwtTokenFactory implements TokenFactory
{
    // TODO: Move key into config...
    private const KEY = 'r,)QP-tmZ2E$)rB';
    private const HASHING_ALGORITHM = 'HS256';

    private static User $user;
    private static array $payload = [];
    private static string $jwt;
    private static string $tokenClass;

    public static function make(string $tokenClass, User $user): Token
    {
        self::$tokenClass = $tokenClass;
        self::$user = $user;

        self::createPayload();
        self::encodeJwtPayload();
        return self::createToken();
    }

    private static function createPayload(): void
    {
        self::$payload = [
            'iss' => self::getIssuer(),
            'exp' => self::calculateExpirationTime(),
            'sub' => self::$user->id(),
            // TODO: Any other useful claims here...
        ];
    }

    private static function getIssuer(): string
    {
        return $_SERVER['SERVER_NAME'];
    }

    private static function calculateExpirationTime(): int
    {
        if(self::$tokenClass == AccessToken::class) {
            return Carbon::now()->addHours(24)->timestamp;
        } else if (self::$tokenClass == RefreshToken::class) {
            return Carbon::now()->addDays(30)->timestamp;
        }

        throw new UndefinedTokenTypeException("Unable to create token. Token type of: " .  self::$tokenClass . " is undefined.");
    }

    private static function encodeJwtPayload(): void
    {
        self::$jwt = JWT::encode(self::$payload, self::KEY, self::HASHING_ALGORITHM);
    }

    private static function createToken(): Token
    {
        if (self::$tokenClass == AccessToken::class) {
            return new AccessToken(self::$payload['exp'], Carbon::now(), self::$jwt);
        } else { // Refresh Token
            return new RefreshToken(self::$payload['exp'], Carbon::now(), self::$jwt);
        }
    }
}