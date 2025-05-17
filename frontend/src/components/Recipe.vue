<script setup>
    import axios from 'axios';
    import { ref, computed, onMounted } from 'vue';
    import { useRouter, useRoute } from 'vue-router';

    // Router
    const router = useRouter();
    const route = useRoute();

    // Local state
    const data = ref(null);
    const keyword = ref(route.query.keyword || '');
    const loading = ref(false);
    const routePage = ref(parseInt(route.query.page) || 1);
    const selected = ref(route.query.selected || '');
    const options = ref(['Keyword', 'Ingredients', 'Email']);
    const recipes_url = 'http://localhost:8888/api/v1/recipes';

    // Centralized fetch logic (DRY)
    const fetchRecipes = async (page = routePage.value) => {
        loading.value = true;
        try {
            const response = await axios.get(recipes_url, {
                withCredentials: true,
                params: {
                    keyword: keyword.value,
                    selected: selected.value,
                    page: page
                }
            });
            data.value = response.data;
        } catch (error) {
            console.error('Fetch error:', error);
            data.value = null;
        } finally {
            loading.value = false;
        }
    };

    // On mount
    onMounted(() => {
        fetchRecipes();
    });

    // Pagination
    const getPage = async (label) => {
        router.push({ query: { ...route.query, page: label } });
        await fetchRecipes(label);
    };

    // Search
    const searchRecipes = async () => {
        routePage.value = 1;
        router.push({
            query: {
                keyword: keyword.value,
                selected: selected.value,
                page: routePage.value
            }
        });
        await fetchRecipes(routePage.value);
    };

    // Utility
    const isCurrentPage = (label) => {
        return label === String(data.value?.current_page);
    };

    const selectOption = (option) => {
        selected.value = option;
    };

    const filteredOptions = computed(() =>
        options.value.filter(option =>
            option.toLowerCase().includes(keyword.value.toLowerCase())
        )
    );
</script>

<template>
    <div class="search-container">
        <div>
            <select class="input" v-model="selected">
                <option v-for="option in options" :key="option" :value="option">
                    {{ option }}
                </option>
            </select>
        </div>
        <input
            class="input"
            v-model="keyword"
            type="text"
            placeholder="Search for Recipes..."
        />
        <button class="btn" @click="searchRecipes">
            Search
        </button>
    </div>

    <div v-if="data">
        <div v-for="recipe in data.data" :key="recipe.id">
            <router-link :to="{ name: 'RecipeDetail', params: { slug: recipe.slug } }">
                <div class="recipeitem">
                    <div class="title">{{ recipe.name }}</div>
                    <div class="author">{{ recipe.author_email }}</div>
                    <div class="description">{{ recipe.description }}</div>
                </div>
            </router-link>
        </div>

        <div class="pagination">
            <div
                v-for="links in data.links"
                :key="links.label"
                @click="getPage(links.label)"
            >
                <div v-if="links.label.includes('laquo')" class="hide-for-now">Prev</div>
                <div v-else-if="links.label.includes('raquo')" class="hide-for-now">Next</div>
                <div
                    class="next-page"
                    :class="isCurrentPage(links.label) ? 'active' : ''"
                    v-else
                >
                    {{ links.label }}
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .search-container {
        display: grid;
        grid-template-columns: repeat(3, 175px); /* 3 columns of 100px */
        gap: 1rem;
    }

    .input {
        padding: 0.5rem 1rem;
        border: 1px solid grey;
        border-radius: 0.5rem;
        outline: none;
        margin: 0.5rem;
        width: 75%;
        min-width: 150px;
        max-width: 275px;
    }
    .input:focus {
        border-color: blue;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
    }

    /* Button styling */
    .btn {
        padding: 0.5rem 1rem;
        background-color: blue;
        color: white;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        margin: 0.5rem;
    }

    .btn:hover {
        background-color: lightseagreen;
    }

    .btn:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
    }
    .hide-for-now {
        display: none;
    }
</style>
