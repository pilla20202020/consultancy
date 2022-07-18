@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}"/>
@endsection

@section('title', 'Claim Commission List')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">Claim Commission List</header>
            </div>
            <div class="card mt-2 p-4">
                <div class="table-responsive">
                    <table id="example" class="table table-hover display">
                        <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Student</th>
                            <th>College</th>
                            <th>Commission Date</th>
                            <th>Program</th>
                            <th>Commission Price</th>
                            <th>Recently Claim Date</th>
                            <th>Commission Status</th>
                            <th>Add Follow Up</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($commissions as $key => $commission)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{ Str::limit($commission->student->name, 47) }}</td>
                                <td>{{ Str::limit($commission->admission->college, 47) }}</td>
                                <td>{{ $commission->claim_date }}</td>
                                <td>{{ Str::limit($commission->student->program, 47) }}</td>
                                <td>{{ $commission->fees }}</td>
                                <td>
                                    @if(isset($commission->claimCommission))
                                        {{$commission->claimCommission->commission_claim_date }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($commission->claimCommission))

                                        @if($commission->claimCommission->commissions_claim_status == "pending")
                                            <span class='badge badge-warning p-1'>{{ucfirst($commission->claimCommission->commissions_claim_status)}}</span>
                                            <button data-commission_id="{{$commission->commissions_id}}"  class="btn btn-warning btn-sm changestatus mt-1" title="Claim Commission">
                                                Claim Commission
                                            </button>
                                            <input type="hidden" class="upcoming_commission_date" value="{{$commission->claim_date}}">
                                            <input type="hidden" class="upcoming_commission_title" value="{{$commission->title}}">
                                        @else
                                            <span class='badge badge-danger p-1'>{{ucfirst($commission->claimCommission->commissions_claim_status)}}</span>
                                            <button data-commission_id="{{$commission->commissions_id}}"  class="btn btn-warning btn-sm changestatus mt-1" title="Claim Commission">
                                                Claim Commission
                                            </button>
                                            <input type="hidden" class="upcoming_commission_date" value="{{$commission->claim_date}}">
                                            <input type="hidden" class="upcoming_commission_title" value="{{$commission->title}}">
                                        @endif
                                    @else
                                        <span class='badge badge-warning p-1'>Pending</span>
                                        <button data-commission_id="{{$commission->commissions_id}}"  class="btn btn-warning btn-sm changestatus mt-1" title="Claim Commission">
                                            Claim Commission
                                        </button>
                                        <input type="hidden" class="upcoming_commission_date" value="{{$commission->claim_date}}">
                                        <input type="hidden" class="upcoming_commission_title" value="{{$commission->title}}">
                                    @endif
                                </td>

                                <td>
                                    @if(isset($commission->claimCommission))
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
            </div>
        </div>
    </div>

    {{-- Change Commission Status Modal --}}
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Claim Commission</h5>
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
                                <label class="control-label">Upcoming Pending Commission: <span class="modal_upcoming_title"></span> (<span class="modal_upcoming_date"></span>)</label>
                            </div>
                        </div>
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
            $('#example').DataTable();
        });

        $(document).on('click','.changestatus',function (e) {
            var commission_id = $(this).data('commission_id');
            var upcoming_commission_date = $(this).next('.upcoming_commission_date').val();
            var upcoming_commission_title = $(this).next().next('.upcoming_commission_title').val();
            $(".modal_upcoming_date").text(upcoming_commission_date);
            $(".modal_upcoming_title").text(upcoming_commission_title);
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


