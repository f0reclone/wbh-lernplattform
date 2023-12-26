<?php

declare(strict_types=1);

namespace App\Enums;

use Kongulov\Traits\InteractWithEnum;

enum ModuleStatus: string
{
    use InteractWithEnum;

    case Open = 'open';

    case InProgress = 'in_progress';

    case WaitingForResult = 'waiting_for_result';

    case DoneWithGrade = 'done_with_grade';

    case DoneWithoutGrade = 'done_without_grade';

    public function getName() {
        return trans('modules.status.' . $this->value);
    }
}
