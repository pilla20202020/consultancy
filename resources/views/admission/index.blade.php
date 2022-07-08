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


