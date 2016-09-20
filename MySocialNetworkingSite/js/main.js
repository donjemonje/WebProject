/// <reference path="C:\Users\Impdev\documents\visual studio 2015\Projects\MySocialNetworkingWebSite\MySocialNetworkingSite\bootstrap/Scripts/jquery-1.9.1.intellisense.js" />


// A $( document ).ready() block.
$(document).ready(function () {
    console.log("ready!");
	
	//$('#picOneUpload').click(function(){
	//	$('#img').css('height','250px');
	//});
	
	$('input:file').change(function(){
		$('#img').css('height','250px');
	});


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

var selectedImgdataURL = "";

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

    img.crossOrigin = 'Anonymous';
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
        ctx.drawImage(this,0,0, 400, newHeight);
        selectedImgdataURL = cnvs.toDataURL();
        // console.log('###: ' + selectedImgdataURL);
        console.log('THIS IS AFTER THE DRAW IMAGE!');

    };

}

/* Click Events */

function uploadPostClicked() {
    var postTextField = document.getElementById("postTextField");
    var cnvs = document.getElementById("cnvsForFormat");
    var privacyImage = document.getElementById("privacyImage");
    var postJson = {
        "postText": postTextField.innerText,
        "postImg": selectedImgdataURL,
        "isPrivate": privacyImage.value,
    };

    console.log("uploadPostParmas: " + JSON.stringify(postJson));

    selectedImgdataURL = "";
	$.ajax({
                     url:"../php/post.php",
                     method:"POST",
                     data:{query: postJson },
                     success:function(data)
                     {
                         location.reload();
                     }
                });
}

function tapPostImage(postId) {

    var modal = document.getElementById('myModal'+postId);

    var img = document.getElementById('myImg'+postId);
    var modalImg = document.getElementById("img"+postId);

    modal.style.display = "block";
    modalImg.src = img.src;
    // captionText.innerHTML = this.alt;

    modal.onclick = function() {
        modal.style.display = "none";
    }
}

function likeClicked(postId) {
    var postId = postId;
	$.ajax({
                     url:"../php/like.php",
                     method:"POST",
                     data:{query: postId },
                     success:function(data)
                     {
						var postJson = JSON.parse(data);
                        var likeThumbnail = document.getElementById("numOfLikes"+postId);
                        likeThumbnail.innerHTML = data;
                        likeThumbnail.fadeIn();
                         //location.reload();
                     }
                });
}

function setPostPrivacy() {
    var privacyImage = document.getElementById("privacyImage");
    privacyImage.value = privacyImage.value == "0" ? "1" : "0";
    privacyImage.src = privacyImage.value == "0" ? "../images/main/Unlock-96.png" : "../images/main/Lock-96.png";
    console.log("setPostPrivacy: to: " + privacyImage.value);
}

function addCommentClicked(postId) {
    var commentTextField = document.getElementById("commentTextField"+postId);
    var addACommentJson = {
        "postId":postId,
        "commentText": commentTextField.value
    };

    $.ajax({
        url:"../php/addAComment.php",
        method:"POST",
        data:{query: addACommentJson },
        success:function(data)
        {
            if(data == "success"){
                reloadPost(postId);
            }
        }
    });
}

function addFriend() {
	var friendName = document.getElementById("searchText").value;
		$.ajax({
			url:"../php/addFriend.php",
			method:"POST",
			data:{query: friendName },
			success:function(data)
			{
				location.reload();
				//alert(data);
			}
		});
    //alert("implement search: --" + document.getElementById("searchText").value + "--");
}

/* Reload Data */

function reloadPost(postId) {
    $.ajax({
        url:"../php/getAPost.php",
        method:"POST",
        data:{query: {"postId": postId} },
        success:function(data)
        {
            $("#"+"postThumbnail"+postId).fadeTo(0.5*1000, 0.3, function(){
                $("#"+"postThumbnail"+postId).fadeTo(0.5*1000, 1);
                var postJson = JSON.parse(data);
                var showPrivacy = document.getElementById("postPrivacy"+postId) !== null;
                var postHtml = createPostHtml(postJson, showPrivacy);
                var postThumbnail = document.getElementById("postThumbnail"+postId);
                postThumbnail.innerHTML = postHtml;
            });



            // $("#"+"postThumbnail"+postId).effect( "shake" );
            // $("#"+"postThumbnail"+postId).fadeOut(0.2);
            // $("#"+"postThumbnail"+postId).fadeIn();
        }
    });
}

/* Post Html Creation */

