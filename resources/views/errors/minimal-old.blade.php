<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="{{ assetHelper('images/ico/e-learning.png') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ assetHelper('images/ico/favicon.ico') }}">

        <title>@yield('title')</title>

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */

            body {
                background-color: #efefef;
            }
            svg {
                position: absolute;
                top: 50%;
                left: 50%;
                margin-top: -250px;
                margin-left: -400px;
            }
            .message-box {
                height: 200px;
                width: 380px;
                position: absolute;
                top: 50%;
                left: 50%;
                margin-top: -100px;
                margin-left: 50px;
                font-family: Roboto;
                font-weight: 300;
            }
            .message-box h1 {
                font-size: 60px;
                line-height: 46px;
                margin-bottom: 40px;
            }

            #Polygon-1 , #Polygon-2 , #Polygon-3 , #Polygon-4 , #Polygon-4, #Polygon-5 {
                animation: float 1s infinite ease-in-out alternate;
            }
            #Polygon-2 {
                animation-delay: .2s;
            }
            #Polygon-3 {
                animation-delay: .4s;
            }
            #Polygon-4 {
                animation-delay: .6s;
            }
            #Polygon-5 {
                animation-delay: .8s;
            }

            @keyframes float {
                100% {
                    transform: translateY(20px);
                }
            }
            @media (max-width: 450px) {
                svg {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    margin-top: -250px;
                    margin-left: -190px;
                }
                .message-box {
                    top: 50%;
                    left: 50%;
                    margin-top: -100px;
                    margin-left: -190px;
                    text-align: center;
                }
            }
        </style>

        <link rel="stylesheet" type="text/css" media="all" href="{{ assetHelper('customs/css/error_page.css') }}" />
    </head>
    <body>
        <div id="body">
            <h1 class="shadow">{{ $exception->getMessage() ?: 'This Page Not Found' }}</h1>
            <section class="error-container">
                <span class="four"><span class="screen-reader-text">4</span></span>
                <span class="zero"><span class="screen-reader-text">0</span></span>
                <span class="four"><span class="screen-reader-text">4</span></span>
            </section>
            <p class="zoom-area"> Back To <a href="{{ routeHelper('/') }}" class="btn btn-sm btn-dark"><i class="fa fa-home"></i> Home</a></p>
        </div>
    </body>
</html>
