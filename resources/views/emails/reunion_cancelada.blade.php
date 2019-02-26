@component('emails.message')

# Reunión Cancelada

## Hola {{ $notifiable->nombre }}

estás recibiendo este correo electrónico porque ha sido cancelada esta reunión a la que estabas invitad@ a asistir.

Fecha: {{ $fecha }}

Hora: {{ $cancelada->horareunion }}

Tipo: {{ $cancelada->meetingtype->tiporeunion }}

La misma tenía el siguiente **ORDEN DEL DÍA**:

@foreach($temas as $tema)
* **{{ $tema->titulo }}**: {{ $tema->tema }}

@endforeach

Te pedimos que sigas pendiente de nuestras notificaciones ya que, en caso de celebrarse ésta u otra reunión a la que estés de nuevo invitad@, recibirás cumplida invitación por este mismo medio.

¡¡ Gracias por usar nuestra aplicación !!

Un cordial saludo.

@endcomponent
