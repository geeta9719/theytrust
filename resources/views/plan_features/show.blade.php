@extends('layouts.admin-master')
@section('content')
    <h1>Plan Feature Details</h1>
    <ul>
        <li><strong>Name:</strong> {{ $planFeature->name }}</li>
        <li><strong>Description:</strong> {{ $planFeature->description }}</li>
    </ul>
    <a href="{{ route('planfeatures.edit', $planFeature->id) }}" class="btn btn-primary">Edit</a>
@endsection
