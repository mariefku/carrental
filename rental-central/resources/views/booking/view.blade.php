@extends('layout.web')

@section('content.fullpage')       
<style>
    .map-wrapper{
        height: 330px;
        position: relative;
        margin-top: -330px;
        z-index: 1;
        background: rgba(92, 92, 92, 0.81);
        opacity: 0;
        -webkit-transition: opacity 0.5s ease-in-out;
           -moz-transition: opacity 0.5s ease-in-out;
            -ms-transition: opacity 0.5s ease-in-out;
             -o-transition: opacity 0.5s ease-in-out;
                transition: opacity 0.5s ease-in-out;
    }
    #opengmaps:hover .map-wrapper{
        filter: alpha(opacity=100);
        opacity: 1;
    }
</style>

    <div class="row bs-wizard" style="border-bottom:0;">
        
        <div class="col-xs-3 bs-wizard-step active">
          <div class="text-center bs-wizard-stepnum">Step 1</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="#" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center">Pilih Mobil</div>
        </div>
        
        <div class="col-xs-3 bs-wizard-step disabled"><!-- complete -->
          <div class="text-center bs-wizard-stepnum">Step 2</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="#" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center">Isi Data</div>
        </div>
        
        <div class="col-xs-3 bs-wizard-step disabled"><!-- complete -->
          <div class="text-center bs-wizard-stepnum">Step 3</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="#" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center">Konfrimasi Data</div>
        </div>

        <div class="col-xs-3 bs-wizard-step disabled"><!-- complete -->
          <div class="text-center bs-wizard-stepnum">Step 4</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="#" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center">Cetak Kode Booking</div>
        </div>
    </div>
    <hr>
@endsection
@section('content')                   
        <section class="product-detail">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="product-detail__info">
                            <div class="product-title">
                                <h2>{{ $databooks->brand }} {{ $databooks->model }}</h2>
                            </div>
                            <div class="product-address">
                                <span>{{ App\Rental::find($databooks->rental_id)->name }}</span>
                            </div>

                            <hr>

                            <div class="property-highlights">
                                <div class="property-highlights__content" style="padding: 15px;margin: 0px;">
                                    
                                    <div class="item">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        Tahun : {{ $databooks->year }}
                                    </div>
                                    <div class="item">
                                        <i class="fa fa-sitemap" aria-hidden="true"></i>
                                        Transmisi : {{ $databooks->transmission }}
                                    </div>
                                    <div class="item">
                                        <i class="material-icons" style="font-size: 18px;position: relative;top: 3px;" title="Fuel">local_gas_station</i>
                                        {{ $databooks->fuel }}
                                    </div>
                                    <div class="item">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                        Kapasitas : 6
                                    </div>
                                    <div class="item">
                                        <i class="fa fa-snowflake-o" aria-hidden="true"></i>
                                        AC
                                    </div>
                                    <div class="item">
                                        <i class="fa fa-volume-up" aria-hidden="true"></i>
                                        Sound System
                                    </div>
                                    <div class="item">
                                        <i class="fa fa-suitcase" aria-hidden="true"></i>
                                        Bagasi
                                    </div>
                                </div>
                            </div>
                            
                            <div class="property-highlights">
                                <h3></h3>
                                <div class="product-descriptions">
                                    <strong>Alamat:</strong>
                                    <br>
                                    <p>{{ App\Rental::find($databooks->rental_id)->address }}</p>
                                </div>
                                <div class="product-descriptions">
                                    <strong>No. Telepon:</strong>
                                    <br>
                                    <p>{{ App\Rental::find($databooks->rental_id)->telp }}</p>
                                </div>
                            </div>
                            <a href="" id="opengmaps" target="_blak">
                            <div class="product-map" id="map-canvas" style="height: 330px;">
                                
                            </div>
                            <div class="map-wrapper">
                                <h1 style="margin: 0px auto;padding-top: 125px;text-transform: uppercase;color: #fff;" class="text-center">Click, To Get Direction !</h1>
                            </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-md-4" style="padding-top: 50px">
                        <div class="product-detail__gallery">
                            <div class="product-slider-wrapper">
                                <div class="product-slider">
                                    <div class="item">
                                        <img src="{{ App\Rental::find($databooks->rental_id)->url.$databooks->img  }}/getPhoto" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="detail-sidebar">
                            <div class="booking-info">
                                <h3>Booking info</h3>
                                
                                <div class="form-group">
                                    <div class="form-elements">
                                        <label>Destination</label>
                                        <div class="form-item">
                                            <input type="text" class="awe-calendar" value=" {{ $databooks->destination }} " disabled="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-elements form-checkin">
                                        <label>Rent From</label>
                                        <div class="form-item">
                                            <input type="text" class="awe-calendar" id="show_start_date" value="" disabled>
                                        </div>
                                    </div>
                                    <div class="form-elements form-checkout">
                                        <label>Untill</label>
                                        <div class="form-item">
                                            <input type="text" class="awe-calendar" id="show_end_date" value="" disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="price">
                                    <em>Total </em>
                                    <span class="amount">{{ currency($databooks->price) }}</span>
                                </div>
                                <div class="form-submit">
                                    <div class="add-to-cart">
                                        <form action="{{ action('GuestBookingController@createForm') }}" method="post">
                                        <div>
    {{ csrf_field() }}
    <input type="hidden" name="id"            value="{{ $databooks-> id }}">
    <input type="hidden" name="created_at"    value="{{ $databooks-> created_at }}">
    <input type="hidden" name="updated_at"    value="{{ $databooks-> updated_at }}">
    <input type="hidden" name="carmodel_id"   value="{{ $databooks-> carmodel_id }}">
    <input type="hidden" name="plate_number"  value="{{ $databooks-> plate_number }}">
    <input type="hidden" name="brand"         value="{{ $databooks-> brand }}">
    <input type="hidden" name="model"         value="{{ $databooks-> model }}">
    <input type="hidden" name="transmission"  value="{{ $databooks-> transmission }}">
    <input type="hidden" name="fuel"          value="{{ $databooks-> fuel }}">
    <input type="hidden" name="car_id"        value="{{ $databooks-> car_id }}">
    <input type="hidden" name="destination"   value="{{ $databooks-> destination }}">
    <input type="hidden" name="price"         value="{{ $databooks-> price }}">
    <input type="hidden" name="year"          value="{{ $databooks-> year }}">
    <input type="hidden" name="rental_id"     value="{{ $databooks-> rental_id }}">
    <input type="hidden" name="start_date"    value="{{ $databooks-> start_date }}">
    <input type="hidden" name="end_date"      value="{{ $databooks-> end_date }}">
    <input type="hidden" name="img"      value="{{ $databooks-> img }}">
                                        </div>    
    <button type="submit">
        Lanjutkan Pemesanan <i class="material-icons" style="font-size: 24px;position: relative;top: 7px;">arrow_forward</i>
    </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
