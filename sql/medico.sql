drop database if exists medico;

CREATE DATABASE medico;

USE medico;
CREATE TABLE ADMIN_LOGIN (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(60) NOT NULL,
    password VARCHAR(225) NOT NULL
);

INSERT INTO ADMIN_LOGIN(email,password) values('admin@gov.com',"$2y$10$c7CFSjKUkXm8DVRFD.0jqufuNXt7modU/9aZjO6z7AY4xR/T32KPi");


CREATE TABLE Visitor (
    visitor_id MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    v_fname VARCHAR(30) NOT NULL,
    v_lname VARCHAR(50) NOT NULL,
    relationship VARCHAR(30) NOT NULL,
    patient_name VARCHAR(60) NOT NULL,
    sex ENUM('Male', 'Female') NOT NULL,
    v_ph_number VARCHAR(13) NOT NULL,
    time_of_visit TIME NOT NULL,
    date_of_visit DATE NOT NULL
);

CREATE TABLE patients (
    patientid TINYINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    firstname VARCHAR(25),
    lastname VARCHAR(25),
    Height DECIMAL(8 , 2 ) NOT NULL,
    Weight DECIMAL(8 , 2 ) NOT NULL,
    Marital_Status ENUM('Single', 'Married') NOT NULL,
    Nationality VARCHAR(80) NOT NULL,
    Sex ENUM('Male', 'Female') NOT NULL,
    DOB DATE NOT NULL,
    patient_tel VARCHAR(15) DEFAULT NULL,
    healthID VARCHAR(15),
    BMI VARCHAR(5),
    bloodtype ENUM('A', 'B', 'AB', 'O') NOT NULL,
    address_street VARCHAR(50) NOT NULL,
    address_city VARCHAR(60) NOT NULL,
    address_region VARCHAR(80) NOT NULL,
    address_postal_code VARCHAR(30) NOT NULL,
    image VARCHAR(100) NOT NULL
);

CREATE TABLE Employees (
    Employee_ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Employee_fname VARCHAR(20) NOT NULL,
    Employee_lname VARCHAR(50) NOT NULL,
    Dept_name VARCHAR(100) NOT NULL,
    nationality VARCHAR(100) NOT NULL,
    work_commence_date DATE NOT NULL,
    email VARCHAR(100) NOT NULL,
    emp_tel VARCHAR(15) NOT NULL,
    Job VARCHAR(30) NOT NULL,
    sex ENUM('Male', 'Female') NOT NULL,
    Marital_Status ENUM('Single', 'Married') NOT NULL,
    level_of_education VARCHAR(100) NOT NULL,
    Salary DECIMAL(13 , 2 ) NOT NULL,
    DOB DATE NOT NULL,
    SSN VARCHAR(15) NOT NULL,
    address_street VARCHAR(50) NOT NULL,
    address_city VARCHAR(60) NOT NULL,
    address_region VARCHAR(80) NOT NULL,
    address_postal_code VARCHAR(30) NOT NULL
);




CREATE TABLE medical_report (
    report_no INT AUTO_INCREMENT,
    patientid TINYINT NOT NULL,
    Asthma ENUM('yes', 'no') NOT NULL,
    SDG ENUM('yes', 'no'),
    Allergies ENUM('yes', 'no'),
    time_recorded TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (report_no),
    FOREIGN KEY (patientid)
        REFERENCES patients (patientid)
);