function createPostHtml(postJson, showPrivacy) {


    /* Post Parsing*/
    var userName = postJson.userName;
    var postId = postJson.postid;
    var postIsPrivate = postJson.isPrivate == "true";
    var userImagePath = postJson.userImagePath === null ? "../images/main/no-profile-pic.jpg": postJson.userImagePath;
    var postDate = postJson.postDate;
    var postText = postJson.text;
    var postImgPath = postJson.postImgPath.length == 0 ? "//:0" : postJson.postImgPath;
    var likeCount = postJson.likeCount;
    var comments = postJson.comments;

    /* Comments list creation */
    var commentsHtml = "";
    if(comments instanceof Array){
        for(var i=0; i<comments.length; i++){
            var comment = comments[i];
            commentsHtml += createCommentHtmlFromCommentJson(comment)
        }
    }

    var privacyHtml ='';
    if(showPrivacy){
        var privacyImg = postIsPrivate ? "../images/main/Lock-96.png" : "../images/main/Unlock-96.png";
        privacyHtml = '<input id="postPrivacy'+postId+'" type="image" src="'+privacyImg +'" width="30" height="30" onclick="changePrivacyClicked('+ postId + ',' + postIsPrivate +')" align="right">';
    }

    var postHtml =

        '<div class="thumbnail" id="postThumbnail'+postId+'"> '

        /* post Details */
        +'<div style="height: 40px">'
        +'<img src='+userImagePath+' alt="..."  width="40" align="left" style="max-height:100%">'
        +'<div style="padding-left: 1.2cm; max-height:100%">'
        +userName
        +privacyHtml
        +'<br>'
        +postDate
        +'</div>'

        +'</div>'


        /* post Text */
        +'<div style="padding-top: 0.3cm" >'
        +postText
        +'</div> <br>'

        /* post Image */
        +'<img id="myImg'+postId+'" src='+postImgPath+' alt="..s." align="center" style="max-width: 100%; max-height:100%" onclick="tapPostImage('+ postId +')">  '
        +'<div id="myModal'+postId+'" class="modal"><img class="modal-content" id="img'+postId+'"> <div id="caption"></div> </div>'



        /* post Actions */
        +'<div style="padding-top: 0.3cm;"></div>'
        +'<div style="height: 1px; background-color: lightgray"></div>'
        +'<div style="padding-top: 0.2cm; padding-left: 0.2cm; height: 25px">'
        +'<ul style="list-style-type: none; overflow: hidden; display: inline;">'
        +'<li style="display: block; float: left;"><input id='+postId+' type="image" src="../images/main/like_ic.jpg" width="30" height="30" onclick="likeClicked('+ postId +')"></li>'
        +'<li style="display: block; float: left; padding-left: 4px; padding-top: 8px;"><div id="numOfLikes'+postId+'">'+likeCount+'</div></li>'
        // +'<li style="display: block; float: left; padding-left: 14px; padding-top: 8px;"><a id="myLink" title="Share"href="#" onclick="shareClicked();return false;">Share</a></li>'
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
        +'<li style="display: block; float: left;"><img src="../images/main/no-profile-pic.jpg" alt="..."  width="40" align="left" style="max-height:100%"></li>'
        +'<li style="display: block; float: left; padding-left: 16px; padding-top: 8px; "><input type="text" id="commentTextField'+postId+"\""+' style="width: 250%" placeholder="Add a comment..."></li>'
        +'<li style="display: block; float: right; padding-right: 10px; padding-top: 11px;"><a id="myLink" title="Add"href="#" onclick="addCommentClicked('+postId+');return false;">Add</a></li>'
        +'</ul>'
        +'</div>'

        +'</div>';

    return postHtml;
}

function createCommentHtmlFromCommentJson(commentJson) {
    var commentUserName = commentJson.author;
    var commentImgPath = commentJson.commentImgPath === null ? "../images/main/no-profile-pic.jpg" : commentJson.commentImgPath;
    var commentText = commentJson.text;
    var commentDate = commentJson.postDate;

    var commentsHtml =
        '<li style="padding-left: 0.2cm; padding-right: 0.2cm; padding-top: 0.5cm">'
        +'<div>'
        +'<img src='+commentImgPath+' alt="..."  width="40" height="40" align="left" style="padding-right: 0.1cm">'
        +commentUserName+':'
        +'<br>'
        +commentDate
        +'<br>'
        +commentText
        +'</div>'
        +'</li>';

    return commentsHtml;
}

/* Helpers */

function formattedDateStr(date) {
    var hr = date.getHours()
    var min = date.getMinutes()
    var formatted = $.datepicker.formatDate("yy M d, "+hr+":"+min, date)

    return formatted;
}


