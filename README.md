# Mini Task Management System

A full-stack web application built with Laravel 10 for managing projects and tracking task progress. This system features secure user authentication, project data isolation, dynamic progress tracking, and a responsive dark-themed dashboard. 

Developed as part of the technical assessment for the Junior Fullstack Developer position at Telediant.

## Project Description
This application allows users to create and manage multiple projects, each containing their own specific tasks. The system automatically calculates and displays the completion percentage for each project based on the real-time status of its nested tasks (To Do, In Progress, Done). 

**Key Features:**
* **Authentication & Security:** Secure user registration, login, and session management using Laravel Breeze.
* **Data Isolation:** Strict relationship mapping ensures users can only view, edit, and delete their own projects and tasks.
* **Dynamic Dashboard:** A high-level overview displaying total project metrics, task status breakdowns, and a dynamically sorted "Recently Updated Projects" table.
* **Relational Timestamps:** Updating a task automatically touches the parent project's timestamp, bubbling recent activity up to the dashboard.
* **Polished UI:** A cohesive, responsive Tailwind CSS dark theme with custom progress bars and hover states.

---

## Prerequisites
Ensure your local development environment has the following installed:
* PHP >= 8.1
* Composer
* Node.js & npm
* MySQL (via Laragon, XAMPP, or native)

---

## Setup & Installation Instructions

**1. Clone the repository**
```bash
git clone https://github.com/RieSyaf/laravel-mini-task-manager.git
cd mini-task-manager
```

**2. Install PHP dependencies**
```bash
composer install
```

**3. Install and compile frontend assets**
```bash
npm install
npm run build
```

**4. Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
```



## Database Setup Steps

**1. Create the Database**
* Open your preferred MySQL client and create a new, empty database named mini_task_manager

**2. Configure Environment Variables**
* Open the .env file in the root of the project and update the database connection variables to match your local setup:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_task_manager
DB_USERNAME=root
DB_PASSWORD=
```

**3. Run Migrations and Seed the Database**
* Execute the following command to build the relational tables and populate the system with realistic test data (including projects, tasks, and calculated progress bars):
```bash
php artisan migrate:fresh --seed
```

**4. Start the Application**
* Launch the local development server:
```bash
php artisan serve
```


## Reviewer Testing Credentials
**To easily evaluate the application and view the dynamic dashboard without manually creating data, please log in using the pre-seeded reviewer account:**
* Email : test@example.com
* Password : testpass123

