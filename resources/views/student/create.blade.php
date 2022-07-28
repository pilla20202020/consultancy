@extends('layouts.admin.admin')

@section('title', 'Create a Student')

@section('content')
    <section>
        <div class="section-body">
            <form id="form-vertical" class="form-horizontal form-wizard-wrapper" action="{{route('student.store')}}" method="POST" enctype="multipart/form-data">
            @include('student.partials.form',['header' => 'Create a Student'])
            </form>
        </div>
    </section>
@endsection

