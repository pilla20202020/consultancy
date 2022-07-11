@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}"/>
@endsection

@section('title', 'Admission List')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">admission List</header>
                <div class="tools ml-auto">
                    <a class="btn btn-primary ink-reaction" href="{{ route('admission.create') }}">
                        <i class="md md-add"></i>
                        Add admission
                    </a>
                </div>
            </div>
            <div class="card mt-2 p-4">
                <div class="table-responsive">
                    <table id="example" class="table table-hover display">
                        <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Student</th>
                            <th>College</th>
                            <th>Admission Date</th>
                            <th>Program</th>
                            <th>Fee</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @each('admission.partials.table', $admissions, 'admission')
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- View Payment Modal --}}
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">View Payment History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>S.No.</th>
                                <th>Title</th>
                                <th>Fees</th>
                                <th>Claim Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="studentadmission">

                        </tbody>
                    </table>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#example').DataTable();
        });

        $(document).on('click','.viewhistory',function (e) {
            let admission_id = $(this).data('admission_id');
            $.ajax({
                type: 'get',
                url: '{{route('admission.getcommissiondetail')}}',
                data: {
                    admission_id: admission_id,
                },
                success:function(response){
                if(typeof(response) != 'object'){
                    response = JSON.parse(response)
                }
                var tbody_html = "";
                if(response.status){
                    $.each(response.data, function(key, commission_detail){
                        key = key+1;
                        tbody_html += "<tr>";
                        tbody_html += "<td>"+key+"</td>";
                        tbody_html += "<td>"+commission_detail.title+"</td>";
                        tbody_html += "<td>"+commission_detail.fees+"</td>";
                        tbody_html += "<td>"+commission_detail.claim_date+"</td>";
                        if(commission_detail.commissions_status == "pending") {
                            tbody_html += "<td><span class='badge badge-danger p-2'>Pending</span></td>";
                        } else {
                            tbody_html += "<td><span class='badge badge-success p-2'>Paid</span></td>";
                        }
                        tbody_html += "</tr>";
                    });
                    $('#studentadmission').html(tbody_html);
                    $('.bs-example-modal-center').modal('show');
                }
            }

            })
        });


    </script>


@endsection


