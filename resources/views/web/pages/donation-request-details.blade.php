@extends('web.layout.layout',[
    'pageClass' =>'inside-request'
])

@section('client-profile-tab')
    @include('web.layout.client-profile-tab')
@endsection

@section('content')
    <!--ask-donation-->
    <div class="ask-donation">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('web.home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="donation-requests.html">Donation Requests </a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Donation Requests for: {{$donationReq->patient_name}}</li>
                    </ol>
                </nav>
            </div>
            <div class="details">
                <div class="person">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>الإسم</p>
                                    </div>
                                    <div class="light">
                                        <p>{{$donationReq->patient_name}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>Blood Type</p>
                                    </div>
                                    <div class="light">
                                        <p dir="ltr">{{$donationReq->bloodType->name}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>Age</p>
                                    </div>
                                    <div class="light">
                                        <p>{{$donationReq->patient_age}} عام</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>No of bags </p>
                                    </div>
                                    <div class="light">
                                        <p>{{$donationReq->bags_num}} أكياس</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>Hospital</p>
                                    </div>
                                    <div class="light">
                                        <p>{{$donationReq->hospital_name}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inside">
                                <div class="info">
                                    <div class="dark">
                                        <p>Phone</p>
                                    </div>
                                    <div class="light">
                                        <p>{{$donationReq->phone}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="inside">
                                <div class="info">
                                    <div class="special-dark dark">
                                        <p>عنوان المشفى</p>
                                    </div>
                                    <div class="special-light light">
                                        <p>المنصورة- شارع عبد العزيز بجوار المرور المتفرع من الدولى</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="details-button">
                        <a href="#" >الملاحظات</a>
                    </div>
                </div>
                <div class="text">
                    <p>
                       {{$donationReq->not ?? 'لايوجد ملاحظات'}}
                    </p>
                </div>
                <div id="map" style="height: 500px ;width:100%">

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDO-YIdd-IJi_ZEcX91TOIpHA3Rljg4Zls&callback=initMap"
	async defer></script>
<script type="text/javascript">
var map;
function initMap() {
	var mapLayer = document.getElementById("map");
	var centerCoordinates = new google.maps.LatLng(37.6, -95.665);
	var defaultOptions = { center: centerCoordinates, zoom: 4 }

	map = new google.maps.Map(mapLayer, defaultOptions);
}

function locate(){
	document.getElementById("btnAction").disabled = true;
	document.getElementById("btnAction").innerHTML = "Processing...";
	if ("geolocation" in navigator){
		navigator.geolocation.getCurrentPosition(function(position){
			var currentLatitude = position.coords.latitude;
			var currentLongitude = position.coords.longitude;

			var infoWindowHTML = "Latitude: " + currentLatitude + "<br>Longitude: " + currentLongitude;
			var infoWindow = new google.maps.InfoWindow({map: map, content: infoWindowHTML});
			var currentLocation = { lat: currentLatitude, lng: currentLongitude };
			infoWindow.setPosition(currentLocation);
			document.getElementById("btnAction").style.display = 'none';
		});
	}
}
</script>
@endpush
