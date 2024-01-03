<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->find(2);
        if ($user) {
            Event::factory()->createMany([
                [
                    'user_id' => $user->id,
                    'key' => 'exam',
                    'title' => 'Prüfungstermin: BSRAPS',
                    'description' => 'Schriftliche Prüfung Betriebssysteme und Rechnerarchitektur',
                    'location' => 'online',
                    'related_id' => 5,
                    'related_type' => 'BSRAPS',
                    'is_editable' => true,
                    'start' => now(),
                    'end' => now(),
                    'is_full_day' => false,
                    'external_id' => null,
                    'created_at' => '2021-10-23 11:00:00',
                    'updated_at' => '2021-10-23 13:00:00',
                ],
                [
                    'user_id' => $user->id,
                    'key' => 'exam',
                    'title' => 'Titel',
                    'description' => 'Beschreibung',
                    'location' => 'online',
                    'related_id' => 15,
                    'related_type' => 'Code',
                    'is_editable' => true,
                    'start' => now(),
                    'end' => now(),
                    'is_full_day' => false,
                    'external_id' => null,
                    'created_at' => '2023-09-19 14:30:00',
                    'updated_at' => '2023-09-19 14:30:00',
                ],
                [
                    'user_id' => $user->id,
                    'key' => 'exam',
                    'title' => 'Titel',
                    'description' => 'Beschreibung',
                    'location' => 'online',
                    'related_id' => 15,
                    'related_type' => 'Code',
                    'is_editable' => true,
                    'start' => now(),
                    'end' => now(),
                    'is_full_day' => false,
                    'external_id' => null,
                    'created_at' => '2023-09-19 14:30:00',
                    'updated_at' => '2023-09-19 14:30:00',
                ],
                [
                    'user_id' => $user->id,
                    'key' => 'exam',
                    'title' => 'Titel',
                    'description' => 'Beschreibung',
                    'location' => 'online',
                    'related_id' => 15,
                    'related_type' => 'Code',
                    'is_editable' => true,
                    'start' => now(),
                    'end' => now(),
                    'is_full_day' => false,
                    'external_id' => null,
                    'created_at' => '2023-09-19 14:30:00',
                    'updated_at' => '2023-09-19 14:30:00',
                ],
            ]);
        } else {
            // Falls der Benutzer nicht gefunden wurde, gibt eine Meldung aus
            echo "Benutzer nicht gefunden. Bitte überprüfen Sie die Benutzer-ID im Seeder.\n";
        }
    }
}
