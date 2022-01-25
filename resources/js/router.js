import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from './components/ExampleComponent';
import ContactCreate from './views/ContactCreate';
import ContactsShow from './views/ContactsShow';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '/', component: ExampleComponent },
        { path: '/contacts/create', component: ContactCreate },
        { path: '/contacts/:id', component: ContactsShow },
    ],
    mode: 'history',
})