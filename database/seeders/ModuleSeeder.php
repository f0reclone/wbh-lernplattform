<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Module;
use App\Models\User;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->find(2);
        if ($user) {
            Module::factory()->createMany([
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
                ],
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
                ],
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
                [
                    'name' => 'Verteilte Informationsverarbeitung',
                    'user_id' => $user->id,
                    'description' =>
                        'Architektur, Prozesse, Threads, Interprozesskommunikation und Synchronisation Protokollarchitektur, Geräte-Adressierung, Adressierung und Routing in IP-Netzwerken, Nachrichten, Übertragung Socket, Remote Procedure Calls Network File Systeme Programmierung von verteilten Systemen Hochverfügbarkeit, Verschlüsselung und digitale Signaturen, Verschlüsselung in Netzwerken, Authentifizierung, Sicherheitsmechanismen in Netzwerken',
                    'status' => 'done_with_grade',
                    'start_semester' => 5,
                    'end_semester' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
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
                [
                    'name' => '',
                    'user_id' => $user->id,
                    'description' =>
                        'Die Bachelorarbeit ist der krönende Abschluss und zugleich die bedeutendste Einzelleistung in Ihrem Studium. Sie dient der Vertiefung und praktischen Anwendung der Stoffinhalte des Studiums. Ziel ist es, die erworbenen Fähigkeiten und insbesondere die Problemlösungskompetenz an einer praktischen Aufgabenstellung zu beweisen. Im Rahmen der Bachelorarbeit werden anspruchsvolle Entwicklungsprojekte oder eine Konzepterarbeitung durchgeführt. Verteidigt wird sie im Rahmen eines Kolloquiums. Alle notwendigen Informationen zu Zulassung, Ablauf, Themensuche, Betreuer, Formatvorgaben u.a. können Sie dem Leitfaden entnehmen, der im Online-Campus zur Verfügung gestellt ist. Auch unser Prüfungsamt hilft Ihnen hier gern weiter. Mit der erfolgreichen Verteidigung Ihrer Bachelorarbeit erlangen Sie den Grad „Bachelor of Science“.',
                    'status' => 'in_progress',
                    'start_semester' => 6,
                    'end_semester' => 6,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

            ]);
        }
        else {
            // Falls der Benutzer nicht gefunden wurde, gibt eine Meldung aus
            echo "Benutzer nicht gefunden. Bitte überprüfen Sie die Benutzer-ID im Seeder.\n";
        }

    }
}
