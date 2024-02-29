// ==UserScript==
// @name         Search Ad Details
// @namespace    http://tampermonkey.net/
// @version      0.1
// @description  search ads pagination wise!
// @author       You
// @match        https://www.kijiji.ca/*?*=true&*=true*
// @icon         data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==
// @grant        none
// @include https://code.jquery.com/jquery-3.7.1.min.js
// ==/UserScript==

(function() {    
    'use strict';
    var loaded = 0;
    var delayy = 18000;    
   window.addEventListener("load", (event) => {
       loaded = 1;
            var delay = 24000;
            var productdata = [];
            var search_category = document.getElementById('global-header-search-bar-input').value;
            var ulItems = document.querySelectorAll("[data-testid='srp-search-list']");
            var totalcount = document.querySelectorAll('li[data-testid*="listing-card-list-item-"]').length;
            var nexturlopentime = 24000 + (6000 * totalcount) + 120000;
            ulItems.forEach(function(item,index){
                item.querySelectorAll('li[data-testid*="listing-card-list-item-"]').forEach(function(ite,ind){
                    var productarray = {};
                    productarray['listing_id'] = ite.querySelector("section[data-listingid]").getAttribute('data-listingid');
                    var productdetailurl = ite.querySelector("a[data-testid='listing-link']").href+'?action=getaddetails&listing_id='+productarray['listing_id']+'&searchitem='+search_category;
                    setTimeout(() => {
                       window.open(productdetailurl,"_blank");
                    }, delay);
                    delay += 6000;
                });
            });
            var pagination_list = document.querySelector("ul[data-testid='pagination-list']");
            var pagination_link = pagination_list.querySelector("li[data-testid='pagination-next-link']");
            var pagination_url = pagination_link.querySelector("a").getAttribute('href');

            console.log(nexturlopentime);
            setTimeout(() => {
                console.log('Now you can open the page');
                window.location.replace(pagination_url);
            }, nexturlopentime);

   });
    setTimeout(() => {
         if(parseInt(loaded) === 0){
                  window.location.reload()
          }
          else{
                  console.log("page loaded");
          }
          }, delayy);

})();