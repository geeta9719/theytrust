@extends('layouts.home-master')

@section('content')

<style>
    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: flex-start;
        max-width: 1200px;
        margin: auto;
        padding: 20px;
        gap: 20px;
    }
    form {
        flex: 1 1 600px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #f9f9f9;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }
    input[type="text"],
    input[type="url"],
    input[type="file"],
    input[type="date"],
    select,
    textarea {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    .char-count {
        font-size: 12px;
        color: #999;
        margin-bottom: 20px;
        display: block;
        text-align: right;
    }
    .error-message {
        color: red;
        font-size: 12px;
        margin-top: -5px;
        margin-bottom: 10px;
    }
    button {
        display: inline-block;
        width: 100%;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        outline: none;
        color: #fff;
        background-color: #007BFF;
        border: none;
        border-radius: 5px;
        box-shadow: 0 4px #999;
        transition: background-color 0.3s;
    }
    button:hover {
        background-color: #0056b3;
    }
    button:active {
        background-color: #0056b3;
        box-shadow: 0 2px #666;
        transform: translateY(2px);
    }
    #preview {
        flex: 1 1 600px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #f9f9f9;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    #preview img, 
    #preview iframe, 
    #preview object, 
    #preview video {
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-top: 10px;
    }
</style>

<h1 style="text-align: center;">Add Portfolio Item</h1>
<div class="row pt-5">
    <div class="col-md-12 m-0 p-0 ">
        @if ($errors->any())
        <div class="alert alert-danger">
            {!! implode('', $errors->all('<div>:message</div>')) !!}
        </div>
    @endif
    
    @if (session()->has('newsuccess'))
        <div class="alert alert-success">
            {{ session()->get('newsuccess') }}
        </div>
    @endif
    </div>
</div>
<div class="container">
  
    <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
   
        <label for="media_type">Select Media Type</label>
        <select name="media_type" id="media_type" onchange="toggleMediaInput()">
            <option value="image_pdf" {{ old('media_type') == 'image_pdf' ? 'selected' : '' }}>Image or PDF File</option>
            <option value="youtube_url" {{ old('media_type') == 'youtube_url' ? 'selected' : '' }}>YouTube Video URL</option>
        </select>
        <div class="error-message" id="media_type_error"></div>

        <div id="file_input_div" style="{{ old('media_type') == 'youtube_url' ? 'display:none;' : '' }}">
            <label for="media">Add Image or PDF</label>
            <input type="file" name="media" id="media" accept="image/*,.pdf" onchange="showPreview(event)">
            <div class="error-message" id="media_error"></div>
        </div>
        <div id="url_input_div" style="{{ old('media_type') == 'youtube_url' ? 'display:block;' : 'display:none;' }}">
            <label for="youtube_url">Insert YouTube Video URL</label>
            <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url') }}" onchange="showPreview(event)">
            <div class="error-message" id="youtube_url_error"></div>
        </div>

        <label for="project_title">Project Title</label>
        <input type="text" name="project_title" id="project_title" value="{{ old('project_title') }}" maxlength="70" oninput="updateCharCount('project_title', 70)">
        <span class="char-count" id="project_title-char-count">0/70</span>
        <div class="error-message" id="project_title_error"></div>

        <label for="client_name">Client Name</label>
        <input type="text" name="client_name" id="client_name" value="{{ old('client_name') }}" maxlength="35" oninput="updateCharCount('client_name', 35)">
        <span class="char-count" id="client_name-char-count">0/35</span>
        <div class="error-message" id="client_name_error"></div>

        <label for="country_location">Country / Location</label>
        <input type="text" name="country_location" id="country_location" value="{{ old('country_location') }}">
        <div class="error-message" id="country_location_error"></div>

        <label for="services_provided">Services Provided (up to 5 comma-separated keywords. 140 characters max)</label>
        <input type="text" name="services_provided" id="services_provided" value="{{ old('services_provided') }}" maxlength="140" oninput="updateCharCount('services_provided', 140)">
        <span class="char-count" id="services_provided-char-count">0/140</span>
        <div class="error-message" id="services_provided_error"></div>

        <label for="short_description">Short Description</label>
        <textarea name="short_description" id="short_description">{{ old('short_description') }}</textarea>
        <div class="error-message" id="short_description_error"></div>

        <label for="engagement_start_date">Engagement Start Date</label>
        <input type="date" name="engagement_start_date" id="engagement_start_date" value="{{ old('engagement_start_date') }}">
        <div class="error-message" id="engagement_start_date_error"></div>

        <label for="engagement_end_date">Engagement End Date</label>
        <input type="date" name="engagement_end_date" id="engagement_end_date" value="{{ old('engagement_end_date') }}">
        <div class="error-message" id="engagement_end_date_error"></div>

        <button type="submit">Save</button>
    </form>

    <div id="preview"></div>
</div>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    function toggleMediaInput() {
        var mediaType = document.getElementById('media_type').value;
        var fileInputDiv = document.getElementById('file_input_div');
        var urlInputDiv = document.getElementById('url_input_div');
        var previewDiv = document.getElementById('preview');
        previewDiv.innerHTML = '';

        if (mediaType === 'image_pdf') {
            fileInputDiv.style.display = 'block';
            urlInputDiv.style.display = 'none';
        } else {
            fileInputDiv.style.display = 'none';
            urlInputDiv.style.display = 'block';
        }
    }

    function showPreview(event) {
        var previewDiv = document.getElementById('preview');
        previewDiv.innerHTML = '';
        
        if (event.target.id === 'media') {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var fileType = file.type;
                if (fileType.startsWith('image/')) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    previewDiv.appendChild(img);
                } else if (fileType === 'application/pdf') {
                    var object = document.createElement('object');
                    object.data = e.target.result;
                    object.type = 'application/pdf';
                    object.width = '100%';
                    object.height = '500px';
                    previewDiv.appendChild(object);
                }
            };

            reader.readAsDataURL(file);
        } else if (event.target.id === 'youtube_url') {
            var url = event.target.value;
            var videoId = url.split('v=')[1];
            var ampersandPosition = videoId.indexOf('&');
            if (ampersandPosition !== -1) {
                videoId = videoId.substring(0, ampersandPosition);
            }
            var iframe = document.createElement('iframe');
            iframe.src = 'https://www.youtube.com/embed/' + videoId;
            iframe.width = '100%';
            iframe.height = '500px';
            iframe.frameBorder = '0';
            iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
            iframe.allowFullscreen = true;
            previewDiv.appendChild(iframe);
        }
    }

    function validateForm() {
        var isValid = true;

        // Clear previous error messages
        document.querySelectorAll('.error-message').forEach(function(el) {
            el.textContent = '';
        });

        // Validate Media Type Input
        var mediaType = document.getElementById('media_type').value;
        if (mediaType === 'image_pdf') {
            var mediaInput = document.getElementById('media');
            if (mediaInput.files.length === 0) {
                isValid = false;
                document.getElementById('media_error').textContent = 'Please add an Image or PDF file.';
            }
        } else {
            var youtubeUrlInput = document.getElementById('youtube_url');
            if (youtubeUrlInput.value.trim() === '') {
                isValid = false;
                document.getElementById('youtube_url_error').textContent = 'Please insert a YouTube Video URL.';
            }
        }

        // Validate Project Title
        var projectTitleInput = document.getElementById('project_title');
        if (projectTitleInput.value.trim() === '') {
            isValid = false;
            document.getElementById('project_title_error').textContent = 'Project Title is required.';
        } else if (projectTitleInput.value.length > 70) {
            isValid = false;
            document.getElementById('project_title_error').textContent = 'Project Title must be less than or equal to 70 characters.';
        }

        // Validate Client Name
        var clientNameInput = document.getElementById('client_name');
        if (clientNameInput.value.trim() === '') {
            isValid = false;
            document.getElementById('client_name_error').textContent = 'Client Name is required.';
        } else if (clientNameInput.value.length > 35) {
            isValid = false;
            document.getElementById('client_name_error').textContent = 'Client Name must be less than or equal to 35 characters.';
        }

        // Validate Country / Location
        var countryLocationInput = document.getElementById('country_location');
        if (countryLocationInput.value.trim() === '') {
            isValid = false;
            document.getElementById('country_location_error').textContent = 'Country / Location is required.';
        }

        // Validate Services Provided
        var servicesProvidedInput = document.getElementById('services_provided');
        const servicesProvided = servicesProvidedInput.value.trim();
        if (servicesProvided === '') {
            isValid = false;
            document.getElementById('services_provided_error').textContent = 'Services Provided is required.';
        } else {
            const servicesProvidedTags = servicesProvided.split(',');
            if (servicesProvidedTags.length > 5 || servicesProvided.length > 140) {
                isValid = false;
                document.getElementById('services_provided_error').textContent = 'Services Provided must be up to 5 comma-separated keywords and not exceed 140 characters.';
            }
        }

        // Validate Short Description
        var shortDescriptionInput = CKEDITOR.instances.short_description;
        if (shortDescriptionInput.getData().trim() === '') {
            isValid = false;
            document.getElementById('short_description_error').textContent = 'Short Description is required.';
        }

        // Validate Engagement Start Date
        var engagementStartDateInput = document.getElementById('engagement_start_date');
        if (engagementStartDateInput.value.trim() === '') {
            isValid = false;
            document.getElementById('engagement_start_date_error').textContent = 'Engagement Start Date is required.';
        }

        // Validate Engagement End Date
        var engagementEndDateInput = document.getElementById('engagement_end_date');
        if (engagementEndDateInput.value.trim() === '') {
            isValid = false;
            document.getElementById('engagement_end_date_error').textContent = 'Engagement End Date is required.';
        }

        return isValid;
    }

    function updateCharCount(fieldId, maxChars) {
        var field = document.getElementById(fieldId);
        var charCount = field.value.length;
        var charCountSpan = document.getElementById(fieldId + '-char-count');
        if (charCountSpan) {
            charCountSpan.textContent = charCount + '/' + maxChars;
        }
    }

    // Initialize CKEditor
    CKEDITOR.replace('short_description');

    // Trigger media input toggle on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleMediaInput();
    });
</script>
@endsection
