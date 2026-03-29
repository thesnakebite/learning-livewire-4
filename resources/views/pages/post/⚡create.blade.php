<?php

use App\Enums\PostStatus;
use App\Models\Post;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::app', ['title' => 'Create post'])] class extends Component {
    public string $title = '';
    public string $content = '';
    public PostStatus $selectedStatus = PostStatus::Draft;

    public function save(): void
    {
        \Illuminate\Support\Sleep::sleep(1);

        $validated = $this->validate([
            'title' => 'required|min:3',
            'content' => 'required',
            'selectedStatus' => ['required', Rule::enum(PostStatus::class)],
        ]);

        Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'status' => $validated['selectedStatus'],
        ]);

        $this->redirect('/post/create');
    }
};
?>

<div class="max-w-lg space-y-6">
    <h1 class="text-xl font-semibold text-zinc-800 dark:text-white">Create post</h1>

    <form wire:submit="save" class="space-y-5">
        <flux:input wire:model="title" label="Title" />

        <flux:textarea wire:model="content" label="Content" />

        <flux:radio.group wire:model="selectedStatus" label="Status" variant="cards" class="max-sm:flex-col">
            @foreach (PostStatus::cases() as $status)
                <flux:radio
                    value="{{ $status->value }}"
                    icon="{{ $status->icon() }}"
                    label="{{ $status->label() }}"
                    description="{{ $status->description() }}"
                />
            @endforeach
        </flux:radio.group>

        <div class="flex justify-end">
            <button
                type="submit"
                class="data-loading:opacity-50 relative inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium text-sm h-10 rounded-lg ps-4 pe-4 bg-zinc-800 text-white border border-black/10 hover:bg-zinc-700 dark:bg-white dark:text-zinc-800 dark:hover:bg-zinc-200 cursor-pointer"
            >
                Create Post
                <flux:icon.loading variant="micro" class="not-in-data-loading:hidden" />
            </button>
        </div>
    </form>
</div>
