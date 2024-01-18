<!-- resources/views/plans/create.blade.php -->

@extends('layouts.admin-master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>Create Plan</h1>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('plans.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" name="price" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="description">Link:</label>
                                <input name="stripe_link" class="form-control">
                            </div>

                            <!-- Metadata input -->
                            <div class="form-group">
                                <label for="metadata">Metadata (Key-Value Pairs):</label>
                                <div id="metadataFields">
                                    <div class="metadata-field">
                                        <input type="text" name="metadata[key][]" placeholder="Key" class="form-control" required>
                                        <input type="text" name="metadata[value][]" placeholder="Value" class="form-control" required>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success" onclick="addMetadataField()">Add Metadata Field</button>
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
                                    <option value="EUR">Euro (EUR)</option>
                                    <option value="USD">United States Dollar (USD)</option>
                                    <option value="INR">Indian Rupee (INR)</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Create Plan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addMetadataField() {
            var metadataFields = document.getElementById('metadataFields');
            var newMetadataField = document.createElement('div');
            newMetadataField.className = 'metadata-field';
            newMetadataField.innerHTML = `
                <input type="text" name="metadata[key][]" placeholder="Key" class="form-control" required>
                <input type="text" name="metadata[value][]" placeholder="Value" class="form-control" required>
            `;
            metadataFields.appendChild(newMetadataField);
        }
    </script>
@endsection
