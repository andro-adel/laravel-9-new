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
												<a href="{{ route('admin.fines') }}">{{ __("Vendor Fines") }}</a>
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
										<div class="godropdown">
                                            <button class="go-dropdown-toggle"> 
                                                Actions
                                                <i class="fas fa-chevron-down">
                                                </i>
                                            </button>
                                            <div class="action-list">
                                                <a href="{{route('admin.fines.create')}}">
                                                    <i class="fas fa-plus"></i>
                                                    Add Fines
                                                </a>
                                                <a href="javascript:;" id="fine-data" data-href="' . route('admin-prod-delete',$data->id) . '" data-toggle="modal" data-target="#update-fine" class="delete">
                                                    <i class="fas fa-edit"></i>
                                                    Update Fines Value
                                                </a>
                                            </div>
                                        </div>
                                        
										<div class="table-responsiv">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr class="text-right">
									                        <th>{{ __("Name") }}</th>
									                        <th>{{ __("Fines") }}</th>
									                        <th>{{ __("Comments") }}</th>
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

{{-- ADD / EDIT MODAL --}}

			<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
										
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
												<div class="submit-loader">
														<img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
												</div>
											<div class="modal-header">
											<h5 class="modal-title"></h5>
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

{{-- ADD / EDIT MODAL ENDS --}}

{{-- DELETE MODAL --}}

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
				<form method="post" action="{{route('admin.fine.update')}}">
					{{csrf_field()}}
					<ul>
						<li>
							<input type="text" class="input-field" id="" name="new_val" placeholder="{{ __("Subject") }} *" required="">
							<input type="text" class="input-field" id="fine-value" hidden="true" name="fine_value" placeholder="{{ __("Subject") }} *" required="">
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

{{-- DELETE MODAL ENDS --}}

{{-- MESSAGE MODAL --}}
<div class="sub-categori">
	<div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="vendorformLabel">{{ __("Send Message") }}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
				</div>
			<div class="modal-body">
				<div class="container-fluid p-0">
					<div class="row">
						<div class="col-md-12">
							<div class="contact-form">
								<form id="emailreply1">
									{{csrf_field()}}
									<ul>
										<li>
											<input type="email" class="input-field eml-val" id="eml1" name="to" placeholder="{{ __("Email") }} *" value="" required="">
										</li>
										<li>
											<input type="text" class="input-field" id="subj1" name="subject" placeholder="{{ __("Subject") }} *" required="">
										</li>
										<li>
											<textarea class="input-field textarea" name="message" id="msg1" placeholder="{{ __("Your Message") }} *" required=""></textarea>
										</li>
									</ul>
									<button class="submit-btn" id="emlsub1" type="submit">{{ __("Send Message") }}</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>

{{-- MESSAGE MODAL ENDS --}}
@endsection    

@section('scripts')

{{-- DATA TABLE --}}

    <script type="text/javascript">

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin.finesdatatable') }}',
               columns: [
                        { data: 'name', name: 'name' },
                        { data: 'fine', name: 'fine' },
                        { data: 'comment', name: 'comment' },
            			{ data: 'action', searchable: false, orderable: false }
                     ],
               language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
                drawCallback : function( settings ) {
                        $('.select').niceSelect();  
                }
            });
        
        $('#fine-data').click(
             $.ajax({
               type:'GET',
               datatype: 'json',
               url:'{{route('admin.fine.edit')}}'
            }).done(function(data){
                var value = JSON.parse(JSON.stringify(data));
                 for(var i = 0; value.length > i;i++){
                    console.log(value[i]);
                }
                $('#fine-value').val(value.data);
            })
        );
            
    </script>

{{-- DATA TABLE --}}
    
@endsection   