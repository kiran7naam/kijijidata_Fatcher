// ==UserScript==
// @name         Contact Seller
// @namespace    http://tampermonkey.net/
// @version      0.1
// @description  Script to contact seller!
// @author       You
// @match        https://www.kijiji.ca/*?action=contact_seller&contact=yes
// @icon         data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==
// @grant        none
// ==/UserScript==

(function() {
    'use strict';
     window.addEventListener("load", (event) => {
        var message =  'Hi, I am interested and wondering if this is still available?';
         setTimeout(() => {
             document.querySelector('textarea[class*="input-2062748707"]').value = message;
         }, 1000);
         document.querySelector('button[class*="submitButton-439202862"]').click();
         window.close();
     });
})();