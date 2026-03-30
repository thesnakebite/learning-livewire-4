<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'content', 'status', 'views'])]
class Post extends Model
{
    #[\Override]
    protected function casts(): array
    {
        return [
            'status' => PostStatus::class,
        ];
    }
}
