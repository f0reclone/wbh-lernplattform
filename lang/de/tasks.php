<?php

declare(strict_types=1);

use App\Enums\TaskStatus;

return [
    'status' => [
        TaskStatus::Open->value => 'Offen',
        TaskStatus::InProgress->value => 'In Bearbeitung',
        TaskStatus::Done->value => 'Erledigt'
    ]
];
