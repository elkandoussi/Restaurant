/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

//bootstrap
require('bootstrap');

//fontawesome
require('@fortawesome/fontawesome-free/js/all.js');


import Vue from 'vue';

// les listes des produits
var entrees = new Vue({
    el: "#entrees",
    data: {
        display: 'd-none'
    }
});

var plats = new Vue({
    el: "#plats",
    data: {
        display: 'd-none'
    }
});

var desserts = new Vue({
    el: "#desserts",
    data: {
        display: 'd-none'
    }
});


var buttons = new Vue({
    el: "#buttons",
    data: {
        EisActive: false,
        PisActive: false,
        DisActive: false
    },
    methods: {
        showEntrees: function(event){
            entrees.display = 'd-print-block';
            this.EisActive = true;

            plats.display = 'd-none';
            this.PisActive = false;

            desserts.display = 'd-none';
            this.DisActive = false;
        },
        showPlats: function(){
           plats.display = 'd-print-block';
           this.PisActive = true;

           entrees.display = 'd-none';
           this.EisActive = false;

           desserts.display = 'd-none';
           this.DisActive = false;
        },
        showDesserts: function(){
            desserts.display = 'd-print-block';
            this.DisActive = true;

            plats.display = 'd-none';
            this.PisActive = false;

           entrees.display = 'd-none';
           this.EisActive = false;
        }
    }

});
