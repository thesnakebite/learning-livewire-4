<?php

use Livewire\Component;
use App\Models\Post;

new class extends Component
{
    public Post $post;

    public function mount()
    {
        \Illuminate\Support\Sleep::usleep(100 * 1000); // 100ms
    }
};
?>

@placeholder
    <flux:skeleton class="min-h-56 rounded-lg" animate="shimmer" />
@endplaceholder

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
