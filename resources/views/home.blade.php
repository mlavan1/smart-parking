@extends('layouts.layout')

@section('main')
<div class="hero_area">

    <!-- slider section -->
    <section class=" slider_section ">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">01</li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1">02</li>
        </ol>
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
        {{-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="sr-only">Next</span>
        </a> --}}
      </div>

    </section>
    <!-- end slider section -->
  </div>

  <!-- feature section -->
  @include('sections.features')

  <!-- why section -->
  @include('sections.why-choose-us')

  <!-- service section -->
  @include('sections.services')

  <!-- client section -->
  @include('sections.reviews')

  <!-- rate section -->
  @include('sections.rates')

  <!-- contact section -->
  @include('sections.rates')

@endsection
