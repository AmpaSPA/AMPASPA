@push('ckeditor')
    <!-- Scripts js para Datepicker -->
    <script src= "{{asset('vendor/ckeditor/ckeditor.js')}}"></script>

    <script type="text/javascript">
        CKEDITOR.config.height = 'auto';
        CKEDITOR.config.width = 'auto';

        CKEDITOR.replace('{{ $field_id }}');
    </script>
@endpush
