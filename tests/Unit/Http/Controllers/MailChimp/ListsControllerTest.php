<?php
declare(strict_types=1);

namespace Tests\App\Unit\Http\Controllers\MailChimp;

use App\Http\Controllers\MailChimp\ListsController;
use Tests\App\TestCases\MailChimp\ListTestCase;

class ListsControllerTest extends ListTestCase
{
    /**
     * Test controller returns error response when exception is thrown during create MailChimp request.
     *
     * @return void
     */
    public function testCreateListMailChimpException(): void
    {
        /** @noinspection PhpParamsInspection Mock given on purpose */
        $controller = new ListsController($this->entityManager, $this->mockMailChimpForException('post'));

        $this->assertMailChimpExceptionResponse($controller->create($this->getRequest(static::$listData)));
    }

    /**
     * Test controller returns error response when exception is thrown during remove MailChimp request.
     *
     * @return void
     */
    public function testRemoveListMailChimpException(): void
    {
        /** @noinspection PhpParamsInspection Mock given on purpose */
        $controller = new ListsController($this->entityManager, $this->mockMailChimpForException('delete'));
        $list = $this->createList(static::$listData);

        // If there is no list id, skip
        if (null === $list->getId()) {
            self::markTestSkipped('Unable to remove, no id provided for list');

            return;
        }

        $this->assertMailChimpExceptionResponse($controller->remove($list->getId()));
    }

    /**
     * Test controller returns error response when exception is thrown during update MailChimp request.
     *
     * @return void
     */
    public function testUpdateListMailChimpException(): void
    {
        /** @noinspection PhpParamsInspection Mock given on purpose */
        $controller = new ListsController($this->entityManager, $this->mockMailChimpForException('patch'));
        $list = $this->createList(static::$listData);

        // If there is no list id, skip
        if (null === $list->getId()) {
            self::markTestSkipped('Unable to update, no id provided for list');

            return;
        }

        $this->assertMailChimpExceptionResponse($controller->update($this->getRequest(), $list->getId()));
    }
}
