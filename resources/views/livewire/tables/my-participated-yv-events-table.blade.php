<div>
    <div class="pop-up-message" @if($popup_message)style="position: absolute; top: 100px !important;"@endif>
            <button type="button" class="close" wire:click="closePopup">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ $popup_message }}</p>
        </div>
        <div class="bg-white p-3">
            <div class="card-header">
                <h3 class="card-title">My Participated YV Events</h3> 
            </div>
        </div>
    </div>
</div>
