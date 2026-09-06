# RAJARATA UNIVERSITY OF SRI LANKA
## Department of ICT – Faculty of Technology
### ICT 1209: Web Technologies – Mini Project Final Report

---

# DIGITAL RECIPE BOOK
### Interactive, Database-Driven Web Application

**Course Code:** ICT 1209 – Web Technologies  
**Batch:** 2024 Batch (First Year, Bachelor of ICT)  
**Date of Submission:** 7th September 2026  
**GitHub Repository Link:** [https://github.com/Kavindukaushalya08/digital-recipe-book](https://github.com/Kavindukaushalya08/digital-recipe-book)  

---

## 1. Project Overview

### 1.1 Purpose and Goals
The **Digital Recipe Book** is a full-stack, database-driven interactive web application developed to solve the common issue of disorganized, fragmented culinary recipes found across the internet. The goal of this application is to offer food enthusiasts, home cooks, and chefs a clean, centralized, and user-friendly platform to browse, search, filter, and publish recipes.

### 1.2 Target Audience
- Home cooks looking for quick step-by-step cooking guides.
- Food enthusiasts seeking diverse cuisines (Breakfast, Lunch, Dinner, Desserts, Asian, Italian).
- Community contributors who wish to share their own culinary recipes.

### 1.3 Key Features
1. **Interactive Search & Category Filtering:** Instant dynamic recipe filtering by keywords and culinary categories (Breakfast, Lunch, Dinner, Dessert, Snacks).
2. **Recipe Detail Modals:** Clickable recipe cards opening dynamic modal popups with ingredients, cooking instructions, and preparation time.
3. **User Authentication & Session Handling:** Secure user registration with BCRYPT password hashing and session-protected dashboard.
4. **Recipe Publishing Dashboard:** Authenticated users can publish recipes directly into the MySQL database.
5. **Contact Inquiries Form:** Visitor messaging system stored in the database.
6. **Responsive Design:** Fluid layout across desktop, tablet, and mobile displays.

---

## 2. System Design & Architecture

### 2.1 Technology Stack
- **Frontend Layer:** HTML5, CSS3, Bootstrap 5, FontAwesome 6
- **Client Logic:** Vanilla JavaScript (ES6)
- **Server-Side Backend:** PHP 8
- **Database:** MySQL 8.0 (via XAMPP)
- **Version Control:** Git & GitHub

### 2.2 Database Schema (`recipe_book`)
The relational database contains three normalized tables:

1. **`users` Table:**
   - `id` (INT, Primary Key, Auto Increment)
   - `username` (VARCHAR(50), Unique, Not Null)
   - `email` (VARCHAR(100), Unique, Not Null)
   - `password` (VARCHAR(255), Not Null — BCRYPT Hash)
   - `created_at` (TIMESTAMP, Default Current Timestamp)

2. **`recipes` Table:**
   - `id` (INT, Primary Key, Auto Increment)
   - `title` (VARCHAR(150), Not Null)
   - `category` (VARCHAR(50), Not Null)
   - `prep_time` (VARCHAR(30), Not Null)
   - `rating` (DECIMAL(3,1), Default 4.5)
   - `reviews` (INT, Default 10)
   - `ingredients` (TEXT, Not Null)
   - `instructions` (TEXT, Not Null)
   - `image` (VARCHAR(255))
   - `user_id` (INT, Foreign Key referencing `users(id)`)
   - `created_at` (TIMESTAMP)

3. **`messages` Table:**
   - `id` (INT, Primary Key, Auto Increment)
   - `name` (VARCHAR(100), Not Null)
   - `email` (VARCHAR(100), Not Null)
   - `message` (TEXT, Not Null)
   - `created_at` (TIMESTAMP)

### 2.3 Folder Structure
```text
digital-recipe-book/
├── assets/
│   ├── css/style.css
│   └── images/
├── auth/
│   ├── login.php
│   ├── logout.php
│   └── register.php
├── includes/
│   ├── db.php
│   └── functions.php
├── app.js
├── contact.php
├── dashboard.php
├── database.sql
├── index.html
├── index.php
├── login.html
├── recipes.html
├── styles.css
└── README.md
```

---

## 3. Implementation Details

### 3.1 Security & Backend Logic
- **Prepared Statements:** All database queries utilize PDO prepared statements (`$stmt = $pdo->prepare(...)`) with bound parameters to eliminate SQL Injection risks.
- **Password Hashing:** Passwords are never stored as plain text. The system employs `password_hash($password, PASSWORD_DEFAULT)` and validates via `password_verify()`.
- **Session Protection:** After successful authentication, `session_regenerate_id(true)` prevents session fixation attacks.

### 3.2 Frontend & Client Logic
- **Live Filtering:** Array filtering via JavaScript's `.filter()` method bound to `input` and `click` event listeners.
- **Fail-Safe Fallbacks:** Image elements are equipped with `onerror` event triggers to fallback to high-resolution web assets if local files are detached.

---

## 4. Challenges and Solutions

| Challenge | Cause | Solution Implemented |
| :--- | :--- | :--- |
| Broken Images when opening standalone HTML | Local relative image paths missed during unzipping | Implemented dual-layer image fallback with automatic online URLs |
| SQL Injection Vulnerabilities | Direct string concatenation in queries | Enforced PDO Prepared Statements across all queries |
| Multi-device Responsive Layout | Varying screen viewports | Utilized CSS Grid with media queries (`repeat(4, 1fr)` to `repeat(1, 1fr)`) |

---

## 5. Individual Contribution Breakdown

| Team Member | Tasks & Responsibilities | Percentage |
| :--- | :--- | :--- |
| **Member 1 (Kavindu Kaushalya)** | Frontend UI/UX Design, HTML5/CSS3 Layout, JavaScript Client Logic & Filtering | 50% |
| **Member 2 (Group Partner)** | PHP 8 Backend Integration, MySQL Database Design, Authentication & Report Writing | 50% |

---

## 6. Setup Instructions (Running via XAMPP)

1. Ensure **XAMPP** is installed with Apache and MySQL services active.
2. Copy the `digital-recipe-book` directory into `C:\xampp\htdocs\`.
3. Open `http://localhost/phpmyadmin` in your web browser.
4. Create a database named `recipe_book` and import the `database.sql` file.
5. Access the application at: `http://localhost/digital-recipe-book/index.php`.

---

## 7. References
1. MDN Web Docs (2026). *HTML5 & CSS3 Standard Specifications*. Mozilla.
2. The PHP Group (2026). *PHP Data Objects (PDO) Manual & Password Hashing API*.
3. Bootstrap Documentation (2026). *Bootstrap v5.3 Responsive Grid Framework*.
