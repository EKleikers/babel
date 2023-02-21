<?php
$user = \Auth::user();
$instances = \App\Models\UserInstance::where('user_id', $user->id)->get();
$apps = \App\UserApp::where('user_id', $user->id)->get();

if (count($instances) == 0 & count($apps) == 0) {
?>

    <div class="mt-element-ribbon bg-grey-steel">
        <div class="ribbon ribbon-border-hor ribbon-clip ribbon-color-danger uppercase">
            <div class="ribbon-sub ribbon-clip"></div> {{ trans('mydashboard.ribbontitle')}} </div>
        <p class="ribbon-content">{{ trans('mydashboard.ribbontext')}}</p>
    </div>


    <div class="portlet light portlet-fit bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-microphone font-dark hide"></i>
                <span class="caption-subject bold font-dark uppercase">{{ trans('mydashboard.getstarted')}}</span>
                <span class="caption-helper">{{ trans('mydashboard.easysteps')}}</span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="mt-widget-4">
                        <div class="mt-img-container">
                            <img style="object-fit: cover" src="<?php echo my_asset('images/installation.jpg'); ?>" /> </div>
                        <div class="mt-container bg-purple-opacity">
                            <div class="mt-head-title">{{trans('mydashboard.install')}}</div>
                            <div class="mt-footer-button">
                                <button type="button" onclick="window.location.href = '/mystore/wizard-step-1';" class="btn btn-primary">{{trans('mydashboard.start')}}</button>
                            </div>
                            </br></br></br>
                            <div style="padding:10px">
                                {{trans('mydashboard.installbody')}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mt-widget-4">
                        <div class="mt-img-container">
                            <img style="object-fit: cover" src="<?php echo my_asset('images/shop.jpg'); ?>" /> </div>
                        <div class="mt-container bg-green-opacity">
                            <div class="mt-head-title">{{trans('mydashboard.visitshop')}}</div>
                            <div class="mt-footer-button">
                                <button type="button" onclick="window.location.href = '/mystore/home';" class="btn btn-primary">{{trans('mydashboard.start')}}</button>
                            </div>
                            </br></br></br>
                            <div style="padding:10px">
                                {{trans('mydashboard.visitshopbody')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </br></br>
        </div>  
    </div>
<?php } ?>