<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiOrganizationTest extends TestCase
{

    /**
     * rest api organization list test
     *
     * @return void
     */
    public function testOrganizationIndex()
    {
        $this->json('GET', 'api/organization')->assertStatus(200)->assertJsonStructure([
            "organizations" => [
                [
                    "name",
                    "email",
                    "phone",
                    "address",
                    "updated_at",
                    "created_at",
                    "id",
                    "uuid",
                ],
            ],
        ]);
    }

    /**
     * rest api organization show test
     *
     * @return void
     */
    public function testOrganizationShow()
    {
        $this->json('GET', 'api/organization/' . rand(1, 50))->assertStatus(200)->assertJsonStructure([
            "organization" => [
                "name",
                "email",
                "phone",
                "address",
                "updated_at",
                "created_at",
                "id",
                "uuid",
            ],
        ]);
    }

    /**
     * rest api organization store test
     *
     * @return void
     */
    public function testOrganizationStore()
    {
        $organization = [
            'name'    => 'testclass-store',
            'email'   => 'testclass-store@email.com',
            'phone'   => '+90-51234567',
            'address' => 'adres',
        ];
        $this->json('POST', 'api/organization', $organization)->assertStatus(201)->assertJsonStructure([
            "organization" => [
                "name",
                "email",
                "phone",
                "address",
                "updated_at",
                "created_at",
                "id",
                "uuid",
            ],
        ]);
    }

    /**
     * rest api organization update test
     *
     * @return void
     */
    public function testOrganizationUpdate()
    {
        $organization = [
            'name'    => 'testclass-update',
            'email'   => 'testclass-update@email.com',
            'phone'   => '+90-51234update',
            'address' => 'adres-update',
        ];
        $this->json('PATCH', 'api/organization/' . rand(1, 50), $organization)->assertStatus(200)->assertJsonStructure([
            "organization" => [
                "name",
                "email",
                "phone",
                "address",
                "updated_at",
                "created_at",
                "id",
                "uuid",
            ],
        ]);
    }

    /**
     * rest api organization delete test
     *
     * @return void
     */
    public function testOrganizationDelete()
    {

        $this->json('DELETE', 'api/organization/' . rand(1, 50))->assertStatus(200);
    }
}
