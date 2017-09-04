<?php
namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Assert as PHPUnit;

class EventControllerTest extends TestCase
{
    /**
     * Test for /events api
     *
     * @return void
     */
    public function testEventsAPI()
    {
        $response = $this->get('/api/events');

        $response->assertStatus(200);
        $data = $response->json();
        foreach ($data as $event) {
            // each event should have mandatory properties
            PHPUnit::assertNotEmpty($event['id']);
            PHPUnit::assertNotEmpty($event['title']);
            PHPUnit::assertNotEmpty($event['lat']);
            PHPUnit::assertNotEmpty($event['lng']);
            PHPUnit::assertNotEmpty($event['startDate']);
            PHPUnit::assertNotEmpty($event['endDate']);
        }
    }

    /**
     * Test for /event/{id} api
     *
     * @return void
     */
    public function testEventsDetailAPI()
    {
        $response = $this->get('/api/event/1');

        $response->assertStatus(200);

        $event = $response->json();
        // each event should have mandatory properties
        PHPUnit::assertNotEmpty($event['id']);
        PHPUnit::assertNotEmpty($event['title']);
        PHPUnit::assertNotEmpty($event['lat']);
        PHPUnit::assertNotEmpty($event['lng']);
        PHPUnit::assertNotEmpty($event['startDate']);
        PHPUnit::assertNotEmpty($event['endDate']);
        // each event should also fetch stands associated with it
        PHPUnit::assertArrayHasKey('stands', $event);

    }
}
