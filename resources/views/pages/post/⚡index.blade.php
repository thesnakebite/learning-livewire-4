<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use App\Models\Post;
use App\Enums\PostStatus;

new #[Title('Posts')] class extends Component {
    public string $sort = 'newest';
    public PostStatus $selectedStatus = PostStatus::Draft;

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
                    <option value="oldset">Oldest</option>
                    <option value="popular">Most popular</option>
                </flux:select>
            </div>

            <flux:separator vertical class="max-lg:hidden mx-2 my-2" />

            <flux:button variant="primary" icon="plus" size="sm" href="/post/create">New post</flux:button>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-3 gap-6 [*:has([data-dim-sorting][data-loading])_&]:opacity-50">
        @foreach ($this->posts as $post)
            <flux:card class="flex flex-col justify-between p-4 rounded-lg" variant="filled">
                <div>
                    <flux:heading size="lg">{{ $post->title }}</flux:heading>
                    <flux:text class="mt-1 text-xs text-zinc-500">{{ $post->created_at->format('M d, Y') }}</flux:text>
                    <flux:text class="mt-4 line-clamp-3">{{ $post->content }}</flux:text>
                </div>

                <div class="mt-6 flex justify-between">
                    <div class="flex items-center">
                            <flux:badge
                                rounded
                                size="sm"
                                color="{{ $post->status->color() }}"
                                icon="{{ $post->status->icon() }}"
                            >
                                {{ $post->status->label() }}
                            </flux:badge>
                    </div>
                </div>
            </flux:card>
        @endforeach
    </div>
</div>

