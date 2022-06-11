@extends('layouts.admin')

@section('content')
    <input type="hidden" id="headerdata" value="{{ __("commissions") }}">
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __("commission processing") }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.commission.processing') }}">{{ __("commission processing") }}</a>
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
                                    <th>{{ __("Customer Email") }}</th>
                                    <th>{{ __("Order Number") }}</th>
                                    <th>{{ __("Total Qty") }}</th>
                                    <th>{{ __("Total Cost") }}</th>
                                    <th>{{ __("commission") }}</th>
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
@endsection

@section('scripts')

    {{-- DATA TABLE --}}

    <script type="text/javascript">

        var table = $('#geniustable').DataTable({
            ordering: false,
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin-commission-datatable','processing') }}',
            columns: [
                { data: 'customer_email', name: 'customer_email' },
                { data: 'id', name: 'id' },
                { data: 'totalQty', name: 'totalQty' },
                { data: 'pay_amount', name: 'pay_amount' },
                { data: 'commission', name: 'commission' },
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