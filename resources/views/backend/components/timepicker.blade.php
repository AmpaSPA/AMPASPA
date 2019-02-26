@push('timepicker')
    <!-- Scripts js para Timepicker -->
    <script src= "{{asset('assets/js/backend/bootstrap-timepicker.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#{{ $time_id }}').timepicker({
                minuteStep: 15,
                maxHours: 23,
                showSeconds: false,
                showMeridian: false,
                disableFocus: true,
                icons: {
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down'
                }
            }).on('focus', function() {
                $('#time').timepicker('showWidget');
            });
        })
    </script>
@endpush