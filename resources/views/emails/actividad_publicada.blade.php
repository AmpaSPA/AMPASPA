@component('emails.message')

# Actividad publicada

## Hola {{ $notifiable->nombre }}

estás recibiendo este correo electrónico porque ha sido publicada esta actividad que puede ser del interés de {{ $hijo->nombre }}.

Nombre: {{ $publicada->nombre }}

Fecha: {{ $fecha }}

Organizada por: {{ $publicada->activitytype->tipoactividad }}

Descripción: {{ $publicada->descripcion }}

@if ($publicada->activitytype->tipoactividad === 'COLEGIO')
Asimismo comentarte que al ser socio de la AMPA disfrutas de una subvención de {{ $publicada->subvencion }}€ a descontar del precio de la actividad marcado por el colegio, por lo que sólo deberás abonar la diferencia que te corresponde.
@else
@if ($publicada->activitytype->tipoactividad === 'AMPA')
Precio: {{ $publicada->precio }}
@else
¡¡ Como puedes comprobar, ser socio de nuestra AMPA comporta buenos beneficios !!.
@endif
@endif

Por favor, para proceder con tu autorización si lo consideras oportuno, accede a nuestra web haciendo clic en la cabecera de este correo.

¡¡ Gracias por usar nuestra aplicación !!

Un cordial saludo.

@endcomponent
