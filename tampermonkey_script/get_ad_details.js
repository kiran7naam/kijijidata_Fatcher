// ==UserScript==
// @name         Get Ad Details
// @namespace    http://tampermonkey.net/
// @version      0.1
// @description  Get ad details and save in the local database!
// @author       You
// @match        https://www.kijiji.ca/*?action=getaddetails&listing_id=*
// @icon         data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==
// @grant        none
// ==/UserScript==

(function() {
    'use strict';
    var start = performance.now();

     window.addEventListener("load", (event) => {
         const queryString  = window.location.search;
         const urlParams = new URLSearchParams(queryString);
         var product_data = [];
         var product_details = {};
         var dealer_details = {};
         var product_images = {};
         var vehicle_details = {};
         const product_listing_id = urlParams.get('listing_id');
         product_details['site_url'] = window.location.href;
         /* start code to select data for products table this data include product details.*/
         if(document.getElementsByTagName('autoverify-vehicle-details').length > 0){
             const [node] = document.getElementsByTagName('autoverify-vehicle-details');
         $.each(node.attributes, (index, attribute) => {
             vehicle_details[attribute.name] = attribute.value;
             product_details['ad_id'] = product_listing_id;
             product_details['product_name'] = $('.title-4206718449').html();
         });
         }
         else{
             product_details['ad_id'] = product_listing_id;
             product_details['product_name'] = $('.title-4206718449').html();
         }
         console.log(product_details['product_name']);
         product_details['vehicle_details'] = vehicle_details;
         var priceSection = document.querySelector('div[class="priceContainer-1877772231"]');
         var price_element = priceSection.querySelector("span[itemprop='price']");
         if(typeof(price_element) != 'undefined' && price_element != null){
             product_details['price'] = price_element.getAttribute('content');
         }
         else{
             product_details['price'] = 0.00;
         }
         product_details['category_name'] = urlParams.get('searchitem');
         var mixed_description = document.querySelector('div[itemprop="description"]').innerHTML;
         product_details['description'] = mixed_description.replace( /(<([^>]+)>)/ig, '');
         product_details['posted_date'] = '';
         if(typeof(document.querySelector('[itemprop="datePosted"]')) != 'undefined' && document.querySelector('[itemprop="datePosted"]') != null){
                product_details['posted_date'] = document.querySelector('[itemprop="datePosted"]').getAttribute('content');
         }
         product_details['valid_through'] = '';
         if(typeof(document.querySelector('[itemprop="ValidThrough"]')) != 'undefined' && document.querySelector('[itemprop="ValidThrough"]') != null){
                product_details['valid_through'] = document.querySelector('[itemprop="ValidThrough"]').getAttribute('content');
         }
         var categorysection = document.querySelectorAll('li[itemprop="itemListElement"]')[1];
         product_details['online_category'] = categorysection.querySelector("span[itemprop='name']").innerHTML;
         product_data.push(product_details);
         /* end code to select data for products table.*/
         /* start code to select data for dealers table this data include dealers details.*/
         var dealer_name_element = document.querySelector('a[class="link-441721484"]');
         var dealer_location_element1 = document.querySelector('a[class*="location-1839384296"]');
         var dealer_location_element2 = document.querySelector('span[class*="address-2094065249"]');
         dealer_details['dealer_address'] = '';
         if (typeof(dealer_name_element) != 'undefined' && dealer_name_element != null){
             dealer_details['dealer_name'] = document.querySelector('a[class="link-441721484"]').text;
             var dealer_url = document.querySelector('a[class="link-441721484"]').href;
             dealer_details['dealer_id'] = dealer_url.match(/[0-9]+/)[0];
         }
         else{
             dealer_details['dealer_name'] = '';
             dealer_details['dealer_id'] = '';
         }
         if (typeof(dealer_location_element1) != 'undefined' && dealer_location_element1 != null){
             dealer_details['dealer_address'] = document.querySelector('a[class*="location-1839384296"]').text;
         }
         if (typeof(dealer_location_element2) != 'undefined' && dealer_location_element2 != null){
             dealer_details['dealer_address'] = dealer_location_element2.innerHTML;
         }
         product_data.push(dealer_details);
         /* end code to select data for dealers table.*/
         /* start code to select others details related to ad. These details are for some specific ads like Cars, Atv and etc.*/
         var i = 0;
         var other_details  = {};
         console.log(document.querySelectorAll('ul[class*="sc-fulCBj"]').length);
         document.querySelectorAll('ul[class*="sc-fulCBj"]').forEach(function(ee,ii){
             ee.querySelectorAll('li').forEach(function(eee,iii){
             console.log(eee.querySelectorAll('span')[0].innerHTML);
             //product_details['vehicle_details'][i] = eee.querySelectorAll('span')[0].innerHTML;
                 other_details[eee.querySelectorAll('span')[0].innerHTML] = eee.querySelectorAll('span')[1].innerHTML
                 i++;
         });
         });
         product_details['other_details'] = other_details;
         /* end code to select others details related to ad.*/
         /* start code to select all the images related to the ad.*/
         if(document.querySelectorAll('div[data-click-type="heroImage"]').length > 0 ){
             document.querySelectorAll('div[data-click-type="heroImage"]')[0].click();
             $('div[class="carousel-2161663468"] ul li').each(function(indexx,elementt){
                 if(typeof(elementt.querySelector('img')) != 'undefined' && elementt.querySelector('img')!=null){
                     product_images[indexx] = elementt.querySelector('img').getAttribute('src');
                 }
                 if(typeof(elementt.querySelector('iframe')) != 'undefined' && elementt.querySelector('iframe')!=null){
                     product_images[indexx] = elementt.querySelector('iframe').getAttribute('src');
                 }
             });
             $('.closeButton-1051845429').click();
         }
         product_data.push(product_images);
         /* end code to select all the images related to the ad.*/

         const url = "http://127.0.0.1:8000/api/saveproducts";
         const writeData = payload =>
         fetch(url, {
             method: "POST",
             body: JSON.stringify(payload),
             contentType: 'application/json; charset=UTF8',
         })
         .then(response => {
             if (!response.ok) {
                 throw Error(response.status);
             }
             return response.json();
         });

         writeData(product_data)
             .then(function(data){
                 if(data['status'] === 200){                    
                    window.close();
                      var end = performance.now();
                     var timeTaken = end - start;
                     console.log("Function took " +
                timeTaken + " milliseconds");
                 }
             })
             .catch(err => console.error(err));
        });
})();