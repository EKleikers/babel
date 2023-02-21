@extends('errors.illustrated-layout')

@section('code', '401')
@section('title', <?php echo trans('auth.notauth'); ?>)

@section('image')
    <div style="background-image: url({{my_asset('svg/403.svg')}}" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message')
<?php echo trans('auth.notauth'); ?>
@endsection
