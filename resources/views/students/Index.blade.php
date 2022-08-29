@extends('students.layout')

@section('content')
<div class="m-2">
    <div class="pull-left">
        <img src="/uploads/pictures/Deerwalk_College_Logo.png" width="200px" alt="Logo">
        <h4>Deerwalk Student Profile Management System</h4>
    </div>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('students.create') }}">Create New Student</a>
            </div>
        </div>
    </div>
    <br>
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p>{{ $message }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No.</th>
            <th>Full Name</th>
            <th>Class</th>
            <th>Course</th>
            <th>Email</th>
            <th>Address</th>
            <th>Image</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($students as $student)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $student->fullname }}</td>
            <td>{{ $student->class }}</td>
            <td>{{ $student->course }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->address }}</td>
            <td>
                <img src="{{ asset('uploads/students/'.$student->image) }}" width="70px" height="70px" alt="Student Image">
            </td>
            <td>
                <form action="{{ route('students.destroy',$student->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>