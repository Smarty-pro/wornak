/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/1.css';
import '../css/2.css';
import '../css/3.css';
import '../css/4.css';
import '../css/5.css';
import '../css/all.css';
// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.


import $ from 'jquery';
import * as Sentry from '@sentry/browser';

Sentry.init({ dsn: 'https://52d4e4c3aa0b431faea51a3e1752fc0e@o392274.ingest.sentry.io/5249757' });


var iconMenu = document.querySelector('.icon-menu'),
    menu = document.querySelector('.menu'),
    menuLink = document.querySelectorAll('.menu-link.sub');

iconMenu.addEventListener('click', openMenu);

menuLink.forEach(function(el) {
    el.addEventListener('click', openSubmenu);
});

function openMenu() {

    if(menu.classList.contains('open')) {
        menu.classList.add('close');
        iconMenu.classList.remove('icon-closed');

        setTimeout(function(){ menu.classList.remove('open'); }, 1300);

    } else {
        menu.classList.remove('close');
        menu.classList.add('open');
        iconMenu.classList.add('icon-closed');
    }
}

function openSubmenu(event) {

    if (event.currentTarget.classList.contains("active")) {
        event.currentTarget.classList.remove("active");
    } else {
        event.currentTarget.classList.add("active");
    }
}
