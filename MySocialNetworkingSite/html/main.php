﻿<?php
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
<!--&lt;!&ndash; main right col &ndash;&gt;-->
<!--<div class="column col-sm-10 col-xs-11" id="main">-->

<!-- top nav -->
<div class="navbar navbar-blue navbar-static-top">
    <div class="navbar-header">
        <!--<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">-->
            <!--<span class="sr-only">Toggle</span>-->
            <!--<span class="icon-bar"></span>-->
            <!--<span class="icon-bar"></span>-->
            <!--<span class="icon-bar"></span>-->
        <!--</button>-->
        <a  class="navbar-brand logo">M&D</a>
    </div>
    <nav class="collapse navbar-collapse" role="navigation">
        <form class="navbar-form navbar-left" action='../php/search.php'>
            <div class="input-group input-group-sm" style="max-width:360px;">
                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term" value="">
				
                <div class="input-group-btn">
                    <button class="btn btn-default" name="submit_search" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </form>
        <ul class="nav navbar-nav">
            <li>
                <a href="profile.html"><i class="glyphicon glyphicon-user"></i> Profile</a>
            </li>
            <!--<li>-->
                <!--<a href="#postModal" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Post</a>-->
            <!--</li>-->
            <!--<li>-->
                <!--<a href="#"><span class="badge">badge</span></a>-->
            <!--</li>-->


        </ul>
        <ul class="nav navbar-nav navbar-right right-nav">
            <!--<li class="dropdown">-->
                <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i></a>-->
                <!--<ul class="dropdown-menu">-->
                    <!--<li><a href="">More</a></li>-->
                    <!--<li><a href="">More</a></li>-->
                    <!--<li><a href="">More</a></li>-->
                    <!--<li><a href="">More</a></li>-->
                    <!--<li>-->
                        <!--<a href="../index.html">LogOut</a>-->
                    <!--</li>-->
                <!--</ul>-->
            <!--</li>-->
            <li>
                <a href="../php/logout.php">LogOut</a>
            </li>
        </ul>
    </nav>
</div>
<!-- /top nav -->
<br><br><br>
    <div class="container">
        <!--<div class="header clearfix">-->
            <!--<h3 class="text-muted">My Social Network Site</h3>-->
            <!--<nav>-->
                <!--<ul class="nav nav-tabs">-->
                    <!--<li role="presentation" class="active"><a href="#">Home</a></li>-->
                    <!--<li role="presentation"><a href="profile.html">Profile</a></li>-->
                    <!--<li role="presentation"><a href="#">Messages</a></li>-->

                    <!--<li role="presentation"><a href="../index.html">LogOut</a></li>-->
                <!--</ul>-->
            <!--</nav>-->
        <!--</div>-->

    <!-- ************************************************************************ -->
        <div class="row">
            <!-- ************************************************* -->
            <div class="thumbnail" id="firstThumbnail">
                <div class="caption">
                    <h3>Thumbnail label</h3>
                    <p>
                        <button id="avi">Button</button>
                    </p>
                </div>
            </div>
            <!-- ************************************************* -->
            <div class="thumbnail">
                <div class="thumbnail">
                    <img src="../images/main/1425577_1283411931698966_2669253318689249575_n.jpg" alt="..." height="40" width="40" align="left">
                    <br />
                    <p>Avi Nessimian</p>
                </div>
                <img src="../images/main/little-mermaid.jpg" alt="..." height="400" width="400">
                <br />
            </div>
            <!-- ************************************************* -->
            <div class="thumbnail">
                <div class="caption">
                    <h3>Thumbnail label</h3>
                    <p>
                        <a href="#" class="btn btn-primary" role="button">Button</a>
                        <a href="#" class="btn btn-default" role="button">Button</a>
                        <a href="#" class="btn btn-default" role="button">Button</a>
                        <a href="#" class="btn btn-default" role="button">Button</a>
                    </p>
                </div>
            </div>
            <!-- ************************************************* -->
            <div class="thumbnail">
                <div class="caption">
                    <h3>Thumbnail label</h3>
                    <p>
                        <a href="#" class="btn btn-primary" role="button">Button</a>
                        <a href="#" class="btn btn-default" role="button">Button</a>
                        <a href="#" class="btn btn-default" role="button">Button</a>
                        <a href="#" class="btn btn-default" role="button">Button</a>
                    </p>
                </div>
            </div>
    <!-- ************************************************************************ -->
        </div>
    

        <footer class="footer">
            <p>&copy; Company 2016</p>
        </footer>

    </div> <!-- /container -->

</body>
</html>
