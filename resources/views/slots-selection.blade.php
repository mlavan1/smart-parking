@extends('layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/search.css') }}">
@endsection

@section('main')
    <div class="details_container">
        <div class="details_tile ctm_date">Date : <span
                style="font-weight: 600">&nbsp;{{ \Carbon\Carbon::parse(request('date'))->format('jS F') }}</span></div>
        <div class="details_tile ctm_time">Time : <span
                style="font-weight: 600">&nbsp;{{ \Carbon\Carbon::parse(request('time'))->format('h : i a') }}</span></div>
    </div>
    <div class="container parking_container">
        <h1 class="ctm_heading">Parking Slot Selection</h1>

        <div class="legend">
            <div><span class="green"></span> Open</div>
            <div><span class="yellow"></span> Pending</div>
            <div><span class="red"></span> Booked</div>
        </div>

        <form id="bookingForm" class="form_container" method="GET" action="{{ route('auth.check') }}">
            @csrf
            <input type="hidden" name="slots" id="selectedSlots" value="">
            <div class="slots-container">
                @php
                    $preselectedSlots = session('selected_slots', []);
                @endphp
                @foreach ($slots as $key => $slot)
                    <div class="slot {{ $slot->status === 'open' ? 'open' : ($slot->status === 'booked' ? 'booked' : 'pending') }}"
                        data-id="{{ $slot->name }}">
                        {{ $slot->name }}
                    </div>
                @endforeach
            </div>
            <button class="submit_btn" id="bookButton" disabled type="submit">Book Now</button>
        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        const preselectedSlots = @json($preselectedSlots ?? []);

        // FOR SELECTING MORE THAN ONE SLOT

        // $(document).ready(function() {
        //     const $slots = $(".slot.open");
        //     const $bookButton = $("#bookButton");
        //     const $selectedSlotsInput = $("#selectedSlots");
        //     let selectedSlots = [];

        //     if (preselectedSlots.length > 0) {
        //         preselectedSlots.forEach(slotId => {
        //             const $slotEl = $(`.slot[data-id="${slotId}"]`);
        //             if ($slotEl.length) {
        //                 $slotEl.addClass("selected");
        //                 selectedSlots.push(slotId);
        //             }
        //         });

        //         $selectedSlotsInput.val(selectedSlots.join(","));
        //         $bookButton.prop("disabled", selectedSlots.length === 0);
        //     }

        //     $slots.on("click", function() {
        //         const slotId = $(this).data("id");

        //         if (selectedSlots.includes(slotId)) {
        //             selectedSlots = selectedSlots.filter(id => id !== slotId);
        //             $(this).removeClass("selected");
        //         } else {
        //             selectedSlots.push(slotId);
        //             $(this).addClass("selected");
        //         }

        //         $selectedSlotsInput.val(selectedSlots.join(","));
        //         $bookButton.prop("disabled", selectedSlots.length === 0);
        //     });
        // });

        // FOR SELECTING ONLY ONE SLOT

        $(document).ready(function() {
            const $slots = $(".slot.open");
            const $bookButton = $("#bookButton");
            const $selectedSlotsInput = $("#selectedSlots");
            let selectedSlots = [];

            if (preselectedSlots.length > 0) {

                const slotId = preselectedSlots[0];
                const $slotEl = $(`.slot[data-id="${slotId}"]`);

                if ($slotEl.length) {
                    $slotEl.addClass("selected");
                    selectedSlots = [slotId];
                }

                $selectedSlotsInput.val(selectedSlots.join(","));
                $bookButton.prop("disabled", selectedSlots.length === 0);
            }

            $slots.on("click", function() {
                const slotId = $(this).data("id");
                const wasSelected = $(this).hasClass("selected");

                $slots.removeClass("selected");
                selectedSlots = [];

                if (!wasSelected) {
                    $(this).addClass("selected");
                    selectedSlots.push(slotId);
                }

                $selectedSlotsInput.val(selectedSlots.join(","));
                $bookButton.prop("disabled", selectedSlots.length === 0);
            });
        });
    </script>
@endsection
