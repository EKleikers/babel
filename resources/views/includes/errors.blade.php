@if (count($errors))
<div class="alert alert-primary container alert-dismissible fade show cartErrors" role="alert" >
    @foreach ($errors->all() as $error)
    <div id="inner-message" class="alert-body" >
        <p>{{ $error }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endforeach
</div>
@endif
@if (isset($issue))
<div class="alert alert-secondary container alert-dismissible fade show" role="alert" style="display: inline-block;  width:auto;">
    <div id="inner-message" class="alert-body">
        <p>{{ $issue }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
</div>
@endif