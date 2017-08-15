<div class="row">
	<div class="col-lg-12">
		@if ($message=Session::get('message'))
          <div class="alert alert-success alert-dismissable fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <p>{{ $message }}</p>
          </div>
        @endif
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		@if ($message=Session::get('warning'))
          <div class="alert alert-warning alert-dismissable fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <p>{{ $message }}</p>
          </div>
        @endif
	</div>
</div>