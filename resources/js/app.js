import { createApp } from 'vue';

import '.././css/app.css'
import HeaderTop from './components/Header.vue';
import TopPage from './components/TopPage.vue';
import Education from './components/Education.vue';
import Portfolio from './components/Portfolio.vue';
import Awards from './components/Awards.vue';
import Contacts from './components/Contacts.vue';
import Admin from './components/Admin.vue';
import router from './routers/index';


const app = createApp({
    components: {
        HeaderTop,
        TopPage,
        Education,
        Portfolio,
        Awards,
        Contacts,
        Admin
    },
});

app.use(router);
app.mount('#app');
