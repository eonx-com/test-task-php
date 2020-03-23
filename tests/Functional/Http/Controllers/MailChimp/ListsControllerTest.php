<?php
declare(strict_types=1);

namespace Tests\App\Functional\Http\Controllers\MailChimp;

use Tests\App\TestCases\MailChimp\ListTestCase;

class ListsControllerTest extends ListTestCase
{
    /**
     * Test application creates successfully list and returns it back with id from MailChimp.
     *
     * @return void
     */
    public function testCreateListSuccessfully(): void
    {
        $this->post('/mailchimp/lists', static::$listData);

        $content = \json_decode($this->response->getContent(), true);

        $this->assertResponseOk();
        $this->seeJson(static::$listData);
        self::assertArrayHasKey('mail_chimp_id', $content);
        self::assertNotNull($content['mail_chimp_id']);

        $this->createdListIds[] = $content['mail_chimp_id']; // Store MailChimp list id for cleaning purposes
    }

    /**
     * Test application returns error response with errors when list validation fails.
     *
     * @return void
     */
    public function testCreateListValidationFailed(): void
    {
        $this->post('/mailchimp/lists');

        $content = \json_decode($this->response->getContent(), true);

        $this->assertResponseStatus(400);
        self::assertArrayHasKey('message', $content);
        self::assertArrayHasKey('errors', $content);
        self::assertEquals('Invalid data given', $content['message']);

        foreach (\array_keys(static::$listData) as $key) {
            if (\in_array($key, static::$notRequired, true)) {
                continue;
            }

            self::assertArrayHasKey($key, $content['errors']);
        }
    }

    /**
     * Test application returns error response when list not found.
     *
     * @return void
     */
    public function testRemoveListNotFoundException(): void
    {
        $this->delete('/mailchimp/lists/invalid-list-id');

        $this->assertListNotFoundResponse('invalid-list-id');
    }

    /**
     * Test application returns empty successful response when removing existing list.
     *
     * @return void
     */
    public function testRemoveListSuccessfully(): void
    {
        $this->post('/mailchimp/lists', static::$listData);
        $list = \json_decode($this->response->content(), true);

        $this->delete(\sprintf('/mailchimp/lists/%s', $list['list_id']));

        $this->assertResponseOk();
        self::assertEmpty(\json_decode($this->response->content(), true));
    }

    /**
     * Test application returns error response when list not found.
     *
     * @return void
     */
    public function testShowListNotFoundException(): void
    {
        $this->get('/mailchimp/lists/invalid-list-id');

        $this->assertListNotFoundResponse('invalid-list-id');
    }

    /**
     * Test application returns successful response with list data when requesting existing list.
     *
     * @return void
     */
    public function testShowListSuccessfully(): void
    {
        $list = $this->createList(static::$listData);

        $this->get(\sprintf('/mailchimp/lists/%s', $list->getId()));
        $content = \json_decode($this->response->content(), true);

        $this->assertResponseOk();

        foreach (static::$listData as $key => $value) {
            self::assertArrayHasKey($key, $content);
            self::assertEquals($value, $content[$key]);
        }
    }

    /**
     * Test application returns error response when list not found.
     *
     * @return void
     */
    public function testUpdateListNotFoundException(): void
    {
        $this->put('/mailchimp/lists/invalid-list-id');

        $this->assertListNotFoundResponse('invalid-list-id');
    }

    /**
     * Test application returns successfully response when updating existing list with updated values.
     *
     * @return void
     */
    public function testUpdateListSuccessfully(): void
    {
        $this->post('/mailchimp/lists', static::$listData);
        $list = \json_decode($this->response->content(), true);

        if (isset($list['mail_chimp_id'])) {
            $this->createdListIds[] = $list['mail_chimp_id']; // Store MailChimp list id for cleaning purposes
        }

        $this->put(\sprintf('/mailchimp/lists/%s', $list['list_id']), ['permission_reminder' => 'updated']);
        $content = \json_decode($this->response->content(), true);

        $this->assertResponseOk();

        foreach (\array_keys(static::$listData) as $key) {
            self::assertArrayHasKey($key, $content);
            self::assertEquals('updated', $content['permission_reminder']);
        }
    }

    /**
     * Test application returns error response with errors when list validation fails.
     *
     * @return void
     */
    public function testUpdateListValidationFailed(): void
    {
        $list = $this->createList(static::$listData);

        $this->put(\sprintf('/mailchimp/lists/%s', $list->getId()), ['visibility' => 'invalid']);
        $content = \json_decode($this->response->content(), true);

        $this->assertResponseStatus(400);
        self::assertArrayHasKey('message', $content);
        self::assertArrayHasKey('errors', $content);
        self::assertArrayHasKey('visibility', $content['errors']);
        self::assertEquals('Invalid data given', $content['message']);
    }
}
