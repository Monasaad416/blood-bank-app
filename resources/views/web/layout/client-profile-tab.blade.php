{{-- client-profile-tab --}}
<ul>
    <style>
        .custom-button {
            background-color:#2d3e50;
            color: #fff;
            border-radius: 0;
            font-weight: 400;
            padding: 10px 20px;
        }
        .custom-button:hover{
            border-radius: 0 !important;
            color:#fff;
        }
        .create {
            text-decoration: none !important;
            font-weight: 600;
        }
    </style>
    @auth('client-web')
        <div class="member">
            <div class="dropdown">
                <button class="btn dropdown-toggle mx-2 custom-button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="welcome">Welcome </span>  {{Auth::guard('client-web')->user()->name}}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                    <a class="dropdown-item" href="{{route('client.profile.edit',Auth::guard('client-web')->user()->id)}}">
                        <i class="far fa-user"></i>
                        My info
                    </a>
                    <a class="dropdown-item" href="{{route('client.notifications.edit',Auth::guard('client-web')->user()->id)}}">
                        <i class="far fa-bell"></i>
                        Notifications settings
                    </a>
                    <a class="dropdown-item" href="{{route('mynotifications')}}">
                        <i class="fas fa-bell"></i>
                        Notifications
                    </a>
                    <a class="dropdown-item" href="{{route('client.favourite.posts',Auth::guard('client-web')->user()->id)}}">
                        <i class="far fa-heart"></i>
                        Favourite
                    </a>

                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                       Sign Out
                    </a>
                    <form id="logout-form" action="{{ route('client.logout') }}" method="POST" style="display: none;">
                        @csrf

                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="accounts">
            <a href="{{route('client.register')}}" class="create" >Register </a>
            <a href="{{route('client.create.login')}}" class="signin mx-2 custom-button" style="background-color:#2d3e50;color: #fff; border-radius: 0;">Login</a>
        </div>
    @endauth
    </ul>
