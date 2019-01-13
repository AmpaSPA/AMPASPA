@component('emails.message')

# Actividad publicada

## Hola {{ $notifiable->nombre }}

estás recibiendo este correo electrónico porque ha sido publicada esta actividad que puede ser del interés de {{ $hijo->nombre }}.

Nombre: {{ $publicada->nombre }}

Descripción: {{ $publicada->descripcion }}

Fecha: {{ $fecha }}

Organizada por: {{ $publicada->activitytype->tipoactividad }}

Asimismo comentarte que al ser socio de la AMPA disfrutas de una subvención de {{ $publicada->subvencion }}€ a descontar del precio de la actividad que asciende a {{ $publicada->precio }}€.

Por favor, para proceder con tu autorización si lo consideras oportuno, accede a nuestra web haciendo clic en la cabecera de este correo.

¡¡ Gracias por usar nuestra aplicación !!

Un cordial saludo.

@endcomponent
