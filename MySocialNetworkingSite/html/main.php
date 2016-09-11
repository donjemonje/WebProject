<?php
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
        <form class="navbar-form navbar-left" id="searchForm">
            <div class="input-group input-group-sm" style="max-width:360px;">
                <input type="text" class="form-control" placeholder="Search" name="searchText" id="searchText" autocomplete="off" value="" list="exampleList">
                <datalist id="exampleList">
                </datalist>
               
            </div>
        </form>
        <ul class="nav navbar-nav">
            <li>
                <a href="#" onclick="searchClicked()"><i class="glyphicon glyphicon-search"></i></a>
            </li>
        </ul>
        <ul class="nav navbar-nav">
            <li>
                <a href="profile.html"><i class="glyphicon glyphicon-user"></i> Profile</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right right-nav">

            <li>
                <a href="../php/logout.php">LogOut</a>
            </li>
        </ul>
    </nav>
</div>
<!-- /top nav -->

<br><br><br>
    <div class="container">
        <div class="row">
            <!-- ************************************************* -->
            <div class="thumbnail" id="firstThumbnail" >
                <div class="caption">

                    <div style="height: 250px;">
                        <ul style="list-style-type: none; overflow: hidden; display: inline;">
                            <li style="display: block; float: left;"><img src="../images/main/1425577_1283411931698966_2669253318689249575_n.jpg" alt="..."  width="40" align="left" style="max-height:100%"></li>
                            <li style="display: block; float: left; padding-left: 16px; max-width: 490px ;">
                                <div id="postTextField" class="editable" contentEditable=true data-ph="What's On Your Mind..." style="max-height:230px;overflow-y: scroll; width: 490px;"></div>
                            </li>
                        </ul>
                    </div>

                    <div style="height: 30px;">
                        <ul style="list-style-type: none; overflow: hidden; display: inline;">
                            <li style="display: block; float: left;"><input name="picOneUpload" type="file" accept="image/*" onchange="picUpload(this.files[0])" style="padding-top: 8px"></li>
                            <li style="display: block; float: right; padding-left: 16px; max-width: 490px ;max-height: 300px; ">
                                <a id="myLink" title="Add" href="#" onclick="uploadPostClicked()" style="display: block;padding-right: 27px;padding-top: 8px;text-align:right";>Post</a>
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
      $('#searchText').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"../php/search.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {

                         var jsonData = JSON.parse(data);
                         var htnlRes = "";
                         for (var i = 0; i < jsonData.length; i++) {
                             var counter = jsonData[i];
                             htnlRes += '<option value='+ counter +'>';
                         }
                         $('#exampleList').html(htnlRes);


                     }
                });  
           }  
      });  

 });  
 </script>

<script>
    $(document).ready(function(){

        $.ajax({
            url:"../php/getPosts.php",
            method:"POST",
            data:{query:"me"},
            success:function(data)
            {

                var postsArr = JSON.parse(data);
                for (var i = 0; i < postsArr.length; i++) {
                    var post = postsArr[i];
                    var htmlWall = createPostHtml(post);
                    $(htmlWall).insertAfter("#firstThumbnail");
                }


            }
        });

    });
</script>
