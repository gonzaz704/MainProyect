<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link href="font-awesome.min.css" rel="stylesheet">
    <style>
        .logo {
            width: 400px;
        }

        td {
            line-height: 22px;
        }

        p {
            margin-bottom: 0px;
            margin-top: 4px;
        }

        .icon {
            margin-right: 5px;
            color: #e41e2d;
            float: left;
            width: 20px;
        }

        .text-center td {
            line-height: 22px;
            display: block;
            text-align: center;
        }

        .body {
            display: block;
            margin-left: 20px;
            line-height: 24px;
            margin-right: 20px;
        }

        .logo {
            text-align: center;
        }

        .footer td {
            margin-top: 13px;
        }

        h4 {
            margin: 0px;
            border-bottom: 1px solid #ccc;
            text-align: center;
            padding-bottom: 10px;
            color: #e41e2d;
        }

        tr.body:after {
            display: table;
            clear: both;
            content: "";
        }

        .shipping-dtails {
            border-top: 1px solid #ccc;
            width: 100%;
            display: block;
            clear: both;
            margin-top: 20px;
            padding-top: 10px;
        }

        .shipping-summary p {
            word-break: break-all;
            width: 95%;
            font-size: 12px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .shipping-summary td {
            width: 32.33%;
            display: block;
            float: left;
        }

        .shipping-summary h5 {
            border-bottom: 1px solid #ccc;
            margin: 0px;
            margin-top: 10px;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 60px;
            border-top: 1px solid #ccc;
        }

        .footer-image {
            text-align: center;
        }

        .icon-right {
            width: 20px;
            margin-right: 5px;
            float: right;
            margin-top: 2px;
        }

        .pull-right {
            float: right;
        }

        a {
            color: #333;
            text-decoration: none;
        }

        .footer a {
            color: blue;
            text-decoration: underline;
        }

        .password-email-container {
            width: 70%;
            margin: 50px auto;
            border: 1px solid #111;
            font-family: 'Roboto', sans-serif;
            font-weight: 400;
            color: #231F20;
            table-layout: fixed;
            padding: 40px 0px 10px;
        }

        .text-center {
            text-align: center;
        }

        @media only screen and (max-width: 768px) {
            .footer td {
                width: 50%;
                font-size: 10px;
                line-height: 12px;
            }

            .icon {
                width: 12px;
            }

            .icon-right {
                width: 12px;
            }

        }

        @media only screen and (max-width: 480px) {
            .logo {
                width: 80%;
            }

            h5 {
                margin: 0px;
            }

            .product {
                width: 100%;
            }

            h2 {
                font-size: 20px;
            }

            .shipping-summary p {
                font-size: 10px;
            }

        }

    </style>
</head>
<body>
<table class="password-email-container">
    <tr class="logo">
        <td><img class="logo" src="images/logo" alt="papers"></td>
    </tr>

    <tr>
        <td class="body">
            <p>Dear {{ $user->name }}</p>
            <p>You are Following Paper: {{$paper->title}}</p>
        </td>
    </tr>
    <tr class="body">
        <td>
            <p>Regards,</p>
            <p>Paperrs</p>
        </td>
    </tr>

    <tr class="body shipping-summary footer">
        <td><span><img src="images/logo"
                       class="icon"></span><span>+977-1-4496544</span></td>
        <td class="text-center"><a href="#">https://www.pappers.com/</a></td>
        <td class="text-right"><span class="pull-right">info@test.com</span><span><img
                        src="images/logo" class="text-right icon-right"></span></td>
    </tr>
</table>
</body>
</html>