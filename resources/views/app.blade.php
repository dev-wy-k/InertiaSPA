<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />

    <!-- Font Awesome -->
    <link
    href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link
    href="https://cdn.jsdelivr.net/npm/mdb-vue-ui-kit/css/mdb.min.css" rel="stylesheet"  />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
   
    
    <title>Inertia</title>
  </head>
  <body>
    <div class="main"></div>
    @inertia
    
    
    <!-- MDB -->
    <script src="https://unpkg.com/vue@next"></script>
    <script src="https://cdn.jsdelivr.net/npm/mdb-vue-ui-kit/js/mdb.umd.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js" ></script>
    @routes
    <script src="{{ mix('/js/app.js') }}" defer></script>
  </body>
</html>