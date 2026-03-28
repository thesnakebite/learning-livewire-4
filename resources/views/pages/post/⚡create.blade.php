<?php

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts::app', ['title' => 'Create post'])] class extends Component {
    public string $title = '';
    public string $content = '';

    public function save(): void
    {
        \Illuminate\Support\Sleep::sleep(1);

        Post::create(
            $this->validate([
                'title' => 'required|min:3',
                'content' => 'required',
            ]),
        );

        $this->redirect('/post/create');
    }
};
?>

<div class="max-w-lg space-y-6">
    <h1 class="text-xl font-semibold text-zinc-800 dark:text-white">Create post</h1>

    <form wire:submit="save" class="space-y-5">
        <flux:input wire:model="title" label="Title" />

        <flux:textarea wire:model="content" label="Content" />

        <div class="flex justify-end">
            <button type="submit"
                class="data-loading:opacity-50 realtive inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium text-sm h-10 rounded-lg ps-4 pe-4 bg-zinc-800 text-white border border-black/10 hover:bg-zinc-700 dark:bg-white dark:text-zinc-800 dark:hover:bg-zinc-200 cursor-pointer">
                Create Post

                <flux:icon.loading variant="micro" class="not-in-data-loading:hidden" />
            </button>
        </div>
    </form>
</div>
