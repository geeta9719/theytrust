@extends('layouts.admin-master')
@section('content')
    <div class="container">
        <h1>Create Plan Feature</h1>

        <form action="{{ route('planfeatures.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name">Description:</label>
                <input type="text" name="description" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="plan_id">Plan:</label>
                <select name="plan_id" class="form-control" required>
                    @foreach ($plans as $plan)
                        <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Create Plan Feature</button>
        </form>
    </div>
@endsection



