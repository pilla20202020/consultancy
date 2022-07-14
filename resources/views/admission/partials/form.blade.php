@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862')}}"/>
@endsection
@csrf
<div class="row">
    <div class="col-sm-9">
        <div class="card">
            <div class="card-underline">
                <div class="card-head">
                    <header class="ml-3 mt-2">{!! $header !!}</header>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="province" class="col-form-label pt-0">Select Students <span class="text-danger">*</span></label>
                                <div class="">
                                    <select data-placeholder="Select Students"
                                        class="select2 tail-select form-control " id=""
                                        name="student_id" required>
                                        <option value="" selected disabled >Select Students</option>
                                        @foreach ($students as $student)
                                            @if(empty($student->admission))
                                            <option value="{{ $student->students_id }}" @if(old('student_id') == $student->students_id) selected @endif @if(isset($admission) && ($admission->student_id == $student->students_id)) selected @endif>{{ ucfirst($student->name) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('student_id')
                                        <span class="text-danger">{{ $errors->first('student_id') }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="province" class="col-form-label pt-0">Select College <span class="text-danger">*</span></label>
                                <div class="">
                                    <select data-placeholder="Select College"
                                        class="select2 tail-select form-control " id=""
                                        name="college" required>
                                        <option value="" selected disabled >Select College</option>
                                        <option value="ABC" {{ old('college') == 'ABC' ? 'selected' : '' }} @if(isset($admission) && $admission->college == "ABC" ) selected @endif>ABC</option>
                                        <option value="XYZ" {{ old('college') == 'XYZ' ? 'selected' : '' }} @if(isset($admission) && $admission->college == "XYZ" ) selected @endif>XYZ</option>

                                    </select>
                                    @error('college')
                                        <span class="text-danger">{{ $errors->first('college') }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="fees" class="col-form-label pt-0">Fees</label>
                                <div class="">
                                    <input class="form-control" type="number" name="fees" data-role="tagsinput"
                                    value="{{ old('fees', isset($admission->fees) ? $admission->fees : '') }}" placeholder="Enter a Fees">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="admission_date" class="col-form-label pt-0">Admission Date</label>
                                <div class="">
                                    <input class="form-control" type="date" name="admission_date" data-role="tagsinput"
                                    value="{{ old('admission_date', isset($admission->admission_date) ? $admission->admission_date : '') }}" placeholder="Enter a Admission Date">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row mt-2 justify-content-center">
                        <div class="form-group">
                            <div>
                                <a class="btn btn-light waves-effect ml-1" href="{{ route('admission.index') }}">
                                    <i class="md md-arrow-back"></i>
                                    Back
                                </a>
                                <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light" value="Submit">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>


@section('page-specific-scripts')
    <script src="{{asset('resources/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/dropify.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
        });

        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
