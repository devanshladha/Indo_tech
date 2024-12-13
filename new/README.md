# CreateX Project

CreateX is a dynamic web application designed to support multiple features, including quiz games (both rewarding and non-rewarding), artefact selling, artisan profiles, item listings, and a digital museum. The application is intended to run on a local server using XAMPP and a MySQL database.

## Table of Contents
- [Requirements](#requirements)
- [Installation](#installation)
  - [Step 1: Download and Install XAMPP](#step-1-download-and-install-xampp)
  - [Step 2: Clone the Repository](#step-2-clone-the-repository)
  - [Step 3: Move to the Project Directory](#step-3-move-to-the-project-directory)
- [Database Setup](#database-setup)
  - [Step 1: Start Apache and MySQL](#step-1-start-apache-and-mysql)
  - [Step 2: Create a Database](#step-2-create-a-database)
  - [Step 3: Import Database Schema](#step-3-import-database-schema)
  - [Step 4: Update Database Configuration](#step-4-update-database-configuration)
- [Running the Application](#running-the-application)
  - [Step 1: Open Your Web Browser](#step-1-open-your-web-browser)
  - [Step 2: Access Different Pages](#step-2-access-different-pages)
- [Features](#features)
- [Folder Structure](#folder-structure)

## Requirements
- XAMPP (Apache and MySQL)
- PHP 7.4 or higher
- A web browser (Chrome, Firefox, etc.)

## Installation

### Step 1: Download and Install XAMPP
1. Download XAMPP from the [official website](https://www.apachefriends.org/index.html).
2. Install XAMPP, ensuring that both Apache and MySQL are selected during installation.

### Step 2: Clone the Repository
Clone this repository to your local machine using Git.

```bash
git clone https://github.com/devanshladha/Indo_tech.git
```

## Step 3: Move to the Project Directory
Move the cloned repository to the htdocs/projects/createX 24/ directory within your XAMPP installation folder. The exact path will depend on where XAMPP is installed on your machine.

For example, on a Windows machine, this might be:

```bash
C:\xampp\htdocs\projects\createX 24\
```
On a Mac or Linux machine, it might be:

```bash
/Applications/XAMPP/htdocs/projects/createX 24\
```

Make sure the projects/createX 24/ directory is within the htdocs directory, as that's where XAMPP serves files from.

## Database Setup
### Step 1: Start Apache and MySQL
Open the XAMPP Control Panel.
Start the Apache and MySQL services by clicking on the "Start" buttons next to each.
### Step 2: Create a Database
Open your web browser and go to ```http://localhost/phpmyadmin.```
Click on the "New" button in the left sidebar to create a new database.
Name the database createx and click "Create."
### Step 3: Import Database Schema
In phpMyAdmin, select the createx database from the left sidebar.
Click on the "Import" tab at the top.
Click "Choose File" and select the ```createx.sql``` file located in the ```sql``` directory of the project.
Click "Go" to import the database schema into MySQL.
### Step 4: Update Database Configuration
Open the connection.php file located in the root directory of the project.
Update the following values if necessary:
```bash
$servername = "localhost";
$username = "root"; //default for XAMPP
$password = ""; //default for XAMPP, leave empty unless you have set a password
$dbname = "createx";
```

## Running the Application
### Step 1: Open Your Web Browser
After completing the setup, open your web browser and go to http://localhost/projects/createX%2024/new/ to access the home page of the application.

### Step 2: Access Different Pages
Daily Quiz: Access the daily quiz game at http://localhost/projects/createX%2024/new/games/daily_quiz.php.
Artisan Dashboard: Access the artisan dashboard at http://localhost/projects/createX%2024/new/artefacts/artisans.php.
Profile Page: Access the user profile page at http://localhost/projects/createX%2024/new/auth/profile.php.

## Features
Daily Quiz: Answer a new quiz question each day and earn rewards. The quiz game could include both rewarding and non-rewarding options.
Artefacts Platform: Artisans can upload items, manage their profiles, view their sales, and interact with their customers.
Profile Management: Users can update their profiles, including uploading a profile picture.
Artist Profiles: View detailed profiles of artisans, including their artworks and items for sale to promote there art work.
Item Listings: Users can view and purchase items listed by artisans.
Digital Museum: View artifacts in a virtual museum format.

## Folder Structure
```bash
new/
│
├── auth/
│   ├── profile.php
│   ├── Login3d.php
│   ├── login_user.php
│   ├── logout.php
│   ├── register.php
│   ├── register_artisan.php
│   ├── register_artisan_auth.php
│   ├── register_uaer.php
│   ├── signup.php
│   ├── sign_user.php
│   ├── style.css
│   ├── login.png
│
├── artefacts/
│   ├── artefacts.php
│   ├── artisans_dash.php
│   ├── artisans_details.php
│   ├── artefact_detail.php
│   ├── update_profile.php
│   ├── upload_item.php
│   ├── style_artefacts.css
│   ├── artefacts_img/
├── games/
│   ├── daily_quiz.php
│   ├── daily_quiz_check.php
│   ├── games.php
│   ├── questions.json
│   ├── quiz_game.php
│   ├── reward.php
│   ├── script.js
│   ├── send_answer.php
│   ├── style_game.css
│   ├── style.css
├── sql/
│   └── createx.sql
├── explore/
│   ├── explore.php
│   ├── style_explore.css
│   ├── style.css
│   ├── script.js
│   └── src/
├── community/
│   ├── index.php
│   ├── script.js
│   └── style.css
├── digim/
│   ├── style.css
│   └── style.css
├── profile/
│   ├── artisans
│   ├── user
│   └── profile_img.png
├── connection.php
├── definition.php
├── digital_museum.php
├── nav.php
├── README.md
├── index.php
├── utility.css
├── index.css
└── src/
```
- index.php: The main landing page of the application.
- auth/: Contains authentication-related files, like user profile management.
- artefacts/: Contains artefacts-related pages, such as the dashboard and item management.
- games/: Contains game-related pages like the quiz games.
- sql/: Contains SQL files, such as the database schema (createx.sql).
- src/: Directory for storing uploaded images or files, such as profile pictures or artwork.
- connection.php: Contains the database connection settings.

With this setup, you should now be able to run and test the CreateX project on your local server using XAMPP.
If you encounter any issues during the setup or running the application, feel free to refer back to the README or ask for help!
