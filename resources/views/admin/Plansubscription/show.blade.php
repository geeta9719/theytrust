@extends('layouts.app')

@section('content')
    <h1>Plan Subscription Details</h1>
    <ul>
        <li>Username: {{ $planSubscription->user->name }}</li>
        <li>Plan ID: {{ $planSubscription->plan_id }}</li>
        <li>Start Date: {{ $planSubscription->starts_on }}</li>
        <li>Expire On: {{ $planSubscription->expires_on }}</li>
        <li>Created At: {{ $planSubscription->created_at }}</li>
    </ul>
    <a href="{{ route('plansubscription.index') }}">Back</a>
@endsection
