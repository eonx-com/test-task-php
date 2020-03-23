<?php
declare(strict_types=1);

namespace Tests\App;

use Tests\App\TestCases\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample(): void
    {
        $this->get('/');

        self::assertEquals($this->app->version(), $this->response->getContent());
    }
}
