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