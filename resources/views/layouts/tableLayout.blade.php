<?php
global $head, $topbar, $leftbar, $scripts, $footer, $appsforceresponse;
if ($head == null | $topbar == null | $leftbar == null | $scripts == null | $footer == null | $appsforceresponse == null) {
    header('Location: /issue?message=Error accessing Graphics APIs 2');
    die();
}
if ($head['code'] != '200' | $topbar['code'] != '200' | $leftbar['code'] != '200' | $scripts['code'] != '200' | $footer['code'] != '200'  | $appsforceresponse['code'] != '200') {
    header('Location: /login');
    die();
}
$theme = $appsforceresponse['data']['theme'];
$head = $head['data'];
$topbar = $topbar['data'];
$leftbar = $leftbar['data'];
$scripts = $scripts['data'];
$footer = $footer['data'];
if ($theme != "vuexy") {
?>
    <!-- METRONIC TEMPLATE -->
    <!DOCTYPE html>

    <head>
        <?php echo $head; ?>
        @yield('page-style')
    </head>

    <body class="page-header-fixed page-footer-fixed navbar navbar-fixed-top page-content-white page-sidebar-fixed">
        <?php echo $topbar; ?>
        <div class="page-container">
            <?php echo $leftbar; ?>
            <div class="page-content-wrapper">
                <div class="page-content">
                    @yield('content')
                </div>
            </div>
            <footer class="row">
                <?php echo $footer; ?>
            </footer>
        </div>
        <?php echo $scripts; ?>
        @yield('page-scripts')
        <!-- BEGIN QUICK SIDEBAR -->
        <a href="javascript:;" class="page-quick-sidebar-toggler">
            <i class="icon-login"></i>
        </a>
        <div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
            <div class="page-quick-sidebar">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="javascript:;" data-target="#quick_sidebar_tab_1" data-toggle="tab">Menu
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
                        <div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
                            <ul class="media-list list-items" id="appsforce-sidebar-paste">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END QUICK SIDEBAR -->
    </body>

    </html>
<?php } else { ?>
    <!-- VUEXY TEMPLATE -->
    <?php
    $meta_tags = getMetaTags($head);
    $vuexyLefbarCollapsed = $meta_tags["vuexyLeftbarCollapsed"];
    $vuexyThemeValue = $meta_tags["vuexyThemeValue"];
    ?>
    <html class="{{ ($vuexyThemeValue === 'light') ? '' : $vuexyThemeValue.'-layout' }}">
    <head>
        <?php
        echo $head;
        ?>
        <link href='/myadmin/resources/themes/vuexy/vendors/css/tables/datatable/dataTables.bootstrap4.min.css' rel="stylesheet" type="text/css" />
        <link href="/myadmin/resources/themes/vuexy/css/pages/datatables-custom.css" rel="stylesheet" type="text/css">
    </head>

    <body class="vertical-layout vertical-menu-modern {{$vuexyLefbarCollapsed}} {{($vuexyThemeValue === 'dark') ? '' : 'light' }}" data-menu="vertical-menu-modern" data-layout="{{ ($vuexyThemeValue === 'light') ? '' : $vuexyThemeValue }}" data-framework="laravel" data-asset-path="{{ asset('/')}}">
        <?php
        echo $leftbar;
        echo $topbar;
        $user = \Auth::user();
        global $roleresponse;
        if ($roleresponse["data"] != $user->role) {
            $user->role = $roleresponse["data"];
            $user->save();
        }
        ?>
        @yield('page-style')
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
        @include('includes.chat')
        <?php echo $footer; ?>
        <?php echo $scripts; ?>
        <script src="/myadmin/resources/themes/vuexy/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
        <script src="/myadmin/resources/themes/vuexy/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
        @yield('page-scripts')
        <script>
            $('.chat-window-title').click(function() {
                let x = $(".chat-window-content")[0];
                if (x.style.height === "0px" && !$(".chat-window").hasClass("detailsOpened")) {
                    x.style.height = "400px";
                    $(".chat-window").addClass("expanded")
                } else if (!$(".chat-window").hasClass("detailsOpened")) {
                    x.style.height = "0px";
                    $(".chat-window").removeClass("expanded")
                }
            });
            $('.messageContainer').click(function() {
                let roomID = $(this).attr("data-id");
                $("#roomID").text(roomID);
                $(".chat-window-title h2").text("RoomID: " + roomID);
                let x = $(".chat-window-content")[0];
                x.style.display = "none";
                $(".chat-window-details")[0].style.display = "block";
                $('.closeWindow')[0].style.display = "block";
                $(".chat-window").addClass("detailsOpened")
            });
            $('.closeWindow').click(function(e) {
                e.stopPropagation(); // prevent top bar onclick from firing otherwise chat would close
                let x = $(".chat-window-details")[0];
                $(".chat-window-title h2").text("Messages");
                x.style.display = "none";
                $(".chat-window-content")[0].style.display = "block";
                $(this)[0].style.display = "none";
                $(".chat-window").removeClass("detailsOpened")
            })
        </script>
    </body>

    </html>
<?php } ?>