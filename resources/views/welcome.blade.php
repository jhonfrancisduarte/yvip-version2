@extends ('layouts.layout')

@section ('title')
    <title>NYC - YVIP</title>
@endsection

@section ('css')
    <link href="css/welcome.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/announcement.css">
    <link rel="stylesheet" type="text/css" href="css/volunteer.css">
@endsection


@section ('main-content')

    <div class="main-container">
            <div class="landing-page-hero">
                
                <div class="welcome-header">
                    <img class="logo" src="images/yvip_logo.png" width="230"/>
                    <div class="title-container">
                        <h4>The NYC</h4>
                        <img src="images/yvip.png" alt="" width="100">
                        <h3>Youth Volunteers & International Programs Beneficiaries Hub</h3>
                    </div>
                    {{-- <div class="info-container">
                        <p>Some custom info can be placed here such as contacts or other details</p>
                    </div> --}}
                </div>

                

                <div class="login-container">
                    <div class="login-form-container">
                        @livewire('login')
                        @livewire('forgot-password')
                    </div>
                </div>

            </div>

            @livewire('main-announcement')
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
