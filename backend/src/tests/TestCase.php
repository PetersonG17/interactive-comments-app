<?php

namespace Tests;

use PHPUnit\Framework\TestCase as FrameworkTestCase;
use Psr\Container\ContainerInterface;

class TestCase extends FrameworkTestCase
{
    protected ContainerInterface $container;

    public function __construct()
    {
        $this->container = require(__DIR__ . '/../bootstrap/bootstrap.php');
    }
}