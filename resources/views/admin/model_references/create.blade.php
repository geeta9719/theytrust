@extends('layouts.admin-master')

@section('content')
<div class="container mx-auto mt-5">
    <h2 class="text-2xl mb-4">Create Model Reference</h2>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('model-references.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="model_id" class="block text-gray-700">Select Category, Subcategory, or Skill:</label>
            <select id="model_id" name="model_id" class="block mt-1 w-full select2">
                <option value="">Select Option</option>
                @foreach($categories as $category)
                    <option value="category-{{ $category->id }}">Category: {{ $category->category }}</option>
                @endforeach
                @foreach($subcategories as $subcategory)
                    <option value="subcategory-{{ $subcategory->id }}">Subcategory: {{ $subcategory->subcategory }}</option>
                @endforeach
                @foreach($skills as $skill)
                    <option value="skill-{{ $skill->id }}">Skill: {{ $skill->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="company_id" class="block text-gray-700">Select Company:</label>
            <select id="company_id" name="company_id" class="block mt-1 w-full select2">
                <option value="">Select Company</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        </div>
    </form>

    <h2 class="text-2xl mt-8 mb-4">Existing  References</h2>
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Model Name</th>
                {{-- <th class="py-2 px-4 border-b">Foreign Key ID</th> --}}
                <th class="py-2 px-4 border-b">Foreign Key Name</th>
                <th class="py-2 px-4 border-b">Company</th>
            </tr>
        </thead>
        <tbody>
            @foreach($modelReferences as $reference)
                <tr>
                    <td class="py-2 px-4 border-b">{{ ucfirst($reference->model_name) }}</td>
                    <td class="py-2 px-4 border-b">{{ $reference->foreign_key_name }}</td>
                    <td class="py-2 px-4 border-b">{{ $reference->company->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Include jQuery before Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
