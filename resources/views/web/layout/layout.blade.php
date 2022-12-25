<!doctype html>
<html lang="en">
    @include('web.layout.head')
    <body class="{{$pageClass ?? ""}}">
        @include('web.layout.navbar')

        @yield('content')

        @include('web.layout.footer')
        @include('web.layout.footer_scripts')

    </body>
</html>
