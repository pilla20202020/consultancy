@extends('layouts.admin.admin')
@section('title', 'Add Commission')

@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection

@section('content')


    <div class="row">
        <div class="col-md-12 col-lg-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add Commission Rate of {{$admission->student->name}}<span class="text-danger">
                            </span></h5>
                    <div class="row mt-5">
                        <div class="col-sm-3 form-group">
                            <label for="name" class="pt-0">Student Name: </label>
                            <span> {{$admission->student->name}}</span>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="name" class="pt-0">Student Contact Number: </label>
                            <span> {{$admission->student->phone}}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label for="name" class="pt-0">College/Uni: </label>
                            <span> {{ $admission->college }}</span>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="name" class="pt-0">Admission Date: </label>
                            <span> {{ $admission->admission_date }}</span>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="name" class="pt-0">Overall Fees: </label>
                            <span> {{ $admission->fees }}</span>
                        </div>

                        {{-- <div class="col-sm-3 form-group">
                            <label for="name" class="pt-0">Created by: </label>
                            <span>{{ $admission->createdBy->name }}</span>
                        </div> --}}
                    </div>
                    <hr>
                    <h5 class="card-title">Add Commission Rate </h5>
                    <form action="{{route('admission.store_commission')}}" method="post">
                        @csrf
                        <input type="hidden" name="admission_id" value="{{$admission->admissions_id}}">
                        <input type="hidden" name="student_id" value="{{$admission->student_id}}">
                        <div id="additernary_edu">
                            @if(isset($admission->commissions) && $admission->commissions->isEmpty() == false)
                                @foreach ($admission->commissions as $commission)
                                    <div class="form-group row d-flex align-items-end">.
                                        <div class="col-sm-2">
                                            <label class="control-label">Title</label>
                                            <input type="text" name="title[]" class="form-control" value="{{$commission->title}}" readonly>
                                        </div>

                                        <div class="col-sm-2">
                                            <label class="control-label">Fees</label>
                                            <input type="number" name="fees[]" class="form-control" value="{{$commission->fees}}" readonly>
                                        </div>

                                        <div class="col-sm-2">
                                            <label class="control-label">Date</label>
                                            <input type="date" name="claim_date[]" class="form-control" value="{{$commission->claim_date}}" readonly>
                                        </div>

                                        {{-- <div class="col-sm-2">
                                            <label class="control-label">Status</label>
                                            <div class="">
                                                <select data-placeholder="Select Status"
                                                    class="select2 tail-select form-control " id=""
                                                    name="status" required>
                                                    <option value="" selected disabled >Select Status</option>
                                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }} @if(isset($commission) && $commission->status == "pending" ) selected @endif>Pending</option>
                                                    <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }} @if(isset($commission) && $commission->status == "paid" ) selected @endif>Paid</option>

                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-2" style="margin-top: 45px;">
                                            <a href="#" class="btn btn-sm btn-danger mr-1" type="submit" value="">Change Status</a>
                                        </div> --}}

                                        <div class="col-md-3" style="margin-top: 45px;">
                                            <a href="{{route('admission.delete_commission',$commission->commissions_id)}}" class="btn btn-sm btn-danger mr-1 p-2" type="submit" value=""><i class="far fa-trash-alt"></i> Remove Commission</a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="form-group row d-flex align-items-end">.
                                <div class="col-sm-2">
                                    <label class="control-label">Title</label>
                                    <input type="text" name="title[]" class="form-control" required>
                                </div>

                                <div class="col-sm-2">
                                    <label class="control-label">Fees</label>
                                    <input type="number" name="fees[]" class="form-control" required>
                                </div>


                                <div class="col-sm-3">
                                    <label class="control-label">Claim Date</label>
                                    <input type="date" name="claim_date[]" min="{{date('Y-m-d')}}" class="form-control" required>
                                </div>

                                <div class="col-md-1" style="margin-top: 45px;">
                                    <input id="additemrowedu" type="button" class="btn btn-sm btn-primary mr-1"
                                        value="Add Row">
                                </div>

                            </div>
                            <input type="hidden" id="tempedu" value="0" name="temp">
                        </div>
                        <hr>

                        <div class="row mt-2 justify-content-center">
                            <div class="form-group">
                                <div>
                                    <a class="btn btn-light waves-effect ml-1" href="{{ route('admission.index') }}">
                                        <i class="md md-arrow-back"></i>
                                        Back
                                    </a>
                                    <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light" value="Save">
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '#additemrowedu', function() {
            var b = parseFloat($("#tempedu").val());
            b = b + 1;
            $("#tempedu").val(b);
            var temp = $("#tempedu").val();
            var tst = `<div class="form-group row d-flex align-items-end appended-row-edu">

                <div class="col-sm-2">
                    <label class="control-label">Title</label>
                    <input type="text" name="title[]" class="form-control" required>
                </div>
                <div class="col-sm-2">
                    <label class="control-label">Fees</label>
                    <input type="number" name="fees[]" class="form-control" required>
                </div>

                <div class="col-sm-3">
                    <label class="control-label">Claim Date</label>
                    <input type="date" name="claim_date[]" class="form-control" required>
                </div>


                <div class="col-md-1" style="margin-top: 45px;">
                    <input class="removeitemrowedu btn btn-sm btn-danger mr-1" type="button" value="Remove row">
                </div>

            </div>`
            $('#additernary_edu').append(tst);
            selectRefresh();
        });

        $(document).on('click', '.removeitemrowedu', function() {
            $(this).closest('.appended-row-edu').remove();
        })

        function remove_product(o) {
            var p = o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }

        function remove_productforedit(o) {
            var p = o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }
    </script>
@endsection
