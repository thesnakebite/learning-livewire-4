<?php

use Livewire\Component;

new class extends Component
{
    public $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }
};
?>

<div class="flex flex-col items-center gap-4">
    <h1 class="text-4xl font-bold mb-8 dark:text-zinc-300">
        Welcome from Livewire <span class="text-amber-400">4</span> ⚡️
    </h1>
    <h3 class="text-xl font-light text-zinc-400">Counter</h3>
    <p class="text-4xl font-bold mb-4 text-amber-400">
        {{ $count }}
    </p>

    <div class="flex gap-4">
        <button wire:click="increment" class="bg-blue-500 text-white px-4 py-2 rounded-md">Increment</button>
        <button wire:click="decrement" class="bg-red-500 text-white px-4 py-2 rounded-md">Decrement</button>
    </div>
</div>

{{-- <script>
    alert('Hello Caleb Porzio')
</script> --}}
