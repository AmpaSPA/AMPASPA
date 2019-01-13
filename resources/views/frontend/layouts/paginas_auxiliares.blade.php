<!DOCTYPE html>
<html lang="es">
 @include('includes.htmlhead')
 <body>
   <div class="container">
     <div class="row">
       @include('includes.topnavbar')
       @include('frontend.includes.auxcontent')
     </div>
   </div>
    <!-- Scripts js para Bootstrap -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   <!-- Scripts js del backend de la aplicación -->
   @include('frontend.includes.scripts')
 </body>
</html>