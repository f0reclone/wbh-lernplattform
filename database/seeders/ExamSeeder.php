<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{

    public function run(): void

    {
        /**
         * Run the database seeds.
         */
        $user = User::query()->find(2);
        if ($user) {
            Exam::factory()->createMany([
                [
                    'code' => 'BSRAPS',
                    'grade' => 30,
                    'credit_points' => 8,
                    'semester' => 1,
                    'module_id' => 14,
                    'created_at' => '2021-10-23 11:00:00',
                    'updated_at' => '2021-10-23 13:00:00',
                ],
                [
                    'code' => 'B-INF01XX',
                    'grade' => 10,
                    'credit_points' => 2,
                    'semester' => 1,
                    'module_id' => 15,
                    'created_at' => '2021-07-20 13:00:00',
                    'updated_at' => '2021-07-20 13:00:00',
                ],
                [
                    'code' => 'GDIAPS',
                    'grade' => 27,
                    'credit_points' => 6,
                    'semester' => 1,
                    'module_id' => 16,
                    'created_at' => '2021-07-17 09:00:00',
                    'updated_at' => '2021-07-17 11:00:00',
                ],
                [
                    'code' => 'B-GOPB01XX',
                    'grade' => 23,
                    'credit_points' => 6,
                    'semester' => 1,
                    'module_id' => 17,
                    'created_at' => '2021-08-20 13:00:00',
                    'updated_at' => '2021-08-20 13:00:00',
                ],
                [
                    'code' => 'MGIPS',
                    'grade' => 23,
                    'credit_points' => 8,
                    'semester' => 1,
                    'module_id' => 18,
                    'created_at' => '2021-07-17 15:00:00',
                    'updated_at' => '2021-07-17 17:00:00',
                ],
                [
                    'code' => 'B-EIS01XX ',
                    'grade' => 17,
                    'credit_points' => 6,
                    'semester' => 2,
                    'module_id' => 19,
                    'created_at' => '2021-11-20 13:00:00',
                    'updated_at' => '2021-11-20 13:00:00',
                ],
                [
                    'code' => 'B-RBW01XX',
                    'grade' => 10,
                    'credit_points' => 3,
                    'semester' => 2,
                    'module_id' => 20,
                    'created_at' => '2022-02-19 08:00:00',
                    'updated_at' => '2022-02-19 08:00:00',
                ],
                [
                    'code' => 'RBWPS',
                    'grade' => 13,
                    'credit_points' => 5,
                    'semester' => 2,
                    'module_id' => 20,
                    'created_at' => '2022-02-12 08:00:00',
                    'updated_at' => '2022-02-12 10:00:00',
                ],
                [
                    'code' => 'SEIBPS',
                    'grade' => 10,
                    'credit_points' => 8,
                    'semester' => 2,
                    'module_id' => 21,
                    'created_at' => '2022-02-11 14:00:00',
                    'updated_at' => '2022-02-11 16:00:00',
                ],
                [
                    'code' => 'WMAPS',
                    'grade' => 33,
                    'credit_points' => 8,
                    'semester' => 2,
                    'module_id' => 22,
                    'created_at' => '2022-04-09 17:00:00',
                    'updated_at' => '2022-04-09 19:00:00',
                ],
                [
                    'code' => 'ITICPS',
                    'grade' => 27,
                    'credit_points' => 8,
                    'semester' => 3,
                    'module_id' => 23,
                    'created_at' => '2022-10-08 11:00:00',
                    'updated_at' => '2022-10-08 13:00:00',
                ],
                [
                    'code' => 'B-ICM01XX',
                    'grade' => 10,
                    'credit_points' => 3,
                    'semester' => 3,
                    'module_id' => 24,
                    'created_at' => '2023-02-08 11:00:00',
                    'updated_at' => '2023-02-08 11:00:00',
                ],
                [
                    'code' => 'B-PWAA01XX',
                    'grade' => 13,
                    'credit_points' => 6,
                    'semester' => 3,
                    'module_id' => 25,
                    'created_at' => '2022-12-08 11:00:00',
                    'updated_at' => '2023-10-08 19:00:00',
                ],
                [
                    'code' => 'SDAPS',
                    'grade' => 20,
                    'credit_points' => 6,
                    'semester' => 3,
                    'module_id' => 26,
                    'created_at' => '2022-10-08 08:00:00',
                    'updated_at' => '2022-10-08 10:00:00',
                ],
                [
                    'code' => 'BPP',
                    'grade' => 20,
                    'credit_points' => 15,
                    'semester' => 4,
                    'module_id' => 27,
                    'created_at' => '2022-10-08 11:00:00',
                    'updated_at' => '2023-06-09 11:00:00',
                ],
                [
                    'code' => 'DBIAPS',
                    'grade' => 23,
                    'credit_points' => 5,
                    'semester' => 4,
                    'module_id' => 28,
                    'created_at' => '2023-02-08 11:00:00',
                    'updated_at' => '2023-02-08 11:00:00',
                ],
                [
                    'code' => 'B-MUMA01XX',
                    'grade' => 10,
                    'credit_points' => 6,
                    'semester' => 4,
                    'module_id' => 29,
                    'created_at' => '2023-03-10 10:00:00',
                    'updated_at' => '2023-03-10 10:00:00',
                ],
                [
                    'code' => 'SRN1PS',
                    'grade' => 13,
                    'credit_points' => 6,
                    'semester' => 4,
                    'module_id' => 30,
                    'created_at' => '2023-04-01 14:00:00',
                    'updated_at' => '2023-04-01 16:00:00',
                ],
                [
                    'code' => 'B-AKI01XX',
                    'grade' => 10,
                    'credit_points' => 6,
                    'semester' => 5,
                    'module_id' => 32,
                    'created_at' => '2023-06-08 11:00:00',
                    'updated_at' => '2023-06-08 11:00:00',
                ],
                [
                    'code' => 'SRN2PS ',
                    'grade' => 30,
                    'credit_points' => 6,
                    'semester' => 5,
                    'module_id' => 35,
                    'created_at' => '2023-09-16 10:00:00',
                    'updated_at' => '2023-09-16 12:00:00',
                ],
                [
                    'code' => 'VIIDPS',
                    'grade' => 20,
                    'credit_points' => 8,
                    'semester' => 5,
                    'module_id' => 31,
                    'created_at' => '2023-12-09 12:30:00',
                    'updated_at' => '2023-12-09 14:30:00',
                ],
                [
                    'code' => 'WFP1PS',
                    'grade' => 13,
                    'credit_points' => 6,
                    'semester' => 5,
                    'module_id' => 37,
                    'created_at' => '2023-09-16 12:30:00',
                    'updated_at' => '2023-09-19 14:30:00',
                ],
                [
                    'code' => 'B-CSI01XX',
                    'grade' => 10,
                    'credit_points' => 0,
                    'semester' => 6,
                    'module_id' => 39,
                    'created_at' => '2023-11-16 12:00:00',
                    'updated_at' => '2023-11-16 12:00:00',
                ],

            ]);
        } else {
            // Falls der Benutzer nicht gefunden wurde, gibt eine Meldung aus
            echo "Benutzer nicht gefunden. Bitte überprüfen Sie die Benutzer-ID im Seeder.\n";
        }

    }
}


$examValue = ['university_external', 'exam'];
$locationValue = ['online', 'Prüfungsstandort'];
["Mündliche Prüfung Kommunikation und Führung 853323",'Abgabefrist für Projektarbeit', 'Prüfungstermin: KFIA',
    ]

    Abgabetermin: B-RBW01XX',
                    'description' => 'B-Prüfung Recht und Betriebswirtschaftslehre',
