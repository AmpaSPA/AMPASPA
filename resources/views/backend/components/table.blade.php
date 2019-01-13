  <!-- Componente para construir una tabla a gestionar como un Datatable -->
  <div class="table-responsive">
    <table class="table table-striped" id="{{ $table_id or 'table-id' }}">
        <thead>
          {{ $thead ?? '' }}
        </thead>
        <tfoot>
          {{ $tfoot ?? '' }}
        </tfoot>
    </table>
  </div>