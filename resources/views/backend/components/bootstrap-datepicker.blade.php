@push('datepicker')
    <!-- Scripts js para Datepicker -->
    <script src= "{{asset('assets/js/backend/bootstrap-datepicker.js')}}"></script>
    <script src= "{{asset('assets/locales/bootstrap-datepicker/bootstrap-datepicker.es.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.datepicker').datepicker({
                "format": "yyyy-mm-dd",
                "orientation": "auto right",
                "weekStart": 1,
                "language": "es",
                "daysOfWeekHighlighted": "0,6",
                "autoclose": true,
                "todayHighlight": true,
                "templates": {
                    "leftArrow": '<i class="fa fa-chevron-left"></i>',
                    "rightArrow": '<i class="fa fa-chevron-right"></i>'
                },
                "container": "#{{ $field_id }}"
            });
        })
    </script>
@endpush
