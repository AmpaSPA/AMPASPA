@section('contenido4')
  @include('backend.includes.adhesion_cabecera')
  <div>
    <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 9pt"><strong>H- Declaración y firma de conformidad sobre este Acuerdo</strong></p>
  </div>
  <div>
    <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 9pt">El/La Asociado/a declara la veracidad de sus datos expresados en el presente Acuerdo en particular y de todos aquellos que ha facilitado a AMPA SPAB a lo largo de todo el proceso de registro como socio/a de la Asociación.</p>
    <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 9pt">Y para que conste, a todos los efectos asociativos, ambas partes expresan su conformidad con el presente y aceptan su relación asociativa sujeta a las condiciones recogidas en los apartados anteriores.</p>
  </div>
  <div>
    <table style="width: 100%; color: #000000; font-family: Arial, sans-serif; font-size: 9pt">
      <tr>
        <th colspan="2" align="left"><img src="{{ asset('/assets/images/selloampa.png') }}"></th>
        <th align="center">{{ $data->created_at }}</th>
      </tr>
      <tr>
        <td align="left">Conforme. La Asociación</td>
        <td>Conforme. {{ $data->nombre }} {{ $data->apellidos }}</td>
        <td align="center">Fecha y hora</td>
      </tr>
    </table>
    <br><br>
  </div>

  <div style="margin-top: 590px">
    <p style="text-align: center; font-family: Arial, sans-serif; font-size: 8pt">AMPA Colegio San Pedro Apóstol - Calle Babilonia, 19, 28042 Madrid   mail:  ampa@sanpedroapostol.es</p>
    <p style="text-align: center; font-family: Arial, sans-serif; font-size: 11pt">4 de 4</p>
  </div>
@endsection