

document.addEventListener('DOMContentLoaded', () => {

    // Initial Recipe Data with Local Image + Online High-Res Fallback
    const initialRecipes = [
        {
            id: 1,
            title: "Fluffy Pancakes",
            category: "Breakfast",
            rating: 4.6,
            reviews: 120,
            image: "assets/images/fluffy_pancakes.jpg",
            fallbackImage: "https://images.unsplash.com/photo-1528207776546-365bb710ee93?q=80&w=800&auto=format&fit=crop",
            prepTime: "15 mins",
            ingredients: [
                "1 1/2 cups all-purpose flour",
                "3 1/2 tsp baking powder",
                "1 tbsp white sugar",
                "1 1/4 cups milk",
                "1 egg",
                "3 tbsp melted butter",
                "Fresh berries & maple syrup"
            ],
            instructions: "Whisk dry ingredients together. In another bowl, mix milk, egg, and melted butter. Combine wet and dry ingredients until just mixed. Pour batter onto hot greased griddle. Flip when bubbles form!"
        },
        {
            id: 2,
            title: "Chicken Biriyani",
            category: "Main Course",
            rating: 4.8,
            reviews: 98,
            image: "assets/images/chicken_biryani.jpg",
            fallbackImage: "https://images.unsplash.com/photo-1563379926898-05f4575a45d8?q=80&w=800&auto=format&fit=crop",
            prepTime: "45 mins",
            ingredients: [
                "500g Basmati rice",
                "700g Chicken cut pieces",
                "1 cup Yogurt (curd)",
                "2 large Onions sliced and fried",
                "2 tbsp Biryani spice mix",
                "Fresh mint & cilantro leaves",
                "Saffron milk"
            ],
            instructions: "Marinate chicken in yogurt and spices for 30 mins. Parboil basmati rice with whole spices. Layer marinated chicken and partially cooked rice with saffron, mint, and fried onions. Seal and cook on dum low heat for 25 mins."
        },
        {
            id: 3,
            title: "Spaghetti Carbonara",
            category: "Italian",
            rating: 4.5,
            reviews: 76,
            image: "assets/images/spaghetti_carbonara.jpg",
            fallbackImage: "https://images.unsplash.com/photo-1473093295043-cdd812d0e601?q=80&w=800&auto=format&fit=crop",
            prepTime: "25 mins",
            ingredients: [
                "400g Spaghetti pasta",
                "150g Pancetta or guanciale",
                "4 fresh egg yolks",
                "1 cup freshly grated Pecorino Romano",
                "Freshly cracked black pepper",
                "Salt for pasta water"
            ],
            instructions: "Boil spaghetti in salted water. Crisp pancetta in a skillet. Beat egg yolks with Pecorino cheese and black pepper. Toss hot pasta into pancetta, remove from heat, and stir in egg mixture quickly with starchy pasta water."
        },
        {
            id: 4,
            title: "Chocolate Cake",
            category: "Dessert",
            rating: 4.7,
            reviews: 64,
            image: "assets/images/chocolate_cake.jpg",
            fallbackImage: "https://images.unsplash.com/photo-1578985545062-69928b1d9587?q=80&w=800&auto=format&fit=crop",
            prepTime: "50 mins",
            ingredients: [
                "2 cups sugar",
                "1 3/4 cups all-purpose flour",
                "3/4 cup cocoa powder",
                "1 1/2 tsp baking powder & baking soda",
                "2 eggs",
                "1 cup milk",
                "1/2 cup vegetable oil",
                "1 cup boiling water / coffee"
            ],
            instructions: "Preheat oven to 350°F (175°C). Stir together sugar, flour, cocoa, baking powder/soda, and salt. Add eggs, milk, oil, and vanilla. Stir in boiling water. Bake for 30-35 mins until toothpick comes out clean."
        },
        {
            id: 5,
            title: "Veggie Stir Fry",
            category: "Asian",
            rating: 4.4,
            reviews: 52,
            image: "assets/images/veggie_stir_fry.jpg",
            fallbackImage: "https://images.unsplash.com/photo-1540420773420-3366772f4999?q=80&w=800&auto=format&fit=crop",
            prepTime: "20 mins",
            ingredients: [
                "1 cup broccoli florets",
                "1 red bell pepper sliced",
                "1 yellow bell pepper sliced",
                "1 cup snap peas & carrots",
                "3 tbsp soy sauce",
                "1 tbsp sesame oil & garlic",
                "Toasted sesame seeds"
            ],
            instructions: "Heat wok with sesame oil over high heat. Sauté minced garlic and ginger. Add tough vegetables like carrots and broccoli first, followed by peppers and snap peas. Pour soy sauce mixture and toss continuously for 4 mins."
        }
    ];

    let recipes = [...initialRecipes];
    let currentCategory = 'all';
    let searchQuery = '';

    // DOM Elements
    const recipesGrid = document.getElementById('recipesGrid');
    const heroSearchInput = document.getElementById('heroSearchInput');
    const heroSearchBtn = document.getElementById('heroSearchBtn');
    const categoryChips = document.querySelectorAll('.filter-chip');
    const browseRecipesBtn = document.getElementById('browseRecipesBtn');

    // Modals
    const recipeModal = document.getElementById('recipeModal');
    const recipeDetailBody = document.getElementById('recipeDetailBody');
    const closeRecipeModal = document.getElementById('closeRecipeModal');

    const addRecipeBtn = document.getElementById('addRecipeBtn');
    const addRecipeModal = document.getElementById('addRecipeModal');

    const toast = document.getElementById('toast');

    // Render Recipes with Fail-Safe Image Fallback
    function renderRecipes() {
        if (!recipesGrid) return;
        recipesGrid.innerHTML = '';

        const filtered = recipes.filter(recipe => {
            const matchesCategory = currentCategory === 'all' || recipe.category.toLowerCase() === currentCategory.toLowerCase();
            const matchesSearch = recipe.title.toLowerCase().includes(searchQuery.toLowerCase()) || 
                                  recipe.category.toLowerCase().includes(searchQuery.toLowerCase());
            return matchesCategory && matchesSearch;
        });

        if (filtered.length === 0) {
            recipesGrid.innerHTML = `
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: var(--text-muted);">
                    <i class="fa-solid fa-utensils" style="font-size: 3rem; margin-bottom: 16px; opacity: 0.5;"></i>
                    <h3>No recipes found</h3>
                    <p>Try searching for another dish or clear your filters.</p>
                </div>
            `;
            return;
        }

        filtered.forEach(recipe => {
            const card = document.createElement('div');
            card.className = 'recipe-card';
            card.setAttribute('data-id', recipe.id);
            card.innerHTML = `
                <div class="card-img-container">
                    <img src="${recipe.image}" 
                         onerror="this.onerror=null; this.src='${recipe.fallbackImage}';" 
                         alt="${recipe.title}" 
                         class="card-img" 
                         loading="lazy">
                    <span class="card-badge">${recipe.category}</span>
                </div>
                <div class="card-info">
                    <h3 class="card-title">${recipe.title}</h3>
                    <div class="card-rating">
                        <span class="star-icon">⭐</span>
                        <span>${recipe.rating.toFixed(1)}</span>
                        <span class="review-count">(${recipe.reviews})</span>
                    </div>
                </div>
            `;

            card.addEventListener('click', () => openRecipeDetail(recipe));
            recipesGrid.appendChild(card);
        });
    }

    // Open Recipe Detail Modal
    function openRecipeDetail(recipe) {
        recipeDetailBody.innerHTML = `
            <img src="${recipe.image}" 
                 onerror="this.onerror=null; this.src='${recipe.fallbackImage}';" 
                 alt="${recipe.title}" 
                 class="recipe-detail-img">
            <div class="recipe-detail-info">
                <div class="recipe-detail-header">
                    <div>
                        <h2 class="recipe-detail-title">${recipe.title}</h2>
                        <div class="recipe-meta-pills">
                            <span><i class="fa-solid fa-tag"></i> ${recipe.category}</span>
                            <span><i class="fa-solid fa-clock"></i> ${recipe.prepTime}</span>
                            <span><i class="fa-solid fa-star" style="color: var(--star-gold);"></i> ${recipe.rating} (${recipe.reviews})</span>
                        </div>
                    </div>
                </div>
                <div class="recipe-ingredients-list">
                    <h4>Ingredients</h4>
                    <ul>
                        ${recipe.ingredients.map(ing => `<li>${ing}</li>`).join('')}
                    </ul>
                </div>
                <div class="recipe-instructions">
                    <h4>Instructions</h4>
                    <p>${recipe.instructions}</p>
                </div>
            </div>
        `;
        openModal(recipeModal);
    }

    // Modal Helpers
    function openModal(modal) {
        if (!modal) return;
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modal) {
        if (!modal) return;
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Event Listeners
    if (heroSearchInput) {
        heroSearchInput.addEventListener('input', (e) => {
            searchQuery = e.target.value;
            renderRecipes();
        });
    }

    if (heroSearchBtn) {
        heroSearchBtn.addEventListener('click', () => {
            searchQuery = heroSearchInput.value;
            renderRecipes();
            document.getElementById('recipes').scrollIntoView({ behavior: 'smooth' });
        });
    }

    if (browseRecipesBtn) {
        browseRecipesBtn.addEventListener('click', () => {
            document.getElementById('recipes').scrollIntoView({ behavior: 'smooth' });
        });
    }

    // Category Filter Chips
    categoryChips.forEach(chip => {
        chip.addEventListener('click', () => {
            categoryChips.forEach(c => c.classList.remove('active'));
            chip.classList.add('active');
            currentCategory = chip.getAttribute('data-category');
            renderRecipes();
        });
    });

    if (closeRecipeModal) {
        closeRecipeModal.addEventListener('click', () => closeModal(recipeModal));
    }

    if (recipeModal) {
        recipeModal.addEventListener('click', (e) => {
            if (e.target === recipeModal) closeModal(recipeModal);
        });
    }

    // Initial Render
    renderRecipes();
});
