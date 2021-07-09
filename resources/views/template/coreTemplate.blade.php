<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SIM Pasar | @yield('title')</title>
   @include('template.partials.style')
</head>
<body>
   <div id="app">
      @include('template.partials.navbar')
      @include('template.partials.sidebar')
      @include('template.partials.content')
      @include('template.partials.footer')
      @include('template.partials.script')
   </div>
</body>
</html>