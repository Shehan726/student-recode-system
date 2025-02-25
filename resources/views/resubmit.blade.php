@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h2>Your application was rejected.</h2>
        <p>Please update your details and resubmit.</p>
        <a href="{{ route('students.resubmit') }}" class="btn btn-primary">Edit & Resubmit</a>
    </div>
@endsection
