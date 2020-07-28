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
function drawMap() {
    var data = google.visualization.arrayToDataTable([
        ['Pays', 'Nombre de CV'],
        ['Russia', 10],
        ['France', 500],
        ['Spain', 1000],
        ['Canada', 100],
        ['United States', 1000],
        ['India', 250],
        ["Peru",50],
        ["Trinidad and Tobago",500],
        ["Lithuania",15],
        ["Estonia",60],
        ["Georgia",68],
        ["Iran",77],
        ["Chile",778],
        ["Latvia",777],
        ["Thailand",7],
        ["Egypt",705],
        ["Ireland",2006],
        ["China",2007],
        ["Finland",3258],
        ["Brazil",330],
        ["Norway",3],
        ["Austria",350],
        ["Denmark",400],
        ["Belgium",410],
        ["New Zealand",420],
        ["Switzerland",507],
    ]);

    var array = {
        0 : "www.google.com",
        1 : "www.google.com",
        2 : "www.google.com",
        3 : "www.google.com",
        4 : "www.google.com",
        5 : "www.google.com",
        6 : "www.google.com",
        7 : "www.google.com",
        8 : "www.google.com",
        9 : "www.google.com",
        10 : "www.google.com",
        11 : "www.google.com",
        12 : "www.google.com",
        13 : "www.google.com",
        14 : "www.google.com",
        15 : "www.google.com",
        16 : "www.google.com",
        17 : "www.google.com",
        18 : "www.google.com",
        19 : "www.google.com",
        20 : "www.google.com",
        21 : "www.google.com",
        22 : "www.google.com",
        23 : "www.google.com",
        24 : "www.google.com",
        25 : "www.google.com",
    };


    var options = {
        dataMode: 'regions',
        width: 1500,
        height: 521,
        colorAxis: {colors: ['grey', 'black']} // '#FFFFFF' / '#FFFFFF' possible aussi
    };

    var container = document.getElementById('map_canvas');
    var chart = new google.visualization.GeoChart(container);

    function myClickHandler(){
        var selection = chart.getSelection();
        var id = selection[0].row;
        var link = array[id];
        window.open('http://' + link, '_blank');
    }

    google.visualization.events.addListener(chart, 'select', myClickHandler);

    chart.draw(data, options);
}
google.load('visualization', '1', {packages: ['geochart'], callback: drawMap});
