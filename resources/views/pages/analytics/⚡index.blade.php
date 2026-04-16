<?php

use App\Analytics;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;

new #[Title('Analytics')] class extends Component
{
    public string $period = 'month';

    #[Computed]
    public function views()
    {
        return Analytics::period($this->period)->views();
    }

    #[Computed]
    public function visitors()
    {
        return Analytics::period($this->period)->visitors();
    }

    #[Computed]
    public function avgTime()
    {
        return Analytics::period($this->period)->avgTime();
    }

    #[Computed]
    public function topPosts()
    {
        return Analytics::period($this->period)->topPosts();
    }

    #[Computed]
    public function topCountries()
    {
        return Analytics::period($this->period)->topCountries();
    }

    #[Computed]
    public function trafficSources()
    {
        return Analytics::period($this->period)->trafficSources();
    }
};
?>

<div class="max-w-5xl">
    {{-- Heading + period selector --}}
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">Analytics</flux:heading>
            <flux:text class="mt-2">Track your website traffic and performance</flux:text>
        </div>

        <flux:select size="sm" wire:model.live="period" class="max-w-40">
            <option value="week">Last 7 days</option>
            <option value="month">Last 30 days</option>
            <option value="year">Last year</option>
        </flux:select>
    </div>

    {{-- Stat cards --}}
    <div class="mt-8 grid grid-cols-3 gap-6">
        <x-pages::analytics.metric
            heading="Views"
            :number="$this->views['total']"
            :change="$this->views['change']"
        />

        <x-pages::analytics.metric
            heading="Visitors"
            :number="$this->visitors['total']"
            :change="$this->visitors['change']"
        />

        <x-pages::analytics.metric
            heading="Avg time on post"
            :number="$this->avgTime['total']"
            :change="$this->avgTime['change']"
        />
    </div>

    {{-- Top posts --}}
    <flux:card class="mt-6 p-5">
        <flux:heading size="lg">Top posts</flux:heading>
        <flux:text class="mt-1">The most viewed posts on your website</flux:text>

        <flux:table class="mt-4">
            <flux:table.columns>
                <flux:table.column>Title</flux:table.column>
                <flux:table.column>Date</flux:table.column>
                <flux:table.column align="end">Views</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($this->topPosts as $post)
                    <flux:table.row>
                        <flux:table.cell>{{ $post['title'] }}</flux:table.cell>
                        <flux:table.cell>{{ $post['date'] }}</flux:table.cell>
                        <flux:table.cell align="end">{{ $post['views'] }}</flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </flux:card>

    {{-- Top countries + traffic sources --}}
    <div class="mt-6 grid grid-cols-2 gap-6">
        <flux:card class="p-5">
            <flux:heading size="lg">Top countries</flux:heading>
            <flux:text class="mt-1">The top countries of traffic to your website</flux:text>

            <div class="mt-6 space-y-2">
                @foreach ($this->topCountries as $country)
                    <div class="flex items-center gap-3">
                        <div class="w-8 text-sm font-medium">{{ $country['code'] }}</div>
                        <div class="flex-1 bg-zinc-100 dark:bg-zinc-800 rounded-full h-2">
                            <div
                                class="bg-zinc-800 dark:bg-zinc-200 h-2 rounded-full"
                                style="width: {{ ($country['views'] / 720) * 100 }}%"
                            ></div>
                        </div>
                        <div class="text-sm w-12 text-right">{{ $country['views'] }}</div>
                    </div>
                @endforeach
            </div>
        </flux:card>

        <flux:card class="p-5">
            <flux:heading size="lg">Traffic sources</flux:heading>
            <flux:text class="mt-1">The sources of traffic to your website</flux:text>

            <div class="mt-6 space-y-3">
                @foreach ($this->trafficSources as $source)
                    <div class="flex justify-between text-sm">
                        <flux:text>{{ $source['name'] }}</flux:text>
                        <flux:text>{{ $source['views'] }}</flux:text>
                    </div>
                @endforeach
            </div>
        </flux:card>
    </div>
</div>
