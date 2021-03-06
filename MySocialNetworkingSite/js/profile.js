/**
 * Created by danieleast on 17/09/2016.
 */

/* Click  Events    */

window.profilePicUpload = function(frmData) {
    console.log("picUpload ran: " + frmData);

    for (objProprty in frmData) {
        console.log(objProprty + " : " + frmData[objProprty]);
    };

    var cnvs=document.getElementById("profileCanvas");

    console.log("cnvs: " + cnvs);
    var ctx=cnvs.getContext("2d");

    var img = new Image;
    img.src = URL.createObjectURL(frmData);

    console.log('img: ' + img);

    img.crossOrigin = 'Anonymous';
    img.onload = function() {
        ctx.clearRect(0, 0, 250, 250);
        ctx.drawImage(this,0,0, 250, 250);
    };

}

function uploadProfileImageClicked() {
    var cnvs = document.getElementById("profileCanvas");
    var imgUrl = cnvs.toDataURL();
    //TODO: add mail UI + logic
    var uploadImgJson = {
        "image": imgUrl,
        // "mail": "TDOD@gmail.com",
    };
    $.ajax({
        url:"../php/user.php",
        method:"POST",
        data:{query: uploadImgJson},
        success:function(data)
        {
            //location.reload();
        }
    });
}

function changePrivacyClicked(postId, isOn) {
    console.log("changePrivacyClicked: postId: " + postId + ", set privacy: " + (isOn ? "ON" :"OFF"));

    var params = {
        "postId":postId,
        "isPrivate": isOn ? "0" : "1",
    };
    $.ajax({
        url:"../php/changePrivacy.php",
        method:"POST",
        data:{query: params },
        success:function(data)
        {
            if(data === "success"){
                reloadPost(postId);
            }

        }
    });
}