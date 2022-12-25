@extends('admin.layout.layout')
@section('header-title')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="text-capitalize d-inline">donation request details</h2>
            <h6 class="text-muted my-2">Donation request from {{$donationRequest->patient_name}}</h>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">donation request</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-6">
                <div class="my-3 mx-4"><strong class="text-capitalize">Patient name : </strong><p class="d-inline">{{$donationRequest->patient_name}}</p></div>
                <div class="my-3 mx-4"><strong class="text-capitalize">Patient age : </strong><p class="d-inline">{{$donationRequest->patient_age}}</p></div>
                <div class="my-3 mx-4"><strong class="text-capitalize">Requird blood type : </strong><p class="d-inline">{{$donationRequest->bloodType->name}}</p></div>
                <div class="my-3 mx-4"><strong class="text-capitalize">Requird no. Of Bags : </strong><p class="d-inline">{{$donationRequest->bags_num}}</p></div>
                <div class="my-3 mx-4"><strong class="text-capitalize">Hospital name : </strong><p class="d-inline">{{$donationRequest->hospital_name}}</p></div>
                <div class="my-3 mx-4"><strong class="text-capitalize">City : </strong><p class="d-inline">{{$donationRequest->city->name}}</p></div>
                <div class="my-3 mx-4"><strong class="text-capitalize">Client Name: </strong><p class="d-inline">{{$donationRequest->client->name}}</p></div>
                <div class="my-3 mx-4"><strong class="text-capitalize">Patient phone : </strong><p class="d-inline">{{$donationRequest->patient_phone}}</p></div>
                <div class="my-3 mx-4"><strong class="text-capitalize">Notes : </strong><p class="d-inline">{{$donationRequest->notes}}</p></div>
                <div class="my-3 mx-4"><strong class="text-capitalize">Date of request : </strong><p class="d-inline">{{ \Carbon\Carbon::parse($donationRequest->created_at)->format('d/m/Y')}}</p></div>
            </div>
            <div class="col-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7290568.383210713!2d26.38276563608272!3d26.844791427835418!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14368976c35c36e9%3A0x2c45a00925c4c444!2sEgypt!5e0!3m2!1sen!2ssa!4v1666601802259!5m2!1sen!2ssa" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
@endsection

