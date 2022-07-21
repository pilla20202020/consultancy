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
                        <div class="col-sm-12">
                            {{-- <div class="form-group">
                                <input type="text" name="name" class="form-control" required
                                       value="{{ old('name', isset($student->name) ? $student->name : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('name') }}</span>
                                <label for="Name">Name</label>
                            </div> --}}

                            <div class="form-group ">
                                <label for="name" class="col-form-label pt-0">Name</label>
                                <div class="">
                                    <input class="form-control" type="text" required name="name" value="{{ old('name', isset($student->name) ? $student->name : '') }}" placeholder="Enter Your Name">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="specialization" class="col-form-label pt-0">Email</label>
                                <div class="">
                                    <input class="form-control" type="email" name="email" data-role="tagsinput"
                                    value="{{ old('email', isset($student->email) ? $student->email : '') }}" placeholder="Enter a email" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="phone" class="col-form-label pt-0">Phone Number</label>
                                <div class="">
                                    <input class="form-control" type="number" name="phone" data-role="tagsinput"
                                    value="{{ old('phone', isset($student->phone) ? $student->phone : '') }}" placeholder="Enter a Phone" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label for="program" class="col-form-label pt-0">Prefered Field</label>
                                <div class="">
                                    <input class="form-control" type="text" name="program" data-role="tagsinput"
                                    value="{{ old('program', isset($student->program) ? $student->program : '') }}" placeholder="Enter a Prefered Program" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label for="program" class="col-form-label pt-0">Prefered Intake(Year)</label>
                                <div class="">
                                    <select data-placeholder="Select Year"
                                        class="select2 tail-select form-control " id=""
                                        name="intake_year" required>
                                        <option value="" selected disabled >Select Intake Year</option>
                                        <option value="2022" {{ old('intake_year') == '2022' ? 'selected' : '' }} @if(isset($student) && $student->intake_year == "2022" ) selected @endif>2022</option>
                                        <option value="2023" {{ old('intake_year') == '2023' ? 'selected' : '' }} @if(isset($student) && $student->intake_year == "2023" ) selected @endif>2023</option>

                                    </select>
                                    @error('intake_year')
                                        <span class="text-danger">{{ $errors->first('intake_year') }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label for="program" class="col-form-label pt-0">Prefered Intake(Month)</label>
                                <div class="">
                                    <select data-placeholder="Select Intake Month"
                                        class="select2 tail-select form-control " id=""
                                        name="intake_month" required>
                                        <option value="" selected disabled >Select Intake Month</option>
                                        <option value="february" {{ old('intake_month') == 'february' ? 'selected' : '' }} @if(isset($student) && $student->intake_month == "february" ) selected @endif>February</option>
                                        <option value="august" {{ old('intake_month') == 'august' ? 'selected' : '' }} @if(isset($student) && $student->intake_month == "august" ) selected @endif>August</option>
                                        <option value="september" {{ old('intake_month') == 'september' ? 'selected' : '' }} @if(isset($student) && $student->intake_month == "september" ) selected @endif>September</option>

                                    </select>
                                    @error('intake_month')
                                        <span class="text-danger">{{ $errors->first('intake_month') }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row mt-2 justify-content-center">
                        <div class="form-group">
                            <div>
                                <a class="btn btn-light waves-effect ml-1" href="{{ route('student.index') }}">
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
    </script>
@endsection
