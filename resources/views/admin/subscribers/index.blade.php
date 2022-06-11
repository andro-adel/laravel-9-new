@extends('layouts.admin') 

@section('content')  

					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __("Subscribers") }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
											</li>
											<li>
												<a href="{{ route('admin-subs-index') }}">{{ __("Subscribers") }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">
                        @include('includes.admin.form-both')  
										<div class="table-responsiv">
												<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr class="text-right">
									                        <th>{{ __("#Sl") }}</th>
									                        <th>{{ __("Email") }}</th>
														</tr>
													</thead>
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>



@endsection    



@section('scripts')

    <script type="text/javascript">

		$('#example').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-subs-datatables') }}',
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'email', name: 'email' }
                     ],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });								
					
      	$(function() {
        $(".btn-area").append('<div class="col-sm-4 text-right">'+
        	'<a class="add-btn" href="{{route('admin-subs-download')}}">'+
          '<i class="fa fa-download"></i> {{ __("Download") }}'+
          '</a>'+
          '</div>');
      });	

    </script>
@endsection   