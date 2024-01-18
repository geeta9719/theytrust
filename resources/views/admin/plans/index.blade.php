{{-- @extends('layouts.admin-master')

@section('content')
    <div class="container">
        <h1 class="my-4">Plans</h1>
        
        <a href="{{ route('plans.create') }}" class="btn btn-primary mb-3">Create Plan</a>

        @forelse ($plans as $plan)
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title">{{ $plan->name }}</h3>
                    <p class="card-text"><strong>Price:</strong> ${{ $plan->price }}</p>
                    <p class="card-text"><strong>Description:</strong> {{ $plan->description }}</p>

                    <a href="{{ route('plans.edit', $plan->id) }}" class="btn btn-info">Edit</a>
                    
                    <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this plan?')">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p>No plans found.</p>
        @endforelse
    </div>
@endsection --}}

@extends('layouts.admin-master')

@section('content')
    <div class="container">
        <h1 class="my-4">Plans</h1>
        
        <a href="{{ route('plans.create') }}" class="btn btn-primary mb-3">Create Plan</a>

        @if(count($plans) > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{{ $plan->name }}</td>
                            <td>${{ $plan->price }}</td>
                            <td>{{ $plan->description }}</td>
                            <td>
                                <a href="{{ route('plans.edit', $plan->id) }}" class="btn btn-info">Edit</a>
                                
                                <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this plan?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No plans found.</p>
        @endif
    </div>
@endsection

