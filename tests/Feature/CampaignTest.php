<?php

use App\Models\{ User, Campaign };
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

uses(RefreshDatabase::class);

it('can create a campaign', function () {
    logInUser($this);
    Storage::fake('local');
    // Mock the file upload
    $file = UploadedFile::fake()->create('test.csv', 100);
    // Send a POST request to create a campaign
    // Manually add the CSRF token to the request
    $response = $this->postJson('/campaigns', [
        '_token' => csrf_token(), // Add the CSRF token here
        'name' => 'Test Campaign',
        'csv_file' => $file,
    ]);
    
    // Assert the response is successful
    $response->assertStatus(302);

    // Assert the campaign is created
    $this->assertDatabaseHas('campaigns', [
        'name' => 'Test Campaign',
    ]);

    // Assert the file is stored
    Storage::disk('local')->assertExists('/campaigns/' . $file->hashName());
});

it('validates the campaign creation input', function () {
    logInUser($this);
    // Test with missing name and file
    $response = $this->postJson('/campaigns', [
        '_token' => csrf_token(), // Add the CSRF token here
    ]);

    // Assert validation errors
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['name', 'csv_file']);
});


function logInUser($instance) {
    $user = User::factory()->create();
    // Act as the created user
    $instance->actingAs($user);

    // Start a session to generate a CSRF token
    Session::start();
    return $user;
}