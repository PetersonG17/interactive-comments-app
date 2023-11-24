<?php

class RefreshTokenCommand
{
    public function __construct(
        public readonly string $refreshToken
    )
    {
        
    }
}