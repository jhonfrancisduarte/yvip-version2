@extends ('layouts.layout')

@section ('title')
    <title>NYC - YVIP</title>
@endsection

@section ('css')
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
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
                    @livewire('login')
                </div>

            </div>
    </div>

@endsection

@section ('js')

@endsection
