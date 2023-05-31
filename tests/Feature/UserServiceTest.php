<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    public function setUp(): void
    {
        parent::setUp();

        $this->userService = App::make(UserService::class);
    }

    public function testLoginSuccess()
    {
        $this->assertTrue($this->userService->login('arwan', 'arwan123'));
    }

    public function testLoginUserNotFound()
    {
        $this->assertFalse($this->userService->login('Arwan', 'arwan'));
    }

    function testLoginWrongPassword()
    {
        $this->assertFalse($this->userService->login('Arwan', 'salah'));
    }
}
