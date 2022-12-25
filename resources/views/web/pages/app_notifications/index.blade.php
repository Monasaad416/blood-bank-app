@extends('web.layout.layout',[
    'pageClass' =>'donation-requests'
])

@section('client-profile-tab')
    @include('web.layout.client-profile-tab')
@endsection

@section('content')
<!--form-->
    <!--inside-article-->
    <div class="all-requests">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('web.home')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
                    </ol>
                </nav>
            </div>

            <!--requests-->
            <div class="requests">

                <div class="card-body">

                    @if(count($notifications) > 0)

                        @foreach ($notifications as $notification)
                        <style>
                            .notification a,.notification {
                                color: #2d3e50;;
                            }
                        </style>
                            <div class="row notification">
                                <a href="#" onclick="event.preventDefault(); document.getElementById('read-form-{{$notification->id}}').submit();">
                                    <div class="col-1 text-right">

                                        <i class="{{$notification->pivot->is_read ? 'far' : 'fas'}} fa-bell"></i>
                                    </div>
                               </a>
                               <form id="read-form-{{$notification->id}}" action="{{ route('readnotification', $notification->id) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <div class="col-11 text-left">
                                    {{$notification->id}} بواسطة {{$notification->donationRequest->client->name}}
                                </div>
                            </div>

                            <hr style="color: #2d3e50;">

                        @endforeach
                    @else
                            <p>No Notifications</p>
                    @endif        

                </div>
            </div>
        </div>
        {{$notifications->links()}}
    </div>


@endsection


