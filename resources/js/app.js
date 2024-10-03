/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import BaseCard from './components/BaseCard.vue';
import BaseButton from './components/BaseButton.vue';
import TabsWrapper from './components/TabsWrapper.vue';
import Accordian from './components/accordian.js';
import Menu from './components/menu.js';

const todoList = document.getElementById('todo');
if(todoList){
    const app = createApp(App);
    
    app.component('base-card', BaseCard);
    app.component('base-button', BaseButton);
    app.component('tabs-wrapper', TabsWrapper);
    
    app.mount('#todo');
}

Accordian.init();
Menu.init();