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

    </script>
@endsection
