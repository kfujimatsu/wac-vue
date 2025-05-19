<script setup>
    import axios from 'axios';
    import { ref, computed, onMounted } from 'vue';
    import { useRouter, useRoute } from 'vue-router'

    // vue-router
    const router = useRouter();
    const route = useRoute();

    const data = ref(null);
    const loading = ref(false);
    const api_url ='http://localhost:8888/api/v1/recipes/'+route.params.slug;
    
    onMounted(async () => {

        
        loading.value = true;
        try {
        // //     // await axios.get('http://localhost:8888/sanctum/csrf-cookie', { withCredentials: true });

            const response = await axios.get(api_url, 
                {
                    withCredentials: true,
                    // params: { page: routePage } // add logic to add search parameters
                });

            data.value = response.data;
            data.value.ingredients = JSON.parse(response.data.ingredients); //parse string->object
            data.value.recipe_steps = JSON.parse(response.data.recipe_steps); //parse string->object

        } catch (error) {
            data.value = null;
            console.error('Fetch error:', error);
            return null;
        } finally {
            loading.value = false;
        }
    });
</script>

<template>
    <div v-if="data" >
         <div class="title">
            {{ data.name }}
        </div>
        <div class="author">{{ data.author_email }}</div>
        <div class="description">
            {{ data.description }}
        </div>
        <div class="recipe_container">
            <div>Ingredients: </div>
            <div class="ingredients_item" v-for="(measurement, ingredients) in data.ingredients" :key="ingredients">
                {{ingredients}}: {{ measurement }}
            </div>
        </div>
        <div class="recipe_container">
            <div>Instructions: </div>
            <div class="container_item" v-for="(recipe, step) in data.recipe_steps" :key="step">
                - {{ recipe }}
            </div>
        </div>
    </div>
</template>

<style scoped>
.title {
    background-color: blue;
	border-radius: 0.5rem;
	font-weight:bold;
	font-size: 3rem;
    color: white;
	padding: 0;
    cursor: default;
    text-align: center;
}

.description {
	font-size: 0.8rem;
	padding: 1rem;

}
.ingredients{
	font-size: 0.3rem;
	padding: 1rem;
}
.recipe_container{
	font-size: 0.9rem;
	padding: 1 0;
	border: 0.1rem solid ghostwhite;
    border-radius: 0.1rem;
    background-color: lightgrey;
    margin-bottom: 1rem;
}
.container_item{
	font-size: 0.9rem;
	padding: 1 0;
    margin: 0.1rem;
    background-color: white;
}
.ingredients_item{
	font-size: 0.7rem;
	padding: 0.1rem;
    background-color: white;
}
</style>
