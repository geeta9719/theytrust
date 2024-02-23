
@extends('layouts.admin-master')
@section('content')
    <h1>Plan Subscriptions</h1>

    <table class="table table-bordered table-sm small-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Plan ID</th>
                <th>Username</th>
                <th>Starts On</th>
                <th>Expires On</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($planSubscriptions as $planSubscription)
            <tr>
                <td>{{ $planSubscription->id }}</td>
                <td>{{ $planSubscription['plan']->name ?? "No Plan" }}</td>
                <td>{{ $planSubscription['model']->name ?? 'No User' }}</td>
                <td>{{ $planSubscription->starts_on }}</td>
                <td>{{ $planSubscription->expires_on }}</td>
                <td>{{ $planSubscription->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
