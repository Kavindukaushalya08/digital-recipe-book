const recipesData = [
    {
        id: 1,
        title: "Fluffy Pancakes",
        category: "Breakfast",
        rating: 4.6,
        reviews: 120,
        image: "assets/images/fluffy_pancakes.jpg",
        fallbackImage: "https://images.unsplash.com/photo-1528207776546-365bb710ee93?q=80&w=800&auto=format&fit=crop",
        prepTime: "20 Min",
        ingredients: [
            "1 1/2 cups flour",
            "3 1/2 tsp baking powder",
            "1 tbsp sugar",
            "1 1/4 cups milk",
            "1 egg",
            "3 tbsp melted butter"
        ],
        instructions: "Mix dry ingredients. Add milk, egg, and melted butter. Cook on hot skillet until golden brown on both sides."
    },
    {
        id: 2,
        title: "Chicken Biriyani",
        category: "Main Course",
        rating: 4.8,
        reviews: 98,
        image: "assets/images/chicken_biryani.jpg",
        fallbackImage: "https://images.unsplash.com/photo-1563379926898-05f4575a45d8?q=80&w=800&auto=format&fit=crop",
        prepTime: "60 Min",
        ingredients: [
            "500g Basmati rice",
            "700g Chicken",
            "1 cup Yogurt",
            "2 Onions (fried)",
            "Biryani spices & herbs"
        ],
        instructions: "Marinate chicken with spices and yogurt. Parboil rice. Layer chicken and rice together and cook on low heat (Dum) for 25 mins."
    },
    {
        id: 3,
        title: "Spaghetti Carbonara",
        category: "Italian",
        rating: 4.5,
        reviews: 76,
        image: "assets/images/spaghetti_carbonara.jpg",
        fallbackImage: "https://images.unsplash.com/photo-1473093295043-cdd812d0e601?q=80&w=800&auto=format&fit=crop",
        prepTime: "30 Min",
        ingredients: [
            "400g Spaghetti",
            "150g Pancetta/Bacon",
            "4 Egg yolks",
            "1 cup Pecorino/Parmesan cheese",
            "Black pepper"
        ],
        instructions: "Boil spaghetti. Fry pancetta until crisp. Mix egg yolks with cheese. Toss hot pasta into pancetta, remove from heat, and mix in egg sauce."
    },
    {
        id: 4,
        title: "Chocolate Cake",
        category: "Dessert",
        rating: 4.7,
        reviews: 64,
        image: "assets/images/chocolate_cake.jpg",
        fallbackImage: "https://images.unsplash.com/photo-1578985545062-69928b1d9587?q=80&w=800&auto=format&fit=crop",
        prepTime: "45 Min",
        ingredients: [
            "2 cups sugar",
            "1 3/4 cups flour",
            "3/4 cup cocoa powder",
            "2 eggs",
            "1 cup milk",
            "1/2 cup vegetable oil"
        ],
        instructions: "Mix dry ingredients. Add eggs, milk, oil, and vanilla. Stir in boiling water. Bake at 350°F (175°C) for 35 minutes."
    },
    {
        id: 5,
        title: "Veggie Stir Fry",
        category: "Asian",
        rating: 4.4,
        reviews: 52,
        image: "assets/images/veggie_stir_fry.jpg",
        fallbackImage: "https://images.unsplash.com/photo-1540420773420-3366772f4999?q=80&w=800&auto=format&fit=crop",
        prepTime: "25 Min",
        ingredients: [
            "1 cup broccoli",
            "1 bell pepper",
            "1 cup snap peas & carrots",
            "3 tbsp soy sauce",
            "1 tbsp sesame oil"
        ],
        instructions: "Stir-fry garlic and fresh vegetables in sesame oil on high heat. Add soy sauce and serve warm with sesame seeds."
    },
    {
        id: 6,
        title: "Tomato Soup",
        category: "Dinner",
        rating: 4.3,
        reviews: 45,
        image: "assets/images/tomato_soup.jpg",
        fallbackImage: "https://images.unsplash.com/photo-1547592166-23ac45744acd?q=80&w=800&auto=format&fit=crop",
        prepTime: "20 Min",
        ingredients: [
            "2 lbs tomatoes",
            "1 onion",
            "2 cloves garlic",
            "1 cup vegetable broth",
            "1/4 cup cream"
        ],
        instructions: "Roast tomatoes, onion, and garlic. Blend with broth until smooth. Stir in cream and heat gently."
    },
    {
        id: 7,
        title: "Grilled Salmon",
        category: "Dinner",
        rating: 4.6,
        reviews: 82,
        image: "assets/images/grilled_salmon.jpg",
        fallbackImage: "https://images.unsplash.com/photo-1485921325833-c519f76c4927?q=80&w=800&auto=format&fit=crop",
        prepTime: "35 Min",
        ingredients: [
            "2 salmon fillets",
            "1 lemon",
            "2 tbsp olive oil",
            "Salt & pepper",
            "Fresh herbs"
        ],
        instructions: "Marinate salmon with olive oil, lemon juice, salt, and pepper. Grill for 4-5 minutes per side until flaky."
    },
    {
        id: 8,
        title: "Fruit Salad",
        category: "Dessert",
        rating: 4.2,
        reviews: 30,
        image: "assets/images/fruit_salad.jpg",
        fallbackImage: "https://images.unsplash.com/photo-1490474418585-ba9bad8fd0ea?q=80&w=800&auto=format&fit=crop",
        prepTime: "15 Min",
        ingredients: [
            "1 cup strawberries",
            "1 cup blueberries",
            "1 cup pineapple chunks",
            "1/2 cup grapes",
            "1 tbsp honey"
        ],
        instructions: "Wash and chop all fruits. Toss gently in a bowl. Drizzle with honey and serve chilled."
    }
];

