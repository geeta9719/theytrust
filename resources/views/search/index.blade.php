@extends('layouts.admin-master')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-4">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sheet Upload Section</h3>
                        </div>

                        <div class="card-body">
                            <div class="mb-3">
                                <label for="file" class="form-label">Upload Sheet:</label>
                                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file" class="form-control" id="file" required>
                                    <button type="submit" class="btn btn-info" >Upload</button>
                                </form>
                            </div>

                            <hr>

                            <div>
                                <p>
                                    <strong>Sample Google Sheets Document:</strong>
                                    <a href="https://docs.google.com/spreadsheets/d/1E4TNq9Sr7nUdoQ0hZjPszpK24-0UClI2qtoxkocU3S4/edit#gid=0" target="_blank">
                                        View Sample
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <x-seo-table :seo="$seo" />

                </div>
            </div>
        </div>
    </section>
@endsection
