<style>
  #main-menu-logo{
    max-height: 40px;
  }
    #main-menu-navigation{
    overflow: hidden;
  }
</style>
@php
$configData = [
          'mainLayoutType' => 'vertical',
          'theme' => 'light',
          'sidebarCollapsed' => false,
          'navbarColor' => '',
          'horizontalMenuType' => 'floating',
          'verticalMenuNavbarType' => 'floating',
          'footerType' => 'static', //footer
          'layoutWidth' => 'full',
          'showMenu' => true,
          'bodyClass' => '',
          'bodyStyle' => '',
          'pageClass' => '',
          'pageHeader' => true,
          'contentLayout' => 'default',
          'blankPage' => false,
          'defaultLanguage'=>'en',
          'direction' => env('MIX_CONTENT_DIRECTION', 'ltr'),
        ];
@endphp
<div class="main-menu menu-fixed {{(($configData['theme'] === 'dark') || ($configData['theme'] === 'semi-dark')) ? 'menu-dark' : 'menu-light'}} menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto">
        <a class="navbar-brand" href="{{url('/')}}">


        </a>
      </li>
      <li class="nav-item nav-toggle"><a onclick=collapseLogo() class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
    </ul>
  </div>
  <div class="shadow-bottom"></div>

  <?php
  if (!checkX()) {

    if (!Auth::guest()) {
      $apps = Auth::user()->getEnabledApps(Auth::user());
      $apps = $apps->sortBy('sort');
      $protocol = empty($_SERVER['HTTPS']) === true ? 'http://' : 'https://';
  ?>

      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          {{-- Foreach menu item starts --}}


          @foreach($apps as $menu)
          @if(isset($menu->navheader))
          <li class="navigation-header">
            <span>{{ $menu->navheader }}</span>
            <i data-feather="more-horizontal"></i>
          </li>
          @else
          {{-- Add Custom Class with nav-item --}}
          @php
          $custom_classes = "";
          if(isset($menu->classlist)) {
          $custom_classes = $menu->classlist;

          }
          $currentRoute = Route::getCurrentRoute()->uri;
          $menuRoute = '/'. $menu->backpath . $menu->login;
          $active = false;

          if (strpos($menuRoute, $currentRoute) !== false) {
          $active = true;
          }

          @endphp
          <li class="nav-item {{ $active ? 'active' : '' }} {{ $custom_classes }}">
            <a href="<?php echo $protocol . $_SERVER['HTTP_HOST'] . $menu->backpath . $menu->login; ?>" class="d-flex align-items-center" target="{{isset($menu->newTab) ? '_blank':'_self'}}">
              @if(isset($menu->feather))
              <i data-feather="{{$menu->feather}}"></i>
              @else
              <i class="far fa-<?php echo $menu->class; ?>"></i>
              @endif
              <span class="menu-title text-truncate">{{ $menu->name }}</span>
              @if (isset($menu->badge))
              <?php $badgeClasses = "badge badge-pill badge-light-primary ml-auto mr-1" ?>
              <span class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }} ">{{$menu->badge}}</span>
              @endif
            </a>
            @if($menu->name == "myAdmin")
            @include('includes/submenu')
            @endif
            @if($menu->name == "myAppsForce")
            @include('includes/submenu' )
            @endif
          </li>
          @endif
          @endforeach

          {{-- Foreach menu item ends --}}
        </ul>
      </div>

  <?php }
  } ?>


</div>
<!-- END: Main Menu-->
<script>
  console.log("loaded");
  <?php $settings = new \App\Models\Appssettings(); ?>

  //logo of left bar
  let logoLeftBarTop = document.getElementById("main-menu-logo");

  // boolean which is true when the menu is collapsed so logo does not change when it is not needed
  let changeLogoLeftBarTop = false;

  function collapseLogo() {
    changeLogoLeftBarTop = !changeLogoLeftBarTop;
  }

  //We get the div in which dark/light theme is reflected in the class name
  const divTheme = document.getElementsByClassName("main-menu")[0];

  // When the content is loaded, if theme is dark, logo is changed
  document.addEventListener("DOMContentLoaded", () => {
    if (divTheme.className.includes("menu-dark")) {
      logoLeftBarTop.src = "<?php if ($settings->getValue('101', 'Logo xldark') != "") {
                    echo my_pictures('avatars/' . $settings->getValue('101', 'Logo xldark'));
                  } else {
                    echo my_asset('layouts/layout/img/AppsForceLogoB.png');
                  }  ?>";
    }
  });

  // We observe mutations in th class names, and change the logo according
  function callback(mutationsList, observer) {
    console.log("mutation 1 ",  mutationsList);
    mutationsList.forEach(mutation => {
      console.log("mutation 2 ",  mutation);
      if (mutation.attributeName === 'class') {
        console.log("mutation 3 ",  mutation);
        if (divTheme.className.includes("expanded") && divTheme.className.includes("menu-light")) {
          console.log("mutation 4 ",  divTheme.className);
          logoLeftBarTop.src = "<?php if ($client->logo !== "default") {
                        echo my_pictures('avatars/' . $client->logo);
                      } else {
                        echo my_asset('layouts/layout/img/AppsForceLogoA.png');
                      } ?>";
          logoLeftBarTop.style.maxWidth = "140px";
        } else if (!divTheme.className.includes("expanded") && divTheme.className.includes("menu-light") && changeLogoLeftBarTop) {
          console.log("mutation 5 ",  divTheme.className);
          logoLeftBarTop.src = "<?php if ($settings->getValue('101', 'Logo xs') != "") {
                        echo my_pictures('avatars/' . $settings->getValue('101', 'Logo xs'));
                      } else {
                        echo my_asset('layouts/layout/img/appsforce_small.jpeg');
                      }  ?>";
          logoLeftBarTop.style.maxWidth = "40px";
        } else if (!divTheme.className.includes("expanded") && divTheme.className.includes("menu-dark") && changeLogoLeftBarTop) {
          console.log("mutation 6 ",  divTheme.className);
          logoLeftBarTop.src = "<?php if ($settings->getValue('101', 'Logo xsdark') != "") {
                        echo my_pictures('avatars/' . $settings->getValue('101', 'Logo xsdark'));
                      } else {
                        echo my_asset('layouts/layout/img/appsforce_small.jpeg');
                      }  ?>"
          logoLeftBarTop.style.maxWidth = "40px";
        } else if (divTheme.className.includes("expanded") && divTheme.className.includes("menu-dark")) {
          console.log("mutation 7 ",  divTheme.className);
          logoLeftBarTop.src = "<?php if ($settings->getValue('101', 'Logo xldark') != "") {
                        echo my_pictures('avatars/' . $settings->getValue('101', 'Logo xldark'));
                      } else {
                        echo my_asset('layouts/layout/img/AppsForceLogoB.png');
                      }  ?>";
          logoLeftBarTop.style.maxWidth = "140px";
        }
      }
    })
  }

  // Creating and initializing the MutationObserver
  const mutationObserver = new MutationObserver(callback)
  mutationObserver.observe(divTheme, {
    attributes: true
  })
</script>
<script>

</script>