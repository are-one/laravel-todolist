<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            'user' => 'arwan',
            'todolist' => [
                [
                    "id" => "1",
                    "todo" => "Arwan"
                ],
                [
                    "id" => "2",
                    "todo" => "Prianto"
                ]
            ]
        ])
            ->get('/todolist')
            ->assertSeeText("1")
            ->assertSeeText("Arwan")
            ->assertSeeText("2")
            ->assertSeeText("Prianto");
    }
}
