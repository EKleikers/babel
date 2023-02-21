<?php
$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "blenderapp";
$b->link = "/blenderapp";
$breadcrumb->add($b);
$breadcrumb->name = "Home";
?>

@extends('layouts.app', ['selected' => 'management'])

@section('content')

@include ('management.mydashboardwelcome')

<div class="row">   
    <div class="col-sm-12 col-xs-12 sections_">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cube" aria-hidden="true"></i><?php echo trans('mydashboard.instances'); ?>
                </div>
                <div class="actions">
                    <a href="#newappsforce" data-toggle="modal" class="btn btn-primary"><?php echo trans('mydashboard.newappsforce'); ?></a>
                    <div class="modal fade" id="newappsforce" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title"><?php echo trans('mydashboard.newappsforce'); ?></h4>
                                </div>
                                <div class="modal-body"><?php echo trans('mydashboard.newappsforcetext'); ?></div>
                                <form method="get" action="<?php echo url('/wizard-step-1') ?>">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('mydashboard.cancel'); ?></button>
                                        <button  class="btn btn-primary" type="submit" ><?php echo trans('mydashboard.confirm'); ?></button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </div>
            </div>
            <?php $x = 1; ?>
            <div class="table-responsive">
                <table class="table table-hover table-light dashboardtable">
                    <thead>
                        <tr>
                            <th class="col-md-2">AppsForce</th>
                            <th class="col-md-3"><?= trans('mydashboard.domain'); ?></th>
                            <th class="col-md-3"><?= trans('mydashboard.server'); ?></th>
                            <th class="col-md-2"><?= trans('mydashboard.status'); ?></th>
                            <th class="usersAction col-md-2"><?= trans('mydashboard.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($instances as $a)
                            <tr id="{{ $a->server }}">
                            <td>{{ $a->appsforce_friendly_name }}</td>
                            <td>{{ $a->domain }}</td>                                
                            <td>{{ $a->server }}</td>
                            <td class="application_status">{{ ($a->status == 1 ? trans('mydashboard.apprunning') : trans('mydashboard.appnotready')) }}</td>
                            <td class="usersAction">
                                @if($a->status == 1)
                                <div class="actions">        
                                    <a class="btn btn-info" data-toggle="modal" href="#adddept{{$x}}">{{ trans('mydashboard.change') }}</a>
                                    <a href="/mystore/manage/apps/{{ $a->appsforce_urn }}" class="btn btn-info"><?php echo trans('mydashboard.manageapps'); ?></a>
                                    @if($a->domain != $a->server)
                                    <!--<a class="btn btn-sm default" href="/manage/ssl/{{ $a->appsforce_urn }}">SSL</a>-->
                                    @endif
                                </div>
                                <div id="adddept{{$x}}" class="modal fade" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="<?php echo url('/manage/name/'); ?>/{{$a->appsforce_urn}}" method="post" enctype="multipart/form-data" class="form-horizontal" role="form" >
                                            <div class="modal-content text-left">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title"><?php echo trans('mydashboard.aurn'); ?></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h4><?php echo trans('mydashboard.urn'); ?></h4>
                                                                <p style="overflow-wrap: break-word;">
                                                                    {{ $a->appsforce_urn }}</p>
                                                                <h4><?php echo trans('mydashboard.changename'); ?></h4>
                                                                </br>
                                                                {{ csrf_field() }}
                                                                <div class="form-body">
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label">{{ trans('mydashboard.newname') }}</label>
                                                                        <div class="col-md-6">
                                                                            <div class="input-icon right">
                                                                                <i class="fa fa-warning"></i>
                                                                                <input name="name" id="name" type="text" class="form-control" placeholder="{{ $a->appsforce_friendly_name }}" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label">{{ trans('mydashboard.domain') }}</label>
                                                                        <div class="col-md-6">
                                                                            <div class="input-icon right">
                                                                                <i class="fa fa-warning"></i>
                                                                                <input name="domain" id="domain" type="text" class="form-control" placeholder="{{ $a->domain }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-dismiss="modal" class="btn btn-default"><?php echo trans('mydashboard.close'); ?></button>                                    
                                                    <button type="submit" class="btn btn-success">{{ trans('mydashboard.change') }}</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                                @else
                                <img src="<?= app_pictures('resources/assets/images/loading.gif') ?>" style="float: right; width: 25px;;" class=""/>
                                @endif
                            </td>
                        </tr>
                        <?php $x = $x + 1; ?>
                        {{--@endforeach--}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">   
    <div class="col-sm-12 col-xs-12 sections_">

        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-external-link" aria-hidden="true"></i><?php echo trans('mydashboard.domains'); ?></div>
                <div class="actions">
                    <a href="#newdomain" data-toggle="modal" class="btn btn-primary"><?php echo trans('mydashboard.newdomain'); ?></a>
                </div>
                <div class="modal fade" id="newdomain" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title"><?php echo trans('mydashboard.newdomain'); ?></h4>
                            </div>
                            <div class="modal-body"><?php echo trans('mydashboard.newdomaintext'); ?></div>
                            <form method="get" action="<?php echo url('/newdomain') ?>">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('mydashboard.cancel'); ?></button>
                                    <button  class="btn btn-primary" type="submit" ><?php echo trans('mydashboard.confirm'); ?></button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-light dashboardtable">
                    <thead>
                        <tr>                            
                            <th class="col-md-2"><?php echo trans('mydashboard.domain'); ?></th>
                            <th class="col-md-3">AppsForce</th>
                            <th class="col-md-3"><?php echo trans('mydashboard.expdate'); ?></th>
                            <th class="col-md-2"><?php echo trans('mydashboard.status'); ?></th>
                            <th class="usersAction col-md-2"><?php echo trans('mydashboard.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($domains as $domain)
                        <tr>
                            <td>{{ $domain->domain_name }}</td>
                            <td>None</td>
                            <td>{{  date("d-m-Y", strtotime($domain->expiry_date))}}</td>
                            <td>{{ $domain->status }}</td>
                            <td class="usersAction"><a href="/mystore/manage/domain/{{ $domain->domain_name }}" class="btn btn-sm primary"><?php echo trans('mydashboard.manage'); ?></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<div class="row">
    <div class="col-sm-12 col-xs-12 sections_">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-server" aria-hidden="true"></i><?php echo trans('mydashboard.hosting'); ?></div>
                <div class="actions">
                    <a href="#newserver" data-toggle="modal" class="btn btn-primary">
                        <?php echo trans('mydashboard.newserver'); ?></a>
                </div>
                <div class="modal fade" id="newserver" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title"><?php echo trans('mydashboard.newserver'); ?></h4>
                            </div>
                            <div class="modal-body"><?php echo trans('mydashboard.newservertext'); ?></div>
                            <form method="get" action="<?php echo url('/newserver') ?>">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('mydashboard.cancel'); ?></button>
                                    <button  class="btn btn-primary" type="submit" ><?php echo trans('mydashboard.confirm'); ?></button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-light dashboardtable">
                    <thead>
                        <tr>
                            <th class="col-md-2"><?php echo trans('mydashboard.hosting'); ?></th>
                            <th class="col-md-3">AppsForce</th>
                            <th class="col-md-3"><?php echo trans('mydashboard.ip'); ?></th>
                            <th class="col-md-2"><?php echo trans('mydashboard.status'); ?></th>
                            <th class="usersAction col-md-2"><?php echo trans('mydashboard.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($servers as $hosting)
                        <?php $bedmessage = ''; ?>
                        @if($hosting->server_status == 'in-progress')
                        <?php $bedmessage = "font-red"; ?>
                        @endif
                        <tr id="{{ $hosting->id }}">
                            <td><span class="<?= $bedmessage ?>">{{ $hosting->server_name }}</span></td>
                            <td><span class="<?= $bedmessage ?>">{{ $hosting->appsforce_friendly_name }}</span></td>
                            <td><span class="<?= $bedmessage ?>">{{ $hosting->server_ip }}</span></td>
                            <td><span class="<?= $bedmessage ?>">{{ trans('mydashboard.'.$hosting->server_status) }}</span></td>
                            @if($bedmessage == "")
                            <td class="usersAction">
                                <a href="/mystore/manage/server/{{ $hosting->id }}" class="btn btn-info">{{ trans('mydashboard.manage') }}</a>
                            </td>
                            @else
                            <td class="usersAction">
                                <img src="<?= app_pictures('resources/assets/images/loading.gif') ?>" style="float: right; width: 25px;;" class=""/>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12 col-xs-12 sections_">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-medkit" aria-hidden="true"></i><?php echo trans('mydashboard.support'); ?></div>
                <div class="actions">
                    <a href="#newsupport" data-toggle="modal" class="btn btn-primary">
                        <?php echo trans('mydashboard.newsupport'); ?></a>
                </div>
                <div class="modal fade" id="newsupport" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title"><?php echo trans('mydashboard.newsupport'); ?></h4>
                            </div>
                            <div class="modal-body"><?php echo trans('mydashboard.newsupporttext'); ?></div>
                            <form method="get" action="<?php echo url('/newsupport') ?>">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('mydashboard.cancel'); ?></button>
                                    <button  class="btn btn-primary" type="submit" ><?php echo trans('mydashboard.confirm'); ?></button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-light dashboardtable">
                    <thead>
                        <tr>
                            <th class="col-md-2"><?php echo trans('mydashboard.support'); ?></th>
                            <th class="col-md-3">AppsForce</th>
                            <th class="col-md-3"><?php echo trans('mydashboard.type'); ?></th>
                            <th class="col-md-2"><?php echo trans('mydashboard.status'); ?></th>
                            <th class="usersAction col-md-2"><?php echo trans('mydashboard.actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($support as $sup)
                        <tr>
                            <td>{{ $sup->name }}</td>
                            <td>{{ $sup->appsforce_friendly_name }}</td>
                            <td>{{ $sup->type }}</td>
                            <td>{{ $sup->status }}</td>
                            <?php if ($sup->status == "Active") { ?>
                                <td class="usersAction"><a href="/mysupport" class="btn btn-info"><?php echo trans('mydashboard.getsupport'); ?></a></td>
                            <?php } else { ?>
                                <td> class="usersAction"<a href="/mystore/renewSupport/<?php $sup->id ?>" class="btn btn-info"><?php echo trans('mydashboard.renew'); ?></a></td>
                                <?php } ?>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include ('management.mydashboardbecome')

@endsection
