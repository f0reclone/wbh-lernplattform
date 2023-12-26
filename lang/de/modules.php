<?php

declare(strict_types=1);

use App\Enums\ModuleStatus;

return [
   'status' => [
       ModuleStatus::Open->value => 'Unbearbeitet',
       ModuleStatus::InProgress->value => 'In Arbeit',
       ModuleStatus::WaitingForResult->value => 'Erledigt (warte auf Ergebnis)',
       ModuleStatus::DoneWithoutGrade->value => 'Erledigt (unbewertet)',
       ModuleStatus::DoneWithGrade->value => 'Erledigt (bewertet)',
   ]
];
