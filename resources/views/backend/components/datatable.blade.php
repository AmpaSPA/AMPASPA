<!-- Componente Datatable -->
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/datatables/datatable.css') }}">
@endpush

@push('scripts')
    <!-- Scripts js para Datatables -->
    <script src="{{ asset('assets/js/backend/datatable.js') }}"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            // DataTable
            oTable = $('#{{ $table_id }}').DataTable({
                "procesing": true,
                "serverSide": true,
                "bStateSave": true,
                "lengthMenu": [ 3, 5, 10, 25, 50, 75, 100 ],
                @if($route_param == '')
                    "ajax": "{!! route($route_name) !!}",
                @else
                    "ajax": "{!! route($route_name, $route_param) !!}",
                @endif
                "autoWidth": false,
                "columnDefs": [
                    @foreach($columndefs as $columndef)
                        { "width": '{{ $columndef['width'] }}', "targets": {{ $columndef['targets'] }} },
                    @endforeach
                ],
                "columns": [
                    @foreach($columns as $column)
                        @if($column['data'] == 'action')
                            { data: 'action', name: 'action', orderable: false, searchable: false },
                        @else
                            { data: '{{ $column['data'] }}', name: '{{ $column['name'] }}' },
                        @endif
                    @endforeach

                ],
                @if ($table_id == 'perfilesinactivos')
                    "columnDefs": [
                        {
                            "targets": 1,
                            "render": function ( data, type, row, meta )
                            {
                                return '<img src="'+data+'" class="itemavatar">';
                            }
                        }
                    ],
                @endif
                @if ($table_id == 'notificaciones')
                    "columnDefs": [
                        {
                            "targets": 0,
                            "render": function ( data, type, row, meta )
                            {
                                return '<i class="fa '+data+'"></i>'+' '+row['tipo'];
                            }
                        }
                    ],
                @endif
                "language": {
                    "decimal":        "",
                    "emptyTable":     "{{ trans('datatables.emptyTable', ['tabla' => $table_name]) }}",
                    "info":           "{{ trans('datatables.info', ['tabla' => $table_name]) }}",
                    "infoEmpty":      "{{ trans('datatables.infoEmpty', ['tabla' => $table_name]) }}",
                    "infoFiltered":   "{{ trans('datatables.infoFiltered', ['tabla' => $table_name, 'filtro' => $filter]) }}",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "{{ trans('datatables.lengthMenu', ['tabla' => $table_name]) }}",
                    "loadingRecords": "{{ trans('datatables.loadingRecords') }}",
                    "processing":     "{{ trans('datatables.processing') }}",
                    "search":         "{{ trans('datatables.search', ['tabla' => $table_name]) }}",
                    "zeroRecords":    "{{ trans('datatables.zeroRecords', ['tabla' => $table_name]) }}",
                    "paginate": {
                        "first":      "{{ trans('datatables.first') }}",
                        "last":       "{{ trans('datatables.last') }}",
                        "next":       "{{ trans('datatables.next') }}",
                        "previous":   "{{ trans('datatables.previous') }}"
                    }
                }
            });
        });
    </script>
@endpush

@component('backend.components.table', ['table_id' => $table_id])
    @slot('thead')
        @foreach($columns as $column)
            <th>{{ $column['header'] }}</th>
        @endforeach
    @endslot

    @slot('tfoot')
        @foreach($columns as $column)
            <th>{{ $column['header'] }}</th>
        @endforeach
    @endslot
@endcomponent