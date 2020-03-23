<?php
declare(strict_types=1);

namespace Tests\App\TestCases;

use Illuminate\Http\Request;
use Laravel\Lumen\Application;
use Laravel\Lumen\Testing\TestCase as LumenTestCase;

abstract class TestCase extends LumenTestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication(): Application
    {
        /** @noinspection UsingInclusionReturnValueInspection Inherited from Lumen */
        return require __DIR__ . '/../../bootstrap/app.php';
    }

    /**
     * Get Http request filled with given data.
     *
     * @param array|null $data
     *
     * @return \Illuminate\Http\Request
     */
    protected function getRequest(?array $data = null): Request
    {
        return new Request($data ?? []);
    }
}
