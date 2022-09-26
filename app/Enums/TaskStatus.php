<?php

namespace App\Enums;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case BUSY = 'busy';
    case DONE = 'done';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => __('Pending'),
            self::BUSY => __('Busy'),
            self::DONE => __('Done'),
        };
    }

    public function isDone(): bool
    {
        return $this === self::DONE;
    }
}
