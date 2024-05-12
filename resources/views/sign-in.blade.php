@extends ('layouts.layout')

@section ('title')
    <title>NYC - YVIP</title>
@endsection

@section ('css')
    <link href="css/welcome.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/announcement.css">
    <link rel="stylesheet" type="text/css" href="css/volunteers.css">
@endsection


@section ('main-content')

    <div class="main-container">

            <div class="top-nav2">
                <div class="top-buttons">
                    <a href="/">Back</a>
                </div>
            </div>

            <div class="sign-inside">
                <div class="nyc2">
                    <img class="signin-logo2" src="images/nyc_logo.png"/>
                    <p>National Youth Commission</p>
                </div>
                <div class="signin-logos">
                    <img class="signin-logo" src="images/yvip_logo.png"/>
                    <div class="yvip">
                        <img src="images/maskhead.png" alt="" width="220">
                        <p style="font-size: 20px">Youth Volunteers & <br>International Programs <br>Beneficiaries Hub</p>
                    </div>
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

        // const signInLink = document.querySelector('.sign-in');
        // const loginContainer = document.querySelector('.login-container');
        // const content = document.querySelector('.landing-content');

        // signInLink.addEventListener('click', (event) => {
        //     event.preventDefault();

        //     loginContainer.classList.toggle('show');
        //     content.classList.toggle('show');
        // });

    </script>
@endsection