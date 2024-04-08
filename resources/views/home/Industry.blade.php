@extends('layouts.home-master')

@section('content')
    <style>
        /* Hide radio buttons */
        input[type="radio"].visually-hidden {
            position: absolute;
            clip: rect(0, 0, 0, 0);
            pointer-events: none;
        }

        /* Style the label of the selected category */
        input[type="radio"]:checked+label {
            background-color: #f0f8ff;
            /* Light blue background */
            color: #333;
            /* Dark text color */
        }
    </style>
    <!-- listing section start -->
    <section class="container-fluid list-top">
        <div class="container">
            <a href="">Home | Company Profile</a>
        </div>
    </section>

    <style>
        .selected-label {
            background-color: lightblue;
        }

        .selected-label-sub {
            background-color: lightblue;
        }
    </style>

    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif


    <section class="container-fluid mt-5 mb-5 list-box">
        <form id="categoryForm">
            <input type="hidden" id="companyIdInput" name="companyId" value="<?php echo $company->id; ?>">

            <div id="primarySkillSection" class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <h4 class="font-weight-bold">Industry Skill</h4>
                    <div id="sessionMessage" class="card p-3 mb-3">
                    </div>
                </div>
            </div>
            <div id="primarySkillSection" class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <h4 class="font-weight-bold">Size </h4>
                    <div id="sessionSize" class="card p-3 mb-3">
                        <!-- Content goes here -->
                    </div>
                </div>
            </div>
            <div class="container">
                <br>
                <br>
                <div class="row">
                    <div class="col-md-3">

                        <fieldset>
                            <div id="categoryFieldset">
                                <legend>Choose Industry</legend>
                                @foreach ($industry as $ind)
                                    <div>
                                        <input type="checkbox" id="{{ strtolower(str_replace(' ', '', $ind->id)) }}"
                                            name="primaryService[]" value="{{ strtolower(str_replace(' ', '', $ind->id)) }}"
                                            data-category-name="{{ $ind->name }}" class="primary-service">
                                        <label
                                            for="{{ strtolower(str_replace(' ', '', $ind->id)) }}">{{ $ind->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-3">
                        <fieldset>
                            <div id="sizeFieldset">
                                <legend>Choose Client Size</legend>
                                @foreach ($clientSize as $size)
                                    <div>
                                        <input type="checkbox" id="{{ strtolower(str_replace(' ', '', $size->id)) }}"
                                            name="primaryclientSize[]"
                                            value="{{ strtolower(str_replace(' ', '', $size->id)) }}"
                                            data-size-name="{{ $size->name }}" class="size">
                                        <label
                                            for="{{ strtolower(str_replace(' ', '', $size->id)) }}">{{ $size->name }}</label>
                                    </div>
                                @endforeach
                            </div>

                        </fieldset>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <button type="button" id="submitFormButton" class="btn btn-primary submit">Submit</button>
                    </div>
                </div>
        </form>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            function fetchDataAndGenerateTextboxes() {

                var companyId = $('#companyIdInput').val();
                debugger
                $.ajax({

                    url: '/industry/' + companyId,
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        response.industry.forEach(function(industry) {
                            var categoryId = industry.industry.id;
                            var categoryName = industry.industry.name;
                            var value = industry.percent;
                            // generateSizeNameTextboxFill(categoryId, categoryName, value );
                            generateCategoryNameTextboxFill(categoryId, categoryName, value );
                        });
                        response.client_size.forEach(function(industry) {
                            debugger;
                            var categoryId = industry.client_size.id;
                            var categoryName = industry.client_size.name;
                            var value = industry.percent;
                            generateSizeNameTextboxFill(categoryId, categoryName, value );
                            // generateCategoryNameTextboxFill(categoryId, categoryName, value );
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
            fetchDataAndGenerateTextboxes();



            function generateSizeNameTextboxFill(categoryid, categoryName, value) {
                var categoryContainer = $('<div class="row category-container" id="' + categoryid +
                    '"></div>'); // Assign categoryid as the ID

                var labelColumn = $('<div class="col-md-3"></div>'); // Label column with col-3 width
                var inputColumn = $('<div class="col-md-9"></div>'); // Input column

                var categoryNameLabel = $('<label class="category-label font-weight-bold" for="' + categoryid +
                    '">' + categoryName + ': </label>'); // Bold label

                var categoryNameInput = $('<input type="text" class="form-control form-control-sm" name="' +
                    categoryid + '" id="' + categoryid + '" placeholder="Enter ' + categoryName +
                    ' name" value="' + value + '">'); // Small text box with value

                labelColumn.append(categoryNameLabel); // Append label to label column
                inputColumn.append(categoryNameInput); // Append input field to input column

                categoryContainer.append(labelColumn, inputColumn); // Append both columns to the row
                $('#sessionSize').append(categoryContainer);

                $('#sizeFieldset').children().each(function() {
                    var checkbox = $(this).find('input[type="checkbox"].primary-service');

                    var id = checkbox.attr('id');

                    console.log(id, categoryid);

                    // Check if the categoryid matches the desired categoryid
                    if (id == categoryid) {
                        console.log(id, "Asdfasdfasdfasdf");
                        // Check the checkbox
                        checkbox.prop('checked', true);
                    }
                });
            }


            function generateCategoryNameTextboxFill(categoryid, categoryName, value, category) {
                        var categoryContainer = $('<div class="row category-container" id="' + categoryid +
                            '"></div>'); // Assign categoryid as the ID

                        var labelColumn = $('<div class="col-md-3"></div>'); // Label column with col-3 width
                        var inputColumn = $('<div class="col-md-9"></div>'); // Input column

                        var categoryNameLabel = $('<label class="category-label font-weight-bold" for="' + categoryid +
                            '">' + categoryName + ': </label>'); // Bold label

                        var categoryNameInput = $('<input type="text" class="form-control form-control-sm" name="' +
                            categoryid + '" id="' + categoryid + '" placeholder="Enter ' + categoryName +
                            ' name" value="' + value + '">'); // Small text box with value

                        labelColumn.append(categoryNameLabel); // Append label to label column
                        inputColumn.append(categoryNameInput); // Append input field to input column

                        categoryContainer.append(labelColumn, inputColumn); // Append both columns to the row
                        $('#sessionMessage').append(categoryContainer);

                        $('#categoryFieldset').children().each(function() {
                            // Check if the child div contains a checkbox
                            var checkbox = $(this).find('input[type="checkbox"].primary-service');


                            // Get the category ID from the checkbox's ID attribute
                            var id = checkbox.attr('id');

                            console.log(id, categoryid);

                            // Check if the categoryid matches the desired categoryid
                            if (id == categoryid) {
                                console.log(id, "Asdfasdfasdfasdf");
                                // Check the checkbox
                                checkbox.prop('checked', true);
                            }
                        });
                        // $.each(category.category.subcategory, function(index, subcategory) {

                        //     generateSubCategoryNameTextboxFill(categoryName, generateSlug(categoryName),
                        //         generateSlug(subcategory.subcategory), subcategory.subcategory, subcategory
                        //         .add_focus[0].percent);
                        // });
                    }






            $('#categoryFieldset').on('change', '.primary-service', function() {
                debugger;
                var selectedCategory = $(this).val();
                var categoryName = $(this).data('category-name');
                var categoryNameSlug = generateSlug(categoryName);
                $('.selected-label').removeClass('selected-label');
                var selectedLabel = $('label[for="' + $(this).attr('id') + '"]');
                selectedLabel.addClass('selected-label');

                if ($(this).is(':checked')) {
                    var selectedCategories = JSON.parse(localStorage.getItem('selectedCategories')) || [];
                    if (!selectedCategories.includes(selectedCategory)) {
                        selectedCategories.push(selectedCategory);
                    }
                    localStorage.setItem('selectedCategories', JSON.stringify(selectedCategories));
                    console.log(selectedCategory, categoryName, "ASdfasfdasdf");
                    // generateCategoryNameTextbox(selectedCategory, categoryName);
                    const data = generateCategoryNameTextbox(selectedCategory, categoryName);
                    $('#sessionMessage').append(data);
                } else {
                    // Remove deselected category from localStorage
                    var selectedCategories = JSON.parse(localStorage.getItem('selectedCategories')) || [];
                    var index = selectedCategories.indexOf(selectedCategory);
                    if (index !== -1) {
                        selectedCategories.splice(index, 1);
                    }
                    localStorage.setItem('selectedCategories', JSON.stringify(selectedCategories));
                    var subCategoryDivId = categoryNameSlug + '_subCategorydiv';
                    $('#' + selectedCategory).remove();
                    $('#' + subCategoryDivId).remove();
                }
            });



            $('#sizeFieldset').on('change', '.size', function() {
                var selectedCategory = $(this).val();
                console.log()
                var categoryName = $(this).data('size-name');
                var categoryNameSlug = generateSlug(categoryName);
                $('.selected-label').removeClass('selected-label');
                var selectedLabel = $('label[for="' + $(this).attr('id') + '"]');
                selectedLabel.addClass('selected-label');

                if ($(this).is(':checked')) {
                    var selectedCategories = JSON.parse(localStorage.getItem('size')) || [];
                    if (!selectedCategories.includes(selectedCategory)) {
                        selectedCategories.push(selectedCategory);
                    }
                    localStorage.setItem('selectedCategories', JSON.stringify(selectedCategories));
                    console.log(selectedCategory, categoryName, "ASdfasfdasdf");
                    const data = generateCategoryNameTextbox(selectedCategory, categoryName);
                    $('#sessionSize').append(data);

                } else {
                    // Remove deselected category from localStorage
                    var selectedCategories = JSON.parse(localStorage.getItem('size')) || [];
                    var index = selectedCategories.indexOf(selectedCategory);
                    if (index !== -1) {
                        selectedCategories.splice(index, 1);
                    }
                    localStorage.setItem('size', JSON.stringify(selectedCategories));
                    var subCategoryDivId = categoryNameSlug + '_subCategorydiv';
                    $('#' + selectedCategory).remove();
                    $('#' + subCategoryDivId).remove();
                }
            });

            function generateCategoryNameTextbox(categoryid, categoryName) {
                var categoryContainer = $('<div class="row category-container" id="' + categoryid +
                    '"></div>'); // Assign categoryid as the ID

                var labelColumn = $('<div class="col-md-3"></div>'); // Label column with col-3 width
                var inputColumn = $('<div class="col-md-9"></div>'); // Input column

                var categoryNameLabel = $('<label class="category-label font-weight-bold" for="' + categoryid +
                    '">' + categoryName + ': </label>'); // Bold label

                var categoryNameInput = $('<input type="text" class="form-control form-control-sm" name="' +
                    categoryid + '" id="' + categoryid + '" placeholder="Enter ' +
                    categoryName + ' name">'); // Small text box

                labelColumn.append(categoryNameLabel); // Append label to label column
                inputColumn.append(categoryNameInput); // Append input field to input column

                categoryContainer.append(labelColumn, inputColumn); // Append both columns to the row
                return categoryContainer;
                $('#sessionSize').append(categoryContainer);
            }

            function generateSlug(inputString) {
                return inputString.toLowerCase().replace(/\s+/g,
                        '-') // Convert to lowercase and replace spaces with hyphens
                    .replace(/[^\w\-]+/g, '') // Remove non-word characters except hyphens
                    .replace(/\-\-+/g, '-') // Replace multiple consecutive hyphens with single hyphen
                    .replace(/^-+/, '') // Remove leading hyphens
                    .replace(/-+$/, ''); // Remove trailing hyphens
            }

            function generateSubCategoryNameTextbox(categoryname, categoryslug, subcategoryslug, subCategoryName) {
                console.log(categoryslug, "slug");
                var categoryClass = categoryslug + '_subCategorydiv'

                var subCategoryDivExists = checkSubCategoryDivExistence(categoryslug);
                console.log(subCategoryDivExists);

                if (!subCategoryDivExists) {
                    var subCategoryDivId = categoryslug + '_subCategorydiv';
                    var subCategoryContainer = $('<div class="card p-3 mb-3" id="' + subCategoryDivId +
                        '" data-categoryname="' + categoryname + '"></div>'); // Added padding and margin
                    var subCategoryCardBody = $('<div class="card-body"></div>');
                    var subCategoryHeading = $('<h5 class="card-title font-weight-bold">' + categoryname +
                        '</h5>'); // Made the card-title bold

                    subCategoryCardBody.append(subCategoryHeading);
                    subCategoryContainer.append(subCategoryCardBody);

                    $('#sessionSubcategory').append(subCategoryContainer);
                }

                console.log(categoryClass, "asdfasdfasdfasdfasdf");
                $('#' + categoryslug + '_subCategorydiv').append(generateSubCategoryNameText(subcategoryslug,
                    subCategoryName, categoryClass));
            }

            function validateInputValues() {
                var totalValue = 0;
                var $errorMessage = $('<div class="error-message"></div>'); // Create a new error message element
                var $textboxes = $('#sessionMessage input[type="text"]');
                $('.error-message').remove();
                $textboxes.css('border-color', '');

                var allValuesValid = true;

                // Check each textbox value
                $textboxes.each(function() {
                    var value = parseFloat($(this).val());

                    // Check if value is valid
                    if (isNaN(value) || value < 1) {
                        allValuesValid = false;
                        $(this).css('border-color', 'red');
                    } else {
                        totalValue += value;
                    }
                });
                if (!allValuesValid) {
                    $errorMessage.text('Please enter values of 1 or greater for all textboxes.');
                    $('#sessionMessage').append($errorMessage);
                    return false;
                }
                if (totalValue > 100) {
                    var excessValue = totalValue - 100;
                    $errorMessage.text('Total value cannot exceed 100. Excess: ' + excessValue.toFixed(2));

                    var currentTotal = 0;
                    $textboxes.each(function() {
                        var value = parseFloat($(this).val());
                        if (!isNaN(value)) {
                            currentTotal += value;
                            if (currentTotal > 100) {
                                $(this).css('border-color', 'red');
                                return false; // Exit the loop after highlighting the first exceeding textbox
                            }
                        }
                    });

                    $('#sessionMessage').append($errorMessage); // Append the error message below the textboxes
                    return false;
                }

                return true; // Validation passed
            }
            $('#sessionMessage').on('mouseleave', function() {
                var inputValuesValid = validateInputValues();
                if (!inputValuesValid) {
                    $('#submitFormButton').prop('disabled',
                        true); // Disable submit button if validation fails
                } else {
                    $('#submitFormButton').prop('disabled',
                        false); // Enable submit button if validation passes
                }
            });
            $('#sessionSize').on('mouseleave', function() {
                var inputValuesValid = validateInputValues();
                if (!inputValuesValid) {
                    $('#submitFormButton').prop('disabled',
                        true); // Disable submit button if validation fails
                } else {
                    $('#submitFormButton').prop('disabled',
                        false); // Enable submit button if validation passes
                }
            });
            $('#submitFormButton').click(function() {
                var companyId = $('#companyIdInput').val();

                var categoryDataArray = [];
                var sizeDataArray = [];
                $('#sessionMessage .category-container').each(function() {
                    var categoryId = $(this).attr('id'); // Get category ID
                    var categoryName = $(this).find('.category-label').text();
                    var categoryslug = generateSlug(categoryName);
                    var categoryNameInput = $(this).find('input[type="text"]').val()
                        .trim();

                    var categoryData = {
                        companyId: companyId,
                        id: categoryId,
                        name: categoryName,
                        inputValue: categoryNameInput,
                    };
                    console.log(categoryData);

                    categoryDataArray.push(categoryData); // Push category data to the array
                });

                $('#sessionSize .category-container').each(function() {
                    debugger;
                    var categoryId = $(this).attr('id'); // Get category ID
                    var categoryName = $(this).find('.category-label').text();
                    var categoryslug = generateSlug(categoryName);
                    var categoryNameInput = $(this).find('input[type="text"]').val()
                        .trim();
                    var categoryData = {
                        companyId: companyId,
                        id: categoryId,
                        name: categoryName,
                        inputValue: categoryNameInput,
                    };
                    sizeDataArray.push(categoryData);
                });
                var data = {
                    categoryDataArray: categoryDataArray,
                    sizeDataArray: sizeDataArray
                }
                $.ajax({
                    url: '/company/save-industry/'+ companyId,
                    method: 'POST',
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify(data),
                    success: function(response) {
                        var redirectURL = '/company/' + companyId + '/marketing';
                        window.location.href = redirectURL;
                        console.log("Asdfasdfasdfasdf");
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving data:', error);
                    }
                });
            });
        });
    </script>
@endsection
