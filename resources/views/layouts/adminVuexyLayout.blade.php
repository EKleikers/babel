<?php
$configData = Helper::applClasses();
?>
<html class="{{ ($configData['vuexyThemeValue'] === 'light') ? '' : $configData['vuexyThemeValue'].'-layout' }}">

<head>
    <?php
        echo $configData['head']; 
        ?>
    @yield('page-style')
    <link href='/myadmin/resources/themes/vuexy/vendors/css/tables/datatable/dataTables.bootstrap4.min.css' rel="stylesheet" type="text/css" />
    <link href="/myadmin/resources/themes/vuexy/css/pages/datatables-custom.css" rel="stylesheet" type="text/css">
</head>

<body
    class="vertical-layout vertical-menu-modern {{$configData['vuexyLeftbarCollapsed']}} {{($configData['vuexyThemeValue'] === 'dark') ? '' : 'light' }}"
    data-menu="vertical-menu-modern" data-layout="{{ ($configData['vuexyThemeValue'] === 'light') ? '' : $configData['vuexyThemeValue'] }}"
    data-framework="laravel" data-asset-path="{{ asset('/')}}">
    <?php
        echo $configData['leftbar'];
        echo $configData['topbar'];
        ?>
    @include('includes.notific8')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <?php echo $configData['footer']; ?>
    <?php echo $configData['scripts']; ?>
    @yield('page-scripts')
    <script src="/myadmin/resources/themes/vuexy/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
  <script src="/myadmin/resources/themes/vuexy/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
</body>

</html>