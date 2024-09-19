@extends('layouts.home-master')

@section('content')

<div class="container request-sec">
    <div class="row ">
    <h3>Request a Review</h3>
</div>
</div>


<div class="container-fluid request-sec">
   <div class="container-fluid m-0 p-0"> 
    <div class="row ">
    
        <div class="col-md-6 mx-auto">
           
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <div class="form-row row">
                        <div class="form-group col-md-6 mx-0 mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" placeholder="Enter Name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 mx-0 mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email"  placeholder="Enter Email Id" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-12 mx-0">
                            <label for="note">Personalized Note</label>
                            <textarea name="note"  placeholder="Enter Note" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
                            @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                        <button type="submit" class="btn btn-primary submit">Submit Request</button>
                    </form>
                </div>
            </div>
        </div>
     </div>
    </div>
</div>




<div class="container request-sec">
    <div class="row ">
    <h3 class="ml-md-3 ml-0">Reviews Request History</h3>
</div>
</div>

<div class="container request-sec request-history">
    <div class="row ">
    
       
        <div class="col-md-12 ">
            <!-- <h3>Reviews Request History</h3> -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr class="heading">
                                <th class="text-center">Check</th>
                                <th>S. No.</th>
                                <th>Date Requested</th>
                                <th >Client Name</th>
                                <th class="text-center">Resend Request</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td  class="text-center"><input type="checkbox"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $review->created_at->format('M d, Y') }}</td>
                                    <td >{{ $review->name }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('reviews.resend', $review->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-link">
                                                <i class="fa fa-paper-plane"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>









@endsection
