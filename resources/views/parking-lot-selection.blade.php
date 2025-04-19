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
        <h1 class="ctm_heading">Parking Lot Selection {{ 'in ' . $location_name[0] }}</h1>

        <form id="bookingForm" class="form_container" method="get" action="{{ route('slots.view') }}">
            @csrf
            <input type="hidden" name="location_id" value="{{ request('location_id') }}">
            <input type="hidden" name="date" value="{{ request('date') }}">
            <input type="hidden" name="time" value="{{ request('time') }}">
            <input type="hidden" name="lot_id" id="lot_id">
            <div class="parking-lots-container">
                @foreach ($parking_lots as $lot)
                    <a class="parking_lot" data-id="{{ $lot->id }}">
                        {{ $lot->name }}
                    </a>
                @endforeach
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.parking_lot').on('click', function(e) {
                e.preventDefault();
                var lotId = $(this).data('id');
                $('#lot_id').val(lotId);
                $('#bookingForm').submit();
            });
        });
    </script>
@endsection
