@extends ('layouts.layout')

@section ('title')
    <title>NYC - YVIP</title>
@endsection

@section ('css')
    <link href="css/welcome.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/announcement.css">
    <link rel="stylesheet" type="text/css" href="css/volunteers.css">
    <style>
        @keyframes slideInLeft {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }
            50% {
                opacity: 0.5;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideInRight {
            0% {
                transform: translateX(100%);
                opacity: 0;
            }
            50% {
                opacity: 0.5;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .signin-logos {
            animation: slideInLeft 1.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            animation-delay: 0.2s;
        }

        .login-form-container {
            animation: slideInRight 1.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            animation-delay: 0.4s;
        }

        .main-container {
            opacity: 0; /* Start hidden */
            animation: fadeIn 0.5s ease-in forwards; /* Fade in to smooth initial appearance */
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>
@endsection

@section ('main-content')
    <div class="main-container">
        <div class="top-nav2">
            <div class="top-buttons">
                <a href="/">Back</a>
            </div>
        </div>
        <div class="sign-inside">
            <div class="signin-logos">
                <img class="signin-logo" src="images/yvip_logo.png" alt="yvip logo"/>
                <div class="yvip2">
                    <div class="nyc-yvip">
                        <img src="images/maskhead.png" alt="yvip maskhead">
                        <p style="font-size: 17px">Youth Volunteers & <br>International Programs Beneficiaries Hub</p>
                    </div>
                </div>
                <img class="signin-logo2" src="images/nyc_logo.png" alt="nyc logo"/>
            </div>
        </div>
        <div class="login-container">
            <div class="login-form-container">
                @livewire('login')
                @livewire('forgot-password')
            </div>
        </div>
    </div>
@endsection

@section ('js')
    <script>
        const container = document.getElementById('forgot-pass-form');
        const toggleButtons = document.getElementsByClassName('forget');

        for (let i = 0; i < toggleButtons.length; i++) {
            toggleButtons[i].addEventListener('click', () => {
                if (container.style.left === '0px') {
                    container.style.left = '-500px';
                } else {
                    container.style.left = '0px';
                }
            });
        }
    </script>
@endsection
