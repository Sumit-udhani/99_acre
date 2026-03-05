

@if($banner)
<div style="background: linear-gradient(135deg, #e8f4fd 0%, #f0f8ff 50%, #e8f0fe 100%); padding: 100px 0;">

    <div class="container">
        <div class="row align-items-center">

            {{-- LEFT SIDE --}}
            <div class="col-lg-7 position-relative">

                <h2 class="fw-bold display-5 mb-3">
                    {{ $banner->title }}
                </h2>

                <p class="text-primary fs-5 mb-4">
                    {{ $banner->subtitle }}
                </p>

                <div class="mb-4">
                    {!! $banner->description !!}
                </div>
@if($banner->image_path)
    <img src="{{ asset('storage/'.$banner->image_path) }}"
         class="img-fluid"
         style="max-height:350px;">
@endif

                <p style="font-size:13px; color:#888;">
                    * Available with Owner Assist Plans
                </p>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="col-lg-5">
                <x-property-form :purposes="$purposes" :categories="$categories" :types="$types" />
            </div>

        </div>
    </div>

</div>
@endif