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
        <flux:input wire:model="title" label="Title" />

        <flux:textarea wire:model="content" label="Content" />

        <div class="flex justify-end">
            <flux:button type="submit" variant="primary" icon="paper-airplane" size="sm">Save post</flux:button>
        </div>
    </form>
</div>
