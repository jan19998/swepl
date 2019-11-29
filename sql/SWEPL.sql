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
	ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	Benutzer VARCHAR(15) NOT NULL UNIQUE,
	Vorname VARCHAR(50) NOT NULL,
	Nachname VARCHAR(50) NOT NULL,
	Passwort VARCHAR(50) NOT NULL,
	IstDozent BOOL NOT NULL,
	`E-Mail` VARCHAR(50) NOT NULL, CONSTRAINT Benutzer_primär PRIMARY KEY (ID)
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

INSERT INTO Semester(Kennung) VALUES
('ws19/20');

INSERT INTO Gruppe(Gruppennummer,Semester_FK) VALUES
('e9','ws19/20');

INSERT INTO Student(Vorname,Nachname,Matrikelnummer,`E-Mail`,Semester_FK,Gruppe_FK) VALUES
('test1','test',111111111,'test1@testmail.com','ws19/20',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
('test2','test',111111112,'test2@testmail.com','ws19/20',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
('test3','test',111111113,'test3@testmail.com','ws19/20',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
('test4','test',111111114,'test4@testmail.com','ws19/20',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
('test5','test',111111115,'test5@testmail.com','ws19/20',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
('test6','test',111111116,'test6@testmail.com','ws19/20',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
('test7','test',111111117,'test7@testmail.com','ws19/20',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
('test8','test',111111118,'test8@testmail.com','ws19/20',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'));

INSERT INTO Meilenstein(Frist,Bezeichnung,Gruppe_FK) VALUES
(2019-10-2,'Lastenheft',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-10-3,'Lastenheft1',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-10-2,'Lastenheft',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-10-3,'Lastenheft1',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-10-2,'Lastenheft',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-10-3,'Lastenheft1',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-10-2,'Lastenheft',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-10-3,'Lastenheft1',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-10-2,'Lastenheft',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-10-3,'Lastenheft1',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-10-2,'Lastenheft',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-10-3,'Lastenheft1',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-10-2,'Lastenheft',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-10-3,'Lastenheft1',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-10-2,'Lastenheft',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-10-3,'Lastenheft1',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-10-4,'Lastenheft2',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'));
INSERT INTO Meilenstein(Frist,Beendet,Bezeichnung,`Status`,Gruppe_FK) VALUES
(2019-12-5,2019-12-2,'Kundenpräsentation', TRUE,(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-12-6,2019-12-2,'Kundenpräsentation1', TRUE,(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
(2019-12-7,2019-12-2,'Kundenpräsentation2', TRUE,(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'));

INSERT INTO Termin(Datum,Semester_FK,Gruppe_FK) VALUES
('2019-10-1','ws19/20',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
('2019-10-2','ws19/20',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
('2019-10-3','ws19/20',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
('2019-10-4','ws19/20',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
('2019-10-5','ws19/20',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
('2019-10-6','ws19/20',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
('2019-10-7','ws19/20',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')),
('2019-10-8','ws19/20',(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'));

INSERT INTO `ist bei`(Anwesend,Student_FK,Termin_FK) VALUES
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111111'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-1' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111111'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-2' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111111'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-3' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111111'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-4' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111111'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-5' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111111'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-6' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111111'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-7' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111111'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-8' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111112'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-1' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111112'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-2' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111112'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-3' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111112'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-4' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111112'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-5' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111112'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-6' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111112'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-7' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111112'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-8' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111113'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-1' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111113'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-2' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111113'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-3' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111113'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-4' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111113'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-5' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111113'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-6' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111113'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-7' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111113'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-8' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111114'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-1' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111114'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-2' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111114'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-3' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111114'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-4' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111114'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-5' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111114'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-6' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111114'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-7' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111114'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-8' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111115'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-1' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111115'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-2' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111115'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-3' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111115'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-4' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(TRUE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111115'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-5' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111115'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-6' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111115'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-7' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111115'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-8' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111116'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-1' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111116'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-2' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111116'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-3' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111116'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-4' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111116'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-5' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111116'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-6' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111116'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-7' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111116'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-8' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111117'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-1' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111117'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-2' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111117'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-3' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111117'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-4' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111117'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-5' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111117'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-6' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111117'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-7' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111117'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-8' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111118'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-1' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111118'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-2' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111118'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-3' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111118'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-4' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111118'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-5' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111118'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-6' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111118'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-7' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
(FALSE,(SELECT `ID` FROM `Student` WHERE `Matrikelnummer`='111111118'),(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-8' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')));

INSERT INTO Bewertung(Ampelstatus,Bewertung,Termin_FK) VALUES
('Grün','+',(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-1' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
('Gelb','-',(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-2' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
('Grün','-',(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-3' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
('Rot','0',(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-4' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
('Grün','0',(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-5' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
('Rot','+',(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-6' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
('Gelb','+',(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-7' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9'))),
('Grün','+',(SELECT `ID` FROM `Termin` WHERE `Datum`='2019-10-8' AND `Gruppe_FK`=(SELECT `ID` FROM `Gruppe` WHERE `Gruppennummer`='e9')));

SHOW WARNINGS;
