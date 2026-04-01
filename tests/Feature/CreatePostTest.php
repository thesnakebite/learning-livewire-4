<?php

use App\Enums\PostStatus;
use App\Models\Post;
use Illuminate\Support\Sleep;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

test('can create a post', function (): void {
    Sleep::fake();

    assertDatabaseMissing(Post::class, [
        'title' => 'Alternative Post',
    ]);

    Livewire::test('pages::post.create')
        ->set('title', 'Alternative Post')
        ->set('content', 'Test content')
        ->set('selectedStatus', PostStatus::Draft)
        ->call('save')
        ->assertRedirect('/post');

    assertDatabaseHas(Post::class, [
        'title' => 'Alternative Post',
        'content' => 'Test content',
    ]);
});
