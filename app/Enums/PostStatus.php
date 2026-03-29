<?php

namespace App\Enums;

enum PostStatus: string
{
    case Draft = 'draft';
    case Published = 'published';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Published => 'Published',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Draft => 'gray',
            self::Published => 'green',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Draft => 'pencil-square',
            self::Published => 'check-circle',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Draft => 'Post will be saved as draft',
            self::Published => 'Post will be published immediately',
        };
    }
}
