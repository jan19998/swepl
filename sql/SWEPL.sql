CREATE DATABASE IF NOT EXISTS `swepl`;
USE swepl;

DROP TABLE IF EXISTS `ist bei`;
DROP TABLE IF EXISTS `betreut`;
DROP TABLE IF EXISTS `Bewertung`;
DROP TABLE IF EXISTS `Meilenstein`;
DROP TABLE IF EXISTS `Student`;
DROP TABLE IF EXISTS `Termin`;
DROP TABLE IF EXISTS `Gruppe`;
DROP TABLE IF EXISTS `Benutzer`;
DROP TABLE IF EXISTS `Semester`;

CREATE TABLE Benutzer(
	ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Benutzer VARCHAR(15) NOT NULL UNIQUE,
	Vorname VARCHAR(50) NOT NULL,
	Nachname VARCHAR(50) NOT NULL,
	Passwort VARCHAR(60) NOT NULL,
	IstDozent BOOL NOT NULL,
	`E-Mail` VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE Semester(
	Kennung VARCHAR(7) NOT NULL, CONSTRAINT `Semester_primär` PRIMARY KEY (Kennung)
);

CREATE TABLE Gruppe(
	ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	Semester_FK VARCHAR(7),
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
	CONSTRAINT `Student ist in Gruppe` FOREIGN KEY (Gruppe_FK) REFERENCES `Gruppe`(ID) ON DELETE SET NULL,
	CONSTRAINT `Student ist in Semester` FOREIGN KEY (Semester_FK) REFERENCES `Semester`(Kennung) ON DELETE CASCADE
);

CREATE TABLE Termin(
	ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	Semester_FK VARCHAR(7),
	Gruppe_FK INT UNSIGNED,
	Datum DATE NOT NULL,
	CONSTRAINT Termin_primär PRIMARY KEY (ID),
	CONSTRAINT `Termin ist in Semester` FOREIGN KEY (Semester_FK) REFERENCES `Semester`(Kennung) ON DELETE CASCADE,
	CONSTRAINT `Termin ist für Gruppe` FOREIGN KEY (Gruppe_FK) REFERENCES `Gruppe`(ID) ON DELETE SET NULL
);

CREATE TABLE Meilenstein(
	ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	Gruppe_FK INT UNSIGNED,
	Frist DATE NOT NULL,
	Beendet DATE DEFAULT NULL,
	`Status` BOOL NOT NULL DEFAULT FALSE,
	Bezeichnung VARCHAR(255) NOT NULL,
	CONSTRAINT Meilenstein_primär PRIMARY KEY (ID),
	CONSTRAINT `Gruppe hat Meilenstein` FOREIGN KEY (Gruppe_FK) REFERENCES `Gruppe`(ID)
);

CREATE TABLE Bewertung(
	ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	Termin_FK INT UNSIGNED,
	Ampelstatus ENUM('Grün','Gelb','Rot') NOT NULL,
	Bewertung ENUM('+','-','0') NOT NULL,
	Kommentar VARCHAR(255), CONSTRAINT Bewertung_primär PRIMARY KEY (ID),
	CONSTRAINT `Termin wird bewertet` FOREIGN KEY (Termin_FK) REFERENCES `Termin`(ID)
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

SHOW WARNINGS;