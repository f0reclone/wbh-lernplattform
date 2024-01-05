<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Exam;
use App\Models\Module;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class ItSicherheitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->where('email', '=', 'florian.hellmann@student.wb-hochschule.com')->first();


        if ($user === null) {
            // Falls der Benutzer nicht gefunden wurde, gibt eine Meldung aus
            echo "Benutzer nicht gefunden. Bitte überprüfen Sie die Benutzer-ID im Seeder.\n";
            return;
        }

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Betriebssysteme und Rechnerarchitektur',
                    'user_id' => $user->id,
                    'description' =>
                        'Grundlagen der Betriebssysteme: Architektur, Prozesse und Threads, Koordinierung paralleler Prozesse, Ressourcen (Betriebsmittel), Speicherverwaltung, Ein-/Ausgabesystem, Dateiverwaltung, Probleme des praktischen Einsatzes von Betriebssystemen Kennenlernen gängiger Betriebssysteme: Einführung in UNIX, Dateisystem, Editor, Prozesssystem, Shell, Textfilter, vernetzte UNIX-Systeme, Schnittstellen, Grafische Benutzeroberfläche, Tools Grundlagen der Rechnerarchitekturen: Von-NeumannKonzept, Architektur eines Prozessors,  aschinenorientierte Programmierung, Arbeitsspeicher, Rechnerarten, Einsatzbereiche, Embedded Systems',
                    'status' => 'done_with_grade',
                    'start_semester' => 1,
                    'end_semester' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

        Task::factory()->createMany([
            [
                'title' => 'BSI01a - UNIX Eine Einführung',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'module_id' => $module->id,
                'status' => 'done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'BSI02a - Nutzung des Betriebssystems UNIX',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'module_id' => $module->id,
                'status' => 'done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'BSI03 - Rechnerarchitekturen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'module_id' => $module->id,
                'status' => 'done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'BSI04 - Betriebssysteme',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'module_id' => $module->id,
                'status' => 'done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'BSI05 - Betriebssysteme II',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'module_id' => $module->id,
                'status' => 'done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'BSI06 - Rechnerarchitektur II',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'module_id' => $module->id,
                'status' => 'done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'BSRAPS - Vorbereitung',
                'user_id' => $user->id,
                'description' => 'Studienhefte überfliegen,
                     Zusammenfassungen durcharbeiten,
                     Lernzettel/ Karteikarten schreiben,
                     Übungsklausuren durcharbeiten',
                'module_id' => $module->id,
                'status' => 'done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'BSRAPS',
                'grade' => 30,
                'credit_points' => 8,
                'semester' => 1,
                'module_id' => $module->id,
                'created_at' => '2021-10-23 11:00:00',
                'updated_at' => '2021-10-23 13:00:00',
            ]
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Prüfungstermin: BSRAPS',
                'description' => 'Schriftliche Prüfung Betriebssysteme und Rechnerarchitektur',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2021-10-23 11:00:00',
                'end' => '2021-10-23 13:00:00',
                'is_full_day' => false,
                'external_id' => null,
                'created_at' => '2021-10-23 11:00:00',
                'updated_at' => '2021-10-23 13:00:00',
            ]
        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Einführungsprojekt für Informatiker',
                    'user_id' => $user->id,
                    'description' =>
                        'Das Einführungsprojekt absolvieren Sie im Rahmen der Einführungsveranstaltung. Sie lernen anhand eines Mini-Projektes Ziel und Wesen interdisziplinärer Informatikprojekte kennen. Dazu erarbeiten Sie in kleinen Gruppen unter laufender Anleitung des Dozenten eine kleine, nichttriviale Entwicklungsaufgabe, die Kenntnisse und Ideen aus den beteiligten Disziplinen erfordert. Das Einführungsprojekt fördert fachübergreifendes Denken und Abstraktionsvermögen und motiviert die Auseinandersetzung mit mathematischen bzw. logischen Grundlagen der Informatikfächer sowie das Arbeiten im Team.',
                    'status' => 'done_with_grade',
                    'start_semester' => 1,
                    'end_semester' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

        Task::factory()->createMany([
            [
                'title' => 'Einf - Einführungsveranstaltung',
                'user_id' => $user->id,
                'description' => 'Anmelden zur Veranstaltung,
                    Veranstaltung durchführen',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'INF-L - Einführungsprojekt für Informatiker',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'INFPL - Einführungsprojekt für Informatiker',
                'user_id' => $user->id,
                'description' => 'An Veranstaltung teilnehmen',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'B-INF01XX - Einführungsprojekt für Informatiker',
                'user_id' => $user->id,
                'description' => 'Studienhefte durchgehen,
                    B-Prüfung bearbeiten,',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'B-INF01XX',
                'grade' => 10,
                'credit_points' => 2,
                'semester' => 1,
                'module_id' => $module->id,
                'created_at' => '2021-07-20 13:00:00',
                'updated_at' => '2021-07-20 13:00:00',
            ],

        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: B-INF01XX',
                'description' => 'B-Prüfung Einführungsprojekt für Informatiker',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2021-07-20 13:00:00',
                'end' => '2021-07-20 13:00:00',
                'is_full_day' => true,
                'external_id' => null,
                'created_at' => '2021-07-20 13:00:00',
                'updated_at' => '2021-07-20 13:00:00',
            ],
        );


        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Grundlagen der Informatik',
                    'user_id' => $user->id,
                    'description' =>
                        'Elementare Grundlagen der Rechnerarchitektur, Verarbeitung und Speicherung von Daten, Darstellung von Zahlen und Zeichen im Rechner Datentypen, Datenstrukturen, Algorithmen: Datentypen, Datenstrukturen (insbesondere Bäume und Graphen) und ihre Klassifikationen, Algorithmen (insbesondere Hashverfahren, Sortier- und Suchverfahren), Analyse von Algorithmen Formale Sprachen und abstrakte Automaten: Formale Grammatik,Compiler und Interpreter, Reguläre Sprachen, Kellerautomaten und kontextfreie Sprachen, Turing-Maschine',
                    'status' => 'done_with_grade',
                    'start_semester' => 1,
                    'end_semester' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'GDI01 - Einführung in die Informatik',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'TGI01 - Datenstrukturen und Algorithmen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'TGI02 - Algorithmen und Komplexität',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'GDIAPS - Vorbereitung',
                'user_id' => $user->id,
                'description' => 'Studienhefte überfliegen,
                     Zusammenfassungen durcharbeiten,
                     Lernzettel/ Karteikarten schreiben,
                     Übungsklausuren durcharbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'GDIAPS',
                'grade' => 27,
                'credit_points' => 6,
                'semester' => 1,
                'module_id' => $module->id,
                'created_at' => '2021-07-17 09:00:00',
                'updated_at' => '2021-07-17 11:00:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Prüfungstermin: GDIAPS',
                'description' => 'Schriftliche Prüfung Grundlagen der Informatik',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2021-07-17 09:00:00',
                'end' => '2021-07-17 11:00:00',
                'is_full_day' => false,
                'external_id' => null,
                'created_at' => '2021-07-17 09:00:00',
                'updated_at' => '2021-07-17 09:00:00',
            ],
        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Grundlagen der objektorientierten Programmierung',
                    'user_id' => $user->id,
                    'description' =>
                        'Einführung in die objektorientierte Programmierung, Datentypen, Ein- und Ausgabe, Ausdrücke und Operatoren, Steuerstrukturen, Verweistypen, Arrays, Definition von Klassen und Methoden, Vererbung, Schnittstellen, Strukturen, Aufzählungen, Überladung von Operatoren, Exceptions, Multithread Programmierung, Assemblies, Grafikdarstellung.',
                    'status' => 'done_with_grade',
                    'start_semester' => 1,
                    'end_semester' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([

            [
                'title' => 'PYTHBU - Theis: Einstieg in Python',
                'user_id' => $user->id,
                'description' => 'Buch durcharbeiten bzw. teilweise durcharbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'PYTH00 - Begleitheft zu PYTHBU',
                'user_id' => $user->id,
                'description' => 'A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'JAPR01 - Programmieren mit Java I',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'JAPR02 - Programmieren mit Java II',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'B-GOPB01XX - Grundlagen der objektorientierten Programmierung',
                'user_id' => $user->id,
                'description' => 'Studienhefte durchgehen,
                    B-Prüfung bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'B-GOPB01XX',
                'grade' => 23,
                'credit_points' => 6,
                'semester' => 1,
                'module_id' => $module->id,
                'created_at' => '2021-08-20 13:00:00',
                'updated_at' => '2021-08-20 13:00:00',
            ],

        );
        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: B-GOPB01XX',
                'description' => 'B-Prüfung Grundlagen der objektorientierten Programmierung',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2021-08-20 13:00:00',
                'end' => '2021-08-20 13:00:00',
                'is_full_day' => true,
                'external_id' => null,
                'created_at' => '2021-08-20 13:00:00',
                'updated_at' => '2021-08-20 13:00:00',
            ],
        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Mathematische Grundlagen für Informatiker',
                    'user_id' => $user->id,
                    'description' =>
                        'Mengen, Zahlenmengen, Vollständige Induktion, Komplexe Zahlen, Relationen, Zins- und Rentenrechnung Logik: Aussagen- und Prädikatenlogik Lineare Algebra: Matrizen, Invertierung, Gauß-Algorithmus, Determinanten, Lineare Gleichungssysteme Funktionenlehre: Folgen und Funktionen, Stetigkeit und Differenzierbarkeit, Ableitungsregeln, Anwendungen der Differenzialrechnung, Integralrechnung mit Anwendungen Stochastik: Zufällige Ereignisse und ihre Wahrscheinlichkeit, Bedingte Wahrscheinlichkeit und Unabhängigkeit zufälliger Ereignisse, Zufallsgrößen, Verteilungsfunktionen ',
                    'status' => 'done_with_grade',
                    'start_semester' => 1,
                    'end_semester' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'MAI01A - Grundlagen der Mathematik Teil 1a: Mengen, Zahlenmengen, Vollständige Induktion',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'MAI01C - Grundlagen der Mathematik Teil 1C: Komplexe Zahlen, Relationen, Finanzmathematik.',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'MAI17 - Lineare Algebra: Lineare Gleichungssysteme und Matrizen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'MAI03 - Grundlagen der Logik',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'MAI24 - Funktionenlehre',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'MAI10 - Stochastik I',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'MGIPS - Vorbereitung',
                'user_id' => $user->id,
                'description' => 'Studienhefte überfliegen,
                     Zusammenfassungen durcharbeiten,
                     Lernzettel/ Karteikarten schreiben,
                     Übungsklausuren durcharbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'MGIPS',
                'grade' => 23,
                'credit_points' => 8,
                'semester' => 1,
                'module_id' => $module->id,
                'created_at' => '2021-07-17 15:00:00',
                'updated_at' => '2021-07-17 17:00:00',
            ],

        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Prüfungstermin: MGIPS',
                'description' => 'Schriftliche Prüfung Mathematische Grundlagen für Informatiker',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2021-07-17 15:00:00',
                'end' => '2021-07-17 17:00:00',
                'is_full_day' => false,
                'external_id' => null,
                'created_at' => '2021-07-17 15:00:00',
                'updated_at' => '2021-07-17 15:00:00',
            ],
        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Einführung in die IT-Sicherheit',
                    'user_id' => $user->id,
                    'description' =>
                        'Begriffe der Informations- und IT-Sicherheit Bedrohungen und Schwachstellen Schutzziele IT-Sicherheit in Organisationen IT-Sicherheit aus wirtschaftlicher und gesellschaftlicher Sicht Angreifer und Angriffsszenarien Gefahren bei der Nutzung des Internets (Surfen, E-Mail, soziale Netzwerke, Banking) Werkzeuge für Angriff und Verteidigung Gefahren durch Malware und entsprechende Schutzmaßnahmen Faktor Mensch in der IT-Sicherheit (Social Engineering, Security Awareness)',
                    'status' => 'done_with_grade',
                    'start_semester' => 2,
                    'end_semester' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([

            [
                'title' => 'EIS01 - Grundlagen der Informations- und IT-Sicherheit',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'EIS02 - Angriffe und Bedrohungen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'EIS03 - Malware',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'EIS04 - Der Faktor Mensch in der Informationssicherheit',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'B-EIS01XX - Einführung in die IT-Sicherheit',
                'user_id' => $user->id,
                'description' => 'Studienhefte durchgehen,
                    B-Prüfung bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'B-EIS01XX ',
                'grade' => 17,
                'credit_points' => 6,
                'semester' => 2,
                'module_id' => $module->id,
                'created_at' => '2021-11-20 13:00:00',
                'updated_at' => '2021-11-20 13:00:00',
            ],

        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: B-EIS01XX ',
                'description' => 'B-Prüfung Einführung in die IT-Sicherheit',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2021-11-20 13:00:00',
                'end' => '2021-11-20 13:00:00',
                'is_full_day' => true,
                'external_id' => null,
                'created_at' => '2021-11-20 13:00:00',
                'updated_at' => '2021-11-20 13:00:00',
            ],
        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Recht und Betriebswirtschaftslehre',
                    'user_id' => $user->id,
                    'description' =>
                        'Grundlagen des Zivilrechts Rechtsgeschäfte, Vertragsrecht, Haftungsrecht, Zivilprozessrecht Grundlagen des Arbeitsrechts Rechtsquellen, Entstehung und Beendigung eines Arbeitsvertrages Grundlagen des Medienrechts Telemediarecht und Dienstegesetzgebung, Urheberrecht Markenschutz, Datenschutz, Internet und Werbung, Recht des elektronischen Geschäftsverkehrs',
                    'status' => 'done_with_grade',
                    'start_semester' => 2,
                    'end_semester' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'RLB01 - Grundlagen des Zivilrechts',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'BWI01 - Betriebswirtschaftliche Grundlagen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'RLB02 - Grundlagen des Arbeitsrechts',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'BWI02 - Organisatorische Strukturen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'MMG03B - Recht in der Medienwirtschaft',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'BWI03 - Unternehmensführung',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'BWI04 - Material- und Produktionswirtschaft',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'BWI05 - Absatz und Marketing',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'B-RBW01XX - Recht',
                'user_id' => $user->id,
                'description' => 'Studienhefte durchgehen,
                    B-Prüfung bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'RBWPS - Vorbereitung',
                'user_id' => $user->id,
                'description' => 'Studienhefte überfliegen,
                     Zusammenfassungen durcharbeiten,
                     Lernzettel/ Karteikarten schreiben,
                     Übungsklausuren durcharbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'B-RBW01XX',
                'grade' => 10,
                'credit_points' => 3,
                'semester' => 2,
                'module_id' => $module->id,
                'created_at' => '2022-02-19 08:00:00',
                'updated_at' => '2022-02-19 08:00:00',
            ],


        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: B-RBW01XX',
                'description' => 'B-Prüfung Recht und Betriebswirtschaftslehre',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2022-02-19 08:00:00',
                'end' => '2022-02-19 08:00:00',
                'is_full_day' => true,
                'external_id' => null,
                'created_at' => '2022-02-19 08:00:00',
                'updated_at' => '2022-02-19 08:00:00',
            ],
        );

        $exam = Exam::factory()->createOne(
            [
                'code' => 'RBWPS',
                'grade' => 13,
                'credit_points' => 5,
                'semester' => 2,
                'module_id' => $module->id,
                'created_at' => '2022-02-12 08:00:00',
                'updated_at' => '2022-02-12 10:00:00',
            ],

        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Prüfungstermin: RBWPS',
                'description' => 'Schriftliche Prüfung Recht und Betriebswirtschaftslehre',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2022-02-12 08:00:00',
                'end' => '2022-02-12 10:00:00',
                'is_full_day' => false,
                'external_id' => null,
                'created_at' => '2022-02-12 08:00:00',
                'updated_at' => '2022-02-12 08:00:00',
            ],
        );


        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Software Engineering',
                    'user_id' => $user->id,
                    'description' =>
                        'Einführung in die Informatik: Elementare Grundlagen der Rechnerarchitektur, Verarbeitung und Speicherung von Daten, Darstellung von Zahlen und Zeichen im Rechner Datentypen, Datenstrukturen, Algorithmen: Datentypen, Datenstrukturen (insbesondere Bäume und Graphen) und ihre Klassifikationen, Algorithmen (insbesondere Hashverfahren, Sortier- und Suchverfahren), Analyse von Algorithmen Formale Sprachen und abstrakte Automaten: Formale Grammatik, Compiler und Interpreter, Reguläre Sprachen, Kellerautomaten und kontextfreie Sprachen, Turing-Maschine ',
                    'status' => 'done_with_grade',
                    'start_semester' => 2,
                    'end_semester' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'SEI11 - Phasenmodelle und Planung von Softwareprojekten',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SEI12 - Unified Modeling Language',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SEI13 - Entwurfsmuster',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SEI04 - Objektorientierte Systementwicklung',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SEI14 - Grundlagen der Softwarearchitektur',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SEIBPS - Software Engineering',
                'user_id' => $user->id,
                'description' => 'Studienhefte überfliegen,
                     Zusammenfassungen durcharbeiten,
                     Lernzettel/ Karteikarten schreiben,
                     Übungsklausuren durcharbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'SEIBPS',
                'grade' => 10,
                'credit_points' => 8,
                'semester' => 2,
                'module_id' => $module->id,
                'created_at' => '2022-02-11 14:00:00',
                'updated_at' => '2022-02-11 16:00:00',
            ],

        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Prüfungstermin: SEIBPS',
                'description' => 'Schriftliche Prüfung Software Engineering',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2022-02-11 14:00:00',
                'end' => '2022-02-11 16:00:00',
                'is_full_day' => false,
                'external_id' => null,
                'created_at' => '2022-02-11 14:00:00',
                'updated_at' => '2022-02-11 14:00:00',
            ],
        );


        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Weiterführende Mathematik',
                    'user_id' => $user->id,
                    'description' =>
                        'Vektoralgebra und Analytische Geometrie: Vektoren, Lineare Abhängigkeit, Analytische Geometrie Gewöhnliche Differenzialgleichungen: Existenz und Eindeutigkeit von Lösungen, Trennung der Variablen, Variation der Konstanten, Lineare Differenzialgleichungen erster und zweiter Ordnung, Anwendungen Reihen und Integraltransformationen: Reihen, Potenzreihen und Fourierreihen, Laplace- und Fouriertransformation Numerische Methoden: Numerisches Rechnen und Fehleranalyse, Iterationsverfahren, Lineare Gleichungssysteme, Interpolation, Lösen von Differenzialgleichungen Statistik: Deskriptive Statistik, Schätz- und Testtheorie',
                    'status' => 'done_with_grade',
                    'start_semester' => 2,
                    'end_semester' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'MAI06 - Vektoralgebra und Analytische Geometrie',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'MAI09 - Reihen und Integraltransformationen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'MAI13 - Gewöhnliche Differenzialgleichungen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'MAI14c - Numerische Methoden',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'MAI11 - Stochastik II',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'WMAPS - Vorbereitung',
                'user_id' => $user->id,
                'description' => 'Studienhefte überfliegen,
                     Zusammenfassungen durcharbeiten,
                     Lernzettel/ Karteikarten schreiben,
                     Übungsklausuren durcharbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'WMAPS',
                'grade' => 33,
                'credit_points' => 8,
                'semester' => 2,
                'module_id' => $module->id,
                'created_at' => '2022-04-09 17:00:00',
                'updated_at' => '2022-04-09 19:00:00',
            ],

        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Prüfungstermin: WMAPS',
                'description' => 'Schriftliche Prüfung Weiterführende Mathematik',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2022-04-09 17:00:00',
                'end' => '2022-04-09 19:00:00',
                'is_full_day' => false,
                'external_id' => null,
                'created_at' => '2022-04-09 17:00:00',
                'updated_at' => '2022-04-09 17:00:00',
            ],
        );


        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Informationstechnologie',
                    'user_id' => $user->id,
                    'description' =>
                        'Grundlagen moderner Computernetze Kenngrößen wie Übertragungsrate, Latenz, Jitter; OSISchichtenmodell; Protokolle Informationstheoretische und physikalisch-technische Grundlagen Grundlagen der Informationstheorie und -übertragung, Signale und Signalübertragung, Übertragungskapazitäten, Einführung in die Codierung Bitübertragung und Netzzugang Physikalische Schicht; die Datenverbindungsschicht; Ethernet; drahtlose und mobile Netze TCP/IP-Protokollfamilie IP-Adressierung und –Protokolle;, Routing-Verfahren und - Algorithmen Internetworking und Netzdesign Netzkomponenten wie Hub, Bridge, Switch, Router; Subnetze; VLAN; Planung und Design von Netzen; Netzarchitektur; Zugangsnetze',
                    'status' => 'done_with_grade',
                    'start_semester' => 3,
                    'end_semester' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'ITI21 - Grundlagen moderner Computernetze',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'ITI22 - Informationstheoretische und physikalisch-technische Grundlagen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'ITI23 - Bitübertragung und Netzzugang',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'ITI24 - TCP/IP-Protokollfamilie',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'ITI25 - Internetworking und Netzdesign',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'ITI26 - Anwendungsdienste und Netzmanagement',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'ITICPS - Informationstechnologie',
                'user_id' => $user->id,
                'description' => 'Studienhefte überfliegen,
                     Zusammenfassungen durcharbeiten,
                     Lernzettel/ Karteikarten schreiben,
                     Übungsklausuren durcharbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'ITICPS',
                'grade' => 27,
                'credit_points' => 8,
                'semester' => 3,
                'module_id' => $module->id,
                'created_at' => '2022-10-08 11:00:00',
                'updated_at' => '2022-10-08 13:00:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Prüfungstermin: ITICPS',
                'description' => 'Schriftliche Prüfung Informationstechnologie',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2022-10-08 11:00:00',
                'end' => '2022-10-08 13:00:00',
                'is_full_day' => false,
                'external_id' => null,
                'created_at' => '2022-10-08 11:00:00',
                'updated_at' => '2022-10-08 11:00:00',
            ],
        );


        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Interkulturelle Kompetenz',
                    'user_id' => $user->id,
                    'description' =>
                        'Language and society Language, meaning, and cultural pragmatics Cultural patterns Globalization: the collapse of culture Negotiating interculturally The power variable',
                    'status' => 'done_with_grade',
                    'start_semester' => 3,
                    'end_semester' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'INMT01 - Intercultural Communication',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'INMT02 - Global Strategies, Regional Implementation',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'B-ICM01XX - Interkulturelle Kompetenz',
                'user_id' => $user->id,
                'description' => 'Studienhefte durchgehen,
                    B-Prüfung bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'B-ICM01XX',
                'grade' => 10,
                'credit_points' => 3,
                'semester' => 3,
                'module_id' => $module->id,
                'created_at' => '2023-02-08 11:00:00',
                'updated_at' => '2023-02-08 11:00:00',
            ],

        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: B-ICM01XX',
                'description' => 'B-Prüfung Interkulturelle Kompetenz',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2023-02-08 11:00:00',
                'end' => '2023-02-08 11:00:00',
                'is_full_day' => true,
                'external_id' => null,
                'created_at' => '2023-02-08 11:00:00',
                'updated_at' => '2023-02-08 11:00:00',
            ],
        );


        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Projektmanagement und wissenschaftliches Arbeiten',
                    'user_id' => $user->id,
                    'description' =>
                        'Wissenschaftsübergreifende Darstellung Forschungsprozess und wichtige Forschungsmethoden Qualitätskriterien für wissenschaftliches Arbeiten Internetrecherchen, Internetquellen und Checklisten Fallstudie Seminarvortrag E-Learning-Kurs „Aufbau wissenschaftlicher Arbeiten“ Begriffe und Grundlagen, Organisation von Projekten, Projektsteuerung und -controlling Psychologie des Projektmanagements: Beziehungsebene, Projektkultur und Projekterfolg, Projektleiter und Projektgruppe, Projektkommunikation und wirksame Zusammenarbeit, Projektphasen',
                    'status' => 'done_with_grade',
                    'start_semester' => 3,
                    'end_semester' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'IMI03 - Projektmanagement',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'FUM08Z - Führungsaspekte des Projektmanagements',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'WAM02 - Wissenschaftliches Arbeiten Teil 1 – Einführung und Grundlagen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'WAM03 - Wissenschaftliches Arbeiten Teil 2 – Forschungsmethoden und methodisch gestütztes Vorgehen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'WAM04 - Wissenschaftliches Arbeiten Teil 3 – Systematische Literaturauswertung',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'B-PWAA01XX - Projektmanagement und wissenschaftliches Arbeiten',
                'user_id' => $user->id,
                'description' => 'Studienhefte durchgehen,
                    B-Prüfung bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'B-PWAA01XX',
                'grade' => 13,
                'credit_points' => 6,
                'semester' => 3,
                'module_id' => $module->id,
                'created_at' => '2022-12-08 11:00:00',
                'updated_at' => '2023-10-08 19:00:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: B-PWAA01XX',
                'description' => 'B-Prüfung Projektmanagement und wissenschaftliches Arbeiten',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2022-12-08 11:00:00',
                'end' => '2022-12-08 11:00:00',
                'is_full_day' => true,
                'external_id' => null,
                'created_at' => '2022-12-08 11:00:00',
                'updated_at' => '2022-12-08 11:00:00',
            ],

        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Sicherheit von Informationen und Anwendungen',
                    'user_id' => $user->id,
                    'description' =>
                        'Nach Abschluss dieses Moduls können Sie die Sicherheit von Daten und Anwendungen analysieren und einschätzen. Im Rahmen der Informationssicherheit erlernen Sie den Umgang mit Verfahren der Kryptografie und Steganografie. Im Bereich des Security Engineering erarbeiten Sie sich Vorgehensweisen für eine sichere Entwicklung von Anwendungen und den dazugehörenden Systemen. Bei den Anwendungen spielen heutzutage gerade die mobilen Apps und die Web-Apps sowie das Cloud Computing eine wichtige Rolle. Für diese Anwendungen beherrschen Sie die notwendigen Sicherheitsvorkehrungen sowohl für den Entwickler als auch für den Anwender. Sie können mit Mitteln der IT-Forensik digitale Spuren finden und Beweise bei Sicherheitsverletzungen sichern.',
                    'status' => 'done_with_grade',
                    'start_semester' => 3,
                    'end_semester' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'SDA01 - Kryptografie',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SDA02 - Sichere Entwicklung',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SDA03 - Identity Management',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SDA04 - Sichere Datenspeicherung',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen,
                    Studienheft nacharbeiten (markieren, zusammenfassen, etc.),
                    A-Aufgaben bearbeiten,
                    B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SDAPS - Vorbereitung',
                'user_id' => $user->id,
                'description' => 'Studienhefte überfliegen,
                     Zusammenfassungen durcharbeiten,
                     Lernzettel/ Karteikarten schreiben,
                     Übungsklausuren durcharbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'SDAPS',
                'grade' => 20,
                'credit_points' => 6,
                'semester' => 3,
                'module_id' => $module->id,
                'created_at' => '2022-10-08 08:00:00',
                'updated_at' => '2022-10-08 10:00:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Prüfungstermin: SDAPS',
                'description' => 'Schriftliche Prüfung Sicherheit von Informationen und Anwendungen',
                'location' => 'Prüfungsstandort Hamburg',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2022-10-08 08:00:00',
                'end' => '2022-10-08 10:00:00',
                'is_full_day' => false,
                'external_id' => null,
                'created_at' => '2022-10-08 08:00:00',
                'updated_at' => '2022-10-08 08:00:00',
            ],

        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Berufspraktische Phase',
                    'user_id' => $user->id,
                    'description' =>
                        'Im Verlauf der BPP erarbeiten die Studierenden ein konkretes Projekt im Betrieb. Anhand der Studienmaterialien zum die BPP begleitenden Modul (Siehe Prüfungsordnung) die Studierenden einen Projektplan aus und sprechen diesen mit ihrem Tutor durch. Weitere Informationen zum begleitenden Modul enthält die Modulbeschreibung. ',
                    'status' => 'done_with_grade',
                    'start_semester' => 4,
                    'end_semester' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'Berufspraktische Phase',
                'user_id' => $user->id,
                'description' => 'Arbeit suchen,
                    Arbeiten,
                    Arbeit Dokumentieren,
                    Berichtsinhalt mit Chef klären',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'BPP - Bericht',
                'user_id' => $user->id,
                'description' => 'Dokumentationen durchgehen,
                    Bericht schreiben,
                    Chef prüfen lassen',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'BPP-Bericht',
                'grade' => 20,
                'credit_points' => 15,
                'semester' => 4,
                'module_id' => $module->id,
                'created_at' => '2022-10-08 11:00:00',
                'updated_at' => '2023-06-09 11:00:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: BPP-Bericht',
                'description' => 'Bericht Berufspraktische Phase',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2022-10-08 11:00:00',
                'end' => '2022-10-08 11:00:00',
                'is_full_day' => true,
                'external_id' => null,
                'created_at' => '2021-07-01 08:00:00',
                'updated_at' => '2021-07-01 08:00:00',
            ],
        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Datenbanken',
                    'user_id' => $user->id,
                    'description' =>
                        '1. Datenbanksysteme In dieser Lehrveranstaltung lernen Sie den Aufbau eines Datenbanksystems kennen. Sie beschäftigen sich mit dem 3-Ebenen-Modell, Entity-Relationship-Modellen, relationalen Datenmodellen, Datenbank-Anomalien, der Normalisierung des Datenbankentwurfs, Tabellenoperationen und MySQL für Datenbankabfragen. Die Lehrveranstaltung schließt mit einer Klausur ab.
                        2. Verteilte und Internetdatenbanken In dieser Lehrveranstaltung beschäftigen Sie sich mit Datenbanken in Web-Anwendungen in Form von relationalen Datenbanken, XML-Datenbanken und NoSQL-Datenbanken sowie mit verteilten Datenbanken.',
                    'status' => 'done_with_grade',
                    'start_semester' => 4,
                    'end_semester' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'DBI11 - Theoretische Grundlagen von DB-Systemen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'DBI12 - Technische Grundlagen von DB-Systemen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'DBI13 - Datenbanksprachen am Beispiel SQL',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'DBI14 - Datenbankanwendungen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'DBI15 - Datenbanken in Webanwendungen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'DBI05 - Verteilte Datenbanken',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'B-DBI02XX - Datenbanken',
                'user_id' => $user->id,
                'description' => 'Studienhefte durchgehen,
                    B-Prüfung bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'DBIAPS - Vorbereitung',
                'user_id' => $user->id,
                'description' => 'Studienhefte überfliegen,
                     Zusammenfassungen durcharbeiten,
                     Lernzettel/ Karteikarten schreiben,
                     Übungsklausuren durcharbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'DBIAPS',
                'grade' => 23,
                'credit_points' => 5,
                'semester' => 4,
                'module_id' => $module->id,
                'created_at' => '2023-02-08 11:00:00',
                'updated_at' => '2023-02-08 11:00:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Prüfungstermin: DBIAPS',
                'description' => 'Schriftliche Prüfung Datenbanken',
                'location' => 'Prüfungsstandort Hamburg',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2023-02-08 11:00:00',
                'end' => '2023-02-08 13:00:00',
                'is_full_day' => false,
                'external_id' => null,
                'created_at' => '2023-02-08 11:00:00',
                'updated_at' => '2023-02-08 11:00:00',
            ],

        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Multimediale Anwendungen',
                    'user_id' => $user->id,
                    'description' =>
                        'Nach Abschluss des Moduls kennen Sie die grundlegenden Medienarten von Texten, Tönen, Bildern und Videos. Sie kennen sich aus mit den Anforderungen an MultimediaHardware und der Codierung und Komprimierung von Daten. Im Fokus dieses Moduls steht die Entwicklung multimedialer Anwendungen mittels clientseitigen als auch serverseitigen Websprachen. Sie erlangen ein Verständnis der grundlegenden Prinzipien der Internet-Kommunikation via HTTP. Sie kennen die Möglichkeiten und Bedeutung der gängigsten Web-Frameworks, sowohl client- als auch serverseitig, können diese installieren und erste Anwendungen darin erstellen. Darüber hinaus lernen Sie mittels Content-Management-Systemen (CMS) Web-Publishing durchzuführen.',
                    'status' => 'done_with_grade',
                    'start_semester' => 4,
                    'end_semester' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'MMI12 - Kommunikation im Web und clientseitige Websprachen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'MMI11 - Multimedia-Grundlagen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'MMI13 - Serverseitige Websprachen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'MMI14 - Web-Anwendungen: Applikationen und Frameworks',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'B-MUMA01XX - Multimediale Anwendungen',
                'user_id' => $user->id,
                'description' => 'Studienhefte durchgehen,
                    B-Prüfung bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'B-MUMA01XX',
                'grade' => 10,
                'credit_points' => 6,
                'semester' => 4,
                'module_id' => $module->id,
                'created_at' => '2023-03-10 10:00:00',
                'updated_at' => '2023-03-10 10:00:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: B-MUMA01XX',
                'description' => 'B-Prüfung Multimediale Anwendungen',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2023-03-10 10:00:00',
                'end' => '2023-03-10 10:00:00',
                'is_full_day' => true,
                'external_id' => null,
                'created_at' => '2023-03-10 10:00:00',
                'updated_at' => '2023-03-10 10:00:00',
            ],

        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Sicherheit von Systemen',
                    'user_id' => $user->id,
                    'description' =>
                        'In diesem Modul lernen Sie im Bereich der Sicherheit von Systemen alle notwendigen Kriterien für den Aufbau einer sicheren IT-Infrastruktur zu beherrschen. Sie sind in der Lage, die physische Sicherheit von Servern und Endsystemen sowie der entsprechenden Betriebssysteme herzustellen. Sie können gezielt Sicherheitsarchitekturen (Redundanzen) und Konzepte der sicheren Datenspeicherung umsetzen. Sie sind befähigt, einen sicheren IT-Betrieb vernetzter Systeme zu realisieren, und sind in der Lage, Technologien zur Gewährleistung der Sicherheit mobiler Geräte und Anwendungen umzusetzen und im Rahmen eines Informationssicherheitsmanagementsystems zu etablieren',
                    'status' => 'done_with_grade',
                    'start_semester' => 4,
                    'end_semester' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'SRN01 - Physische Sicherheit und Hochverfügbarkeit',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SRN02 - Grundlagen eines sicheren IT-Betriebs',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SRN06 - Mobile Sicherheit',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SRN1PS - Vorbereitung',
                'user_id' => $user->id,
                'description' => 'Studienhefte überfliegen,
                     Zusammenfassungen durcharbeiten,
                     Lernzettel/ Karteikarten schreiben,
                     Übungsklausuren durcharbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'SRN1PS',
                'grade' => 13,
                'credit_points' => 6,
                'semester' => 4,
                'module_id' => $module->id,
                'created_at' => '2023-04-01 14:00:00',
                'updated_at' => '2023-04-01 16:00:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Prüfungstermin: SRN1PS',
                'description' => 'Schriftliche Prüfung Sicherheit von Systemen',
                'location' => 'Prüfungsstandort Hamburg',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2023-04-01 14:00:00',
                'end' => '2023-04-01 16:00:00',
                'is_full_day' => false,
                'external_id' => null,
                'created_at' => '2023-04-01 14:00:00',
                'updated_at' => '2023-04-01 14:00:00',
            ],

        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Verteilte Informationsverarbeitung',
                    'user_id' => $user->id,
                    'description' =>
                        'Architektur, Prozesse, Threads, Interprozesskommunikation und Synchronisation Protokollarchitektur, Geräte-Adressierung, Adressierung und Routing in IP-Netzwerken, Nachrichten, Übertragung Socket, Remote Procedure Calls Network File Systeme Programmierung von verteilten Systemen Hochverfügbarkeit, Verschlüsselung und digitale Signaturen, Verschlüsselung in Netzwerken, Authentifizierung, Sicherheitsmechanismen in Netzwerken ',
                    'status' => 'done_with_grade',
                    'start_semester' => 4,
                    'end_semester' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'VII11 - Grundlagen verteilter Informationssysteme',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'VII12 - Grundlagen von Computernetzwerken',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'VII13 - Interprozess-Kommunikation',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'VII14 - Programmierung für verteilte Systeme',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'VII15 - Sicherheit',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'VIIDPS - Vorbereitung',
                'user_id' => $user->id,
                'description' => 'Studienhefte überfliegen,
                     Zusammenfassungen durcharbeiten,
                     Lernzettel/ Karteikarten schreiben,
                     Übungsklausuren durcharbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'VIIDPS',
                'grade' => 20,
                'credit_points' => 8,
                'semester' => 5,
                'module_id' => $module->id,
                'created_at' => '2023-12-09 12:30:00',
                'updated_at' => '2023-12-09 14:30:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Prüfungstermin: VIIDPS',
                'description' => 'Schriftliche Prüfung Verteilte Informationsverarbeitung',
                'location' => 'Prüfungsstandort Hamburg',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2023-12-09 12:30:00',
                'end' => '2023-12-09 14:30:00',
                'is_full_day' => false,
                'external_id' => null,
                'created_at' => '2023-12-09 12:30:00',
                'updated_at' => '2023-12-09 12:30:00',
            ],

        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Anwendung künstlicher Intelligenz',
                    'user_id' => $user->id,
                    'description' =>
                        'Grundlagen der Künstlichen Intelligenz Grundlagen der Neuronale Netze Grundlagen des maschinellen Lernens Grundlagen Depp Learning und Analyse von Big Data Anwendungen in den Bereichen maschinelles Lernen, Deep Learning und Big Data',
                    'status' => 'done_with_grade',
                    'start_semester' => 5,
                    'end_semester' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'KII01a - Grundlagen der Künstlichen Intelligenz',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'open',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'KII02 - Logische Programmierung mit Prolog',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'open',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'KII03a - Expertensysteme und Genetische Algorithmen',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'open',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'KII04a - Künstliche Neuronale Netze',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'open',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'B-AKI01XX - Anwendung künstlicher Intelligenz',
                'user_id' => $user->id,
                'description' => 'Studienhefte durchgehen,
                    B-Prüfung bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'B-AKI01XX',
                'grade' => 10,
                'credit_points' => 6,
                'semester' => 5,
                'module_id' => $module->id,
                'created_at' => '2023-06-08 11:00:00',
                'updated_at' => '2023-06-08 11:00:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: B-AKI01XX',
                'description' => 'B-Prüfung Anwendung künstlicher Intelligenz',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2023-06-08 11:00:00',
                'end' => '2023-06-08 11:00:00',
                'is_full_day' => true,
                'external_id' => null,
                'created_at' => '2023-06-08 11:00:00',
                'updated_at' => '2023-06-08 11:00:00',
            ],

        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Kommunikation und Führung',
                    'user_id' => $user->id,
                    'description' =>
                        'Führung: Anforderungen an Führungskräfte, Grundlagen und Dimensionen des Führungsverhaltens, Führungsmodelle, Schlüsselqualifikationen Kooperative Führung, Konfliktmanagement, Konflikte verstehen, analysieren und bewältigen Kommunikation: Kommunikation, Gesetzmäßigkeiten, Kommunikationsmodelle',
                    'status' => 'in_progress',
                    'start_semester' => 5,
                    'end_semester' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'FUM01Z - Mitarbeiter führen und motivieren',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'FUM02Z - Grundlagen der Führung',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'FUM09Z - Führung und Konfliktlösung',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'open',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'FUM05Z - Führungstechniken und Führungsinstrumente',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'open',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'FUM03Z - Führung und Kommunikation',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'open',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'FUM-O10Z - WBT Moderation',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'open',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'FUM10aZ - Führung und Moderation',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'open',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'KFIAPM - Vorbereitung',
                'user_id' => $user->id,
                'description' => 'Studienhefte überfliegen,
                     Moderation üben',
                'status' => 'open',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'KFIAPM',
                'grade' => null,
                'credit_points' => 6,
                'semester' => 5,
                'module_id' => $module->id,
                'created_at' => '2023-06-08 11:00:00',
                'updated_at' => '2023-06-08 11:00:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Prüfungstermin: KFIAPM',
                'description' => 'Mündliche Prüfung Kommunikation und Führung',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2024-01-25 18:00:00',
                'end' => '2024-01-25 21:00:00',
                'is_full_day' => false,
                'external_id' => null,
                'created_at' => '2024-01-25 18:00:00',
                'updated_at' => '2024-01-25 18:00:00',
            ],
        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Projektarbeit',
                    'user_id' => $user->id,
                    'description' =>
                        'Die Studierenden wenden ihr Wissen über Projektmanagement, Prozesse im Projektteam und Projektmanagementinstrumente an und setzen dieses in einem konkreten wissenschaftlichen Projekt um. Insbesondere arbeiten sie die Aspekte Kommunikation, Motivation, kooperativer Führungsstil, Teamarbeit, Zielvereinbarung, Delegation, Erfolgskontrolle sowie Kritik und Anerkennung im Projektteam heraus.',
                    'status' => 'in_progress',
                    'start_semester' => 5,
                    'end_semester' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'PRJR - Projektstart',
                'user_id' => $user->id,
                'description' => 'Team suchen,
                    Thema besprechen,
                    Veranstaltung besuchen',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'ProPräsentation - Projektpräsentation',
                'user_id' => $user->id,
                'description' => 'Matjesbrötchen auf Silbertablett präsentieren',
                'status' => 'open',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Projekt ausarbeiten',
                'user_id' => $user->id,
                'description' => 'Matjesbrötchen belegen',
                'status' => 'in_progress',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Projektarbeit - Projektarbeit',
                'user_id' => $user->id,
                'description' => 'Das Belegen ausführlich beschreiben und alle Dokumentierten Schritte zusammenfassen',
                'status' => 'open',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'ProPrä ',
                'grade' => null,
                'credit_points' => 6,
                'semester' => 5,
                'module_id' => $module->id,
                'created_at' => '2023-09-16 10:00:00',
                'updated_at' => '2023-09-16 12:00:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Prüfungstermin: Projektpräsentation',
                'description' => 'Projektpräsentation Matjesbrötchen',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2024-02-03 14:00:00',
                'end' => '2024-02-03 16:00:00',
                'is_full_day' => false,
                'external_id' => null,
                'created_at' => '2024-02-03 14:00:00',
                'updated_at' => '2024-02-03 14:00:00',
            ],
        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Sicherheit von Netzwerken',
                    'user_id' => $user->id,
                    'description' =>
                        'Nach Abschluss dieses Moduls beherrschen Sie von der physischen Sicherung bis zur Netzwerküberwachung alle notwendigen Kriterien für den Aufbau einer sicheren IT-Infrastruktur. Unter anderem erlernen Sie die Handhabung von Hochverfügbarkeitslösungen, Sicherheit in Netzen (LANs, WLANs, mobile Netze), Firewalls, IDS/IPS, Voice over IP. Sie sind in der Lage, IPS-Lösungen (Intrusion Prevention System, IPS) zur Verhinderung von Einbruchsversuchen und IDS-Lösungen (Intrusion Detection System, IDS) zur Erkennung von Einbruchsversuchen zu erarbeiten.',
                    'status' => 'done_with_grade',
                    'start_semester' => 5,
                    'end_semester' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'SRN03 - Firewall-Systeme',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SRN04 - Intrusion Detection und Intrusion Prevention',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SRN05 - Sichere Netzwerkkommunikation',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SRN2PS - Vorbereitung',
                'user_id' => $user->id,
                'description' => 'Studienhefte überfliegen,
                     Zusammenfassungen durcharbeiten,
                     Lernzettel/ Karteikarten schreiben,
                     Übungsklausuren durcharbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'SRN2PS ',
                'grade' => 30,
                'credit_points' => 6,
                'semester' => 5,
                'module_id' => $module->id,
                'created_at' => '2023-09-16 10:00:00',
                'updated_at' => '2023-09-16 12:00:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Prüfungstermin: SRN2PS ',
                'description' => 'Schriftliche Prüfung Sicherheit von Netzwerken',
                'location' => 'Prüfungsstandort Hamburg',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2023-09-16 10:00:00',
                'end' => '2023-09-16 12:00:00',
                'is_full_day' => false,
                'external_id' => null,
                'created_at' => '2023-09-16 10:00:00',
                'updated_at' => '2023-09-16 10:00:00',
            ],

        );

        $module = Module::factory()
            ->createOne(

                [
                    'name' => 'Weiterführende Programmierung',
                    'user_id' => $user->id,
                    'description' =>
                        'C-Programmierung Aufbau und Entwicklung von C-Programmen: Sprachelemente und Steuerstrukturen, Felder und Zeichenketten, Zeiger, Funktionen, der Präprozessor, Bibliotheksfunktionen und Speicherklassen
                        C++-Programmierung Eclipse CDT, Grundlagen der Objekttechnologie, Klassenhierachien und –heterarchien, Dateiverarbeitung, Templates, Klassenrelationen, Klassen als statische Strukturelemente, Ein- und Ausgabe mit Streams.',
                    'status' => 'done_with_grade',
                    'start_semester' => 5,
                    'end_semester' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'GPI21 - Programmieren in C - Teil 1',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'GPI22 - Programmieren in C - Teil 2',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'GPI15 - Programmieren in C++ Teil 1',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'GPI16 - Programmieren in C++ Teil 2',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'WFP1PS - Vorbereitung',
                'user_id' => $user->id,
                'description' => 'Studienhefte überfliegen,
                     Zusammenfassungen durcharbeiten,
                     Lernzettel/ Karteikarten schreiben,
                     programmieren,
                     programmieren und mehr programmieren',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'WFP1PS',
                'grade' => 13,
                'credit_points' => 6,
                'semester' => 5,
                'module_id' => $module->id,
                'created_at' => '2023-09-16 12:30:00',
                'updated_at' => '2023-09-19 14:30:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Prüfungstermin: WFP1PS',
                'description' => 'Schriftliche Prüfung Weiterführende Programmierung in C und C++',
                'location' => 'Prüfungsstandort Hamburg',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2023-09-16 12:30:00',
                'end' => '2023-09-16 14:30:00',
                'is_full_day' => false,
                'external_id' => null,
                'created_at' => '2023-09-16 12:30:00',
                'updated_at' => '2023-09-16 12:30:00',
            ],
        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'IT-Sicherheit-Management',
                    'user_id' => $user->id,
                    'description' =>
                        'Modelle (nach Stelzer, des BSI), Managementsysteme (Leitfäden, Empfehlung des BSI, Zertifizierungen) Entwicklung von Sicherheitskonzepten (Risikoanalyse, Grundschutz, etc.), Datenschutz Notfallmanagement Incident Handling IT-Forensik (Grundlagen, IT-Forensische Untersuchungen) Standards und Gesetze (BSI-Leitfaden, IT-Grundrecht, ISO 2700x, Bundesdatenschutzgesetz)',
                    'status' => 'in_progress',
                    'start_semester' => 6,
                    'end_semester' => 6,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'ISM01 - IT-Sicherheitsmanagement I',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'ISM02 - IT-Sicherheitsmanagement II',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'open',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'ISM04 - IT-Forensik – Grundlagen, Standards, Rechtliche Aspekte, Werkzeuge',
                'user_id' => $user->id,
                'description' => 'Studienheft durchlesen, Studienheft nacharbeiten (markieren, zusammenfassen, etc.), A-Aufgaben bearbeiten, B-Aufgaben bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'B-ISM01XX - IT-Sicherheit-Management',
                'user_id' => $user->id,
                'description' => 'Studienhefte durchgehen,
                    B-Prüfung bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'B-ISM01XX',
                'grade' => null,
                'credit_points' => 6,
                'semester' => 5,
                'module_id' => $module->id,
                'created_at' => '2023-09-16 12:30:00',
                'updated_at' => '2023-09-19 14:30:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: B-ISM01XX',
                'description' => 'B-Prüfung IT-Sicherheit-Management',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2024-02-19 14:00:00',
                'end' => '2024-02-19 14:00:00',
                'is_full_day' => true,
                'external_id' => null,
                'created_at' => '2024-02-19 14:00:00',
                'updated_at' => '2024-02-19 14:00:00',
            ],

        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Labor Cybersicherheit',
                    'user_id' => $user->id,
                    'description' =>
                        'In diesem Modul betrachten Sie die in den vorherigen Modulen behandelten Themen im Zusammenhang und beleuchten anhand von praktischen Fallbeispielen einzelne Aspekte in einem Labor. Zunächst analysieren Sie die aktuelle Cybersicherheitslage. Hierzu erstellen Sie einen Bericht. In einem PC-Labor konfigurieren Sie konkrete Beispiele für eine sichere Infrastruktur. Das Labor wird virtuell am heimischen PC durchgeführt.',
                    'status' => 'in_progress',
                    'start_semester' => 6,
                    'end_semester' => 6,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'CSI-L - Laborbeschreibung Cyber-Sicherheit',
                'user_id' => $user->id,
                'description' => 'Laborvorbereitung, lesen und verstehen, Vorlage für B-CSI01',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'B-CSI01XX - Laboreingangsprüfung Cyber-Sicherheit',
                'user_id' => $user->id,
                'description' => 'Linux vertiefen,
                    B-Prüfung bearbeiten',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'CSISem - Auftaktveranstaltung Cyber-Sicherheit',
                'user_id' => $user->id,
                'description' => 'An Veranstalltung teilnehmen,
                    Linux vertiefen',
                'status' => 'in_progress',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'CSILab - Labor Cyber-Sicherheit',
                'user_id' => $user->id,
                'description' => 'Aufgaben aus Seminar bearbeiten',
                'status' => 'open',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'B-CSI02XX - Laborabschlussprüfung Cyber-Sicherheit',
                'user_id' => $user->id,
                'description' => 'Gelerntes aus Seminar anwenden,
                    B-Prüfung bearbeiten',
                'status' => 'open',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'B-CSI01XX',
                'grade' => 10,
                'credit_points' => 0,
                'semester' => 6,
                'module_id' => $module->id,
                'created_at' => '2023-11-16 12:00:00',
                'updated_at' => '2023-11-16 12:00:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: B-CSI01XX',
                'description' => 'B-Prüfung/ Laboreingangsprüfung Modul Labor Cybersicherheit',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2023-11-16 12:00:00',
                'end' => '2023-11-16 12:00:00',
                'is_full_day' => true,
                'external_id' => null,
                'created_at' => '2023-11-16 12:00:00',
                'updated_at' => '2023-11-16 12:00:00',
            ],
        );

        $exam = Exam::factory()->createOne(
            [
                'code' => 'B-CSI02XX',
                'grade' => null,
                'credit_points' => 6,
                'semester' => 6,
                'module_id' => $module->id,
                'created_at' => '2023-11-16 12:00:00',
                'updated_at' => '2023-11-16 12:00:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: B-CSI02XX',
                'description' => 'B-Prüfung/ Laborabschlussprüfung Cyber-Sicherheit',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2024-03-04 12:00:00',
                'end' => '2023-03-04 12:00:00',
                'is_full_day' => true,
                'external_id' => null,
                'created_at' => '2023-11-16 12:00:00',
                'updated_at' => '2023-11-16 12:00:00',
            ],
        );
        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: B-CSI02XX',
                'description' => 'B-Prüfung/ Laborabschlussprüfung Cyber-Sicherheit',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2024-01-05 12:00:00',
                'end' => '2023-01-05 12:00:00',
                'is_full_day' => true,
                'external_id' => null,
                'created_at' => '2023-11-16 12:00:00',
                'updated_at' => '2023-11-16 12:00:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: B-CSI02XX',
                'description' => 'B-Prüfung/ Laborabschlussprüfung Cyber-Sicherheit',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2024-01-19 12:00:00',
                'end' => '2023-01-19 12:00:00',
                'is_full_day' => true,
                'external_id' => null,
                'created_at' => '2023-11-16 12:00:00',
                'updated_at' => '2023-11-16 12:00:00',
            ],
        );
        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: B-CSI02XX',
                'description' => 'B-Prüfung/ Laborabschlussprüfung Cyber-Sicherheit',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2024-01-27 12:00:00',
                'end' => '2023-01-27 12:00:00',
                'is_full_day' => true,
                'external_id' => null,
                'created_at' => '2023-11-16 12:00:00',
                'updated_at' => '2023-11-16 12:00:00',
            ],
        );

        $module = Module::factory()
            ->createOne(
                [
                    'name' => 'Bachelor-Thesis',
                    'user_id' => $user->id,
                    'description' =>
                        'Die Bachelorarbeit ist der krönende Abschluss und zugleich die bedeutendste Einzelleistung in Ihrem Studium. Sie dient der Vertiefung und praktischen Anwendung der Stoffinhalte des Studiums. Ziel ist es, die erworbenen Fähigkeiten und insbesondere die Problemlösungskompetenz an einer praktischen Aufgabenstellung zu beweisen. Im Rahmen der Bachelorarbeit werden anspruchsvolle Entwicklungsprojekte oder eine Konzepterarbeitung durchgeführt. Verteidigt wird sie im Rahmen eines Kolloquiums. Alle notwendigen Informationen zu Zulassung, Ablauf, Themensuche, Betreuer, Formatvorgaben u.a. können Sie dem Leitfaden entnehmen, der im Online-Campus zur Verfügung gestellt ist. Auch unser Prüfungsamt hilft Ihnen hier gern weiter. Mit der erfolgreichen Verteidigung Ihrer Bachelorarbeit erlangen Sie den Grad „Bachelor of Science“.',
                    'status' => 'in_progress',
                    'start_semester' => 6,
                    'end_semester' => 6,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );

        Task::factory()->createMany([
            [
                'title' => 'Exposé ',
                'user_id' => $user->id,
                'description' => 'Thesis-Thema suchen, Professor finden, einarbeiten ins Thema, Exposé schreiben',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Thesis',
                'user_id' => $user->id,
                'description' => 'Viel Arbeit',
                'status' => 'open',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kolloquium',
                'user_id' => $user->id,
                'description' => 'Getane Arbeit verteidigen',
                'status' => 'done',
                'module_id' => $module->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $exam = Exam::factory()->createOne(
            [
                'code' => 'Bachelor-Thesis',
                'grade' => null,
                'credit_points' => 12,
                'semester' => 6,
                'module_id' => $module->id,
                'created_at' => '2023-11-16 12:00:00',
                'updated_at' => '2023-11-16 12:00:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Abgabetermin: Bachelor-Thesis',
                'description' => 'Bachelor-Thesis "Secure-Scrum", Eine konzeptionelle Thsis über die Aufstellung von Scrum Theams und deren Methoden zur Gewährleistung sicherer Softwareentwicklung.',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2024-06-30 23:59:59',
                'end' => '2024-06-30 23:59:59',
                'is_full_day' => true,
                'external_id' => null,
                'created_at' => '2023-11-16 12:00:00',
                'updated_at' => '2023-11-16 12:00:00',
            ],
        );

        $exam = Exam::factory()->createOne(
            [
                'code' => 'Kolloquium',
                'grade' => null,
                'credit_points' => 0,
                'semester' => 6,
                'module_id' => $module->id,
                'created_at' => '2023-11-16 12:00:00',
                'updated_at' => '2023-11-16 12:00:00',
            ],
        );

        Event::factory()->createOne(
            [
                'user_id' => $user->id,
                'key' => 'exam',
                'title' => 'Kolloquium: Bachelor-Thesis Verteidigung',
                'description' => 'Präsentation und Verteidigung der Bachelor-Thesis',
                'location' => 'online',
                'related_id' => $exam->id,
                'related_type' => $exam->getMorphClass(),
                'is_editable' => true,
                'start' => '2024-07-14 11:00:00',
                'end' => '2024-07-14 14:00:00',
                'is_full_day' => false,
                'external_id' => null,
                'created_at' => '2023-11-16 12:00:00',
                'updated_at' => '2023-11-16 12:00:00',
            ],
        );
    }
}
