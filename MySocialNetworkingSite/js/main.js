﻿/// <reference path="C:\Users\Impdev\documents\visual studio 2015\Projects\MySocialNetworkingWebSite\MySocialNetworkingSite\bootstrap/Scripts/jquery-1.9.1.intellisense.js" />


// A $( document ).ready() block.
$(document).ready(function () {
    console.log("ready!");

    // $("#uploadPost").on("click", function () {
    //    
    // });
});

//$(window).load() block.
$(window).load(function () {
    console.log("window loaded");
});

$('div').on('activate', function() {
    $(this).empty();
    var range, sel;
    if ( (sel = document.selection) && document.body.createTextRange) {
        range = document.body.createTextRange();
        range.moveToElementText(this);
        range.select();
    }
});

$('div').focus(function() {
    if (this.hasChildNodes() && document.createRange && window.getSelection) {
        $(this).empty();
        var range = document.createRange();
        range.selectNodeContents(this);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
    }
});

window.picUpload = function(frmData) {
    console.log("picUpload ran: " + frmData);

    for (objProprty in frmData) {
        console.log(objProprty + " : " + frmData[objProprty]);
    };

    var cnvs=document.getElementById("cnvsForFormat");
    if(!cnvs){
        var postTextField = document.getElementById("postTextField");
        postTextField.innerHTML += ('<div><br></div><canvas id="cnvsForFormat" width="400px" height="400" style="padding-top: 16px"></canvas>');
        cnvs = document.getElementById("cnvsForFormat");
    }
    console.log("cnvs: " + cnvs);
    var ctx=cnvs.getContext("2d");

    var img = new Image;
    img.src = URL.createObjectURL(frmData);

    console.log('img: ' + img);

    img.onload = function() {
        var picWidth = this.width;
        var picHeight = this.height;

        var wdthHghtRatio = picHeight/picWidth;
        console.log('wdthHghtRatio: ' + wdthHghtRatio);

        if (Number(picWidth) > 400) {
            var newHeight = Math.round(Number(400) * wdthHghtRatio);
        } else {
            return false;
        };

        document.getElementById('cnvsForFormat').height = newHeight;
        console.log('width: 400  h: ' + newHeight);
        //You must change the width and height settings in order to decrease the image size, but
        //it needs to be proportional to the original dimensions.
        console.log('This is BEFORE the DRAW IMAGE');
        ctx.drawImage(img,0,0, 400, newHeight);

        console.log('THIS IS AFTER THE DRAW IMAGE!');

    };
}

// $(document).mouseup(function (e)
// {
    // var postTextField = $("#postTextField");
    //
    // if (!postTextField.is(e.target) // if the target of the click isn't the container...
    //     && postTextField.has(e.target).length === 0) // ... nor a descendant of the container
    // {
    // }
// });

/* Get Posts */

function getPosts() {
    // var postJson = {
    //     "userName":"Daniel East",
    //     "userImagePath":"../images/main/1425577_1283411931698966_2669253318689249575_n.jpg",
    //     "postDate": new Date(new Date().setDate(new Date().getDate()-1)),
    //     "postText": '-Post Text- bla blla bla <br> blaalsdkalsd',
    //     "postImgPath":"../images/main/little-mermaid.jpg",
    //     "likeCount":"130",
    //     "comments":[
    //         {"commentUserName":"Jorgio","commentImgPath":"../images/main/1425577_1283411931698966_2669253318689249575_n.jpg", "commentText":"dhasjkdgdadas","commentDate":new Date(new Date().setDate(new Date().getDate()-1))},
    //         {"commentUserName":"Jorgio","commentImgPath":"../images/main/1425577_1283411931698966_2669253318689249575_n.jpg", "commentText":"dhasjkdgdadas","commentDate":new Date(new Date().setDate(new Date().getDate()-1))},
    //         {"commentUserName":"Jorgio","commentImgPath":"../images/main/1425577_1283411931698966_2669253318689249575_n.jpg", "commentText":"dhasjkdgdadas","commentDate":new Date(new Date().setDate(new Date().getDate()-1))},
    //     ]
    // };
    //
    // var newThumbnail = createPostHtml(postJson);
    // $(newThumbnail).insertAfter("#firstThumbnail");
}


/* Click Events */

