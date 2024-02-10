<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function testListAllTasks()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Task::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->getJson('/api/task');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function testStoreTask()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'title' => 'Test Task',
            'description' => 'This is a test task description',
        ];

        $response = $this->postJson('/api/task', $data);

        $response->assertStatus(201)
            ->assertJson(['message' => 'Task created with successfully']);

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testUpdateTask()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create(['user_id' => $user->id]);

        $data = [
            'title' => 'Updated Task Title',
            'description' => 'This is an updated task description',
        ];

        $response = $this->putJson("/api/task/{$task->id}", $data);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Task updated successfully']);

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testDeleteTask()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson("/api/task/{$task->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Task deleted successfully']);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function testOnlyOwnerCanUpdateTask()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $this->actingAs($user);

        $task = Task::factory()->create(['user_id' => $user->id]);

        $data = [
            'title' => 'Updated Task Title',
            'description' => 'This is an updated task description',
        ];

        $this->actingAs($otherUser);
        $response = $this->putJson("/api/task/{$task->id}", $data);
        $response->assertStatus(403);
    }

    public function testOnlyOwnerCanDeleteTask()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $this->actingAs($user);

        $task = Task::factory()->create(['user_id' => $user->id]);

        $this->actingAs($otherUser);
        $response = $this->deleteJson("/api/task/{$task->id}");
        $response->assertStatus(403);
    }
}
