@include('layouts.dashboard._header')
@include('layouts.dashboard._navbar')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    @stack('title')

    </section>

    <!-- Main content -->
    <section class="content">
        @include('layouts.dashboard._message')
            @yield('content')
    </section>
        <!-- /.content -->
    </div>
@include('partials._session')
@include('layouts.dashboard._footer')
