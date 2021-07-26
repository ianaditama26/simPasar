<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   @include('frontend.components.style')
</head>
<body>
   <div class="antialiased font-sans">
      @include('frontend.components.navbar')
      @include('frontend.components.content')
      @include('frontend.components.script')
   </div>
</body>
</html>
