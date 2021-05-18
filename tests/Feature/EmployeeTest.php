<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\User;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRepository(): void
    {
        $this->actingAs((new User())->first(), 'sanctum');

        $response = $this->get('/api/employees');

        $response->assertStatus(200);

        $responseData = json_decode($response->content(), true);

        $this->assertIsArray($responseData);

        $itemData = $responseData[0];

        $this->assertArrayHasKey('id', $itemData);
        $this->assertIsInt($itemData['id']);
        $this->assertArrayHasKey('surname', $itemData);
        $this->assertIsString($itemData['surname']);
        $this->assertArrayHasKey('name', $itemData);
        $this->assertIsString($itemData['name']);
        $this->assertArrayHasKey('patronymic', $itemData);
        $this->assertIsString($itemData['patronymic']);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMainActions(): void
    {
        $this->actingAs((new User())->first(), 'sanctum');

        $this->get('/api/employees/1000')
            ->assertStatus(404);

        $employeeData = Employee::factory()->create()->toArray();
        unset(
            $employeeData['id'],
            $employeeData['surname'],
            $employeeData['name']
        );

        $this->postJson('/api/employees', $employeeData)
            ->assertStatus(422);

        $employeeData['surname'] = 'Test surname';
        $employeeData['name'] = 'Test name';

        $response = $this->postJson('/api/employees', $employeeData);
        $response->assertStatus(201);

        $responseData = json_decode($response->content(), true);

        $this->assertArrayHasKey('id', $responseData);
        $this->assertIsInt($responseData['id']);

        $employeeId = $responseData['id'];

        $employee = (new Employee())->find($employeeId);

        $this->assertEquals($employee->surname, $employeeData['surname']);
        $this->assertEquals($employee->name, $employeeData['name']);
        $this->assertEquals($employee->patronymic, $employeeData['patronymic']);

        $response = $this->getJson('/api/employees/' . $employeeId);
        $response->assertStatus(200);

        $this->assertJsonStringEqualsJsonString(
            $response->content(),
            json_encode(array_merge(['id' => $employeeId], $employeeData))
        );

        $employeeData['surname'] = 'Test surname 2';
        $employeeData['name'] = 'Test name 2';
        $employeeData['patronymic'] = 'Test patronymic 2';

        $response = $this->putJson('/api/employees/' . $employeeId, $employeeData);
        $response->assertStatus(200);

        $employee = (new Employee())->find($employeeId);

        $this->assertEquals($employee->surname, $employeeData['surname']);
        $this->assertEquals($employee->name, $employeeData['name']);
        $this->assertEquals($employee->patronymic, $employeeData['patronymic']);

        $this->delete('/api/employees/' . $employeeId)
            ->assertStatus(200);

        $this->getJson('/api/employees/' . $employeeId)
            ->assertStatus(404);
    }
}
