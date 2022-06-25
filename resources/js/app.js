import { createApp } from 'vue'
import MainApp from './components/MainApp.vue'
import router from './router'

export const eventBus = createApp(MainApp)

createApp(MainApp).use(router).mount('#app')