<?php

use App\Models\Post;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

test('example', function (): void {

    assertDatabaseMissing(Post::class, [
        'title' => 'Alternative Post',
        'content' => 'Test content',
    ]);

    Livewire::visit('pages::post.create')
        ->type('[wire\:model="title"]', 'Alternative Post')
        ->type('[wire\:model="content"]', 'Test content')
        // ->debug()
        ->press('Save post')
        ->assertPathIs('/post/create');

    assertDatabaseHas(Post::class, [
        'title' => 'Alternative Post',
        'content' => 'Test content',
    ]);
});