@section('content.js')
<script>
    var markerpos = new google.maps.LatLng( 
            {{ App\Rental::find($databooks->rental_id)->lat }},
            {{ App\Rental::find($databooks->rental_id)->lng }}
        );

    var map = new google.maps.Map(document.getElementById('map-canvas'),{
      center:{
          lat: {{ App\Rental::find($databooks->rental_id)->lat }},
          lng: {{ App\Rental::find($databooks->rental_id)->lng }}
      },
      zoom:17,
      draggable: false,
      scrollwheel: false,
      navigationControl: false,
      mapTypeControl: false,
      scaleControl: false
    });

    var marker = new google.maps.Marker({
        position: markerpos,
        map: map,
        title: "{{ App\Rental::find($databooks->rental_id)->name }}",
        draggable: false
    });

    if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {

            $("#opengmaps").attr("href", "https://www.google.com/maps/dir/" + position.coords.latitude + "," + position.coords.longitude +"/" + {{ App\Rental::find($databooks->rental_id)->lat }} + "," + {{ App\Rental::find($databooks->rental_id)->lng }} + "/data=!3m1!4b1!4m2!4m1!3e2")

            /**
            var pos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
            
            var position = new google.maps.Marker({
                position: pos,
                map: map,
                draggable: false
            });

            var directionsService = new google.maps.DirectionsService,
              directionsDisplay = new google.maps.DirectionsRenderer({
              map: map
            });

            calculateAndDisplayRoute(directionsService, directionsDisplay, pos, markerpos);

            function calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB) {
                directionsService.route({
                    origin: pointA,
                    destination: pointB,
                    travelMode: google.maps.TravelMode.WALKING
                }, function(response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                      directionsDisplay.setDirections(response);
                    } else {
                      window.alert('Directions request failed due to ' + status);
                    }
                });
            };
            */
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
    } else {
      // Browser doesn't support Geolocation
        alert("Geolocation is not supported by this browser.");
    }

    //init and set date

    var start_date=new Date("{!! $databooks->start_date !!}");
    var end_date = new Date("{!! $databooks->end_date !!}");


    //init option bootstrap datepicker
    $('#show_start_date').datepicker({
        format: 'DD, dd MM yyyy',
        autoclose: true,
    }).datepicker("setDate", start_date).datepicker("setStartDate", start_date);

    $('#show_end_date').datepicker({
        format: 'DD, dd MM yyyy',
        autoclose: true,
    }).datepicker("setDate", end_date).datepicker("setStartDate", start_date);


</script>
@endsection