document.addEventListener('DOMContentLoaded', () => {
    
    const recipesGrid = document.getElementById('recipesGrid');
    const heroSearchInput = document.getElementById('heroSearchInput');
    const heroSearchBtn = document.getElementById('heroSearchBtn');
    const categoryChips = document.querySelectorAll('.filter-chip');
    const browseRecipesBtn = document.getElementById('browseRecipesBtn');
    
    const recipeModal = document.getElementById('recipeModal');
    const recipeDetailBody = document.getElementById('recipeDetailBody');
    const closeRecipeModal = document.getElementById('closeRecipeModal');

    let currentCategory = 'all';
    let currentSearchTerm = '';

    function displayRecipes() {
        if (!recipesGrid) return;
        
        recipesGrid.innerHTML = '';

        const filteredList = recipesData.filter(recipe => {
            const matchesCategory = (currentCategory === 'all') || (recipe.category.toLowerCase() === currentCategory.toLowerCase());
            const matchesSearch = recipe.title.toLowerCase().includes(currentSearchTerm.toLowerCase()) || 
                                  recipe.category.toLowerCase().includes(currentSearchTerm.toLowerCase());
            return matchesCategory && matchesSearch;
        });

        if (filteredList.length === 0) {
            recipesGrid.innerHTML = `<p style="grid-column: 1/-1; text-align: center; color: #777; padding: 40px;">No recipes match your search.</p>`;
            return;
        }

        filteredList.forEach(recipe => {
            const cardElement = document.createElement('div');
            cardElement.className = 'recipe-card';
            cardElement.innerHTML = `
                <div class="card-img-container">
                    <img src="${recipe.image}" 
                         onerror="this.onerror=null; this.src='${recipe.fallbackImage}';" 
                         alt="${recipe.title}" 
                         class="card-img">
                </div>
                <div class="card-info" style="display: flex; flex-direction: column;">
                    <h3 class="card-title" style="margin-bottom: 10px;">${recipe.title}</h3>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto;">
                        <i class="fa-regular fa-heart" style="font-size: 1.2rem; cursor: pointer;"></i>
                        <div class="card-meta" style="font-size: 0.9rem; color: #333; font-weight: 600; text-align: right;">
                            ${recipe.prepTime} &nbsp;|&nbsp; ⭐ ${recipe.rating}
                        </div>
                    </div>
                </div>
            `;

            cardElement.addEventListener('click', () => {
                window.location.href = 'recipe-details.html?id=' + recipe.id;
            });
            recipesGrid.appendChild(cardElement);
        });
    }

    function openRecipeModal(recipe) {
        recipeDetailBody.innerHTML = `
            <img src="${recipe.image}" 
                 onerror="this.onerror=null; this.src='${recipe.fallbackImage}';" 
                 alt="${recipe.title}" 
                 class="recipe-detail-img">
            <div style="padding: 24px;">
                <h2 style="font-size: 1.8rem; margin-bottom: 12px;">${recipe.title}</h2>
                <p style="color: #666; margin-bottom: 16px;">
                    <strong>Category:</strong> ${recipe.category} &nbsp;|&nbsp; 
                    <strong>Time:</strong> ${recipe.prepTime} &nbsp;|&nbsp; 
                    <strong>Rating:</strong> ⭐ ${recipe.rating}
                </p>
                <h4 style="margin-bottom: 8px; font-size: 1.1rem;">Ingredients:</h4>
                <ul style="margin-bottom: 20px; padding-left: 20px;">
                    ${recipe.ingredients.map(item => `<li>${item}</li>`).join('')}
                </ul>
                <h4 style="margin-bottom: 8px; font-size: 1.1rem;">Instructions:</h4>
                <p style="color: #444; line-height: 1.6;">${recipe.instructions}</p>
            </div>
        `;
        recipeModal.classList.add('active');
    }

    if (heroSearchInput) {
        heroSearchInput.addEventListener('input', (e) => {
            currentSearchTerm = e.target.value;
            displayRecipes();
        });
    }

    if (heroSearchBtn) {
        heroSearchBtn.addEventListener('click', () => {
            currentSearchTerm = heroSearchInput.value;
            displayRecipes();
            document.getElementById('recipes').scrollIntoView({ behavior: 'smooth' });
        });
    }

    if (browseRecipesBtn) {
        browseRecipesBtn.addEventListener('click', () => {
            document.getElementById('recipes').scrollIntoView({ behavior: 'smooth' });
        });
    }

    categoryChips.forEach(chip => {
        chip.addEventListener('click', () => {
            categoryChips.forEach(c => c.classList.remove('active'));
            chip.classList.add('active');
            currentCategory = chip.getAttribute('data-category');
            displayRecipes();
        });
    });

    if (closeRecipeModal) {
        closeRecipeModal.addEventListener('click', () => {
            recipeModal.classList.remove('active');
        });
    }

    if (recipeModal) {
        recipeModal.addEventListener('click', (e) => {
            if (e.target === recipeModal) {
                recipeModal.classList.remove('active');
            }
        });
    }

    const sidebarItems = document.querySelectorAll('.sidebar-item');
    if (sidebarItems.length > 0) {
        sidebarItems.forEach(item => {
            item.addEventListener('click', () => {
                sidebarItems.forEach(i => i.classList.remove('active'));
                item.classList.add('active');
                currentCategory = item.getAttribute('data-category');
                displayRecipes();
            });
        });
    }

    const recipesPageSearch = document.getElementById('recipesPageSearch');
    const recipesPageSearchBtn = document.getElementById('recipesPageSearchBtn');
    
    if (recipesPageSearch) {
        recipesPageSearch.addEventListener('input', (e) => {
            currentSearchTerm = e.target.value;
            displayRecipes();
        });
    }
    if (recipesPageSearchBtn) {
        recipesPageSearchBtn.addEventListener('click', () => {
            currentSearchTerm = recipesPageSearch.value;
            displayRecipes();
        });
    }

    const addRecipeBtn = document.getElementById('addRecipeBtn');
    if (addRecipeBtn) {
        addRecipeBtn.addEventListener('click', () => {
            window.location.href = 'add-recipe.html';
        });
    }

    const addRecipeForm = document.getElementById('addRecipeForm');
    if (addRecipeForm) {
        addRecipeForm.addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Recipe submitted successfully! Waiting for admin approval.');
            addRecipeForm.reset();
        });
    }
    
    const fileUploadBox = document.getElementById('fileUploadBox');
    const recipeImageInput = document.getElementById('recipeImage');
    
    if (fileUploadBox && recipeImageInput) {
        fileUploadBox.addEventListener('click', () => {
            recipeImageInput.click();
        });
        
        recipeImageInput.addEventListener('change', (e) => {
            if (e.target.files && e.target.files[0]) {
                const fileName = e.target.files[0].name;
                fileUploadBox.innerHTML = '<i class="fa-solid fa-check-circle" style="color: #27ae60;"></i><p><strong>' + fileName + '</strong> selected</p>';
                fileUploadBox.style.borderColor = '#27ae60';
            }
        });
    }

    const recipeDetailsContainer = document.getElementById('recipeDetailsContainer');
    
    if (recipeDetailsContainer) {
        const urlParams = new URLSearchParams(window.location.search);
        const recipeId = parseInt(urlParams.get('id'));
        
        const recipe = recipesData.find(r => r.id === recipeId);
        
        if (recipe) {
            const description = "These " + recipe.title.toLowerCase() + " are soft, light and perfect for a delicious meal. Serve with your favourite side and enjoy!";
            const difficulty = "Easy";
            const servings = 4;
            
            let instructionsArray = recipe.instructions.split('. ');
            let instructionsHtml = '';
            instructionsArray.forEach((step, index) => {
                if (step.trim()) {
                    let cleanStep = step.trim();
                    if (!cleanStep.endsWith('.')) cleanStep += '.';
                    instructionsHtml += `<li class="instruction-item">
                        <span class="instruction-number">${index + 1}</span>
                        <span class="instruction-text">${cleanStep}</span>
                    </li>`;
                }
            });

            recipeDetailsContainer.innerHTML = `
                <div class="details-col-left">
                    <img src="${recipe.image}" 
                         onerror="this.onerror=null; this.src='${recipe.fallbackImage}';" 
                         alt="${recipe.title}" 
                         class="details-main-img">
                    
                    <h1 class="details-title">${recipe.title}</h1>
                    
                    <div class="details-meta-row">
                        <div class="details-meta-item">⭐ ${recipe.rating}</div>
                        <div class="details-meta-item">⏱ ${recipe.prepTime}</div>
                        <div class="details-meta-item">👥 ${servings} servings</div>
                        <div class="details-meta-item">🟢 ${difficulty}</div>
                    </div>
                    
                    <h3 class="details-heading">Description</h3>
                    <p class="details-description">${description}</p>
                </div>
                
                <div class="details-col-right">
                    <h3 class="details-heading">Ingredients</h3>
                    <ul class="ingredients-list">
                        ${recipe.ingredients.map(item => `<li>${item}</li>`).join('')}
                    </ul>
                    
                    <h3 class="details-heading">Instructions</h3>
                    <ul class="instructions-list">
                        ${instructionsHtml}
                    </ul>
                </div>
            `;
        } else {
            recipeDetailsContainer.innerHTML = `<div style="grid-column: 1/-1; text-align: center; padding: 50px;">
                <h2>Recipe not found</h2>
                <a href="recipes.html" style="color: #257838; margin-top: 20px; display: inline-block;">Browse all recipes</a>
            </div>`;
        }
    }

    displayRecipes();
});
