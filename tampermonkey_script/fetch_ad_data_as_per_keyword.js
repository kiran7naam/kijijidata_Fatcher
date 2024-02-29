// ==UserScript==
// @name         Fetch Ad Data as per the Keyword
// @namespace    http://tampermonkey.net/
// @version      0.1
// @description  Fetch ad data as per the keyword!
// @author       You
// @match        https://*.kijiji.ca/?searchAd=*
// @grant        none
// @include https://code.jquery.com/jquery-3.7.1.min.js
// ==/UserScript==

(function() {
    'use strict';
    window.addEventListener("load", (event) => {
        const queryString= window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const searchvalue = urlParams.get('searchAd');
        if (urlParams.has('searchAd') ) {
            document.getElementById('SearchKeyword').value = searchvalue;
            document.querySelector("[data-qa-id='header-button-submit']").click();
        }
    });
})();