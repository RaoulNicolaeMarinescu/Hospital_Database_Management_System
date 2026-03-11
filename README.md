# Hospital Database Management System

A web-based **Hospital Database Management System** developed for the **Databases and Web course (2023/2024)**.

The project integrates a **PostgreSQL relational database** with a **PHP web interface** that allows users to query, insert, and update hospital data through a structured website.

---

# Author

**Raoul Nicolae Marinescu**

University of Milan
Course: *Databases and Web*

---

# Project Overview

The goal of this project is to model and manage the structure and operations of a hospital through a relational database and a web application.

The system allows interaction with hospital data such as:

* hospitals
* departments
* administrative staff
* nurses
* medical staff
* patients
* hospital admissions
* hospital discharges
* rooms
* operating rooms
* laboratories / clinics
* exams
* reservations

The application provides a web interface that allows users to perform **database queries and modifications through forms and structured navigation pages**.

---

# System Architecture

The project consists of two main components:

### Database Layer

A **PostgreSQL database** named:

```
ospedale
```

The database contains tables representing the entities and relationships of a hospital system.

Example entities include:

* Ospedale
* ProntoSoccorso
* Reparto
* PersonaleMedico
* Infermiere
* PersonaleAmministrativo
* Paziente
* PazienteRicoverato
* PazienteDimesso
* Stanza
* SalaOperatoria
* LaboratorioAmbulatorio
* Esame
* Prenotazione
* Primario
* VicePrimario

The schema defines:

* primary keys
* foreign keys
* integrity constraints
* domain checks

to guarantee data consistency.

---

# Web Application

The web application is built using:

* **PHP**
* **HTML**
* **SQL queries**

The interface allows users to perform different types of operations on the database through dedicated pages and forms.

---

# Website Navigation

The website structure is organized around a main homepage and a set of operation pages.

Main operations include:

### Select Operations

* View hospital staff organized by department
* View the hospitalization history of a patient

### Insert Operations

* Insert new staff members
* Insert new hospitals
* Insert new patients
* Insert new medical exams
* Insert new reservations

### Update Operations

* Update staff data
* Update hospital data
* Update patient data
* Update exam data
* Update reservation data

Each operation is handled through a dedicated PHP page that performs validation checks and executes the corresponding SQL queries.

---

# Database Constraints

The system includes several domain constraints to maintain logical consistency.

Examples include:

* hospitalized patients must always be assigned to a room
* occupied beds cannot exceed the total capacity
* booking urgency values are restricted
* booking cost regimes must belong to predefined categories
* medical leadership roles must follow hierarchical rules

These constraints are implemented using SQL checks and relational constraints.

---

# Technologies Used

* PostgreSQL
* SQL
* PHP
* HTML
* Apache (XAMPP environment)

---

# How to Run the Project

## 1 Create the database

Open PostgreSQL and create the database:

```
CREATE DATABASE ospedale;
```

## 2 Create the tables

Run the SQL script containing the table definitions.

## 3 Insert sample data

Execute the SQL script containing sample records.

## 4 Configure the web application

Place the project folder inside your local web server directory (for example inside `htdocs` if using XAMPP).

Example:

```
htdocs/Hospital_Database_Management_System
```

## 5 Start the server

Start Apache and PostgreSQL.

## 6 Open the website

Open your browser and go to:

```
http://localhost/Hospital_Database_Management_System/
```

---

# Example Features

The system allows:

* managing hospital staff
* managing patient information
* managing exams and bookings
* monitoring hospital departments
* querying patient medical history

---

# Educational Purpose

This project was developed for academic purposes to demonstrate knowledge of:

* conceptual database design
* ER modeling
* relational schema design
* SQL development
* database constraints
* web interfaces for database interaction
