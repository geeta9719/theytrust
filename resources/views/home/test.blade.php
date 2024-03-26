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
    </style>

    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif


    <section class="container-fluid mt-5 mb-5 list-box">
        <form id="categoryForm">
            <div id="primarySkillSection" class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <h4 class="font-weight-bold">Primary Skill</h4>
                    <div id="sessionMessage" class="card p-3 mb-3">
                        <!-- Content goes here -->
                    </div>
                </div>
            </div>
            <div id="primarySkillSection" class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <h4 class="font-weight-bold">Sub Category</h4>
                    <div id="sessionSubcategory" class="card p-3 mb-3">
                        <!-- Content goes here -->
                    </div>
                </div>
            </div>

            <div class="container">
                <br>
                <br>

                {{-- <form id="categoryForm"> --}}
                <div class="row">
                    <div class="col-md-3">

                        <fieldset>
                            <div id="categoryFieldset">
                                <legend>Choose Primary Service</legend>
                                @foreach ($categories as $category)
                                    <div>
                                        <input type="checkbox" id="{{ strtolower(str_replace(' ', '', $category->id)) }}"
                                            name="primaryService[]"
                                            value="{{ strtolower(str_replace(' ', '', $category->id)) }}"
                                            data-category-name="{{ $category->category }}" class="primary-service">
                                        <label
                                            for="{{ strtolower(str_replace(' ', '', $category->id)) }}">{{ $category->category }}</label>
                                    </div>
                                @endforeach
                            </div>

                        </fieldset>
                    </div>

                    <div class="col-md-3">
                        <fieldset>
                            <legend>Choose Sub Category</legend>
                            <div id="subCategoryFieldset"></div>
                        </fieldset>
                    </div>

                    <div class="col-md-3">
                        <fieldset>
                            <legend>Choose Skills</legend>
                            <div id="Skills"></div>
                            <!-- Skills checkboxes will go here -->
                        </fieldset>
                    </div>

                    <div class="col-md-3">
                        <fieldset>
                            <legend>Choose Deep Skill Tags</legend>
                            <!-- Deep skill tags checkboxes will go here -->
                        </fieldset>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary submit">Submit</button>
                    </div>
                </div>
        </form>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // $('.primary-service').change(function() {
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
                    generateCategoryNameTextbox(selectedCategory, categoryName);
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

                $.ajax({
                    url: '/api/subcategories',
                    type: 'GET',
                    data: {
                        categories: selectedCategory
                    },
                    success: function(response) {
                        var subCategoryFieldset = $('#subCategoryFieldset');
                        subCategoryFieldset.empty();

                        if (response.length > 0) {
                            var html = '<div>';
                            for (var i = 0; i < response.length; i++) {
                                var subcategoryslug = generateSlug(response[i].subcategory);
                                html += '<input type="checkbox" id="' + response[i].id +
                                    '" name="subCategory[]" value="' + response[i].subcategory +
                                    '" class="subcategory-checkbox" data-subcategory="' +
                                    subcategoryslug + '" data-name="' + response[i]
                                    .category_name + '">';
                                html += ' <label for="' + response[i].id + '"> ' + response[i]
                                    .subcategory + '</label><br>';
                            }
                            html += '</div>';
                            subCategoryFieldset.append(html);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
            $('.primary-service + label').click(function() {
                debugger;
                $('.selected-label').removeClass('selected-label');
                $(this).toggleClass('selected-label');

                var selectedCategory = $(this).attr('for');
                var categoryName = $(this).prev('input[type="checkbox"]').data('category-name');

                const TextBoxdivId = checkIfSubCategoryExists(categoryName);
                $.ajax({
                    url: '/api/subcategories',
                    type: 'GET',
                    data: {
                        categories: selectedCategory
                    },
                    success: function(response) {
                        var subCategoryFieldset = $('#subCategoryFieldset');
                        subCategoryFieldset.empty();

                        if (response.length > 0) {
                            var html = '<div>';
                            for (var i = 0; i < response.length; i++) {
                                var subcategoryslug = generateSlug(response[i].subcategory);
                                html += '<input type="checkbox" id="' + response[i].id +
                                    '" name="subCategory[]" value="' + response[i].subcategory +
                                    '" class="subcategory-checkbox" data-subcategory="' +
                                    subcategoryslug + '" data-name="' + response[i]
                                    .category_name + '">';
                                html += ' <label for="' + response[i].id + '"> ' + response[i]
                                    .subcategory + '</label><br>';
                            }
                            html += '</div>';
                            subCategoryFieldset.append(html);

                            // Now that checkboxes are appended, check them based on certain condition
                            $('.SubCategoryNameText').each(function() {
                                var subcategoryName = $(this).data('subcategoryname');
                                console.log(subcategoryName, "Asdfasdf");
                                subCategoryFieldset.find('input[type="checkbox"]').each(
                                    function() {
                                        console.log(this.value, "asdfasdf")
                                        if (this.value === subcategoryName) {
                                            debugger
                                            $(this).prop('checked', true);
                                        }
                                    });
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

            });

            $('#subCategoryFieldset').on('change', 'input.subcategory-checkbox', function(event) {
                debugger;
                var categoryname = $(this).data('name');
                var subCategoryName = $(this).val();
                const subcategoryslug = generateSlug(subCategoryName);

                var primaryCategory = $('.primary-service[data-category-name="' + categoryname + '"]');
                console.log(primaryCategory, "Primary Category");
                var isChecked = primaryCategory.is(':checked');

                if (isChecked) {
                    if ($(this).is(':checked')) {
                        var categoryslug = generateSlug($(this).data('name'));
                        hitAPIAndCreateCheckbox(subCategoryName, subcategoryslug, subcategoryslug,
                            categoryslug);
                        generateSubCategoryNameTextbox($(this).data('name'), categoryslug, subcategoryslug,
                            subCategoryName);
                    } else {
                        removeElementAndParentIfSingleChild(subcategoryslug);
                    }
                } else {
                    alert("Select the Primary Category");
                    $(this).prop('checked', false);
                }
            });

            $('#subCategoryFieldset').on('click', 'input.subcategory-checkbox + label', function(event) {
                debugger;
                var categoryname = $(this).prev('.subcategory-checkbox').data('name');
                var subCategoryName = $(this).prev('.subcategory-checkbox').val();
                const subcategoryslug = generateSlug(subCategoryName);

                var primaryCategory = $('.primary-service[data-category-name="' + categoryname + '"]');
                var isChecked = primaryCategory.is(':checked');


                if (isChecked) {
                    // if ($(this).is(':checked')) {
                    $(this).prop('checked', false);
                    var categoryslug = generateSlug(categoryname);
                    hitAPIAndCreateCheckbox(subCategoryName, subcategoryslug, subcategoryslug,
                        categoryslug);
                    const skillappenddiv = "subCategoryName_" + subcategoryslug;
                    var getsoftskills = $('#' + skillappenddiv).find('.getsoftskill');

                    // Initialize an array to store IDs of getsoftskill elements
                    var softSkillIDs = [];


                    getsoftskills.each(function() {
                        // Get the ID of the current getsoftskill element
                        var softSkillID = $(this).attr('id');

                        // Push the ID to the softSkillIDs array
                        softSkillIDs.push(softSkillID);
                    });
                    console.log(softSkillIDs,"softSkillIDssoftSkillIDssoftSkillIDs");
                    // Get all checkboxes with class 'skillsCheckbox'
                    // var checkboxes = document.('.skillsCheckbox');
                        console.log($("#Skills").find(".Skills"));
                        debugger;

                    // Iterate through each checkbox
                    checkboxes.forEach(function(checkbox) {
                        // Get the ID of the current checkbox
                        var checkboxID = checkbox.id;

                        // Check if the checkboxID exists in the softSkillIDs array
                        if (softSkillIDs.includes(checkboxID)) {
                            // Check the checkbox
                            checkbox.checked = true;
                        }
                    });










                    // $('#Skills .Skills').each(function() {
                    //     // Get the ID of the current element
                    //     var currentID = $(this).find('input.skillsCheckbox').attr('id');

                    //     // Check if the current ID matches the desired ID
                    //     if (currentID === desiredID) {
                    //         // Do something if the ID matches
                    //         console.log("The desired ID is present.");
                    //     } else {
                    //         // Do something else if the ID does not match
                    //         console.log("The desired ID is not present.");
                    //     }
                    // });

                    // generateSubCategoryNameTextbox($(this).data('name'), categoryslug, subcategoryslug,
                    //     subCategoryName);
                    // } else {
                    // removeElementAndParentIfSingleChild(subcategoryslug);
                    // }
                } else {
                    alert("Select the Primary Category");
                    $(this).prop('checked', false);
                }
            });

            $(document).on('click', '.skillsCheckbox', function() {

                if ($(this).prop('checked')) {
                    var subcategory = $(this).data('subcategory');
                    var appendDive = "subCategoryName_" + $(this).data('subcategory');
                    var subcategorydiv = $(this).data('name') + "_subCategorydiv";
                    console.log(subcategorydiv, "    asdfasdfasdf");
                    var checkboxValue = $(this).val();
                    const softSkillTag = generateSlug(checkboxValue);

                    // Create a new div element
                    var newDiv = $('<div>');

                    // Set id attribute
                    newDiv.attr('id', softSkillTag);

                    // Set data attributes
                    newDiv.attr({
                        'data-category': $(this).data('name'),
                        'data-subcategory': subcategory
                    });

                    newDiv.addClass('getsoftskill');

                    // Create a new span element
                    var newSpan = $('<span>');

                    // Set text content
                    newSpan.text(checkboxValue);

                    // Append the span to the div
                    newDiv.append(newSpan);
                    console.log()

                    // Append the new div to the target element
                    $('#' + appendDive).append(newDiv);
                } else {
                    // Get the id of the soft skill tag
                    var checkboxValue = $(this).val();
                    const softSkillTag = generateSlug(checkboxValue);

                    // Remove the generated div with the soft skill tag id
                    $('#' + softSkillTag).remove();

                    console.log("unchecked");
                    // Handle the case when the checkbox is unchecked if needed
                }
            });




            // Generate input field for category name
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
                $('#sessionMessage').append(categoryContainer);
            }

            function generateSlug(inputString) {
                return inputString.toLowerCase().replace(/\s+/g,
                        '-') // Convert to lowercase and replace spaces with hyphens
                    .replace(/[^\w\-]+/g, '') // Remove non-word characters except hyphens
                    .replace(/\-\-+/g, '-') // Replace multiple consecutive hyphens with single hyphen
                    .replace(/^-+/, '') // Remove leading hyphens
                    .replace(/-+$/, ''); // Remove trailing hyphens
            }


            function generateSubCategoryNameText(slug, subCategoryName) {
                var subCategoryNameTextbox =
                    '<div class="card-body p-3 mb-3  SubCategoryNameText" id="subCategoryName_' + slug +
                    '" data-subcategoryname="' + subCategoryName + '">' +
                    '<label for="subCategoryName_input' + slug + '">' + subCategoryName + ':</label>' +
                    '<div><input type="text" name="subCategoryName" id="subCategoryName_input' + slug +
                    '" class="form-control form-control-sm" placeholder="Enter ' + subCategoryName +
                    ' name"></div>' +
                    '</div>';
                return subCategoryNameTextbox;
            }



            function generateSubCategoryNameTextbox(categoryname, categoryslug, subcategoryslug, subCategoryName) {
                console.log(categoryslug, "slug");
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

                $('#' + categoryslug + '_subCategorydiv').append(generateSubCategoryNameText(subcategoryslug,
                    subCategoryName));
            }

            // Check if subcategory div exists
            function checkSubCategoryDivExistence(categoryslug) {
                var subCategoryDivId = categoryslug + '_subCategorydiv';
                var subCategoryDivExists = $('#' + subCategoryDivId).length > 0;

                return subCategoryDivExists;
            }

            function removeElementAndParentIfSingleChild(subcategoryslug) {
                var elementToRemove = $('#subCategoryName_' + subcategoryslug);
                var parentDiv = elementToRemove.parent('.card');

                // Check if the parent div has only one child element
                if (parentDiv.children('.card-body').length === 2) {
                    // If only one child element, remove both the parent and child elements
                    parentDiv.remove();
                } else {
                    // If more than one child element, remove only the child element
                    elementToRemove.remove();
                }
                $('#Skills .' + subcategoryslug).remove();
            }




            function validateInputValues() {
                var totalValue = 0;
                var $errorMessage = $('<div class="error-message"></div>'); // Create a new error message element
                var $textboxes = $('#sessionMessage input[type="text"]');
                $('.error-message').remove();
                $textboxes.css('border-color', '');

                // Calculate total value and highlight textbox if total exceeds 100
                $textboxes.each(function() {
                    var value = parseFloat($(this).val());
                    if (!isNaN(value)) {
                        totalValue += value;
                    }
                });

                if (totalValue > 100) {
                    var excessValue = totalValue - 100;
                    $errorMessage.text('Total value cannot exceed 100. Excess: ' + excessValue.toFixed(2));

                    // Highlight the first exceeding textbox
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
                }
            }
            $('.submit').click(function() {
                validateInputValues();
            });

            function hitAPIAndCreateCheckbox(subCategoryName, subcategoryslug, subcategoryslug, categoryslug) {

                var skills = $('#Skills');
                skills.empty();
                $.ajax({
                    url: '/api/skill',
                    type: 'get',
                    data: {
                        id: subcategoryslug
                    },
                    success: function(response) {
                        response.forEach(function(skill) {
                            const skilId = generateSlug(skill.name)
                            var checkbox = $('<div class="form-check Skills ' +
                                subcategoryslug +
                                '">' +
                                '<input class="form-check-input skillsCheckbox" type="checkbox" name="softSkills[]" id="' +
                                skilId + '" value="' + skill.name +
                                '" data-subcategory="' +
                                subcategoryslug + '" data-name="' + categoryslug + '">' +
                                '<label class="form-check-label" for="softSkill_' + skill
                                .id + '">' + skill.name + '</label>' +
                                '</div>');

                            skills.append(checkbox);
                        });
                    },

                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(error);
                    }
                });
            }

        });

        function checkIfSubCategoryExists(selectedCategory) {
            var foundId = false;
            $('#sessionSubcategory > div[data-categoryname="' + selectedCategory + '"]').each(function() {
                foundId = $(this).attr('id');
                return false;
            });

            return foundId;
        }
    </script>
@endsection
