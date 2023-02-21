 <?php if (\Auth::user() != null && \Auth::user()->reseller_id == 0 | \Auth::user()->developer_id == 0) { ?>
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
                <?php if (\Auth::user() != null && \Auth::user()->reseller_id == 0) { ?>
                <div class="col-md-4">
                    <div class="mt-widget-4">
                        <div class="mt-img-container">
                            <img style="object-fit: cover" src="<?php echo my_asset('images/reseller.jpg'); ?>" /> </div>
                        <div class="mt-container bg-green-opacity">
                            <div class="mt-head-title">{{trans('mydashboard.becomereseller')}}</div>
                            <div class="mt-footer-button">
                                <button type="button" onclick="window.location.href = '/mystore/reseller/signup';" class="btn btn-primary">{{trans('mydashboard.start')}}</button>
                            </div>
                            </br></br></br>
                            <div style="padding:10px">
                                {{trans('mydashboard.becomeresellerbody')}}
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                if (\Auth::user() != null && \Auth::user()->developer_id == 0) {
                ?>
                <div class="col-md-4">
                    <div class="mt-widget-4">
                        <div class="mt-img-container">
                            <img style="object-fit: cover" src="<?php echo my_asset('images/developer.jpg'); ?>" /> </div>
                        <div class="mt-container bg-dark-opacity">
                            <div class="mt-head-title">{{trans('mydashboard.becomedeveloper')}}</div>
                            <div class="mt-footer-button">
                                <button type="button" onclick="window.location.href = '/mystore/developer/signup';" class="btn btn-primary">{{trans('mydashboard.start')}}</button>
                            </div>
                            </br></br></br>
                            <div style="padding:10px">
                                {{trans('mydashboard.becomedeveloperbody')}}
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            </br></br>
        </div>  
    </div>
 <?php } ?>