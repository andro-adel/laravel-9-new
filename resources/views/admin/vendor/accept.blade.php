@extends('layouts.admin') 

@section('content')  
					<input type="hidden" id="headerdata" value="{{ __("VENDOR") }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __("Vendors") }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
											</li>
											<li>
												<a href="javascript:;">{{ __("Vendors") }}</a>
											</li>
											<li>
												<a href="{{ route('admin-vendor-index') }}">{{ __("Vendors List") }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">

								<div class="heading-area">
									<h4 class="title">
										{{ __("Vendor Registration") }} :
									</h4>
	                                <div class="action-list">
	                                    <select class="process select1 vdroplinks {{ $gs->reg_vendor == 1 ? 'drop-success' : 'drop-danger' }}">
	                                      <option data-val="1" value="{{route('admin-gs-regvendor',1)}}" {{ $gs->reg_vendor == 1 ? 'selected' : '' }}>{{ __("Activated") }}</option>
	                                      <option data-val="0" value="{{route('admin-gs-regvendor',0)}}" {{ $gs->reg_vendor == 0 ? 'selected' : '' }}>{{ __("Deactivated") }}</option>
	                                    </select>
	                                  </div>
								</div>


									<div class="mr-table allproduct">
										@include('includes.admin.form-success') 
										<div class="table-responsiv">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr class="text-right">
		                                                  <th>{{ __("Store Name") }}</th>
		                                                  <th>{{ __("Vendor Email") }}</th>
		                                                  <th>{{ __("Shop Number") }}</th>
		                                                  <th>{{ __("request status") }}</th>
		                                                  <th>{{ __("Options") }}</th>
														</tr>
													</thead>
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
{{-- VERIFICATION MODAL --}}

<div class="modal fade" id="verify-modal" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
										
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="submit-loader">
					<img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
				</div>
				<div class="modal-header">
					<h5 class="modal-title">ASK FOR VERIFICATION</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
				</div>
			</div>
		</div>

</div>

{{-- VERIFICATION MODAL ENDS --}}

{{-- STATUS MODAL --}}

<div class="modal fade" id="confirm-delete1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <div class="modal-header d-block text-center">
        <h4 class="modal-title d-inline-block">{{ __("Update Status") }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __("You are about to change the status.") }}</p>
            <p class="text-center">{{ __("Do you want to proceed?") }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancel") }}</button>
            <a class="btn btn-success btn-ok">{{ __("Update") }}</a>
      </div>

    </div>
  </div>
</div>

{{-- STATUS MODAL ENDS --}}

@endsection    

@section('scripts')

{{-- DATA TABLE --}}

    <script type="text/javascript">

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-vendor-datatables_accept') }}',
               columns: [
                        { data: 'shop_name', name: 'shop_name' },
                        { data: 'email', name: 'email' },
                        { data: 'shop_number', name: 'shop_number' },
                        { data: 'verfiy', searchable: false, orderable: false },
            			{ data: 'action', searchable: false, orderable: false }
                     ],
               language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
				drawCallback : function( settings ) {
	    				$('.select').niceSelect();	
				}
            });

	    				$('.select1').niceSelect();	
																
    </script>


<script type="text/javascript">

$(document).on('click','.verify',function(){
if(admin_loader == 1)
  {
  $('.submit-loader').show();
}
  $('#verify-modal .modal-content .modal-body').html('').load($(this).attr('data-href'),function(response, status, xhr){
      if(status == "success")
      {
        if(admin_loader == 1)
          {
            $('.submit-loader').hide();
          }
      }
    });
});


</script>

{{-- DATA TABLE --}}
    
@endsection   