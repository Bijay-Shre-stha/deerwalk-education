<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/26/2018
 * Time: 5:19 PM
 */

//include "DSS/include/header.php";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deerwalk Education Group</title>
    <link rel='shortcut icon' type='image/x-icon' href='http://it4d.org/wp-content/uploads/2018/04/logoOnly.png' />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="DSS/css/style.css">
    <style>
        body{
            font-weight: 500;
            line-height: 2.9em;
            font-size: 16px;
            min-height: 100%;
            position: relative;
            font-family: "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif;
        }
        html{
            height: 100%;
        }
        .style-1 {
            font-size: 20px;
            padding: 15px 0 35px;
            background: url("DWIT/img/backgroundSocialbottom.jpg") no-repeat center;
            background-size: cover;
            color:#3573a3;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        .navbar{
            height: 62px !important;
        }
        .fntwgt-500{
            font-weight: 500 !important;
        }

        .font136{
            font-size: 136px !important;
        }
        .errorImage{
            height: 500px;
            width: auto;
        }
        .no-pad{
            padding-right: 0px !important;
            padding-left: 0px !important;
        }
        .no-margin{
            margin-right: 0px !important;
            margin-left: 0px !important;
            margin-top: 5px;
        }
        .logo-design{
            height: 60px; position: absolute;top:0;left: 50%;position: absolute;transform: translateX(-50%);
            padding: 5px 0;
        }
        .navbar{
            border-radius: 0px !important;
            margin-bottom: 0px !important;
            background-color: #0f5288;

        }
        .text-primary{
            color:#0f5288 !important;
        }
        .footer{
            background-color: #fff;
            border-top:2px solid #046031;
            padding: 10px;
            color:#046031;
            font-weight: 700;
            width:100%;
            position: absolute;
            bottom: 0;
        }
        .copyright{
            color: #046031;
        }
        .btn-default:hover{
            background-color:#0f5288;
            transition: 0.6s ease;
            color:#fff;
        }
@media screen and (max-width: 800px){
    .font136{
        font-size: 100px !important;
        text-align: center;
    }
    h3{
        text-align: center;
    }
    .errorImage{
        height: 200px;
        width: auto;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .btn-lg{
        display: block;
        margin-right: auto;
        margin-left: auto;
    }
}
    </style>
</head>
<body>
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand text-primary" href="#"> <strong> <img src="images/Deerwalk_Educational_Group_Logo.png" class="text-center logo-design" /> </strong></a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">  </a> </li>
        </ul>
    </div>
</nav>


<div class="container-fluid">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <h1 class="font136"> Oops!</h1>
        <h3>
            We can't seem to find the <br> page you're looking for.
        </h3>
        <br>
        <a href="http://deerwalk.edu.np">  <button type="button" class="btn btn-default btn-lg "> Return to Homepage </button> </a>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-5 no-pad no-margin">
        <img src="images/deer.png" class="errorImage" />
    </div>
    <div class="col-md-1"></div>
</div>
<footer class="style-1">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-12">
            </div>
            <div class="col-md-6 col-xs-12" style="text-align: center;">
                <span class="fntweight500">© 2018 Deerwalk Education Group - Version 1.0.0</span>
            </div>
            <div class="col-md-3 col-xs-12" style="text-align: right; font-size: large">

            </div>
        </div>
    </div>
</footer>

</body>
</html>
