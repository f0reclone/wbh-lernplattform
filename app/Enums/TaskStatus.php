<?php

declare(strict_types=1);

namespace App\Enums;

use Kongulov\Traits\InteractWithEnum;

enum TaskStatus: string
{
    use InteractWithEnum;

    case Open = 'open';

    case InProgress = 'in_progress';


    case Done = 'done';

    public function getName(): string
    {
        return trans('tasks.status.' . $this->value);
    }
}
