# 🎓 Digital Recipe Book - Viva Preparation Guide & Q&A

මෙම ලේඛනය (Guide) ඔබගේ **Viva Exam / Oral Test** එකේදී අසන ඕනෑම ප්‍රශ්නයකට විශ්වාසයෙන් පිළිතුරු දීමට උපකාරී වේ.

---

## 📌 1. Project Overview (ව්‍යාපෘතිය පිළිබඳ කෙටි හැඳින්වීම)

**Q: What is this project and what technologies did you use?**
> **Answer (පිළිතුර):** 
> "This is a responsive web application called **Digital Recipe Book** built using **HTML5**, **CSS3**, and **Vanilla JavaScript**. It allows users to search, filter by category, and view detailed cooking recipes with responsive design across desktop and mobile devices."

---

## 🧱 2. HTML Structure Questions (HTML පිළිබඳ ප්‍රශ්න)

### Q1: What semantic HTML tags did you use in this project?
> **Answer:**
> We used standard HTML5 semantic elements:
> - `<header>`: Top navigation bar and logo.
> - `<nav>`: Navigation menu links.
> - `<main>`: Main content area.
> - `<section>`: Divided page sections (Hero, Popular Recipes, About).
> - `<footer>`: Bottom footer bar with social icons.

### Q2: How did you implement Font Awesome icons?
> **Answer:**
> We included Font Awesome CDN stylesheet in the `<head>` tag and used `<i class="fa-solid fa-..."></i>` tags to render icons like search, user login, and stars.

---

## 🎨 3. CSS & Styling Questions (CSS පිළිබඳ ප්‍රශ්න)

### Q1: How did you achieve responsive layout for different devices?
> **Answer:**
> We used **CSS Grid** for the recipe cards (`grid-template-columns: repeat(5, 1fr);`) combined with **CSS Media Queries** (`@media (max-width: 992px)`) so the grid automatically adjusts from 5 columns on desktop to 3 on tablets and 1 on mobile screens.

### Q2: What are CSS Variables and why did you use them?
> **Answer:**
> CSS variables (like `--primary-green: #257838` and `--primary-orange: #ee5d20`) allow us to store brand colors in one place (`:root`) and reuse them throughout the stylesheet for consistency and easy color theme updates.

### Q3: What layout models did you use (Flexbox vs Grid)?
> **Answer:**
> - **Flexbox (`display: flex;`)**: Used for one-dimensional layouts like the navbar, search capsule, and footer.
> - **CSS Grid (`display: grid;`)**: Used for two-dimensional layouts like the 5-column recipe cards grid and login page split container.

---

## ⚡ 4. JavaScript Logic Questions (JavaScript පිළිබඳ ප්‍රශ්න)

### Q1: How are the recipe cards loaded on the page?
> **Answer:**
> "All recipe data is stored in an array of JavaScript objects called `recipesData`. When the page loads (`DOMContentLoaded`), the function `displayRecipes()` loops through the array using `.forEach()`, generates HTML elements dynamically, and inserts them into the `#recipesGrid` div."

### Q2: How does the live search bar work?
> **Answer:**
> "We attach an `input` event listener to the search input. As the user types, it filters the `recipesData` array using JavaScript's `.filter()` method checking if the recipe title or category includes the search query, and re-renders the filtered list."

### Q3: How does category filtering work?
> **Answer:**
> "Each category filter chip button has a `data-category` attribute (e.g. `data-category="Italian"`). When clicked, JS updates the `currentCategory` variable, filters `recipesData`, and calls `displayRecipes()`."

### Q4: How does the image fallback work if an image fails to load?
> **Answer:**
> "We added an `onerror` attribute to `<img>` tags (`onerror="this.src='fallback_url'"`). If a local image path fails or isn't found, it automatically falls back to an online Unsplash image URL so the UI never breaks."

---

## 💡 Quick Summary Checklist for Viva

| Component | Technology / Method Used | Key Explanation |
| :--- | :--- | :--- |
| **Structure** | HTML5 Semantic Elements | Clean tags `<header>`, `<nav>`, `<section>` |
| **Styling** | Vanilla CSS3 | Flexbox, CSS Grid, Media Queries |
| **Data Storage** | JS Array of Objects | `recipesData = [{ title: '...', rating: 4.6 }]` |
| **DOM Manipulation** | `document.getElementById()` | Dynamic HTML insertion via `.innerHTML` |
| **Interactivity** | Event Listeners | `.addEventListener('click', ...)` & `.filter()` |

