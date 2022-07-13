@extends('layouts.admin.admin')
@section('title', 'Bibhuti Solution ')


@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}"/>
@endsection

@section('content')
            <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bibhuti Solution </a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-1">All Summary</h4>
                                <div class="row p-3">
                                    <div class="col-md-3 p-2" style="border-left: 4px solid #44a2d2;">
                                        <span class="pl-2">{{$users_count}}</span>
                                        <h6 class="pl-2 pt-1">Total Users</h6>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-xl-12 p-0">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Upcoming Commission Pending Lists</h5>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-hover display">
                                                <thead>
                                                    <tr>
                                                        <th>Student Name</th>
                                                        <th>College</th>
                                                        <th>Admission Date</th>
                                                        <th>Upcoming Commission </th>
                                                        <th>Commission Claim Date</th>
                                                        <th>Claim Commission </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($commissions as $commission)
                                                        <tr>
                                                            <td>{{$commission->student->name}}</td>
                                                            <td>{{$commission->admission->college}}</td>
                                                            <td>{{$commission->admission->admission_date}}</td>
                                                            <td>{{$commission->title}}</td>
                                                            <td>{{$commission->claim_date}}</td>
                                                            <td>
                                                                @if(empty($commission->claimCommission))
                                                                    <a href="javascript: void(0);" data-commission_id="{{$commission->commissions_id}}" data-commission_status="{{$commission->commissions_status}}"  class="btn btn-warning btn-sm mr-1 p-1 changestatus" title="Claim Commission">
                                                                        Claim Commission
                                                                    </a>
                                                                @elseif($commission->claimCommission->commissions_claim_status == "paid")
                                                                    <span class='badge badge-success p-1'>{{ucfirst($commission->claimCommission->commissions_claim_status)}}</span>
                                                                @elseif($commission->claimCommission->commissions_claim_status == "pending")
                                                                    <span class='badge badge-warning p-1'>{{ucfirst($commission->claimCommission->commissions_claim_status)}}</span>
                                                                    <a href="javascript: void(0);" data-commission_id="{{$commission->claimCommission->claim_commissions_id}}"  class="btn btn-secondary btn-sm mr-1 p-1 ml-2 addfollowup" title="Add Follow Up">
                                                                        Add Follow Up
                                                                    </a>
                                                                @else
                                                                    <span class='badge badge-danger p-1'>{{ucfirst($commission->claimCommission->commissions_claim_status)}}</span>
                                                                    <a href="javascript: void(0);" data-commission_id="{{$commission->claimCommission->claim_commissions_id}}"  class="btn btn-secondary btn-sm mr-1 p-1 ml-2 addfollowup" title="Add Follow Up">
                                                                        Add Follow Up
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--end table-responsive-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                </div>



        <!-- End Page-content -->
    </div>

    {{-- Change Status Modal --}}
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Change Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admission.addcommissionclaim')}}" method="POST" class="form form-validate floating-label">
                        @csrf
                        <input type="hidden" class="change_status_commission" value="" name="commission_id" id="">
                        <div class="row justify-content-center">
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Client Name</label>
                                <input type="text" name="client_name" class="form-control" required>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Commission Claim Date</label>
                                <input type="date" name="commission_claim_date" class="form-control" required>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Remarks</label>
                                <textarea name="claim_remarks" class="form-control" required></textarea>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Status</label>
                                <div class="">
                                    <select data-placeholder="Select Status"
                                        class="select2 tail-select form-control " id="mydropdownlist"
                                        name="commissions_claim_status" required>
                                        <option value="" selected disabled >Select Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="paid" >Paid</option>
                                        <option value="defer" >Defer</option>

                                    </select>

                                </div>
                            </div>

                            <div class="col-md-12 mt-2 deferdate d-none">
                                <label class="control-label">Defer Commission Date</label>
                                <input type="date" name="defer_date" class="form-control defer_date" value="">
                            </div>
                        </div>

                        <hr>
                        <div class="row mt-2 justify-content-center">
                            <div class="form-group">
                                <div>
                                    <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light" value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
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
            $('#example').DataTable({
                order: [[4, 'asc'] ]
            });
        });

        $(document).on('click','.changestatus',function (e) {
            let commission_id = $(this).data('commission_id');
            $(".change_status_commission").val(commission_id);
            $('.bs-example-modal-center').modal('show');

        });

        $(document).on('change','#mydropdownlist',function (e) {
            if($(this).val() == "defer") {
                $('.deferdate').removeClass('d-none');
                $(".deferdate").show().find("input").prop("required", true);
            } else {
                $('.deferdate').addClass('d-none');
                $(".deferdate").show().find("input").prop("required", false);
                $('.defer_date').val(null);
            }
        })
    </script>
@endsection
