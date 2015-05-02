<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YOLO Forum</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        list-style: none;
        box-sizing: border-box;
    }
    body {
        background: #9FDFED;
    }
    #content {
        margin-top: 30px;
        box-shadow: 0 0 30px rgba(0,0,0,0.1);
        background: #ffffff;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .mainHeader{
        border-bottom: 1px solid #CEECF2;
    }
    .mainHeader a {
        text-decoration: underline;
    }
    .likeA {
        height: 50px;
        line-height: 50px;
        margin: 0 10px;
    }
    .title {
        margin: 30px 10px;
    }
    .itemSet {
        border-bottom: 1px solid #4687BD;
    }
    .itemSet li{
        display: block;
        width: 100%;
        min-height: 60px;
        border: 1px solid #4687BD;
        border-bottom: none;
    }
    .itemSet li:hover {
        background: #F2F8FC;
    }
    .itemSet li a {
        font-size: 1.2em;
        line-height: 60px;
        margin: 0 10px;
    }
    .setInfo {
        float: right;
        line-height: 60px;
        margin: 0 10px;
    }
    .date1 {
        color: #aaaaaa;
        font-size: 0.8em;
    }
    .button {
        border: none;
        background: #4687BD;
        height: 40px;
        padding: 0 15px;
        color: #ffffff;
        margin: 10px 0;
    }
    .button:hover {
        opacity: 0.8;
    }
    .muchText {
        padding: 30px;
        margin: 0 0 10px;
        background: #4687BD;
        color: #ffffff;
        font-size: 1.2em;
    }
    .posterName {
        opacity: 0.5;
        font-size: 0.8em;
        margin: 0 10px;
    }
    .answerSet li {
        min-height: 60px;
        line-height: 30px;
        padding: 15px;
        border-bottom: 1px solid #4687BD;
    }
    .tagsUl li {
        display: inline-block;
        background: #4687BD;
        color: #ffffff;
        padding: 8px;
        margin: 0 5px 5px 0;
    }
    .styledForm {
        padding: 0 10px;
    }
    .styledForm div {
        margin: 20px 0;
    }
    .styledForm div label, .styledForm div {
        width: 100%;
    }
    .styledForm input[type="text"], .styledForm input[type="password"]{
        max-width: 400px;
        width: 400px;
        height: 35px;
        padding: 0 7px;
    }
    .styledForm textarea {
        max-width: 400px;
        width: 400px;
        height: 100px;
    }
    .example {
        color: #999;
    }
    .errorMsg {
        background: darkred;
        color: #ffffff;
        width: 100%;
        line-height: 30px;
        padding: 10px 20px;
    }
    .inlineLink {
        color: #4687BD;
    }

    #footer {
        width: 100%;
        background: #333;
        min-height: 40px;
        line-height: 40px;
        color: #ffffff;
        padding: 0 10px;
        margin-top: 400px;
    }

    .pLabel {
        font-size: 1.2em;
        font-weight: bold;
    }
    .pLabel + span {
        display: block;
        margin: 0 0 13px 0;
        color: #4687BD;
        font-size: 1.2em;
    }






</style>
<body>
<div id="content" class="container">
    <header class="mainHeader navbar navbar-collapse">
        <div class="navbar-brand">Beautiful Forum</div>
        <?php
        $url = $this->model->getSubUrl();
        if ($this->model->loggedIn()) {
            $username = htmlspecialchars($_SESSION['user']); ?>
            <ul class="nav navbar-nav">
                <li><a href="<?php echo $url?>/home">All categories</a></li>
                <li><a href="<?php echo $url?>/profile">Profile</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="likeA">Hello, <?php echo $username ?></li>
                <li><a href="<?php echo $url?>/logout">Logout</a></li>
            </ul>
        <?php
        }
        else { ?>
            <ul class="nav navbar-nav">
                <li><a href="<?php echo $url?>/home">All categories</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="likeA">Hello, guest</li>
                <li><a href="<?php echo $url?>/login">Login</a></li>
                <li><a href="<?php echo $url?>/register">Register</a></li>
            </ul>
        <?php
        }
        ?>
    </header>























