@extends('layouts.admin') 

@section('content')  
					<input type="hidden" id="headerdata" value="{{ __("Vendor Fines") }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __("Vendor Fines") }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
											</li>
											<li>
												<a href="{{ route('admin.fines') }}">{{ __("fines imposed") }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">
										@include('includes.admin.form-success') 

										<div class="table-responsiv">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr class="text-right">
									                        <th>{{ __("Name") }}</th>
									                        <th>{{ __("Vendor Email") }}</th>
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



{{-- Fine MODAL --}}

<div class="modal fade" id="update-fine" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header d-block text-center">
                <h4 class="modal-title d-inline-block">{{ __("update fine") }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <!-- Modal body -->
            
            <div class="modal-body">
                <div class="contact-form">
                <form method="post">
                    {{csrf_field()}}
                    <ul>
                        <li>
                            <input type="text" class="input-field" id="fine-value" name="fine_value" placeholder="{{ __("Subject") }} *" required="">
                        </li>
                    </ul>
                    <button type="button" class="btn btn-danger btn-ok" data-dismiss="modal">{{ __("Cancel") }}</button>
                    <button class="btn btn-success btn-ok" type="submit">{{ __("Send Message") }}</button>
                </form>
            </div>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
                
          </div>

        </div>
    </div>
</div>

{{-- Fine MODAL ENDS --}}

@endsection    

@section('scripts')

{{-- DATA TABLE --}}

    <script type="text/javascript">

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin.vendor.finesdatatable') }}',
               columns: [
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
            			{ data: 'action', searchable: true, orderable: false }
                     ],
               language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
                drawCallback : function( settings ) {
                        $('.select').niceSelect();  
                }
            });
        
       /* $('#fine-data').click(
             $.ajax({
               type:'POST',
               datatype: 'json',
               url:'',
            }).done(function(data){
                var value = JSON.parse(JSON.stringify(data));
                $('#fine-value').val(value.data);
            })
        );*/
    </script>

{{-- DATA TABLE --}}
    
@endsection   