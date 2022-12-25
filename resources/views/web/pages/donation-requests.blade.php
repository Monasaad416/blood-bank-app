@extends('web.layout.layout',[
    'pageClass' =>'donation-requests'
])

@section('client-profile-tab')
    @include('web.layout.add-donation-request')
@endsection

@section('content')
    <!--inside-article-->
    <div class="all-requests">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('web.home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Donation Requests </li>
                    </ol>
                </nav>
            </div>

            <!--requests-->
            <div class="requests">
                <div class="head-text">
                    <h2>Donation Requests </h2>
                </div>
                <div class="content">
                    <form class="row filter" method="GET" action="{{route('donation.requests')}}">
                        <div class="col-md-5 blood">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select class="form-control" name="blood_type_id" id="exampleFormControlSelect1">
                                        <option selected disabled> Select blood type </option>
                                        @foreach ($bloodTypes as $bloodType)
                                            <option value="{{$bloodType->id}}">{{$bloodType->name}}</option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 city">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select class="form-control" name="city_id" id="exampleFormControlSelect1">
                                        <option selected disabled>Select city</option>
                                        @foreach ($cities as $city)
                                            <option value="{{$city->id}}" >{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 search">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="patients">

                        @foreach ($donationRequests as $donationReq)
                        <div class="details">
                            <div class="blood-type">
                                <h2 dir="ltr">{{$donationReq->bloodType->name}}</h2>
                            </div>
                            <ul>
                                <li><span>Patient Name:</span>{{$donationReq->patient_name}}</li>
                                <li><span>Hospital Name:</span>{{$donationReq->hospital_name}}</li>
                                <li><span>City:</span> {{$donationReq->city->name}}</li>
                            </ul>
                            <a href="{{route('donation.request.details',$donationReq->id)}}">Details</a>
                        </div>
                    @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center my-5">
        {!! $donationRequests->links() !!}
    </div>

@endsection


@push('scripts')

@endpush
