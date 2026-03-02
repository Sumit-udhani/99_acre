<div class="card property-card">
    <div class="card-body p-4">

        <h5 class="fw-semibold mb-3">
            Start posting your property, it’s free
        </h5>

        <p class="text-muted small mb-2">Add Basic Details</p>

        <label class="fw-semibold mb-2">You're looking to ...</label>

        <div class="d-flex gap-2 flex-wrap mb-3">
            @foreach($purposes as $purpose)
                <button type="button"
                    class="btn purpose-btn"
                    data-id="{{ $purpose->id }}">
                    {{ $purpose->name }}
                </button>
            @endforeach
        </div>

        <hr>

        <label class="fw-semibold mt-2">
            Your contact details for the buyer to reach you
        </label>

        <input type="text"
               class="form-control mt-2 mb-3"
               placeholder="Enter mobile number">

        <button class="btn start-btn w-100">
            Start now
        </button>

    </div>
</div>