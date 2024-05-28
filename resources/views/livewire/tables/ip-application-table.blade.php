<div>

    <div class="pop-up-message" @if($popup_message)style="position: fixed; top: 100px !important;"@endif>
        <button type="button" class="close" wire:click="closePopup">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="contents">

                    <div class="contents-header">
                            <h2 class="title">International Program</h2>
                            <h1>CONGRATULATIONS!</h1>
                            <p>You are eligible to apply for International Program</p>
                            <button class="{{ $ipRegRequested === 0 ? 'btn-success' : 'btn-cancel' }}"  wire:click='registerForIp' {{ $ipRegRequested === 0 ? '' : 'disabled' }}>
                                @if($ipRegRequested === 0)
                                    Apply
                                @else
                                    Application Pending
                                @endif
                            </button>
                    </div>

                    <div class="contents-body">
                       

                    </div>

                    <div class="contents-footer">

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
