@extends('layouts.layout')

@section('main')
<div class="hero_area">
    <section class=" slider_section ">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container">
              <div class="detail-box">
                <h1>Find your perfect place</h1>

                {{-- Form --}}
                <div class="ctm_form_container" style="margin-top:150px">
                    @include('components.home-slots-form')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
  </div>

  @include('sections.features')

  @include('sections.why-choose-us')

  @include('sections.services')

  @include('sections.reviews')

  @include('sections.rates')

@endsection
