@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}"/>
@endsection

@section('title', 'Claimed Commission List')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">Claimed Commission List</header>
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
                            <th>Commission Claim Date</th>
                            <th>Status</th>
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
                                        {{ $commission->claimCommission->commission_claim_date }}
                                    @endif
                                </td>
                                <td>
                                    <span class='badge badge-success p-1'>Paid</span>
                                </td>


                            </tr>
                            @endforeach
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
                        <tbody id="studentcommissionclaim">

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




    </script>


@endsection


