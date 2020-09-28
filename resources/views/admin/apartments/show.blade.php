@extends('layouts.app')

@section('content')
    {{-- Layout --}}
    <div class="container py-4">
        <div class="show-page-wrapper">
            {{-- Intestazione --}}
            <div class="show-top-heading">
                <h1>{{$apartment->title}}</h1>
                <h5><span class="icon"><i class="fas fa-map-marker-alt"></i></span> {{$apartment->city}}, {{$apartment->region}}</h5>
            </div>

            {{-- Image container --}}
            <div class="show-image-container">
                <div class="main-image">
                    {{-- Immagine --}}
                    @if (!empty($apartment->main_img))
                        @if (strpos($apartment->main_img,'mpixel'))
                            <img src="{{$apartment->main_img}}" alt="{{$apartment->title}}">
                          @else
                            <img src="{{asset('storage').'/'.$apartment->main_img}}" alt="{{$apartment->title}}">
                        @endif
                    @else
                        <img src="{{asset('img/no-image/no-image.png')}}" alt="immagine non disponibile">
                    @endif
                </div>
                <div class="images">
                    @for ($i=0; $i < 4; $i++)
                      <div class="small-img-preview">
                        @if (!empty($apartment->main_img))
                            @if (strpos($apartment->main_img,'mpixel'))
                                <img src="{{$apartment->main_img}}" alt="{{$apartment->title}}">
                              @else
                                <img src="{{asset('storage').'/'.$apartment->main_img}}" alt="{{$apartment->title}}">
                            @endif
                        @else
                            <img src="{{asset('img/no-image/no-image.png')}}" alt="immagine non disponibile">
                        @endif
                      </div>
                    @endfor
                </div>
            </div>
            {{-- END Image container --}}

            {{-- Show body --}}
            <div class="show-body">

                <div class="apartment-info">
                    <div class="general-info">
                        <h3>Informazioni generali</h3>
                        <p>
                          {{$apartment->mq}} m&sup2; <span class="divider">&bull;</span>
                          {{$apartment->num_beds}} letti  <span class="divider">&bull;</span>
                          {{$apartment->num_rooms}} stanze  <span class="divider">&bull;</span>
                          {{$apartment->num_baths}} bagni
                        </p>
                    </div>
                    <div class="description">
                        <h3>Descrizione</h3>
                        <p>
                          {{$apartment->description}}
                        </p>
                    </div>
                    <div class="apartment-services">
                        <h3>Servizi</h3>
                        <div class="services-container">
                            @if (!$apartment->services->isEmpty())
                                @foreach ($apartment->services as $service)
                                  <div class="service">
                                      <span class="icon">{!!$service->icon!!}</span>
                                      <span class="name">{{$service->name}}</span>
                                  </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="contact-owner-form">

                </div>

            </div>
            {{-- End show body --}}

            {{-- MAP --}}
            <div class="show-map-container">
                <h3>Posizione dell'appartamento</h3>
                <h5>{{$apartment->address}}</h5>
                <div class="row">
                    <div class="col-12">
                      <div class="marker-on-map" >
                          <input hidden type="search" id="input-map"/>
                          <input hidden type="text"  class="show-latitude" value="{{$apartment->latitude}}" />
                          <input hidden type="text"  class="show-longitude" value="{{$apartment->longitude}}" />
                      </div>
                      <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>
                      <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>

                      <div id="map-example-container"></div>
                    </div>
                </div>
            </div>
            {{-- END MAP --}}
        </div>
    </div>
    {{-- End Layout --}}

  <script src="{{asset('js/boolbnb/admin/show.js')}}"></script>
@endsection
