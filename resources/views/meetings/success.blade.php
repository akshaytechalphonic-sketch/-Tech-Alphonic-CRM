
@extends('office.partical.main')

@section('content')
<div class="container mt-4">
    <div class="alert alert-success shadow">
        <h5>✅ Meeting Scheduled Successfully</h5>
        <p><strong>Google Meet Link:</strong></p>
        <a href="{{ $meeting->meet_link }}" target="_blank" class="btn btn-success">
            Join Google Meet
        </a>
    </div>
</div>
@endsection
