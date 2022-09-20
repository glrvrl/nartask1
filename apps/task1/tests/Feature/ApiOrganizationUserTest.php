<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiOrganizationUserTest extends TestCase
{
    /**
     * rest api organization-user list test
     *
     * @return void
     */
    public function testOrganizationUserIndex()
    {
        $this->json('GET', 'api/organization-user')
             ->assertStatus(200)
             ->assertJsonStructure([
                 "organizationsUser" => [
                     [
                         "name",
                         "email",
                         "updated_at",
                         "created_at",
                         "id",
                         "uuid",
                     ],
                 ],
             ]);
    }

    /**
     * rest api organization-user show test
     *
     * @return void
     */
    public function testOrganizationUserShow()
    {

        $this->json('GET', 'api/organization-user/' . rand(1, 50))->assertStatus(200)->assertJsonStructure([
            "organizationUser" => [
                "name",
                "email",
                "updated_at",
                "created_at",
                "id",
                "uuid",
            ],
        ]);
    }

    /**
     * rest api organization-user store test
     *
     * @return void
     */
    public function testOrganizationUserStore()
    {
        $organizationUser = [
            'name'                  => 'testclass',
            'email'                 => 'testuser@email.com',
            'password'              => '123456',
            'password_confirmation' => '123456',
        ];
        $this->json('POST', 'api/organization-user', $organizationUser)->assertStatus(201)->assertJsonStructure([
            "organizationUser" => [
                "name",
                "email",
                "updated_at",
                "created_at",
                "id",
                "uuid",
            ],
        ]);
    }

    /**
     * rest api organization-user update test
     *
     * @return void
     */
    public function testOrganizationUserUpdate()
    {
        $organizationUser = [
            'name'                  => 'testclass-update',
            'email'                 => 'test-update@email.com',
            'password'              => '654321',
            'password_confirmation' => '654321',
        ];
        $this->json('PATCH', 'api/organization-user/' . rand(1, 50),
            $organizationUser)->assertStatus(200)->assertJsonStructure([
            "organizationUser" => [
                "name",
                "email",
                "updated_at",
                "created_at",
                "id",
                "uuid",
            ],
        ]);
    }

    /**
     * rest api organization-user delete test
     *
     * @return void
     */
    public function testOrganizationUserDelete()
    {

        $this->json('DELETE', 'api/organization-user/' . rand(1, 50))->assertStatus(200);
    }
}
