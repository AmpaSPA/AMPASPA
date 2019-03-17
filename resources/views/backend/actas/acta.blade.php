<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
</head>

<body>
    <div>
        <table width="100%">
            <tr>
                <td style="text-align: left"><strong><em>Acta Reunión: {{ $fecha }}</em></strong></td>
                <td style="text-align: right">Madrid a, {{ $hoy }}</td>
            </tr>
        </table>
    </div>

    <div>
        <p style="text-align: center; font-family: Arial, sans-serif; font-size: 14pt; margin-bottom: 10px"><strong>CURSO ESCOLAR {{ $periodo->periodo }}</strong></p>
        <p style="text-align: center; font-family: Arial, sans-serif; font-size: 14pt; margin-bottom: 10px"><strong>REUNION {{ $tipo }}</strong></p>
        <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 11pt">Reunidos en Madrid el día {{ $fechaLiteral }} a las {{ $reunion->horareunion }} horas los siguientes miembros de
            la Junta Directiva de la AMPA:</p>

        <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 11pt">
            @foreach ($asistentes as $asistente)
            <ul>
                <li>{{ $asistente->nombre }} con DNI: {{ $asistente->numdoc }}</li>
            </ul>
            @endforeach
            <br>
        </p>

        <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 11pt">{{ $reunion->nota }}</p>

        <p style="text-align: center; font-family: Arial, sans-serif; font-size: 14pt"><u><strong>ORDEN DEL DÍA</strong></u></p>

        <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 11pt">
            @foreach ($temas as $tema)
            <ul>
                <li><strong>{{ $tema->titulo }}</strong></li>
                <br> {{ $tema->tema }}
            </ul>
            @endforeach
            <br>
        </p>

        <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 11pt">
            Tras el oportuno debate se llegó a los siguientes:
            <br>
        </p>

        <p style="text-align: center; font-family: Arial, sans-serif; font-size: 14pt"><u><strong>ACUERDOS</strong></u></p>

        <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 11pt">
            @foreach ($temas as $tema)
            <ul>
                <li><strong>{{ $tema->titulo }}</strong></li>
                <br> {{ $tema->agree->acuerdo }}
            </ul>
            @endforeach
            <br>
        </p>

        <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 11pt">
            Y sin más asuntos que tratar, se levanta la sesión a las {{ $reunion->horafinreunion }} horas del día {{ $fechaLiteral }}.
            <br>
        </p>

        <p style="text-align: center; font-family: Arial, sans-serif; font-size: 11pt">
            <br>
            Firmas de los asistentes
        </p>
    </div>
</body>
</html>