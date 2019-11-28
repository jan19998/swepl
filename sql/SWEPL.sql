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
	Gruppe_FK INT UNSIGNED, CONSTRAINT `betreut_primär` PRIMARY KEY (Benutzer_FK,Gruppe_FK), 
	CONSTRAINT `Benutzer betreut Gruppe` FOREIGN KEY (Benutzer_FK) REFERENCES `Benutzer`(ID) ON DELETE CASCADE, 
	CONSTRAINT `Gruppe wird betreut` FOREIGN KEY (Gruppe_FK) REFERENCES `Gruppe`(ID) ON DELETE CASCADE
);

INSERT INTO Semester(Kennung) VALUES 
('ws19/20');

INSERT INTO Gruppe(Gruppennummer,Semester_FK) VALUES
('e9','ws19/20');

INSERT INTO Student(Vorname,Nachname,Matrikelnummer,`E-Mail`,Semester_FK,Gruppe_FK) VALUES 
('test1','test',111111111,'test@testmail.com','ws19/20',1),
('test2','test',111111112,'test@testmail.com','ws19/20',1),
('test3','test',111111113,'test@testmail.com','ws19/20',1),
('test4','test',111111114,'test@testmail.com','ws19/20',1),
('test5','test',111111115,'test@testmail.com','ws19/20',1),
('test6','test',111111116,'test@testmail.com','ws19/20',1),
('test7','test',111111117,'test@testmail.com','ws19/20',1),
('test8','test',111111118,'test@testmail.com','ws19/20',1);

INSERT INTO Meilenstein(Frist,Bezeichnung,Gruppe_FK) VALUES
(2019-10-2,'Lastenheft',1);
INSERT INTO Meilenstein(Frist,Beendet,Bezeichnung,`Status`,Gruppe_FK) VALUES
(2019-12-2,2019-12-2,'Kundenpräsentation', TRUE,1);

INSERT INTO Termin(Datum,Semester_FK,Gruppe_FK) VALUES
(2019-10-1,'ws19/20',1),
(2019-10-2,'ws19/20',1),
(2019-10-3,'ws19/20',1),
(2019-10-4,'ws19/20',1),
(2019-10-5,'ws19/20',1),
(2019-10-6,'ws19/20',1),
(2019-10-7,'ws19/20',1),
(2019-10-8,'ws19/20',1);

INSERT INTO `ist bei`(Anwesend,Student_FK,Termin_FK) VALUES 
(TRUE,1,1),
(FALSE,1,2),
(TRUE,1,3),
(TRUE,1,4),
(TRUE,1,5),
(TRUE,1,6),
(TRUE,1,7),
(TRUE,1,8),
(TRUE,2,1),
(FALSE,2,2),
(FALSE,2,3),
(TRUE,2,4),
(TRUE,2,5),
(TRUE,2,6),
(FALSE,2,7),
(FALSE,2,8),
(TRUE,3,1),
(FALSE,3,2),
(TRUE,3,3),
(FALSE,3,4),
(TRUE,3,5),
(TRUE,3,6),
(TRUE,3,7),
(FALSE,3,8),
(FALSE,4,1),
(FALSE,4,2),
(TRUE,4,3),
(FALSE,4,4),
(TRUE,4,5),
(FALSE,4,6),
(FALSE,4,7),
(TRUE,4,8),
(TRUE,5,1),
(TRUE,5,2),
(TRUE,5,3),
(FALSE,5,4),
(TRUE,5,5),
(FALSE,5,6),
(FALSE,5,7),
(FALSE,5,8),
(FALSE,6,1),
(FALSE,6,2),
(FALSE,6,3),
(FALSE,6,4),
(FALSE,6,5),
(FALSE,6,6),
(FALSE,6,7),
(FALSE,6,8),
(FALSE,7,1),
(FALSE,7,2),
(FALSE,7,3),
(FALSE,7,4),
(FALSE,7,5),
(FALSE,7,6),
(FALSE,7,7),
(FALSE,7,8),
(FALSE,8,1),
(FALSE,8,2),
(FALSE,8,3),
(FALSE,8,4),
(FALSE,8,5),
(FALSE,8,6),
(FALSE,8,7),
(FALSE,8,8);

INSERT INTO Bewertung(Ampelstatus,Bewertung,Termin_FK) VALUES
('Grün','+',1),
('Gelb','-',2),
('Grün','-',3),
('Rot','0',4),
('Grün','0',5),
('Rot','+',6),
('Gelb','+',7),
('Grün','+',8);
