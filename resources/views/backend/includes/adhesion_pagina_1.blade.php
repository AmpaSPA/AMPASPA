@section('contenido1')
  @include('backend.includes.adhesion_cabecera')
  <div>
    <p style="text-align: center; font-family: Arial, sans-serif; font-size: 11pt; margin-bottom: 10px"><strong>ACUERDO DE ADHESIÓN COMO SOCIO/A DE LA ASOCIACIÓN DE MADRES Y PADRES DE ALUMNOS DEL COLEGIO SAN PEDRO APÓSTOL</strong></p>
    <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 9pt">En Madrid a, {{ $data->created_at }}, por una parte la Asociación de Madres y Padres de Alumnos del Colegio San Pedro Apóstol, a partir de ahora AMPA SPAB, representada suficientemente por el presidente de su Junta Directiva que suscribe el presente acuerdo, y por otra, {{ $data->nombre }} {{ $data->apellidos }}, a partir de ahora el/la Asociado/a, en posesión del {{ $tdocumento }} número {{ $data->numdoc }}.</p>
    <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 9pt">Ambas partes se reconocen mutuamente capacidad para asociarse y obligarse, y respecto al objeto de asociación indicado en las condiciones particulares, formalizan el presente acuerdo de adhesión sujeto a las condiciones siguientes:<br></p>
  </div>
  <div style="margin-top: 25px;">
    <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 9pt"><strong>A- Datos y condiciones particulares de la Asociación AMPA SPAB</strong></p>
  </div>
  <div>
    <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 9pt">AMPA SPAB se halla registrada, desde fecha 9 de junio de 2016, de conformidad con lo previsto en el capítulo V de la Ley Orgánica 1/2002, de 22 de marzo, en el Registro de Asociaciones de la Comunidad de Madrid, Sección Primera, número 36.699, a los solos efectos de publicidad.</p>
    <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 9pt"><strong>CIF:</strong> G87604658.<br>
      <strong>Denominación o Razón Social:</strong> AMPA COLEGIO SAN PEDRO APÓSTOL DE EI EP Y ESO DE MADRID.<br>
      <strong>Anagrama Comercial:</strong> AMPA-SPAB.<br>
      <strong>Domicilio Social:</strong> Calle Babilonia, num. 19, 28042 Madrid - (Madrid).<br>
      <strong>Domicilio Fiscal:</strong> Calle Babilonia, num. 19, 28042 Madrid - (Madrid).<br>
      <strong>Tipo de Asociación:</strong> Sin ánimo de lucro L. O. 1/2002.<br>
    </p>
  </div>
  <div style="margin-top: 25px;">
    <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 9pt"><strong>B- Datos y condiciones particulares del/de la Asociado/a</strong></p>
  </div>
  <div>
    <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 9pt"><strong>Nombre y apellidos:</strong> {{ $data->nombre }} {{ $data->apellidos }}.<br>
      <strong>Documento de Identificación:</strong> {{ $data->numdoc }}.<br>
      <strong>Modalidad de pago de cuotas:</strong> {{ $tpago }}.<br>
    </p>
  </div>
  <div style="margin-top: 25px;">
    <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 9pt"><strong>C- Condiciones específicas del Acuerdo de adhesión</strong></p>
  </div>
  <div>
    <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 9pt"><strong><ins>1.- Cambio de modalidad de pago de cuotas</ins></strong></p>
    <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 9pt">El/La Asociado/a se reserva el derecho de cambiar la modalidad del pago de sus cuotas en el momento que éste/a lo desee. Para ello será requisito indispensable la comunicación mediante escrito a AMPA SPAB, bien sea: dirigido a su domicilio social, entregado de forma presencial en el horario de atención que ésta tenga publicitado o a través de su dirección de correo electrónico. En caso de ausencia de solicitud escrita por parte del/de la Asociado/a, AMPA SPAB seguirá cobrando la cuota a éste/a según su última modalidad de pago elegida.</p>
    <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 9pt">En el caso de que exista posición morosa por impago de cuotas del/de la Asociado/a, AMPA SPAB podrá adoptar cuantas medidas considere oportunas para regularizar la situación de pagos por parte de aquél/aquélla pudiendo, si dicha regularización no se produce, ejecutar su baja perdiendo por tanto el/la Asociado/a todos los derechos adquiridos en este Acuerdo, el cual quedaría sin efecto.</p>
    <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 9pt"><strong><ins>2.- Efecto y duración del Acuerdo</ins></strong></p>
    <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 9pt">Como consecuencia de la formalización del presente Acuerdo y únicamente durante su vigencia, quedará el Asociado/a vinculado/a con la Asociación y la Asociación con el Asociado/a, ambos a los efectos derivados de los derechos y obligaciones recogidas en el apartado correspondiente de este Acuerdo, pudiendo libremente cualquiera de las partes cancelarlo si se diera alguna circunstancia que así lo provocara y que podrá ser una de las recogidas en su apartado correspondiente de este Acuerdo.</p>
  </div>

  <div style="margin-top: 50px">
    <p style="text-align: center; font-family: Arial, sans-serif; font-size: 8pt">AMPA Colegio San Pedro Apóstol - Calle Babilonia, 19, 28042 Madrid   mail:  ampa@sanpedroapostol.es</p>
    <p style="text-align: center; font-family: Arial, sans-serif; font-size: 11pt">1 de 4</p>
  </div>
@endsection