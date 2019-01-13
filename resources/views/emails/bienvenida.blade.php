@extends('backend.layouts.mails')
@section('cuerpo')
  <p>Estimado/a Sr/a.</p>
  <p>Ante todo, agradecerle su colaboración durante todo el proceso de registro como socio de nuestra Asociación.</p>
  <p>En el anexo de este correo encontrará el documento con las condiciones de su adhesión como socio del AMPA. Este anexo firmado por Ud. (junto con la copia del justificante de pago de su cuota si ésta ha sido abonada por transferencia), deberán ser entregados al AMPA por uno de los siguientes medios:</p>
  <p>
    a) Depositándolo en nuestro buzón junto a la entrada de la cafetería del Colegio.<br>
    b) Por correo electrónico a la dirección ampa@sanpedroapostol.es.<br>
    c) Presencialmente en nuestro despacho donde podrá firma directamente la copia de su acuerdo que obra en nuestro poder. Infórmese de nuestros horarios de atención.
  </p>
  <p>A continuación le indicamos las <strong><ins>INSTRUCCIONES ACERCA DEL INGRESO DE SU CUOTA:</ins></strong></p>
  <p>La modalidad de pago que Ud. ha elegido es: {{ $tipopago }}.</p>

  @if ($tipopago === 'Transferencia a nuestra cuenta')
    <p>Para hacer efectivo el pago de su cuota de socio por este medio deberá realizar una transferencia de <strong>25€</strong> a la cta.:</p>
    <p>
      C.C.C: 0081 5378 23 0001193729.<br>
      IBAN: ES71 0081 5378 2300 0119 3729.<br>
      Concepto: <strong>CUOTA AMPA {{ $numdoc }}</strong>.
    </p>
    <p><strong>IMPORTANTE:</strong> Tenga en cuenta que si realiza el ingreso por ventanilla en cualquier sucursal del Banco Sabadell, le van a cobrar una comisión de 2€.</p>
    <p>No olvide que, como justificación de su ingreso, Ud. deberá hacernos llegar el resguardo correspondiente de su ingreso/transferencia por alguno de los medios expuestos anteriormente.</p>
    <p>También puede imprimir, firmar y escanear su justificante firmado en formato pdf y subirlo a nuestra aplicación web empleando para ello las credenciales de acceso que se le facilitan al final de este mismo correo.</p>
  @endif

  @if ($tipopago === 'Metálico')
    <p>Para hacer efectivo el pago de su cuota de socio (<strong>25€ para este año</strong>) en metálico, debe acudir con dicho importe a nuestro despacho en el Colegio o bien depositarlo en Secretaría a nuestra atención. Le rogamos encarecidamente que acuda, en la medida de lo posible, con el importe exacto.</p>
    <p>Una vez hecho efectivo el pago de su cuota de socio, se le entregará un recibo como justificante del pago de su cuota. Cuando le hayamos registrado en nuestra Base de Datos le haremos llegar su Acuerdo de adhesión al AMPA.</p>
  @endif

  <p>Si tiene alguna duda acerca del documento que se anexa o sobre el proceso de registro, no dude en ponerse en contacto con nosotros a través de nuestro correo electrónico: ampa@sanpedroapostol.es.</p>
  <p><strong>CREDENCIALES DE ACCESO A NUESTRA WEB</strong></p>
  <P>A continuación le facilitamos sus credenciales de acceso a nuestra web:</P>
  <p>Usuario: {{ $correo }}<br>
    Contraseña: secret
  </p>
  <p>Sin otro particular, y agradeciéndole de nuevo su colaboración.</p>
  <p>Un cordial saludo.</p>
@endsection