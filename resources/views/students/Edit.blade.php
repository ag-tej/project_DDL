@extends('students.layout')
@section('content')
<div class="m-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Student Data</h2>
            </div>

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('students.index') }}">Back</a>
            </div>
        </div>
    </div>
    <br>
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('students.update',$student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Full Name</strong>
                    <input type="text" name="fullname" value="{{ $student->fullname }}" class="form-control" placeholder="John Smith">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Class</strong>
                    <input type="text" name="class" value="{{ $student->class }}" class="form-control" placeholder="Class of 2025">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Course</strong>
                    <input type="text" name="course" value="{{ $student->course }}" class="form-control" placeholder="CSIT">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email</strong>
                    <input type="text" name="email" value="{{ $student->email }}" class="form-control" placeholder="john.smith@deerwalk.edu.np">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Address</strong>
                    <input type="text" name="address" value="{{ $student->address }}" class="form-control" placeholder="Sifal, Kathmandu">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image</strong>
                    <input type="file" name="image" class="form-control">
                    <img src="{{ asset('uploads/students/'.$student->image) }}" width="70px" height="70px" alt="Student Image">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>

    </form>
</div>
@endsection