@extends('layouts.admin.admin')

@section('title', 'Create a Student')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('student.store')}}" method="POST" enctype="multipart/form-data" novalidate>
            @include('student.partials.form',['header' => 'Create a Student'])
            </form>
        </div>
    </section>
@endsection

