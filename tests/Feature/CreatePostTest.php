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

    Livewire::test('pages::post.create')
        ->set('title', 'Alternative Post')
        ->set('content', 'Test content')
        ->call('save')
        ->assertRedirect('/post/create');

    assertDatabaseHas(Post::class, [
        'title' => 'Alternative Post',
        'content' => 'Test content',
    ]);
});
