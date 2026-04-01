<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use App\Models\Post;
use App\Enums\PostStatus;

new #[Title('Posts')] class extends Component {
    public string $sort = 'newest';
    public $selected = [];
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

    public function deleteSelected()
    {
        Post::whereIn('id', $this->selected)->delete();

        $this->selected = [];
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
            @if (count($this->selected) > 0)
                <div class="max-lg:hidden flex justify-start items-center gap-2.5">
                    <flux:subheading class="whitespace-nowrap">
                        <span>{{ count($this->selected) }}</span>
                        selected:
                    </flux:subheading>

                    <flux:button size="sm" variant="danger" icon="trash" wire:click="deleteSelected">Selected</flux:button>
                </div>
            @endif

            <div class="max-lg:hidden flex justify-start items-center gap-2">
                <flux:subheading class="whitespace-nowrap">Sort by:</flux:subheading>

                <flux:select size="sm" wire:model.live="sort" data-dim-sorting>
                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                    <option value="popular">Most popular</option>
                </flux:select>
            </div>

            <flux:separator vertical class="max-lg:hidden mx-2 my-2" />

            <flux:button variant="primary" icon="plus" size="sm" href="/post/create">New post</flux:button>
        </div>
    </div>

    <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-6 [*:has([data-dim-sorting][data-loading])_&]:opacity-50">
        @forelse ($this->posts as $post)
            <livewire:card
                :$post
                :wire:key="$post->id"
                :lazy.bundle="$loop->iteration > 6"
                :class="$post->status === PostStatus::Draft ? 'border-dashed border-zinc-300!' : 'border-zinc-400!'"
            >
                <livewire:slot name="checkbox">
                    <flux:checkbox wire:model.live="selected" :value="$post->id" />
                </livewire:slot>
            </livewire:card>
        @empty
            <div class="col-span-3 text-center py-28">
                <flux:heading>No posts yet</flux:heading>
                <flux:text class="mt-2">Create your first post to get started.</flux:text>
            </div>
        @endforelse
    </div>
</div>

