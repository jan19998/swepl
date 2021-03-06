CREATE DATABASE IF NOT EXISTS `swepl`;
USE swepl;

DROP TABLE IF EXISTS `ist bei`;
DROP TABLE IF EXISTS `betreut`;
DROP TABLE IF EXISTS `Bewertung`;
DROP TABLE IF EXISTS `Meilenstein`;
DROP TABLE IF EXISTS `Meilenstein_Global`;
DROP TABLE IF EXISTS `Student`;
DROP TABLE IF EXISTS `Termin`;
DROP TABLE IF EXISTS `Gruppe`;
DROP TABLE IF EXISTS `Benutzer`;
DROP TABLE IF EXISTS `Semester`;

CREATE TABLE Semester(
	Kennung VARCHAR(7) NOT NULL, CONSTRAINT `Semester_primär` PRIMARY KEY (Kennung)
);

CREATE TABLE Benutzer(
	ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Benutzer VARCHAR(15) NOT NULL UNIQUE,
	Semester_FK VARCHAR(7) DEFAULT NULL,
	Vorname VARCHAR(50) NOT NULL,
	Nachname VARCHAR(50) NOT NULL,
	Passwort CHAR(60) NOT NULL,
	IstDozent BOOL NOT NULL,
	`E-Mail` VARCHAR(50) NOT NULL UNIQUE,
	CONSTRAINT `Benutzer gehört zu Semester` FOREIGN KEY (Semester_FK) REFERENCES `Semester`(Kennung) ON DELETE CASCADE 
);

CREATE TABLE Gruppe(
	ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	Semester_FK VARCHAR(7),
	Raum VARCHAR(7) NOT NULL,
	Wochentag ENUM('Montag','Dienstag','Mittwoch','Donnerstag','Freitag') NOT NULL,
	Uhrzeit TIME NOT NULL,
	Gruppennummer VARCHAR(3) NOT NULL, CONSTRAINT Gruppe_primär PRIMARY KEY (ID),
	CONSTRAINT `Gruppe ist in Semester` FOREIGN KEY (Semester_FK) REFERENCES `Semester`(Kennung) ON DELETE CASCADE
);

CREATE TABLE Student(
	ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	Gruppe_FK INT UNSIGNED,
	Semester_FK VARCHAR(7),
	Vorname VARCHAR(50) NOT NULL,
	Nachname VARCHAR(50) NOT NULL,
	Matrikelnummer INT(9) UNSIGNED NOT NULL,
	`E-Mail` VARCHAR(50) NOT NULL,
	CONSTRAINT Student_primär PRIMARY KEY (ID),
	CONSTRAINT vorhanden UNIQUE(Semester_FK, Matrikelnummer),
	CONSTRAINT `Student ist in Gruppe` FOREIGN KEY (Gruppe_FK) REFERENCES `Gruppe`(ID) ON DELETE SET NULL,
	CONSTRAINT `Student ist in Semester` FOREIGN KEY (Semester_FK) REFERENCES `Semester`(Kennung) ON DELETE CASCADE
);

CREATE TABLE Termin(
	ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	Semester_FK VARCHAR(7),
	Gruppe_FK INT UNSIGNED,
	Datum DATETIME NOT NULL,
	CONSTRAINT Termin_primär PRIMARY KEY (ID),
	CONSTRAINT `Termin ist in Semester` FOREIGN KEY (Semester_FK) REFERENCES `Semester`(Kennung) ON DELETE CASCADE,
	CONSTRAINT `Termin ist für Gruppe` FOREIGN KEY (Gruppe_FK) REFERENCES `Gruppe`(ID) ON DELETE SET NULL
);

CREATE TABLE Meilenstein_Global(
ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
Semester_FK VARCHAR(7),
Frist DATE NOT NULL,
Bezeichnung VARCHAR(255) NOT NULL,
Beschreibung VARCHAR(255),
CONSTRAINT Meilenstein_Global PRIMARY KEY (ID),
CONSTRAINT `Meilenstein ist in Semester` FOREIGN KEY (Semester_FK) REFERENCES `Semester`(Kennung) ON DELETE CASCADE
);

CREATE TABLE Meilenstein(
	ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	Meilenstein_FK INT UNSIGNED,
	Gruppe_FK INT UNSIGNED,
	Beendet DATE DEFAULT NULL,
	`Status` BOOL NOT NULL DEFAULT FALSE,
	CONSTRAINT Meilenstein_primär PRIMARY KEY (ID),
	CONSTRAINT `Gruppe hat Meilenstein` FOREIGN KEY (Gruppe_FK) REFERENCES `Gruppe`(ID) ON DELETE CASCADE,
	CONSTRAINT `Meilenstein erbt von` FOREIGN KEY (Meilenstein_FK) REFERENCES `Meilenstein_Global`(ID) ON DELETE CASCADE
);

CREATE TABLE Bewertung(
	ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	Termin_FK INT UNSIGNED,
	Ampelstatus ENUM('Grün','Gelb','Rot') NOT NULL,
	Bewertung ENUM('+','-','0') NOT NULL,
	Kommentar VARCHAR(255), CONSTRAINT Bewertung_primär PRIMARY KEY (ID),
	CONSTRAINT `Termin wird bewertet` FOREIGN KEY (Termin_FK) REFERENCES `Termin`(ID) ON DELETE CASCADE
);

-- N:M Relation
CREATE TABLE `ist bei`(
	Anwesend BOOL DEFAULT FALSE,
	Student_FK INT UNSIGNED,
	Termin_FK INT UNSIGNED, CONSTRAINT `ist_bei_primär` PRIMARY KEY (Student_FK,Termin_FK),
	CONSTRAINT `Student ist bei Termin` FOREIGN KEY (Student_FK) REFERENCES `Student`(ID) ON DELETE CASCADE,
	CONSTRAINT `Termin ist für Student` FOREIGN KEY (Termin_FK) REFERENCES `Termin`(ID) ON DELETE CASCADE
);

CREATE TABLE `betreut`(
	Benutzer_FK INT UNSIGNED,
	Gruppe_FK INT UNSIGNED,
	CONSTRAINT `betreut_primär` PRIMARY KEY (Benutzer_FK,Gruppe_FK),
	CONSTRAINT `Benutzer betreut Gruppe` FOREIGN KEY (Benutzer_FK) REFERENCES `Benutzer`(ID) ON DELETE CASCADE,
	CONSTRAINT `Gruppe wird betreut` FOREIGN KEY (Gruppe_FK) REFERENCES `Gruppe`(ID) ON DELETE CASCADE
);

INSERT INTO Benutzer(Benutzer,Passwort,IstDozent,`E-Mail`) VALUES
('Dozent1','$1$EK4qiF3L$s1lIpt.qFUir2v51GnqBs/',1,'dozent1@live.de'); -- Passwort Dozent


SHOW WARNINGS;