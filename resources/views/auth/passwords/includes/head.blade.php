<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Icono de nuestra aplicación para la pestaña del navegador -->
  <link rel="icon" href="{{ asset('favicon.ico') }}">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Título de nuestra aplicación en la pestaña del navegador. Se toma el informado en /config/app.php -->
  @section('titulo')
    <title>{{ config('app.name', 'Laravel') }}</title>
@show
<!-- Fuentes utilizadas en la aplicación -->
  <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic" rel="stylesheet" type="text/css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <!-- Estilos de Bootstrap por defecto -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- Estilos propios de nuestra aplicación -->
  <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css">
  <!-- Scripts js: token de seguridad -->
</head>