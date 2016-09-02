/// <reference path="C:\Users\Impdev\documents\visual studio 2015\Projects\MySocialNetworkingWebSite\MySocialNetworkingSite\bootstrap/Scripts/jquery-1.9.1.intellisense.js" />


// A $( document ).ready() block.
$(document).ready(function () {
    console.log("ready!");

    $("#avi").on("click", function () {
        var newThumbnail = '<div class="thumbnail">'
                +
                '<div class="caption">'
                +
                    '<h3>Thumbnail label</h3>'
                +
                 '<p>'
                 +
                    '<a href="#" class="btn btn-primary" role="button">Button</a>'
                    +
                    '<a href="#" class="btn btn-default" role="button">Button</a>'
                    +
                    '<a href="#" class="btn btn-default" role="button">Button</a>'
                    +
                    '<a href="#" class="btn btn-default" role="button">Button</a>'
               +
                '</p>'
                +
            '</div>'
            +
        '</div>';

        $(newThumbnail).insertAfter("#firstThumbnail");
    });


});

//$(window).load() block.
$(window).load(function () {
    console.log("window loaded");
});


/*******************************************************/
//$('body').html($('body').html() + '<div>footer</div>');


//$("<p>Test</p>").insertBefore(".thumbnail");

//$(".inner").append("<p>Test</p>");
/*******************************************************/
//var trueFalse = confirm("Go ahead make my day");
//var myData = prompt("Enter your name please", "Levi");
//alert(trueFalse + ' ' + myData);

//var age = 16;
//if (age < 18) {
//    document.write("<h1> Sorry you can not vote!</h1>");
//    document.write("<h1> Sorry you can not vote!</h1>");
//}
//else {
//    document.write("<h1>Go ahead and vote!</h1>");
//}