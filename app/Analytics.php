<?php

namespace App;

use App\Models\Post;

class Analytics
{
    protected string $period;

    public static function period(string $period): self
    {
        $instance = new self;
        $instance->period = $period;

        return $instance;
    }

    public function views(): array
    {
        return [
            'total' => 2_707,
            'change' => 12,
        ];
    }

    public function visitors(): array
    {
        return [
            'total' => 1_835,
            'change' => 8,
        ];
    }

    public function avgTime(): array
    {
        return [
            'total' => '4:14',
            'change' => -3,
        ];
    }

    public function topPosts(): array
    {
        return Post::query()
            ->orderBy('views', 'desc')
            ->limit(5)
            ->get()
            ->map(fn ($post) => [
                'title' => $post->title,
                'date' => $post->created_at->format('M d, Y'),
                'views' => $post->views,
            ])
            ->all();
    }

    public function topCountries(): array
    {
        return [
            ['code' => 'US', 'views' => 720],
            ['code' => 'GB', 'views' => 571],
            ['code' => 'CA', 'views' => 392],
            ['code' => 'FR', 'views' => 197],
            ['code' => 'JP', 'views' => 195],
        ];
    }

    public function trafficSources(): array
    {
        return [
            ['name' => 'Google', 'views' => 551],
            ['name' => 'Direct', 'views' => 533],
            ['name' => 'Facebook', 'views' => 530],
            ['name' => 'Reddit', 'views' => 520],
            ['name' => 'Twitter', 'views' => 506],
        ];
    }
}
