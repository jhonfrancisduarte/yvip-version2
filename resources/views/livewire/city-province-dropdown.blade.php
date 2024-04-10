<div class="input-group">
    <label class="label" for="province">Select Province:</label>
    <select class="label select-status" wire:model.live="selectedProvince" id="province" name="selectedProvince">
        @foreach ($provinces as $province)
            <option class="label" value="{{ $province }}">{{ $province }}</option>
        @endforeach
    </select>

    <label class="label" for="city">Select City:</label>
    <select class="label select-status" wire:model="selectedCity" id="city" name="selectedCity">
        @foreach ($cities as $city)
            <option class="label" value="{{ $city }}">{{ $city }}</option>
        @endforeach
    </select>
</div>
