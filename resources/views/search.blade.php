@extends('layouts.layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/search.css') }}">
@endsection

@section('main')
    <div class="details_container">
        <div class="details_tile ctm_location">Jaffna</div>
        <div class="details_tile ctm_date">12th March 2025</div>
        <div class="details_tile ctm_time">02:00pm</div>
    </div>
    <div class="container parking_container">
        <h1 class="ctm_heading">Parking Slot Selection</h1>

        <div class="legend">
            <div><span class="green"></span> Open</div>
            <div><span class="yellow"></span> Pending</div>
            <div><span class="red"></span> Booked</div>
        </div>

        <form id="bookingForm" class="form_container" method="POST" action="{{ route('book.parking') }}">
            @csrf
            <input type="hidden" name="slots" id="selectedSlots" value="">
            <div class="slots-container">
                @php
                    $preselectedSlots = session('selected_slots', []);
                @endphp

                @foreach ($slots as $key => $slot)
                    <div class="slot {{ $slot->status === 'open' ? 'open' : ($slot->status === 'parked' ? 'booked' : 'pending') }}"
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

        $(document).ready(function() {
            const $slots = $(".slot.open");
            const $bookButton = $("#bookButton");
            const $selectedSlotsInput = $("#selectedSlots");
            let selectedSlots = [];

            if (preselectedSlots.length > 0) {
                preselectedSlots.forEach(slotId => {
                    const $slotEl = $(`.slot[data-id="${slotId}"]`);
                    if ($slotEl.length) {
                        $slotEl.addClass("selected");
                        selectedSlots.push(slotId);
                    }
                });

                $selectedSlotsInput.val(selectedSlots.join(","));
                $bookButton.prop("disabled", selectedSlots.length === 0);
            }

            $slots.on("click", function() {
                const slotId = $(this).data("id");

                if (selectedSlots.includes(slotId)) {
                    selectedSlots = selectedSlots.filter(id => id !== slotId);
                    $(this).removeClass("selected");
                } else {
                    selectedSlots.push(slotId);
                    $(this).addClass("selected");
                }

                $selectedSlotsInput.val(selectedSlots.join(","));
                $bookButton.prop("disabled", selectedSlots.length === 0);
            });
        });
    </script>
@endsection
