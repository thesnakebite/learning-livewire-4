<?php

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts::app', ['title' => 'Create post'])] class extends Component
{
    public string $title = '';
    public string $content = '';

    public function save(): void
    {
        Post::create($this->validate([
            'title' => 'required|min:3',
            'content' => 'required',
        ]));

        $this->redirect('/post/create');
    }
};
?>

<div class="max-w-lg space-y-6">
    <h1 class="text-xl font-semibold text-zinc-800 dark:text-white">Create post</h1>

    <form wire:submit="save" class="space-y-5">
        <div class="space-y-1">
            <label class="block space-y-2" for="title">
                <p class="inline-flex items-center text-sm font-medium [:where(&)]:text-zinc-800 [:where(&)]:dark:text-white">
                    Title
                </p>
            </label>
            <input
                wire:model="title"
                type="text"
                id="title"
                class="block w-full rounded border border-zinc-300 bg-white px-3 py-2 text-sm text-zinc-800 shadow-xs appearance-none
                       focus:border-zinc-400 focus:ring-2 focus:ring-zinc-200 focus:outline-none
                       disabled:shadow-none
                       dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:placeholder-zinc-400 dark:shadow-none
                       dark:focus:border-zinc-500 dark:focus:ring-zinc-500/30"
            />
            @error('title')
                <div class="text-xs font-medium text-red-500 dark:text-red-400">{{ $message }}</div>
            @enderror
        </div>

        <div class="space-y-1">
            <label class="block space-y-2" for="content">
                <p class="inline-flex items-center text-sm font-medium [:where(&)]:text-zinc-800 [:where(&)]:dark:text-white">
                    Content
                </p>
            </label>
            <textarea
                wire:model="content"
                id="content"
                rows="5"
                class="block w-full rounded border border-zinc-300 bg-white px-3 py-2 text-sm text-zinc-800 shadow-xs appearance-none
                       focus:border-zinc-400 focus:ring-2 focus:ring-zinc-200 focus:outline-none
                       disabled:shadow-none
                       dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:placeholder-zinc-400 dark:shadow-none
                       dark:focus:border-zinc-500 dark:focus:ring-zinc-500/30"
            ></textarea>
            @error('content')
                <div class="text-xs font-medium text-red-500 dark:text-red-400">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex justify-end">
            <button
                type="submit"
                class="rounded bg-zinc-800 px-4 py-2 text-sm font-medium text-white hover:bg-zinc-700
                       focus:ring-2 focus:ring-zinc-400 focus:outline-none
                       dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-100"
            >
                Save post
            </button>
        </div>
    </form>
</div>
