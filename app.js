

const recipesData = [
    {
        id: 1,
        title: "Fluffy Pancakes",
        category: "Breakfast",
        rating: 4.6,
        reviews: 120,
        image: "assets/images/fluffy_pancakes.jpg",
        fallbackImage: "https://images.unsplash.com/photo-1528207776546-365bb710ee93?q=80&w=800&auto=format&fit=crop",
        prepTime: "20 mins",
        ingredients: [
            "1 1/2 cups All-purpose flour",
            "3 1/2 tsp Baking powder",
            "1 tbsp Sugar",
            "1 1/4 cups Milk",
            "1 Egg",
            "3 tbsp Melted butter",
            "Maple syrup & fresh berries"
        ],
        instructions: "1. Sift flour, baking powder, and sugar in a large bowl.<br>2. Whisk milk, egg, and melted butter together.<br>3. Combine wet and dry ingredients into a smooth batter.<br>4. Pour 1/4 cup batter onto a hot buttered pan and cook until bubbles form.<br>5. Flip and cook until golden brown on both sides. Serve warm with maple syrup."
    },
    {
        id: 2,
        title: "Chicken Biriyani",
        category: "Lunch",
        rating: 4.8,
        reviews: 98,
        image: "assets/images/chicken_biryani.jpg",
        fallbackImage: "https://images.unsplash.com/photo-1563379926898-05f4575a45d8?q=80&w=800&auto=format&fit=crop",
        prepTime: "60 mins",
        ingredients: [
            "500g Basmati rice",
            "700g Marinated Chicken",
            "1 cup Plain yogurt",
            "2 Large onions (sliced & caramelized)",
            "2 tbsp Biryani masala powder",
            "Whole spices (cardamom, cloves, cinnamon)",
            "Fresh mint & coriander leaves"
        ],
        instructions: "1. Marinate chicken with yogurt, ginger-garlic paste, and spices for 30 mins.<br>2. Parboil soaked basmati rice with whole spices until 70% cooked.<br>3. Layer marinated chicken and fragrant rice in a heavy pot.<br>4. Top with fried onions, saffron milk, and fresh mint.<br>5. Seal pot lid and slow cook on low heat (Dum) for 25 mins. Fluff and serve hot with raita."
    },
    {
        id: 3,
        title: "Spaghetti Carbonara",
        category: "Dinner",
        rating: 4.5,
        reviews: 76,
        image: "assets/images/spaghetti_carbonara.jpg",
        fallbackImage: "https://images.unsplash.com/photo-1473093295043-cdd812d0e601?q=80&w=800&auto=format&fit=crop",
        prepTime: "30 mins",
        ingredients: [
            "400g Italian Spaghetti",
            "150g Pancetta or smoked bacon",
            "4 Fresh egg yolks",
            "1 cup Grated Pecorino Romano / Parmesan cheese",
            "Freshly cracked black pepper",
            "Salt to taste"
        ],
        instructions: "1. Boil spaghetti in salted water until al dente.<br>2. Crisp diced pancetta in a skillet over medium heat.<br>3. Whisk egg yolks with grated cheese and coarse black pepper in a bowl.<br>4. Transfer hot spaghetti directly into the pancetta pan (off the heat).<br>5. Stir in egg-cheese mixture quickly with reserved pasta water for a silky, glossy sauce."
    },
    {
        id: 4,
        title: "Chocolate Cake",
        category: "Dessert",
        rating: 4.7,
        reviews: 64,
        image: "assets/images/chocolate_cake.jpg",
        fallbackImage: "https://images.unsplash.com/photo-1578985545062-69928b1d9587?q=80&w=800&auto=format&fit=crop",
        prepTime: "45 mins",
        ingredients: [
            "2 cups Granulated sugar",
            "1 3/4 cups All-purpose flour",
            "3/4 cup Dutch cocoa powder",
            "2 Large eggs",
            "1 cup Whole milk",
            "1/2 cup Vegetable oil",
            "1 cup Boiling water or brewed coffee"
        ],
        instructions: "1. Preheat oven to 350°F (175°C) and grease cake pans.<br>2. Whisk dry ingredients in a bowl.<br>3. Add eggs, milk, oil, and vanilla; beat on medium speed for 2 mins.<br>4. Stir in boiling water to create a thin, rich batter.<br>5. Bake for 30–35 minutes until a toothpick inserted in center comes out clean."
    },
    {
        id: 5,
        title: "Veggie Stir Fry",
        category: "Snacks",
        rating: 4.4,
        reviews: 52,
        image: "assets/images/veggie_stir_fry.jpg",
        fallbackImage: "https://images.unsplash.com/photo-1540420773420-3366772f4999?q=80&w=800&auto=format&fit=crop",
        prepTime: "25 mins",
        ingredients: [
            "1 cup Fresh broccoli florets",
            "1 Red bell pepper (sliced)",
            "1 cup Snap peas & julienned carrots",
            "3 tbsp Low-sodium soy sauce",
            "1 tbsp Pure sesame oil",
            "2 Cloves minced garlic & ginger"
        ],
        instructions: "1. Heat sesame oil in a smoking-hot wok or skillet.<br>2. Add minced garlic and ginger, stir-frying for 30 seconds.<br>3. Add vibrant vegetables and toss rapidly on high heat for 4–5 minutes.<br>4. Pour in savory soy sauce glaze and stir until vegetables are crisp-tender.<br>5. Garnish with toasted sesame seeds and serve warm."
    },
    {
        id: 6,
        title: "Tomato Soup",
        category: "Dinner",
        rating: 4.3,
        reviews: 48,
        image: "https://images.unsplash.com/photo-1547592166-23ac45744acd?q=80&w=800&auto=format&fit=crop",
        fallbackImage: "https://images.unsplash.com/photo-1547592166-23ac45744acd?q=80&w=800&auto=format&fit=crop",
        prepTime: "20 mins",
        ingredients: [
            "1kg Ripe Roma tomatoes",
            "1 Chopped onion & 4 garlic cloves",
            "2 cups Vegetable broth",
            "1/2 cup Heavy cream",
            "Fresh basil leaves & olive oil"
        ],
        instructions: "1. Sauté onions and garlic in olive oil until soft.<br>2. Add tomatoes, basil, and vegetable broth; simmer for 15 minutes.<br>3. Blend with an immersion blender until completely smooth and velvety.<br>4. Stir in fresh heavy cream, season with salt and pepper, and serve with crusty garlic bread."
    },
    {
        id: 7,
        title: "Grilled Salmon",
        category: "Lunch",
        rating: 4.6,
        reviews: 82,
        image: "https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?q=80&w=800&auto=format&fit=crop",
        fallbackImage: "https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?q=80&w=800&auto=format&fit=crop",
        prepTime: "35 mins",
        ingredients: [
            "2 Fresh salmon fillets (skin-on)",
            "2 tbsp Extra virgin olive oil",
            "1 Fresh lemon (juiced & zested)",
            "2 Cloves garlic (minced)",
            "Fresh dill, salt, and black pepper"
        ],
        instructions: "1. Season salmon fillets with olive oil, lemon juice, garlic, and fresh dill.<br>2. Preheat grill or cast iron grill pan over medium-high heat.<br>3. Place salmon skin-side down and cook undisturbed for 4–5 minutes.<br>4. Carefully flip and cook for another 3–4 minutes until tender and flaky."
    },
    {
        id: 8,
        title: "Fruit Salad",
        category: "Dessert",
        rating: 4.8,
        reviews: 110,
        image: "https://images.unsplash.com/photo-1568158879083-c42860933ed7?q=80&w=800&auto=format&fit=crop",
        fallbackImage: "https://images.unsplash.com/photo-1568158879083-c42860933ed7?q=80&w=800&auto=format&fit=crop",
        prepTime: "15 mins",
        ingredients: [
            "1 cup Fresh strawberries (halved)",
            "1 cup Blueberries & kiwi slices",
            "1 cup Mango & pineapple chunks",
            "2 tbsp Pure honey or maple syrup",
            "1 tbsp Fresh lime juice & mint leaves"
        ],
        instructions: "1. Wash and chop all fresh seasonal fruits into bite-sized pieces.<br>2. Place fruits into a large glass mixing bowl.<br>3. Whisk fresh lime juice with honey in a small cup.<br>4. Drizzle honey-lime dressing over the fruit and toss gently.<br>5. Chill in refrigerator for 15 minutes before serving garnished with mint."
    }
];

