<?php

namespace App\Infrastructure\Factories;

use Firebase\JWT\JWT;
use App\Infrastructure\Exceptions\UndefinedTokenTypeException;
use App\Domain\User;
use App\Oauth\Infrastructure\Token;
use App\Oauth\Infrastructure\TokenType;
use Carbon\Carbon;

class JwtTokenFactory implements TokenFactory
{
    // TODO: Move key into config...
    private const KEY = 'r,)QP-tmZ2E$)rB';
    private const HASHING_ALGORITHM = 'HS256';

    private static TokenType $type;
    private static User $user;
    private static array $payload = [];
    private static string $jwt;

    public static function make(TokenType $type, User $user): Token
    {
        self::$type = $type;
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
        if(self::$type == TokenType::ACCESS) {
            return Carbon::now()->addHours(24)->timestamp;
        } else if (self::$type == TokenType::REFRESH) {
            return Carbon::now()->addDays(30)->timestamp;
        }

        throw new UndefinedTokenTypeException("Unable to create token. Token type of: " .  self::$type . " is undefined.");
    }

    private static function encodeJwtPayload(): void
    {
        self::$jwt = JWT::encode(self::$payload, self::KEY, self::HASHING_ALGORITHM);
    }

    private static function createToken(): Token
    {
        return new Token(self::$type, self::$payload['exp'], Carbon::now(), self::$jwt);
    }
}