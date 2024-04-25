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
                    <img src="images/yvip_logo.png" width="160"/>
                    <div class="title-container">
                        <h4>The NYC</h4>
                        <img src="images/yvip.png" alt="" width="230">
                        <h3>Youth Volunteers & International Programs Beneficiaries Hub</h3>
                    </div>
                </div>

                <div class="login-container">
                    @livewire('login')
                </div>

            </div>
    </div>

@endsection

@section ('js')

@endsection
