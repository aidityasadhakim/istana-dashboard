<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class FooBarServiceProviderTest extends TestCase
{
    public function testServiceProvider()
    {
        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        assertEquals($foo, $bar->foo);
    }
}
