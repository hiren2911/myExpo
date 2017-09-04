<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Assert as PHPUnit;

class RegisterCompanyControllerTest extends TestCase
{
    /**
     * Testing /company/{user} api
     *
     * @return void
     */
    public function testCompanyAPI()
    {
        $response = $this->get('/api/company/1');

        $response->assertStatus(200);
        $company = $response->json();

        PHPUnit::assertNotEmpty($company['id']);
        PHPUnit::assertNotEmpty($company['name']);
        PHPUnit::assertNotEmpty($company['email']);
        PHPUnit::assertNotEmpty($company['mobile']);
        PHPUnit::assertArrayHasKey('logo', $company);
        PHPUnit::assertArrayHasKey('document', $company);
    }


    
}