function uploadPostClicked() {
    var postTextField = document.getElementById("postTextField");
    var cnvs = document.getElementById("cnvsForFormat");
    var postJson = {
        "userId":"TODO",
        "postText": postTextField.innerText,
        "postImg": cnvs.toDataURL(),
    };
    alert("implement upload POST");
}

function shareClicked() {
    alert("implement share");
}

function addCommentClicked() {
    alert("implement add comment");
}


/* Post Html Creation */

function createPostHtml(postJson) {


    /* Post Parsing*/
    var userName = postJson.userName;
    var userImagePath = postJson.userImagePath;

    var postDate = formattedDateStr(postJson.postDate);

    var postText = postJson.postText;
    var postImgPath = postJson.postImgPath;
    var likeCount = postJson.likeCount;
    var comments = postJson.comments;


    /* Comments list creation */
    var commentsHtml = "";
    for(var i=0; i<comments.length; i++){
        var comment = comments[i];
        var commentUserName = comment.commentUserName;
        var commentImgPath = comment.commentImgPath;
        var commentText = comment.commentText;
        var commentDate = formattedDateStr(comment.commentDate);

        commentsHtml +=
            '<li style="padding-left: 0.2cm; padding-right: 0.2cm; padding-top: 0.5cm">'
            +'<div>'
            +'<img src='+commentImgPath+' alt="..."  width="40" height="40" align="left" style="padding-right: 0.1cm">'
            +commentUserName+':'
            +'<br>'
            +commentText
            +'<br>'
            +commentDate
            +'</div>'
            +'</li>';
    }

    var postHtml =

        '<div class="thumbnail"> '

        /* post Details */
        +'<div style="height: 40px">'
        +'<img src='+userImagePath+' alt="..."  width="40" align="left" style="max-height:100%">'
        +'<div style="padding-left: 1.2cm; max-height:100%">'
        +userName
        +'<br>'
        +postDate
        +'</div>'
        +'</div>'

        /* post Text */
        +'<div style="padding-top: 0.3cm" >'
        +postText
        +'</div> <br>'

        /* post Image */
        +'<img src='+postImgPath+' alt="..." align="center" style="max-width: 100%; max-height:100%">  '

        /* post Actions */
        +'<div style="padding-top: 0.3cm;"></div>'
        +'<div style="height: 1px; background-color: lightgray"></div>'
        +'<div style="padding-top: 0.2cm; padding-left: 0.2cm; height: 25px">'
        +'<ul style="list-style-type: none; overflow: hidden; display: inline;">'
        +'<li style="display: block; float: left;"><input type="image" src="../images/main/like_ic.jpg" width="30" height="30" alt="Submit"></li>'
        +'<li style="display: block; float: left; padding-left: 4px; padding-top: 8px;"><div>'+likeCount+'</div></li>'
        +'<li style="display: block; float: left; padding-left: 14px; padding-top: 8px;"><a id="myLink" title="Share"href="#" onclick="shareClicked();return false;">Share</a></li>'
        +'</ul>'
        +'</div>'

        /* post Comments */
        +'<ul style="list-style-type: none; overflow: hidden; display: inline;">'
        +'<li style="padding-left: 0.2cm; padding-right: 0.2cm"><div style="height: 1px; background-color: lightgray"></div></li>'
        +commentsHtml
        +'</ul>'

        /* post Add A Comment */
        +'<div style="padding-top: 0.3cm;"></div>'
        +'<div style="height: 40px; background-color: #f5f5f5">'
        +'<ul style="list-style-type: none; overflow: hidden; display: inline;">'
        +'<li style="display: block; float: left;"><img src="../images/main/1425577_1283411931698966_2669253318689249575_n.jpg" alt="..."  width="40" align="left" style="max-height:100%"></li>'
        +'<li style="display: block; float: left; padding-left: 16px; padding-top: 8px; "><input type="text" id="commentTextField" style="width: 250%" placeholder="Add a comment..."></li>'
        +'<li style="display: block; float: right; padding-right: 10px; padding-top: 11px;"><a id="myLink" title="Add"href="#" onclick="addCommentClicked();return false;">Add</a></li>'
        +'</ul>'
        +'</div>'

        +'</div>';

    return postHtml;
}

/* Helpers */

function formattedDateStr(date) {
    var hr = date.getHours()
    var min = date.getMinutes()
    var formatted = $.datepicker.formatDate("yy M d, "+hr+":"+min, date)

    return formatted;
}
