<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    {{-- Style --}}
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
  </head>

  <body>
      <div class="loading-halaman"></div>
   {{-- Navbar --}}
   @include('includes.navbar')

   {{-- Page Content --}}
   @yield('content')

   {{-- Footer --}}
   @include('includes.footer')

   {{-- Script --}}
    <script  type="text/javascript" src="{{ asset('js/loader.js') }}"></script>
   @stack('prepend-script')
   @include('includes.script')
   @stack('addon-script')
  </body>
</html>
