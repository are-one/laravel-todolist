<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText("Login");
    }

    public function testLoginForMember()
    {
        $this->withSession(['user' => 'arwan'])
            ->get('/login')
            ->assertRedirect("/");
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            'user' => 'arwan',
            'password' => 'arwan123'
        ])->assertRedirect('/')
            ->assertSessionHas('user', 'arwan');
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession(['user' => 'arwan'])
            ->post('/login', ['user' => 'arwan', 'password' => 'arwan123'])
            ->assertRedirect("/");
    }

    public function testLoginValidationError()
    {
        $this->post('/login', [])
            ->assertSeeText('User or password is required');
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            'user' => 'test',
            'password' => 'cek'
        ])
            ->assertSeeText('User or password is wrong');
    }

    public function testLogout()
    {
        $this->withSession(['user' => 'arwan'])
            ->post('/logout')
            ->assertRedirect("/")
            ->assertSessionMissing("user");
    }
}
