<x-modal-action :action="$action">
    @if ($data->package_ID)
        @method('PUT')
    @endif
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <input type="text" name="start_date" value="{{ $data->start_Date }}" class="form-control datepicker" placeholder="Start Date">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <input type="text" name="end_date" value="{{ $data->end_Date }}" class="form-control datepicker" placeholder="End Date">
            </div>
        </div>
        <div class="col-12 mb-3">
            <label for="package_name">Package Name</label>
            <select name="package_name" class="form-select">
                <option value="" selected disabled>Select...</option>
                <option value="Wedding" {{ $data->package_Name == 'Wedding' ? 'selected' : '' }}>Wedding</option>
                <option value="Graduation" {{ $data->package_Name == 'Graduation' ? 'selected' : '' }}>Graduation</option>
                <option value="Birthday Party" {{ $data->package_Name == 'Birthday Party' ? 'selected' : '' }}>Birthday Party</option>
                <option value="Engagement" {{ $data->package_Name == 'Engagement' ? 'selected' : '' }}>Engagement</option>
                <option value="Studio Photoshoot" {{ $data->package_Name == 'Studio Photoshoot' ? 'selected' : '' }}>Studio Photoshoot</option>
            </select>
        </div>
        <div class="col-12 mb-3">
            <label for="service_type">Service Type</label>
            <select name="service_type" class="form-select">
                <option value="" selected disabled>Select...</option>
                <option value="Photographer" {{ $data->service_Type == 'Photographer' ? 'selected' : '' }}>Photographer</option>
                <option value="Videographer" {{ $data->service_Type == 'Videographer' ? 'selected' : '' }}>Videographer</option>
            </select>
        </div>
        <div class="col-12 mb-3">
            <label for="priceRange">PRICE RANGE (RM) :</label>
            <input type="range" id="priceRange" name="price_range" min="0" max="10000" step="100" oninput="this.nextElementSibling.value = this.value" value="{{ $data->price_range }}">
            <output>{{ $data->price_range }}</output>
        </div>
        <div class="col-6 mb-3">
            <label for="time_from">Time From</label>
            <input type="time" name="time_from" value="{{ $data->time_From }}" class="form-control">
        </div>
        <div class="col-6 mb-3">
            <label for="time_to">Time To</label>
            <input type="time" name="time_to" value="{{ $data->time_To }}" class="form-control">
        </div>
        <div class="col-12 mb-3">
            <label for="location">Location</label>
            <select name="location" class="form-select">
                <option value="" selected disabled>Select...</option>
                <option value="Cheras" {{ $data->location == 'Cheras' ? 'selected' : '' }}>Cheras</option>
                <option value="Ampang" {{ $data->location == 'Ampang' ? 'selected' : '' }}>Ampang</option>
                <option value="Kajang" {{ $data->location == 'Kajang' ? 'selected' : '' }}>Kajang</option>
                <option value="Semenyih" {{ $data->location == 'Semenyih' ? 'selected' : '' }}>Semenyih</option>
                <option value="Batu Caves" {{ $data->location == 'Batu Caves' ? 'selected' : '' }}>Batu Caves</option>
                <option value="Rawang" {{ $data->location == 'Rawang' ? 'selected' : '' }}>Rawang</option>
                <option value="Setapak" {{ $data->location == 'Setapak' ? 'selected' : '' }}>Setapak</option>
                <option value="Dengkil" {{ $data->location == 'Dengkil' ? 'selected' : '' }}>Dengkil</option>
                <option value="Sepang" {{ $data->location == 'Sepang' ? 'selected' : '' }}>Sepang</option>
                <option value="Petaling Jaya" {{ $data->location == 'Petaling Jaya' ? 'selected' : '' }}>Petaling Jaya</option>
                <option value="Shah Alam" {{ $data->location == 'Shah Alam' ? 'selected' : '' }}>Shah Alam</option>
                <option value="Damansara" {{ $data->location == 'Damansara' ? 'selected' : '' }}>Damansara</option>
                <option value="Sungai Buloh" {{ $data->location == 'Sungai Buloh' ? 'selected' : '' }}>Sungai Buloh</option>
                <option value="Subang" {{ $data->location == 'Subang' ? 'selected' : '' }}>Subang</option>
                <option value="Puchong" {{ $data->location == 'Puchong' ? 'selected' : '' }}>Puchong</option>
            </select>
        </div>
        @if ($data->package_ID)
            <div class="col-12">
                <div class="mb-3">
                    <button type="button" id="delete-event" class="btn btn-danger">Delete</button>
                </div>
            </div>
        @endif
    </div>
</x-modal-action>
