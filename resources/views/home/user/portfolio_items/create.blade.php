@extends('layouts.home-master')

@section('content')

<style>
    .container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        max-width: 1200px;
        margin: auto;
        padding: 20px;
        gap: 20px;
    }
    form {
        flex: 1;
        max-width: 600px;
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
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
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
        flex: 1;
        max-width: 600px;
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
<div class="container">
    <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="media_type">Select Media Type</label>
        <select name="media_type" id="media_type" onchange="toggleMediaInput()">
            <option value="image_pdf_video">Image, PDF, or Video File</option>
            <option value="youtube_url">YouTube Video URL</option>
        </select>

        <div id="file_input_div">
            <label for="media">Add Image or PDF</label>
            <input type="file" name="media" id="media" onchange="showPreview(event)">
        </div>
        <div id="url_input_div" style="display: none;">
            <label for="youtube_url">Insert YouTube Video URL ( Ex:)</label>
            <input type="url" name="youtube_url" id="youtube_url" onchange="showPreview(event)">
        </div>

        <label for="project_title">Project Title</label>
        <input type="text" name="project_title" id="project_title">

        <label for="client_name">Client Name</label>
        <input type="text" name="client_name" id="client_name">

        <label for="country_location">Country / Location</label>
        <input type="text" name="country_location" id="country_location">

        <label for="services_provided">Services Provided (up to 5 comma separated keywords. 70 characters max)</label>
        <input type="text" name="services_provided" id="services_provided">

        <label for="short_description">Short Description</label>
        <textarea name="short_description" id="short_description"></textarea>

        <label for="engagement_start_date">Engagement Start Date</label>
        <input type="date" name="engagement_start_date" id="engagement_start_date">

        <label for="engagement_end_date">Engagement End Date</label>
        <input type="date" name="engagement_end_date" id="engagement_end_date">

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

        if (mediaType === 'image_pdf_video') {
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
                } else if (fileType.startsWith('video/')) {
                    var video = document.createElement('video');
                    video.src = e.target.result;
                    video.controls = true;
                    previewDiv.appendChild(video);
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

    // Initialize CKEditor
    CKEDITOR.replace('short_description');
</script>
@endsection