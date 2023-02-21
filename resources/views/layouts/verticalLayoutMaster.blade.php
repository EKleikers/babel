<body class="vertical-layout vertical-menu-modern 2-columns
" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="" style="" data-framework="laravel" data-asset-path="{{ asset('/')}}">

  {{-- Include Sidebar --}}
  @include('includes.leftbar')

  {{-- Include Navbar --}}
  @include('includes.topbar')

  <!-- BEGIN: Content-->
  <div class="app-content content">
    <!-- BEGIN: Header-->
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-area-wrapper container p-0">
      <div class="sidebar-left">
        <div class="sidebar">
          {{-- Include Sidebar Content --}}
          @yield('content-sidebar')
        </div>
      </div>
      <div class="sidebar-left">
        <div class="content-wrapper">
          <div class="content-body">
            {{-- Include Page Content --}}
            @yield('content')
          </div>
        </div>
      </div>
    </div>
    

  </div>
  <!-- End: Content-->

  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>

  {{-- include footer --}}
  @include('includes/footer')

  {{-- include default scripts --}}
  @include('includes/scripts')
  @livewireScripts

</body>

</html>
