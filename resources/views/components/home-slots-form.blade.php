<section class="find_section">
    <div class="container">
        <form action="{{ url('/location-selection') }}" method="get">

            <div class=" form-row">
                <div class="col-lg-3 d-flex flex-column align-items-start">
                    <label for="carlocation">Select Location</label>
                    <select name="location_id" class="form-control" id="carlocation">
                        <option value="" disabled {{ old('location_id') ? '' : 'selected' }}>Select a location</option>
                        @foreach ($places as $place)
                        <option value="{{ $place->id }}" {{ old('location_id') == $place->id ? 'selected' : '' }}>{{ $place->location_name }}</option>
                        @endforeach

                    </select>
                    @error('location_id')
                        <span style="color: red;font-size:0.8em"><i>{{ $message }}</i></span>
                    @enderror
                </div>
                <div class="col-lg-3 d-flex flex-column align-items-start">
                    <label for="parkingDate">Select Your Date</label>
                    <input type="date" name= "date" class="form-control" id="parkingDate" value="{{ old('date') }}">
                    @error('date')
                        <span style="color: red;font-size:0.8em"><i>{{ $message }}</i></span>
                    @enderror
                </div>

                <div class="col-lg-3 d-flex flex-column align-items-start">
                    <label for="parkingTime">Select Your Time</label>
                    <input type="time" name="time" class="form-control" id="parkingTime" value="{{ old('time') }}">
                    @error('time')
                        <span style="color: red;font-size:0.8em"><i>{{ $message }}</i></span>
                    @enderror
                </div>
                <div class="col-lg-3 d-flex justify-content-center align-items-center">
                    <div class="btn-container d-flex flex-column align-items-end justify-content-{{ ($errors->has('time') || $errors->has('date') || $errors->has('location_id'))?'center':'end' }}">
                        <button type="submit" class="search_slots_btn">Search Slots</button>

                    </div>
                </div>
            </div>

        </form>
    </div>
</section>
