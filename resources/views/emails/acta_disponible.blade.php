@component('emails.message')

# Acta Disponible

## Hola {{ $notifiable->nombre }}

estás recibiendo este correo electrónico porque el acta correspondiente a esta reunión, a la que confirmastes tu asistencia, ha sido publicada y está disponible.

Fecha: {{ $fecha }}

Tipo: {{ $reunion->meetingtype->tiporeunion }}

Por favor, a la mayor brevedad posible, es preciso que pases por el colegio a fin de firmarla.

¡¡ Gracias por usar nuestra aplicación !!

Un cordial saludo.

@endcomponent
