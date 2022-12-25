<div class="footer">
    <div class="inside-footer">
        <div class="container">
            <div class="row">
                <div class="details col-md-4">
                    <img src="{{url('web-layout/assets/imgs/logo-ltr.png')}}">
                    <h4>Blood Bank</h4>
                    <p>
                        This text is an example of text that can be replaced in the same space, this text has been generated from the Arabic text generator, where you can generate such text or many other.
                    </p>
                </div>
            <div class="pages col-md-4">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action {{(request()->is('web') ? 'active' : '')}}" id="list-home-list" href="{{route('web.home')}}" role="tab" aria-controls="home">Home</a>
                {{-- <a class="list-group-item list-group-item-action" id="list-profile-list" href="#" role="tab" aria-controls="profile">عن بنك الدم</a> --}}
                <a class="list-group-item list-group-item-action {{(request()->is('web/posts') ? 'active' : '')}}" id="list-messages-list" href="{{route('posts.all')}}" role="tab" aria-controls="messages">Posts</a>
                    @auth('client-web')
                <a class="list-group-item list-group-item-action {{(request()->is('web/donation-requests') ? 'active' : '')}}" id="list-settings-list" href="{{route('donation.requests')}}" role="tab" aria-controls="settings">DonationRequests</a>
                @endauth
                <a class="list-group-item list-group-item-action {{(request()->is('web/who-are-us') ? 'active' : '')}}" id="list-settings-list" href="{{route('whoAreUs')}}" role="tab" aria-controls="settings">About Us</a>
                <a class="list-group-item list-group-item-action {{(request()->is('web/contact-us') ? 'active' : '')}}" id="list-settings-list" href="{{route('contactUs')}}" role="tab" aria-controls="settings">Contact Us</a>
            </div>
        </div>
                <div class="stores col-md-4">
                    <div class="availabe">
                        <p>Download Now</p>
                        <a href="#">
                            <img src="{{url('web-layout/assets/imgs/google1.png')}}">
                        </a>
                        <a href="#">
                            <img src="{{url('web-layout/assets/imgs/ios1.png')}}">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="other">
        <div class="container">
            <div class="row">
                <div class="social col-md-4">
                    <div class="icons">
                        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="rights col-md-8">
                    <p>All rights reserved to <span>Blood Bank</span> &copy; 2019</p>
                </div>
            </div>
        </div>
    </div>
</div>
