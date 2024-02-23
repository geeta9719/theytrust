
@extends('layouts.app')

@section('content')
    <h1>Edit Plan Subscription</h1>
    <form action="{{ route('plansubscriptions.update', $planSubscription->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="user_id">Username:</label>
        <input type="text" name="user_id" value="{{ $planSubscription->user->name }}">
        <label for="plan_id">Plan ID:</label>
        <input type="text" name="plan_id" value="{{ $planSubscription->plan_id }}">
        <label for="starts_on">Start Date:</label>
        <input type="date" name="starts_on" value="{{ $planSubscription->starts_on }}">
        <label for="expires_on">Expire On:</label>
        <input type="date" name="expires_on" value="{{ $planSubscription->expires_on }}">
        <button type="submit">Update</button>
    </form>
@endsection
