import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import RecipeView from '../views/RecipeView.vue'
import RecipeDetailView from '../views/RecipeDetailView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/recipes',
      name: 'RecipeList',
      component: RecipeView
    },

    {
      path: '/recipes/:slug',
      name: 'RecipeDetail',
      component: RecipeDetailView,
      // props: true  // passes slug as a prop to the component
    }
  ]
})

export default router
