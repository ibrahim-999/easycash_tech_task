<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Laravel\Lumen\Testing\TestCase;

class TransactionTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function testTransaction()
    {
        $response = $this->json('GET', '/api/v1/transactaions');
        $response->assertResponseStatus(200);
        $response->seeJson(['message' => 'Success!']);
    }

    public function testExample()
    {
        $this->assertTrue(true);
    }
    public function createApplication()
    {
        return require __DIR__ . '/../bootstrap/app.php';
    }
}
