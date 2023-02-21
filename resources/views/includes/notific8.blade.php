<?php
if (count($errors)) { ?>
    <section id="bootstrap-toasts"> <?php  
    foreach ($errors->all() as $message) { 
        ?>
   <!-- Basic toast -->
   <div class="toast toast-basic hide position-fixed" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" style="top: 1rem; right: 1rem">
        <div class="toast-header">
            <strong class="mr-auto">AppsForce {{ trans('menu.update') }}</strong>
            <button type="button" class="ml-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">{{ $message }}</div>
    </div>
    <!-- Basic toast ends -->
        <?php
    }
    $errors = null;
    ?> </section> <?php
}
?>


