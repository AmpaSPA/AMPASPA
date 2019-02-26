@component('emails.message')

# Reunión Convocada

## Hola {{ $notifiable->nombre }}

estás recibiendo este correo electrónico porque ha sido convocada esta reunión a la que estás invitado a asistir.

Fecha: {{ $fecha }}

Hora: {{ $convocada->horareunion }}

Tipo: {{ $convocada->meetingtype->tiporeunion }}

La misma tendrá el siguiente **ORDEN DEL DÍA**:

@foreach($temas as $tema)
* **{{ $tema->titulo }}**: {{ $tema->tema }}

@endforeach

Por favor, para proceder con tu confirmación de asistencia, si lo consideras oportuno, accede a nuestra web haciendo clic en la cabecera de este correo.

¡¡ Gracias por usar nuestra aplicación !!

Un cordial saludo.

@endcomponent
