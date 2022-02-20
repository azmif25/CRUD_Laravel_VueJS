import { createApp } from 'vue'
import App from './App.vue'

// Import Router 
import router from './router'

// Import Bootstrap, Popper, jQuery
import 'bootstrap/dist/css/bootstrap.css'
import 'jquery/dist/jquery.min'
import 'popper.js/dist/popper.min'
import 'bootstrap/dist/js/bootstrap.min'

const app = createApp(App)

// Use Vue Router
app.use(router)

app.mount('#app')
