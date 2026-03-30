<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use App\Models\Post;
use App\Enums\PostStatus;

new #[Title('Posts')] class extends Component {
    public string $sort = 'newest';
    //  public PostStatus $selectedStatus = PostStatus::Draft;

    #[Computed]
    public function posts()
    {
        \Illuminate\Support\Sleep::sleep(1);

        return Post::query()
            ->tap(
                fn($q) => match ($this->sort) {
                    'oldest' => $q->oldest(),
                    'popular' => $q->orderBy('views', 'desc'),
                    default => $q->latest(),
                },
            )
            ->get();
    }

    public function delete(Post $post)
    {
        $post->delete();
    }
};
?>

<div class="max-w-5xl">
    <div class="flex items-center justify-between">
        {{-- Heading --}}
        <div>
            <flux:heading size="xl">Posts</flux:heading>
            <flux:text class="mt-2">Manage your blog posts ans articles</flux:text>
        </div>

        {{-- Filter --}}
        <div class="flex gap-2">
            <div class="max-lg:hidden flex justify-start items-center gap-2">
                <flux:subheading class="whitespace-nowrap">Sort by:</flux:subheading>

                <flux:select size="sm" wire:model.live="sort" data-dim-sorting>
                    <option value="newest">Newset</option>
                    <option value="oldest">Oldest</option>
                    <option value="popular">Most popular</option>
                </flux:select>
            </div>

            <flux:separator vertical class="max-lg:hidden mx-2 my-2" />

            <flux:button variant="primary" icon="plus" size="sm" href="/post/create">New post</flux:button>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-3 gap-6 [*:has([data-dim-sorting][data-loading])_&]:opacity-50">
        @forelse ($this->posts as $post)
            <livewire:card
                :$post
                :wire:key="$post->id"
                :lazy.bundle="$loop->iteration > 6"
                :class="$post->status === PostStatus::Draft ? 'border-dashed border-zinc-300!' : 'border-zinc-400!'"
            />

        @empty
            <div class="col-span-3 text-center py-28">
                <flux:heading>No posts yet</flux:heading>
                <flux:text class="mt-2">Create your first post to get started.</flux:text>
            </div>
        @endforelse
    </div>
</div>

