<div class="vertical-layout h-100 vertical-menu-modern menu-expanded navbar-floating footer-static" data-col="1-column">
    <nav class="navbar header-navbar navbar navbar-shadow align-items-center navbar-light navbar-expand floating-nav topMenu">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <a href="/blender"><img src="/blender/resources/images/logo.png" class="logo" alt="logo"></a>
            </div>

            <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item dropdown dropdown-user">
                    @if (\Auth::user())
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name font-weight-bolder">{{ \Auth::user()->name }}</span>
                        </div>
                        @if (\Auth::user()->avatar)
                        <span class="avatar"><img class="round" src="/myadmin/public/images/avatars/{{\Auth::user()->avatar}}"alt="SMURF" height="40" width="40"></span>
                        <span class="avatar-status-online"></span>
                        @else
                        <span class="avatar"><img class="round" src="/blender/resources/images/user-placeholder.png" alt="avatar" height="40" width="40"></span>
                        <span class="avatar-status-offline"></span>
                        @endif
                    
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="/myProfile/usersprofile/{{ \Auth::user()->id }}"><i class="fal fa-cog"></i>&nbsp; {{trans('blender.myprofile')}}</a>
                        <a class="dropdown-item" href="/logout"><i class="fal fa-sign-out-alt"></i>&nbsp; {{trans('blender.logout')}}</a>
                        <a class="dropdown-item" href="https://blenderworlds.com/blender/cart"><i class="fal fa-shopping-cart"></i>&nbsp; {{trans('blender.cart')}}</a>
                    </div>
                    @else
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name font-weight-bolder"></span>
                        </div>
                        <span class="avatar"><img class="round" src="resources/images/user-placeholder.png" alt="avatar" height="40" width="40">
                        <span class="avatar-status-offline"></span>
                    </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="/login">
                            <i class="mr-50" data-feather="user"></i>{{trans('blender.login')}}</a>
                        <a class="dropdown-item" href="/register"><i class="mr-50" data-feather="settings"></i>{{trans('blender.register')}}</a>
                    </div>
                    
                    @endif

                </li>
            </ul>
        </div>
    </nav>