document.addEventListener('DOMContentLoaded', () => {

    const recipesGrid = document.getElementById('recipesGrid');
    const heroSearchInput = document.getElementById('heroSearchInput');
    const heroSearchBtn = document.getElementById('heroSearchBtn');
    const categoryChips = document.querySelectorAll('.filter-chip');
    const browseRecipesBtn = document.getElementById('browseRecipesBtn');
    
    let recipeModal = document.getElementById('recipeModal');
    let recipeDetailBody = document.getElementById('recipeDetailBody');
    let closeRecipeModal = document.getElementById('closeRecipeModal');

    let currentCategory = 'all';
    let currentSearchTerm = '';

    function initSearchModal() {
        let searchOverlay = document.getElementById('searchModalOverlay');

        if (!searchOverlay) {
            searchOverlay = document.createElement('div');
            searchOverlay.id = 'searchModalOverlay';
            searchOverlay.className = 'modal-overlay';
            searchOverlay.style.display = 'none'; 
            searchOverlay.innerHTML = `
                <div class="search-modal-container">
                    <div class="search-modal-header">
                        <i class="fa-solid fa-magnifying-glass search-modal-icon"></i>
                        <input type="text" id="navbarSearchModalInput" class="search-modal-input" placeholder="Search recipes, ingredients, categories... (e.g. Pasta, Biryani)" autocomplete="off">
                        <button class="search-modal-close-btn" id="closeSearchModalBtn" title="Close (Esc)"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                    <div class="search-modal-categories" id="searchModalCategories">
                        <button class="search-tag-chip active" data-cat="all">All</button>
                        <button class="search-tag-chip" data-cat="Breakfast">Breakfast</button>
                        <button class="search-tag-chip" data-cat="Lunch">Lunch</button>
                        <button class="search-tag-chip" data-cat="Dinner">Dinner</button>
                        <button class="search-tag-chip" data-cat="Dessert">Dessert</button>
                        <button class="search-tag-chip" data-cat="Snacks">Snacks</button>
                    </div>
                    <div class="search-modal-results" id="searchModalResults">
                        <!-- Live Search Results -->
                    </div>
                    <div class="search-modal-footer">
                        <span>Press <kbd>ESC</kbd> to close</span>
                        <span><strong id="searchResultsCount">8</strong> recipes available</span>
                    </div>
                </div>
            `;
            document.body.appendChild(searchOverlay);
        }

        const modalInput = document.getElementById('navbarSearchModalInput');
        const resultsContainer = document.getElementById('searchModalResults');
        const countSpan = document.getElementById('searchResultsCount');
        const closeBtn = document.getElementById('closeSearchModalBtn');
        const categoryBtns = searchOverlay.querySelectorAll('.search-tag-chip');
        let activeModalCat = 'all';

        function renderSearchResults() {
            const query = (modalInput ? modalInput.value : '').trim().toLowerCase();
            
            const filtered = recipesData.filter(recipe => {
                const matchesCat = (activeModalCat === 'all') || (recipe.category.toLowerCase() === activeModalCat.toLowerCase());
                const matchesText = !query || 
                                    recipe.title.toLowerCase().includes(query) || 
                                    recipe.category.toLowerCase().includes(query) || 
                                    recipe.ingredients.some(ing => ing.toLowerCase().includes(query));
                return matchesCat && matchesText;
            });

            if (countSpan) countSpan.textContent = filtered.length;

            if (filtered.length === 0) {
                resultsContainer.innerHTML = `
                    <div class="search-no-results">
                        <i class="fa-solid fa-utensils"></i>
                        <h4 style="margin-bottom: 6px; color: #475569;">No recipes found</h4>
                        <p style="font-size: 0.9rem;">Try searching for a different dish name or ingredient.</p>
                    </div>
                `;
                return;
            }

            resultsContainer.innerHTML = filtered.map(recipe => `
                <div class="search-result-item" data-recipe-id="${recipe.id}">
                    <img src="${recipe.image}" onerror="this.onerror=null; this.src='${recipe.fallbackImage}';" alt="${recipe.title}" class="search-result-thumb">
                    <div class="search-result-info">
                        <div class="search-result-title">${recipe.title}</div>
                        <div class="search-result-meta">
                            <span class="search-result-badge">${recipe.category}</span>
                            <span><i class="fa-regular fa-clock"></i> ${recipe.prepTime}</span>
                            <span>⭐ ${recipe.rating}</span>
                        </div>
                    </div>
                    <i class="fa-solid fa-chevron-right search-result-arrow"></i>
                </div>
            `).join('');

            resultsContainer.querySelectorAll('.search-result-item').forEach(item => {
                item.addEventListener('click', () => {
                    const id = parseInt(item.getAttribute('data-recipe-id'), 10);
                    const found = recipesData.find(r => r.id === id);
                    if (found) {
                        closeSearchModal();
                        openRecipeModal(found);
                    }
                });
            });
        }

        function openSearchModal(initialQuery = '') {
            searchOverlay.style.display = 'flex';
            searchOverlay.classList.add('active');
            if (modalInput) {
                modalInput.value = initialQuery;
            }
            renderSearchResults();
            setTimeout(() => {
                if (modalInput) {
                    modalInput.focus();
                    if (initialQuery) {
                        modalInput.setSelectionRange(initialQuery.length, initialQuery.length);
                    }
                }
            }, 100);
        }

        function closeSearchModal() {
            searchOverlay.classList.remove('active');
            searchOverlay.style.display = 'none';
        }

        if (modalInput) {
            modalInput.addEventListener('input', renderSearchResults);
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', closeSearchModal);
        }

        searchOverlay.addEventListener('click', (e) => {
            if (e.target === searchOverlay) {
                closeSearchModal();
            }
        });

        categoryBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                categoryBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                activeModalCat = btn.getAttribute('data-cat');
                renderSearchResults();
            });
        });

        const searchTriggers = document.querySelectorAll('.search-trigger-btn, #searchTriggerBtn, #heroSearchBtn, .navbar-search-btn');
        searchTriggers.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const heroIn = document.getElementById('heroSearchInput');
                const initialVal = (heroIn && btn.id === 'heroSearchBtn') ? heroIn.value.trim() : '';
                openSearchModal(initialVal);
            });
        });

        const heroInputElem = document.getElementById('heroSearchInput');
        if (heroInputElem) {
            heroInputElem.addEventListener('click', () => {
                openSearchModal(heroInputElem.value.trim());
            });
            heroInputElem.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    openSearchModal(heroInputElem.value.trim());
                }
            });
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeSearchModal();
                if (recipeModal) {
                    recipeModal.classList.remove('active');
                    recipeModal.style.display = 'none';
                }
            }
            if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
                e.preventDefault();
                openSearchModal();
            }
        });
    }

    function ensureRecipeModal() {
        if (!recipeModal) {
            recipeModal = document.createElement('div');
            recipeModal.id = 'recipeModal';
            recipeModal.className = 'modal-overlay';
            recipeModal.style.display = 'none';
            recipeModal.innerHTML = `
                <div class="modal-content recipe-detail-modal">
                    <button class="modal-close" id="closeRecipeModal">&times;</button>
                    <div class="recipe-detail-body" id="recipeDetailBody"></div>
                </div>
            `;
            document.body.appendChild(recipeModal);
            recipeDetailBody = document.getElementById('recipeDetailBody');
            closeRecipeModal = document.getElementById('closeRecipeModal');
        }

        if (closeRecipeModal) {
            closeRecipeModal.onclick = () => {
                recipeModal.classList.remove('active');
                recipeModal.style.display = 'none';
            };
        }
        recipeModal.onclick = (e) => {
            if (e.target === recipeModal) {
                recipeModal.classList.remove('active');
                recipeModal.style.display = 'none';
            }
        };
    }

    function displayRecipes() {
        if (!recipesGrid) return;

        recipesGrid.innerHTML = '';

        const filteredList = recipesData.filter(recipe => {
            const matchesCategory = (currentCategory === 'all') || (recipe.category.toLowerCase() === currentCategory.toLowerCase());
            const matchesSearch = !currentSearchTerm || 
                                  recipe.title.toLowerCase().includes(currentSearchTerm.toLowerCase()) || 
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
        ensureRecipeModal();
        if (!recipeDetailBody) return;

        recipeDetailBody.innerHTML = `
            <img src="${recipe.image}" 
                 onerror="this.onerror=null; this.src='${recipe.fallbackImage}';" 
                 alt="${recipe.title}" 
                 class="recipe-detail-img">
            <div style="padding: 24px;">
                <h2 style="font-size: 1.8rem; margin-bottom: 12px; color: #1e252b; font-family: 'Outfit', sans-serif;">${recipe.title}</h2>
                <div style="display: flex; gap: 12px; align-items: center; margin-bottom: 18px; font-size: 0.9rem; color: #64748b;">
                    <span style="background: #e0f2fe; color: #0369a1; padding: 3px 10px; border-radius: 6px; font-weight: 700;">${recipe.category}</span>
                    <span><i class="fa-regular fa-clock"></i> <strong>Time:</strong> ${recipe.prepTime}</span>
                    <span>⭐ <strong>Rating:</strong> ${recipe.rating}</span>
                </div>
                
                <h4 style="margin-bottom: 10px; font-size: 1.15rem; color: #257838; font-weight: 700;">🛒 Ingredients:</h4>
                <ul style="margin-bottom: 20px; padding-left: 20px; line-height: 1.7; color: #334155;">
                    ${recipe.ingredients.map(item => `<li>${item}</li>`).join('')}
                </ul>
                
                <h4 style="margin-bottom: 10px; font-size: 1.15rem; color: #ee5d20; font-weight: 700;">👨‍🍳 Instructions:</h4>
                <div style="color: #334155; line-height: 1.7;">${recipe.instructions}</div>
            </div>
        `;
        recipeModal.style.display = 'flex';
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
            currentSearchTerm = heroSearchInput ? heroSearchInput.value : '';
            displayRecipes();
            const recSection = document.getElementById('recipes');
            if (recSection) recSection.scrollIntoView({ behavior: 'smooth' });
        });
    }

    if (browseRecipesBtn) {
        browseRecipesBtn.addEventListener('click', () => {
            const recSection = document.getElementById('recipes');
            if (recSection) recSection.scrollIntoView({ behavior: 'smooth' });
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

    function updateNavbarAuth() {
        let rawUser = localStorage.getItem('recipeLoggedInUser');
        const loginBtn = document.getElementById('loginBtn') || 
                         document.querySelector('.nav-actions a[href*="login"]') || 
                         document.querySelector('.nav-actions a[title="Account"]') ||
                         document.querySelector('.nav-actions .fa-circle-user')?.closest('a');
        
        if (rawUser && loginBtn) {
            let displayName = rawUser;

            try {
                const reg = JSON.parse(localStorage.getItem('registeredRecipeUser') || '{}');
                if (reg && reg.username && reg.username.trim() !== '') {
                    displayName = reg.username.trim();
                }
            } catch(e) {}

            if (displayName.includes('@')) {
                displayName = displayName.split('@')[0];
            }

            if (/^[a-zA-Z]+[0-9]+$/.test(displayName)) {
                const alphaOnly = displayName.replace(/[0-9]+$/, '');
                if (alphaOnly.length >= 3) {
                    displayName = alphaOnly;
                }
            }

            if (displayName.length > 0) {
                displayName = displayName.charAt(0).toUpperCase() + displayName.slice(1);
            }

            const parent = loginBtn.parentElement;
            loginBtn.remove();

            if (!document.getElementById('userProfileNav')) {
                const userBox = document.createElement('div');
                userBox.id = 'userProfileNav';
                userBox.style.display = 'inline-flex';
                userBox.style.alignItems = 'center';
                userBox.style.gap = '8px';
                userBox.innerHTML = `
                    <a href="dashboard.php" style="background:#00a843; color:white; padding:8px 16px; border-radius:99px; font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:6px; font-size:0.95rem;">
                        <i class="fa-solid fa-circle-user"></i>
                        <span>${displayName}</span>
                    </a>
                    <a href="auth/logout.php" id="customLogoutBtn" style="background:#ef4444; color:white; text-decoration:none; padding:8px 14px; border-radius:99px; font-weight:700; display:inline-flex; align-items:center; font-size:0.9rem;" title="Logout">Logout</a>
                `;
                parent.appendChild(userBox);

                const logoutBtn = document.getElementById('customLogoutBtn');
                if (logoutBtn) {
                    logoutBtn.addEventListener('click', () => {
                        localStorage.removeItem('recipeLoggedInUser');
                    });
                }
            }
        }
    }

    initSearchModal();
    ensureRecipeModal();
    updateNavbarAuth();
    displayRecipes();
});

