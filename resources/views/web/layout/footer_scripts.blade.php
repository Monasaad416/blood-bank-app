        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="{{asset('web-layout/assets/js/bootstrap.bundle.js')}}"></script>
        <script src="{{asset('web-layout/assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js" integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k" crossorigin="anonymous"></script>
        <script src="{{asset('web-layout/assets/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('web-layout/assets/js/main.js')}}"></script>

        <script>
            $(function(){
                $('.fa-heart').click(function(e){
                    e.preventDefault();
                    var post_id  = $(this).data('id');
                    console.log(post_id);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ URL::to("web/toggle-post-favourite") }}/"  + post_id,
                        type: "post",
                        data:{post_id : post_id},
                        success: function (data) {
                            $('#' + post_id).toggleClass('far fas');

                        },
                    });
                })
            })
        </script>
        {{-- filter donation requests --}}
        {{-- <script>
            $(document).ready(function () {
                $('select[name="blood_type_id"]').on('change', function () {
                    var blood_type_id = $(this).val();
                    console.log(blood_type_id);
                    if (blood_type_id) {
                        $.ajax({
                            url: "{{ URL::to('/web/donation-requests') }}/",
                            type: "GET",
                            dataType: "json",
                            success: function (data) {
                              console.log(data);
                            },
                        });
                    } else {
                        console.log('AJAX load did not work');
                    }
                });
            });
        </script> --}}





        @stack('scripts')

