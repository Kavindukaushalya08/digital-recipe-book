

const recipesData = [
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
        prepTime: "45 mins",
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
        prepTime: "25 mins",
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
        prepTime: "50 mins",
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
        prepTime: "20 mins",
        ingredients: [
            "1 cup broccoli",
            "1 bell pepper",
            "1 cup snap peas & carrots",
            "3 tbsp soy sauce",
            "1 tbsp sesame oil"
        ],
        instructions: "Stir-fry garlic and fresh vegetables in sesame oil on high heat. Add soy sauce and serve warm with sesame seeds."
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
                    <span class="card-badge">${recipe.category}</span>
                </div>
                <div class="card-info">
                    <h3 class="card-title">${recipe.title}</h3>
                    <div class="card-rating">
                        <span class="star-icon">⭐</span>
                        <span>${recipe.rating}</span>
                        <span class="review-count">(${recipe.reviews})</span>
                    </div>
                </div>
            `;

          
            cardElement.addEventListener('click', () => openRecipeModal(recipe));
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


    displayRecipes();
});
