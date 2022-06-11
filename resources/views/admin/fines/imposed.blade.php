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
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header d-block text-center">
                                                    <h4 class="modal-title d-inline-block">{{ __("fines imposed"). $user->name }}</h4>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <div class="contact-form">
                                                    <form method="post" action="{{route('admin.fines.store',$user->id)}}">
                                                        {{csrf_field()}}
                                                        <ul>
                                                            <li>
                                                                <input type="text" class="input-field"name="fine" placeholder="{{ __("Fines") }} *" required="">
                                                            </li>
                                                             <li>
                                                                <input type="text" class="input-field" name="comment" placeholder="{{ __("Comments") }} *" required="">
                                                            </li>
                                                        </ul>
                                                        <a href="{{route('admin.fines.create')}}" class="btn btn-danger btn-ok" >{{ __("Cancel") }}</a>
                                                        <button class="btn btn-success btn-ok" type="submit">{{ __("add fine") }}</button>
                                                    </form>
                                                </div>
                                                </div>
                                              </div>
                                    
                                            </div>
                                        </div>
                                        <center><h3>{{__("previous fine")}}</h3></center>
                                        @if(count($fines) > 0)
                                        <table class="table table-hover dt-responsive ltr" cellspacing="0" width="100%">
													<thead>
														<tr class="text-right">
									                        <th>{{ __("Fines") }}</th>
									                        <th>{{ __("Comments") }}</th>
									                        <th>{{ __("created at") }}</th>
														</tr>
													</thead>
													<tbody>
													    @foreach($fines as $fine)
													        <tr>
													            <td>{{$fine->fine}}</td>
													            <td>{{$fine->comment}}</td>
													            <td>{{$fine->created_at}}</td>
													        </tr>
													    @endforeach
													</tbody>
												</table>
										@else
										<br><br><br>
										<center><h5>{{__("No Previous Fine")}}</h5></center>
										@endif
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