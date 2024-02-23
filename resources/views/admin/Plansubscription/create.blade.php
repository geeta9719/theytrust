
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Plan Subscription</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('plansubscription.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="plan_id">Plan ID</label>
                                <input type="text" id="plan_id" name="plan_id" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="expireon">Expire On</label>
                                <input type="date" id="expireon" name="expireon" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="startdate">Start Date</label>
                                <input type="date" id="startdate" name="startdate" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Plan Subscription</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

