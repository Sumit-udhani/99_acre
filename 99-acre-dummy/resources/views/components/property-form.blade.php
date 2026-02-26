<div class="card shadow p-4" style="border-radius:15px;">
    <h5 class="mb-3">Start posting your property, it’s free</h5>

    <label class="mb-2 fw-bold">You're looking to ...</label>

    <div class="d-flex gap-2 mb-3">
        @foreach($purposes as $purpose)
            <button type="button"
                class="btn btn-outline-primary purpose-btn"
                data-id="{{ $purpose->id }}">
                {{ $purpose->name }}
            </button>
        @endforeach
    </div>

    <hr>

    <label class="fw-bold">Your contact details</label>
    <input type="text" class="form-control mt-2" placeholder="Enter mobile number">

    <button class="btn btn-primary w-100 mt-3">
        Start Now
    </button>
</div>