# 📖 Digital Recipe Book

**Course:** ICT 1209 – Web Technologies  
**Department:** Department of ICT, Rajarata University of Sri Lanka  
**Batch:** 2024 Batch  
**Theme:** Digital Recipe Book (Interactive Web Application)

---

## 🌟 1. Project Overview
**Digital Recipe Book** is a full-stack interactive web application that allows users to discover, search, and share culinary recipes from around the world. Users can filter recipes by category, search in real-time, view detailed preparation steps and ingredients, register an account, and publish their own recipes.

---

## 🛠️ 2. Technology Stack
- **Frontend Structure & Styling:** HTML5, CSS3, Bootstrap 5, FontAwesome Icons
- **Client-Side Scripting:** Vanilla JavaScript (ES6)
- **Server-Side Scripting:** PHP 8
- **Database Management:** MySQL (via XAMPP / WAMP)
- **Version Control:** Git & GitHub

---

## 📁 3. Project Folder Structure
```text
digital-recipe-book/
├── assets/
│   ├── css/
│   │   └── style.css
│   └── images/
│       ├── chicken_biryani.jpg
│       ├── chocolate_cake.jpg
│       ├── fluffy_pancakes.jpg
│       ├── hero_pasta_dish.jpg
│       ├── spaghetti_carbonara.jpg
│       └── veggie_stir_fry.jpg
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

## 🚀 4. How to Setup & Run Using XAMPP

1. **Install XAMPP**: Download and install XAMPP from [apachefriends.org](https://www.apachefriends.org).
2. **Move Project Folder**: Copy the `digital-recipe-book` folder into your XAMPP `htdocs` directory:
   ```text
   C:\xampp\htdocs\digital-recipe-book
   ```
3. **Start Apache & MySQL**:
   - Open **XAMPP Control Panel**.
   - Click **Start** for **Apache** and **MySQL**.
4. **Import Database**:
   - Open your web browser and navigate to: `http://localhost/phpmyadmin`
   - Click **New** on the left sidebar to create a database named: `recipe_book`
   - Click on the newly created `recipe_book` database.
   - Go to the **Import** tab at the top.
   - Choose the `database.sql` file from the project root and click **Import**.
5. **Run the Application**:
   - In your browser, go to:
     ```text
     http://localhost/digital-recipe-book/index.php
     ```

---

## 🔐 5. Security & Features Implemented
- **Password Security:** BCRYPT Hashing using `password_hash()` and `password_verify()`.
- **SQL Injection Prevention:** Secure PDO Prepared Statements for all database queries.
- **Session Management:** Secure session initialization, `session_regenerate_id()`, and clean session termination upon logout.
- **Fail-Safe Image Rendering:** Local image loading with automatic online fallback URLs for 100% uptime.
- **Interactive UI:** Dynamic JS live filtering, modal recipe detail popups, and responsive layout for mobile, tablet, and desktop.
