{{--@extends('errors::minimal')--}}

{{--@section('title', __('Service Unavailable'))--}}
{{--@section('code', '503')--}}
{{--@section('message', __('Service Unavailable'))--}}
<html>
<head>
    <title>Zoro Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @import "https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,400italic";
        .aqua-bg {
            background-color: #7fdbff;
        }

        .blue-bg {
            background-color: #0074d9;
        }

        .navy-bg {
            background-color: #001f3f;
        }

        .teal-bg {
            background-color: #39cccc;
        }

        .green-bg {
            background-color: #2ecc40;
        }

        .olive-bg {
            background-color: #3d9970;
        }

        .lime-bg {
            background-color: #01ff70;
        }

        .yellow-bg {
            background-color: #ffdc00;
        }

        .orange-bg {
            background-color: #ff851b;
        }

        .red-bg {
            background-color: #ff4136;
        }

        .fuchsia-bg {
            background-color: #f012be;
        }

        .purple-bg {
            background-color: #b10dc9;
        }

        .maroon-bg {
            background-color: #85144b;
        }

        .white-bg {
            background-color: #fff;
        }

        .silver-bg {
            background-color: #ddd;
        }

        .gray-bg {
            background-color: #aaa;
        }

        .black-bg {
            background-color: #111;
        }

        body,
        input,
        option,
        select,
        button {
            font-family: "Source Sans Pro", Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            margin: 0 auto;
            width: 1280px;
            max-width: 100%;
        }

        body {
            background: #1e1e1e;
            height: 100vh;
        }

        header {
            position: relative;
            display: block;
            background: #171717;
            margin-top: 15%;
            border-top: 2px solid black;
            border-bottom: 1px solid #2b2b2b;
            box-shadow: 0px -1rem 0px 0px #3171a8;
        }
        header:before, header:after {
            content: "";
            position: absolute;
            width: 150%;
            height: 100%;
            margin: 0px -25%;
            width: 100%;
        }
        header:before {
            width: 125%;
            z-index: 0;
            box-shadow: inset 0px 0px 20px 10px #111, inset 0px 0px 2px 3px #111;
        }
        header:after {
            width: 125%;
            z-index: 1;
            height: 60px;
            bottom: -61px;
            background: linear-gradient(rgba(255, 255, 255, 0.02), rgba(255, 255, 255, 0));
        }

        h1 {
            position: relative;
            z-index: 2;
            font-size: 4rem;
            line-height: 4rem;
            margin: 3.5rem 0px;
            text-align: center;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.75);
            text-shadow: 1px 3px 1px #000;
        }

        p {
            font-size: 1.25rem;
            letter-spacing: 0.07rem;
            padding: 1.2rem 4rem;
            margin: 0rem;
            line-height: 1.8rem;
            color: #fff;
            text-align: center;
            opacity: 0.5;
        }
    </style>
</head>
<body>
<!-- JJ -->
<header>
    <h1>Coming Soon - انتظرونا قريبا</h1>
</header>
<p>Our new site is almost ready! - !موقعنا الجديد جاهز تقريبًا</p>
<p style="margin: 0; padding: 0;">Created by <a style="color: lightblue;" href="https://business.mrtechnawy.com">Mr Technawy</a></p>
<!-- SDG -->
</body>
</html>
