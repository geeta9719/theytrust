{{-- @extends('layouts.admin-master')

@section('content')
    <div class="container">
        <h1 class="my-4">PlansFeatures</h1>
       
    <a href="{{ route('planfeatures.create') }}" class="btn btn-primary mb-3">Create PlanFeature</a>
 
       
        @if(count($planFeatures) > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Limit</th>
                        <th>Type</th>
                        <th>Plan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                    @foreach ($planFeatures as $planFeature)
                    <tr>
                        <td>{{ $planFeature->name }}</td>
                        <td>{{ $planFeature->code }}</td>
                        <td>{{ $planFeature->description }}</td>
                        <td>{{ $planFeature->limit }}</td>
                        <td>{{ $planFeature->type }}</td>
                        <td>{{ $planFeature->plan->name }}</td>
                        <td>
                            <!-- Edit button, links to the edit route -->
                         <a href="{{ route('planfeatures.edit', $planFeature->id) }}" class="btn btn-primary">Edit</a>

        <form action="{{ route('planfeatures.destroy', $planFeature->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this plan feature?')">Delete</button>
        </form>   
                        
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7"><hr></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No PlanFeaturefound.</p>
        @endif
    </div>
@endsection --}}

@extends('layouts.admin-master')

@section('content')
    <div class="container">
        <h1 class="my-4">Plans Features</h1>
       
        <a href="{{ route('planfeatures.create') }}" class="btn btn-primary mb-3">Create Plan Feature</a>
 
       
        @if(count($planFeatures) > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead >
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Limit</th>
                            <th>Type</th>
                            <th>Plan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($planFeatures as $planFeature)
                            <tr>
                                <td>{{ $planFeature->name }}</td>
                                <td>{{ $planFeature->code }}</td>
                                <td>{{ $planFeature->description }}</td>
                                <td>{{ $planFeature->limit }}</td>
                                <td>{{ $planFeature->type }}</td>
                                <td>{{ $planFeature->plan->name }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('planfeatures.edit', $planFeature->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('planfeatures.destroy', $planFeature->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this plan feature?')">Delete</button>
                                        </form>   
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No Plan Features found.</p>
        @endif
    </div>
@endsection





