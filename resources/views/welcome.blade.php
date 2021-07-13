<!DOCTYPE html>
<html class="cspio">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>New Page</title>

    <meta name="generator" content="comingsoonpage.com 1.0.0" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:url" content="http://eastwestmc.com.np" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Ease West Management Center" />
    <meta property="og:description" content="" />

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap and default Style -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/cspio/style.css')}}">

    <!-- Calculated Styles -->
    <style type="text/css">




        /* Background Style */
        html{
            height:100%;
            background: #ffffff url('{{config('app.url')}}/resources/img/bg.jpg') no-repeat center bottom fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        #cspio-page{
            background-color: rgba(0,0,0,0);
        }

        .flexbox #cspio-page{
            align-items: center;
            justify-content: center;
        }



        .cspio body{
            background: transparent;
        }


        /* Text Styles */
        .cspio body, .cspio body p{
            font-family: Helvetica, Arial, sans-serif;
            font-weight: 400;
            font-style: ;
            font-size: 16px;
            line-height: 1.50em;
            color:#ffffff;
        }

        ::-webkit-input-placeholder {
            font-family:Helvetica, Arial, sans-serif;
            font-weight: 400;
            font-style: ;
        }
        ::-moz-placeholder {
            font-family:Helvetica, Arial, sans-serif;
            font-weight: 400;
            font-style: ;
        } /* firefox 19+ */
        :-ms-input-placeholder {
            font-family:Helvetica, Arial, sans-serif;
            font-weight: 400;
            font-style: ;
        } /* ie */
        :-moz-placeholder {
            font-family:Helvetica, Arial, sans-serif;
            font-weight: 400;
            font-style: ;
        }




        .cspio h1, .cspio h2, .cspio h3, .cspio h4, .cspio h5, .cspio h6{
            font-family: Helvetica, Arial, sans-serif;
            color:#ffffff;
        }
        #cspio-headline{
            font-family: Helvetica, Arial, sans-serif;
            font-weight: 400;
            font-style: ;
            font-size: 42px;
            color:#ffffff;
            line-height: 1.00em;
        }

        .cspio button{
            font-family: Helvetica, Arial, sans-serif;
            font-weight: 400;
            font-style: ;
        }

        /* Link Styles */
        .cspio a, .cspio a:visited, .cspio a:hover, .cspio a:active{
            color: #ffffff;
        }


        #cspio-socialprofiles a {
            color: #ffffff;
        }
        .cspio .btn-primary,
        .cspio .btn-primary:focus,
        .gform_button,
        #mc-embedded-subscribe,
        .mymail-wrapper .submit-button {
            color: black;
            text-shadow: 0 -1px 0 rgba(255,255,255,0.3);
            background-color: #ffffff;
            background-image: -moz-linear-gradient(top,#ffffff,#d9d9d9);
            background-image: -ms-linear-gradient(top,#ffffff,#d9d9d9);
            background-image: -webkit-gradient(linear,0 0,0 100%,from(#ffffff),to(#d9d9d9));
            background-image: -webkit-linear-gradient(top,#ffffff,#d9d9d9);
            background-image: -o-linear-gradient(top,#ffffff,#d9d9d9);
            background-image: linear-gradient(top,#ffffff,#d9d9d9);
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#d9d9d9', GradientType=0);
            border-color: #d9d9d9 #d9d9d9 #b3b3b3;
            border-color: rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
            *background-color: #d9d9d9;
            filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
        }
        .cspio .btn-primary:hover,
        .cspio .btn-primary:active,
        .cspio .btn-primary.active,
        .cspio .btn-primary.disabled,
        .cspio .btn-primary[disabled],
        .cspio .btn-primary:focus:hover,
        .cspio .btn-primary:focus:active,
        .cspio .btn-primary:focus.active,
        .cspio .btn-primary:focus.disabled,
        .cspio .btn-primary:focus[disabled],
        .gform_button:hover,
        .gform_button:active,
        .gform_button.active,
        .gform_button.disabled,
        .gform_button[disabled],
        #mc-embedded-subscribe:hover,
        #mc-embedded-subscribe:active,
        #mc-embedded-subscribe.active,
        #mc-embedded-subscribe.disabled,
        #mc-embedded-subscribe[disabled],
        .mymail-wrapper .submit-button:hover,
        .mymail-wrapper .submit-button:active,
        .mymail-wrapper .submit-button.active,
        .mymail-wrapper .submit-button.disabled,
        .mymail-wrapper .submit-button[disabled] {
            background-color: #d9d9d9;
            *background-color: #cccccc;
        }
        .cspio .btn-primary:active,
        .cspio .btn-primary.active,
        .cspio .btn-primary:focus:active,
        .cspio .btn-primary:focus.active,
        .gform_button:active,
        .gform_button.active,
        #mc-embedded-subscribe:active,
        #mc-embedded-subscribe.active,
        .mymail-wrapper .submit-button:active,
        .mymail-wrapper .submit-button.active {
            background-color: #bfbfbf \9;
        }
        .form-control,
        .progress {
            background-color: #f5f5f5;
        }
        #cspio-progressbar span,
        .countdown_section {
            color: black;
            text-shadow: 0 -1px 0 rgba(255,255,255,0.3);
        }
        .cspio .btn-primary:hover,
        .cspio .btn-primary:active {
            color: black;
            text-shadow: 0 -1px 0 rgba(255,255,255,0.3);
            border-color: #e6e6e6;
        }
        .cspio input[type='text']:focus {
            webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 8px rgba(217,217,217,0.6);
            -moz-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 8px rgba(217,217,217,0.6);
            box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 8px rgba(217,217,217,0.6);
        }


        #cspio-content {
            max-width: 600px;
            background-color: #000000;
            -webkit-border-radius: 2px;
            border-radius: 2px;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
        }

        #cspio-content{
            background-color:transparent;
        }


        .cspio .progress-bar,
        .countdown_section,
        .cspio .btn-primary,
        .cspio .btn-primary:focus,
        .gform_button {
            background-image: none;
            text-shadow: none;
        }
        .countdown_section,
        .cspio .progress-bar {
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        .cspio input,
        .cspio input:focus {
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
        }




        html {
            height: 100%;
            overflow: hidden;
        }
        body
        {
            height:100%;
            overflow: auto;
            -webkit-overflow-scrolling: touch;
        }



        #cspio-page{
            background: -moz-radial-gradient(ellipse at center, rgba(0, 0, 0, 0.3) 0%,rgba(0, 0, 0, 0.2) 37%,rgba(0,0,0,0) 68%,rgba(0,0,0,0) 100%);
            background: -webkit-radial-gradient(ellipse at center, rgba(0, 0, 0, 0.3) 0%,rgba(0, 0, 0, 0.2) 37%,rgba(0,0,0,0) 68%,rgba(0,0,0,0) 100%);
            background: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.3) 0%,rgba(0, 0, 0, 0.2) 37%,rgba(0,0,0,0) 68%,rgba(0,0,0,0) 100%);
        }

        .cspio body{
            background: -moz-radial-gradient(center, ellipse cover,  rgba(0,0,0,0) 7%, rgba(0,0,0,0) 80%, rgba(0,0,0,0.23) 100%); /* FF3.6-15 */
            background: -webkit-radial-gradient(center, ellipse cover,  rgba(0,0,0,0) 7%,rgba(0,0,0,0) 80%,rgba(0,0,0,0.23) 100%); /* Chrome10-25,Safari5.1-6 */
            background: radial-gradient(ellipse at center,  rgba(0,0,0,0) 7%,rgba(0,0,0,0) 80%,rgba(0,0,0,0.23) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#3b000000',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */


        }

        #cspio-subscribe-btn{
            background:transparent;
            border: 1px solid #fff !important;
            color: #fff;
        }

        #cspio-subscribe-btn:hover{
            background: rgba(255,255,255,0.2);
            color: #fff;
        }

        .countdown_section{
            background:transparent;
            color: #fff;
            border: 1px #fff solid;
        }

        #cspio-progressbar span{
            color: #222;
        }

        .progress{
            background-color:transparent;
            border: 1px solid #fff;
        }

    </style>
</head>
<body>
<div id="cspio-page">
    <div id="cspio-content">
        <img id="cspio-logo" src="{{asset('img/logo.png')}}">

        <h1 id="cspio-headline">Coming Soon</h1>
        <div id="cspio-description">Get ready! Something really cool is coming!</div>
        <div id="cspio-description">Login Panel For Test Registration is <a href="{{route('home.index')}}">Here.</a></div>



    </div>
</div>
</body>
</html>
