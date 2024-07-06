<x-modal-action :action="$action">
    @if ($data->id)
        @method('PUT')
    @endif
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <input type="text" name="start_date" value="{{ $data->start_date }}" class="form-control datepicker" placeholder="Start Date">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <input type="text" name="end_date"  value="{{ $data->end_date }}" class="form-control datepicker" placeholder="End Date">
            </div>
        </div>
        <div class="col-12">
            <textarea name="title" class="form-control" placeholder="Event Title">{{ $data->event_name }}</textarea>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="category" id="category-success" value="success" {{ $data->category == 'success' ? 'checked' : '' }}>
                    <label class="form-check-label" for="category-success">Success</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="category" id="category-pending" value="pending" {{ $data->category == 'pending' ? 'checked' : '' }}>
                    <label class="form-check-label" for="category-pending">Pending</label>
                </div>
            </div>
        </div>


        
        
        <div class="col-12 mb-3">
            <label for="service_type">Service Type</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="service_type" id="service_photographer" value="Photographer" {{ $data->service_type == 'Photographer' ? 'checked' : '' }}>
                <label class="form-check-label" for="service_photographer">Photographer</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="service_type" id="service_videographer" value="Videographer" {{ $data->service_type == 'Videographer' ? 'checked' : '' }}>
                <label class="form-check-label" for="service_videographer">Videographer</label>
            </div>
        </div>
        <div class="col-6 mb-3">
            <label for="time_from">Time From</label>
            <input type="time" name="time_from" value="{{ $data->time_from }}" class="form-control">
        </div>
        <div class="col-6 mb-3">
            <label for="time_to">Time To</label>
            <input type="time" name="time_to" value="{{ $data->time_to }}" class="form-control">
        </div>
        <div class="col-12 mb-3">
            <label for="package">Package</label>
            <select name="package" class="form-select">
                <option value="Wedding" {{ $data->package == 'Wedding' ? 'selected' : '' }}>Wedding</option>
                <option value="Graduation" {{ $data->package == 'Graduation' ? 'selected' : '' }}>Graduation</option>
                <option value="Birthday party" {{ $data->package == 'Birthday party' ? 'selected' : '' }}>Birthday party</option>
                <option value="Engagement" {{ $data->package == 'Engagement' ? 'selected' : '' }}>Engagement</option>
                <option value="Studio Photoshoot" {{ $data->package == 'Studio Photoshoot' ? 'selected' : '' }}>Studio Photoshoot</option>
            </select>
        </div>
        <div class="col-12 mb-3">
            <label for="package_price">Package Price (RM)</label>
            <input type="number" name="package_price" value="{{ $data->package_price }}" class="form-control" min="0" max="10000" step="0.01">
        </div>






        <div class="col-12">
            <div class="mb-3">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="delete" role="switch" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Delete</label>
                </div>
            </div>
        </div>
    </div>
</x-modal-action>
