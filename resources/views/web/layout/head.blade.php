    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <!--google fonts css-->
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

        <!--font awesome css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
        <link rel="icon" href="imgs/Icon.png">

        <!--owl-carousel css-->
        <link rel="stylesheet" href="{{asset('web-layout/assets/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('web-layout/assets/css/owl.theme.default.min.css')}}">

        <!--style css-->
        <link rel="stylesheet" href="{{asset('web-layout/assets/css/style.css')}}">

        <!--override on style css-->
        <link rel="stylesheet" href="{{asset('web-layout/assets/css/style-ltr.css')}}">
        <link rel="icon" href="{{url('web-layout/assets/imgs/icon.png')}}" type="image/x-icon"/>
        <title>Blood Bank</title>


    @yield('styles')
</head>


