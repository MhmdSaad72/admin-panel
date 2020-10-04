@extends('adminlte::page')

@section('content')
<div class="container">
  <div class="row">
    <div class="mb-4 col-lg-5 mr-3">
      <!-- Dashboard Card-->
      <div class="card border-0 overflow-hidden p-4 p-lg-0">
        <div class="card-body p-lg-5">
          <h2 class="h1 mb-0 text-dark">{{ $clients }}</h2>
          <p class="text-muted mb-0">Clients</p>
          <i class="dash-card-icon fas fa-users"></i>
          <div class="pt-2">
            <a class="btn btn-link p-0 btn-arrow" href="{{ route('clients.index') }}">
              <span>show details</span>
              <i class="fas fa-long-arrow-alt-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="mb-4 col-lg-5 mr-3">
      <!-- Dashboard Card-->
      <div class="card border-0 overflow-hidden p-4 p-lg-0">
        <div class="card-body p-lg-5">
          <h2 class="h1 mb-0 text-dark">{{ $projects }}</h2>
          <p class="text-muted mb-0">Projects</p>
          <i class="dash-card-icon fas fa-project-diagram"></i>
          <div class="pt-2">
            <a class="btn btn-link p-0 btn-arrow" href="{{ route('projects.index') }}">
              <span>show details</span>
              <i class="fas fa-long-arrow-alt-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="mb-4 col-lg-5 mr-3">
      <!-- Dashboard Card-->
      <div class="card border-0 overflow-hidden p-4 p-lg-0">
        <div class="card-body p-lg-5">
          <h2 class="h1 mb-0 text-dark">{{ $reviews }}</h2>
          <p class="text-muted mb-0">Reviews</p>
          <i class="dash-card-icon fas fa-star"></i>
          <div class="pt-2">
            <a class="btn btn-link p-0 btn-arrow" href="{{ route('reviews.index') }}">
              <span>show details</span>
              <i class="fas fa-long-arrow-alt-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="mb-4 col-lg-5 mr-3">
      <!-- Dashboard Card-->
      <div class="card border-0 overflow-hidden p-4 p-lg-0">
        <div class="card-body p-lg-5">
          <h2 class="h1 mb-0 text-dark">{{ $newsletter }}</h2>
          <p class="text-muted mb-0">NewsLetter</p>
          <i class="dash-card-icon fas fa-newspaper"></i>
          <div class="pt-2">
            <a class="btn btn-link p-0 btn-arrow" href="{{ route('news-letter.index') }}">
              <span>show details</span>
              <i class="fas fa-long-arrow-alt-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
