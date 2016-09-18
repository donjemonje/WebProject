<?php
/**
 * Created by PhpStorm.
 * User: danieleast
 * Date: 17/09/2016
 * Time: 3:10 PM
 */
session_start();
echo $_SESSION['session_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--#region meta-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!--#endregion meta-->

    <!--#region CSS-->
    <!--<link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/bootstrap/3.3.6/css/bootstrap.min.css">-->
    <link href="../bootstrap/Content/bootstrap.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="../css/main.css" rel="stylesheet" />
    <!--#endregion CSS-->

    <!--#region javascript-->
    <script src="../bootstrap/Scripts/jquery-1.9.1.js"></script>
    <script src="../js/profile.js"></script>
    <script src="../js/main.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.11.4/jquery-ui.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/bootstrap/3.3.6/bootstrap.min.js"></script>
    <!--#endregion javascript-->

    <title>Social Networking Web Site</title>
</head>

<body>

<!-- top nav -->
<div class="navbar navbar-blue navbar-static-top">
    <div class="navbar-header">
        <a  class="navbar-brand logo">M&D</a>
    </div>
    <nav class="collapse navbar-collapse" role="navigation">
        <ul class="nav navbar-nav">
            <li>
                <a href="main.php"><i class="glyphicon glyphicon-home"></i> Home</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right right-nav">

            <li>
                <a href="../index.php">LogOut</a>
            </li>
        </ul>
    </nav>
</div>
<!-- /top nav -->

<br><br><br>
<div class="container">
    <div class="row">

        <div class="thumbnail" id="firstThumbnail" >
            <div class="caption">

                <div class="jumbotron" style="background-color: white">
                    <canvas id="profileCanvas" width="250" height="250"></canvas>
                </div>


                <div style="height: 30px;">
                    <ul style="list-style-type: none; overflow: hidden; display: inline;">
                        <li style="display: block; float: left;"><input name="picOneUpload" type="file" accept="image/*" onchange="profilePicUpload(this.files[0])" style="padding-top: 8px"></li>
                        <li style="display: block; float: right; padding-left: 16px; max-width: 490px ;max-height: 300px; ">
                            <a id="myLink" title="Add" href="#" onclick="uploadProfileImageClicked()" style="display: block;padding-right: 27px;padding-top: 8px;text-align:right";>Change</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>



        <footer class="footer">
            <p>&copy; Meital & Daniel 2016</p>
        </footer>

    </div> <!-- /container -->

</body>
</html>

<script>
    $(document).ready(function(){

        $.ajax({
            url:"../php/user.php",
            method:"GET",
            data:{},
            success:function(data)
            {

                var user = JSON.parse(data);


                var cnvs = document.getElementById("profileCanvas");
                var ctx = cnvs.getContext("2d");
                var img = new Image;
                img.src = user.image == null ? "../images/main/no-profile-pic.jpg" : user.image;
                img.crossOrigin = 'Anonymous';
                img.onload = function() {
                    ctx.drawImage(this,0,0, 250, 250);
                };
            }
        });

        $.ajax({
            url:"../php/getPosts.php",
            method:"POST",
            data:{query:"me"},
            success:function(data)
            {
				//alert(data);
                var postsArr = JSON.parse(data);
                for (var i = 0; i < postsArr.length; i++) {
                    var post = postsArr[i];
                    var htmlWall = createPostHtml(post, true);
                    $(htmlWall).insertAfter("#firstThumbnail");
                }

            }
        });



    });
</script>
