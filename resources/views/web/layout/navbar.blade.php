{{--
     <!--upper-bar-->
        <div class="upper-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="social">
                            <div class="icons">
                                <a href="{{$settings->fb_url}}" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{$settings->insta_url}}" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
                                <a href="{{$settings->tw_url}}" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a>
                                <a href="{{$settings->whatsapp_url}}" target="_blank" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- not a member-->
                    <div class="col-lg-6">
                        <div class="info" dir="ltr">
                            <div class="phone">
                                <i class="fas fa-phone-alt"></i>
                                <p>{{$settings->phone}}</p>
                            </div>
                            <div class="e-mail">
                                <i class="far fa-envelope"></i>
                                <p>{{$settings->email}}</p>
                            </div>
                        </div>

                        <!--I'm a member -->





                    </div>
                </div>
            </div>
        </div>


        <!--nav-->
        <div class="nav-bar">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="{{url('web-layout/assets/imgs/logo-ltr.png')}}" class="d-inline-block align-top" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item {{(request()->is('web') ? 'active' : '')}}">
                                <a class="nav-link " href="{{route('web.home')}}">الرئيسية</a>
                            </li>
                            <li class="nav-item {{(request()->is('web/posts') ? 'active' : '')}}">
                                <a class="nav-link" href="{{route('posts.all')}}">المقالات</a>
                            </li>
                            @auth('client-web')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('donation.requests')}}">طلبات التبرع</a>
                                </li>
                            @endauth
                            <li class="nav-item {{(request()->is('web/who-are-us') ? 'active' : '')}}">
                                <a class="nav-link" href="{{route('whoAreUs')}}">من نحن</a>
                            </li>
                            <li class="nav-item {{(request()->is('web/contact-us') ? 'active' : '')}}">
                                <a class="nav-link" href="{{route('contactUs')}}">اتصل بنا</a>
                            </li>
                        </ul>


                        <!--not a member-->
                        @yield('client-profile-tab')
                        @yield('add-donation-requestblade')






                    </div>
                </div>
            </nav>
        </div>
 --}}







         <!--upper-bar-->
        <div class="upper-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="social">
                           <div class="icons">
                                <a href="{{$settings->fb_url}}" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{$settings->insta_url}}" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
                                <a href="{{$settings->tw_url}}" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a>
                                <a href="{{$settings->whatsapp_url}}" target="_blank" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- not a member-->
                    <div class="col-lg-4">
                        <div class="info" dir="ltr">
                            <div class="phone">
                                <i class="fas fa-phone-alt"></i>
                                <p>{{$settings->phone}}</p>
                            </div>
                            <div class="e-mail">
                                <i class="far fa-envelope"></i>
                                <p>{{$settings->email}}</p>
                            </div>
                        </div>

                        <!--I'm a member

                        <div class="member">
                            <p class="welcome">مرحباً بك</p>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    احمد محمد
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="index-1.html">
                                        <i class="fas fa-home"></i>
                                        الرئيسية
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="far fa-user"></i>
                                        معلوماتى
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="far fa-bell"></i>
                                        اعدادات الاشعارات
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="far fa-heart"></i>
                                        المفضلة
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="far fa-comments"></i>
                                        ابلاغ
                                    </a>
                                    <a class="dropdown-item" href="contact-us.html">
                                        <i class="fas fa-phone-alt"></i>
                                        تواصل معنا
                                    </a>
                                    <a class="dropdown-item" href="index.html">
                                        <i class="fas fa-sign-out-alt"></i>
                                        تسجيل الخروج
                                    </a>
                                </div>
                            </div>
                        </div>

                        -->

                    </div>
                </div>
            </div>
        </div>


        <!--nav-->
        <div class="nav-bar">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="{{url('web-layout/assets/imgs/logo-ltr.png')}}" class="d-inline-block align-top" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                           <li class="nav-item {{(request()->is('web') ? 'active' : '')}}">
                                <a class="nav-link " href="{{route('web.home')}}">Home</a>
                            </li>
                            <li class="nav-item {{(request()->is('web/posts') ? 'active' : '')}}">
                                <a class="nav-link" href="{{route('posts.all')}}">Posts</a>
                            </li>
                            @auth('client-web')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('donation.requests')}}">Donation Requests</a>
                                </li>
                            @endauth
                            <li class="nav-item {{(request()->is('web/who-are-us') ? 'active' : '')}}">
                                <a class="nav-link" href="{{route('whoAreUs')}}">About Us</a>
                            </li>
                            <li class="nav-item {{(request()->is('web/contact-us') ? 'active' : '')}}">
                                <a class="nav-link" href="{{route('contactUs')}}">Contact Us</a>
                            </li>
                        </ul>
                        @yield('client-profile-tab')
                        @yield('add-donation-requestblade')

                    </div>
                </div>
            </nav>
        </div>
               {{-- notifications scripts --}}
               {{-- <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
               <script>

                 // Enable pusher logging - don't include this in production
                 Pusher.logToConsole = true;

                 var pusher = new Pusher('fd0deecaa67438463358', {
                   cluster: 'ap2'
                 });

                 var channel = pusher.subscribe('notifications-channel');
                 channel.bind('donation-request-added', function(data) {
                   alert(JSON.stringify(data));
                 });
               </script> --}}
