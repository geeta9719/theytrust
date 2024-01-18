<!-- resources/views/plans/edit.blade.php -->

@extends('layouts.admin-master')
    @section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Edit Plan</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.update', $plan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" value="{{ $plan->name }}" required>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" name="price" class="form-control" value="{{ $plan->price }}" required>
                </div>

                
                <div class="form-group">
                    <label for="duration">Duration:</label>
                    <select name="duration" class="form-control" required>
                        <option value="30">30 Days</option>
                        <option value="60">60 Days</option>
                        <option value="90">90 Days</option>
                        
                        <option value="365"> 365 Days</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

                <!-- Currency dropdown -->
                <div class="form-group">
                    <label for="currency">Currency:</label>
                    <select name="currency" class="form-control" required>
                        <option value="EUR" {{ $plan->currency === 'EUR' ? 'selected' : '' }}>Euro (EUR)</option>
                        <option value="USD" {{ $plan->currency === 'USD' ? 'selected' : '' }}>United States Dollar (USD)</option>
                        <option value="INR">{{ $plan->currency === 'INR' ? 'selected' : '' }}Indian Rupee (INR)</option>
                        <!-- Add more currency options as needed -->
                    </select>
                </div>

            

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control" rows="4">{{ $plan->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Update Plan</button>
            </form>
        </div>
    </div>
</div>
@endsection
