@extends('layouts.home-master')

@section('content')
    <style>
        .category-container {
            width: 9% !important;
            vertical-align: top;

        }

        .category-container .servicesbox {
            height: 55px;
        }


        #primarySkillSection h3 {
            text-align: left;
            color: #ffffff;
            font-size: 19px;
            background-color: #0087f2;
            padding: 11px 20px;
            font-weight: bold;

        }

        #primarySkillSection h4 {
            text-align: left;
            font-size: 19px;
            padding: 0;
            margin: 9px 19px 36px 19px;

        }

        legend {
            color: #ffffff;
            background-color: #0087f2;
            font-size: 17px;
            padding: 4px 6px;
        }

        #categoryFieldset div {
            padding: 4px 10px;
            border-bottom: 1px solid #ccc;
        }

        #categoryFieldset {
            border: 1px solid #ccc;

        }

        .getsoftskill span {

            background-color: #0087f2;
            color: #fff;
            padding: 4px 10px;
            margin-top: 20px !important;
        }

        .SubCategoryNameText {

            vertical-align: top;
        }

        .getsoftskill {
            margin-bottom: 20px;
            margin-top: 28px;
            display: block;
        }

        /* .catbox .col-md-3{
                border:1px solid #ccc;

                 } */

        #subCategoryFieldset {
            border: 1px solid #ccc;
            margin-top: -9px;
        }

        #subCategoryFieldset div {
            padding: 4px 0px;
            border-bottom: 1px solid #ccc;
        }

        #subCategoryFieldset input {
            margin-left: 13px;
        }

        .selected-label,
        .selected-label-sub {
            background-color: #0087f2 !important;
            color: #fff !important;
        }

        #Skills {
            border: 1px solid #ccc;
            margin-top: -9px;
        }

        #Skills div {
            padding: 4px 0px;
            border-bottom: 1px solid #ccc;
        }

        #Skills input {
            margin-left: 13px;
        }

        #Skills .form-check-label {
            margin-left: 32px;
            padding: 10px 0;
            margin-top: -10px;
        }

        @media (min-width: 768px) {

            .SubCategoryNameText,
            .category-container {
                width: 45%;
                display: inline-block;
            }
        }

        .SubCategoryNameText,
        .category-container {

            text-align: left;
            margin: 10px;

        }

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
                <div class="container text-center">
                    <h3>Select a Primary Services</h3>
                    <!-- <h4 class="font-weight-bold">Primary Skill</h4> -->
                    <div id="sessionMessage" class="card p-3 mb-3" style="display:block; text-align:left">
                        <!-- Content goes here -->
                    </div>
                </div>
            </div>
            <div id="primarySkillSection" class="row justify-content-center">
                <div class="container mt-5 text-center">
                    <h3>Select a Sub Category</h3>
                    <!-- <h4 class="font-weight-bold">Sub Category</h4> -->
                    <div id="sessionSubcategory" class="  p-3 mb-3">
                        <!-- Content goes here -->
                    </div>
                </div>
            </div>

            <div class="container">
                <br>
                <br>

                {{-- <form id="categoryForm"> --}}
                <div class="row catbox">
                    <div class="col-lg-3 col-md-6">

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

                    <div class="col-lg-3 col-md-6">
                        <fieldset>
                            <legend>Choose Sub Category</legend>
                            <div>
                                <div id="subCategoryFieldset"></div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="col-lg-3 col-md-6 categoryFieldset">
                        <fieldset>

                            <legend>Choose Skills</legend>
                            <div id="Skills"></div>
                            <!-- Skills checkboxes will go here -->
                        </fieldset>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <fieldset>
                            <legend>Choose Deep Skill Tags</legend>
                            <!-- Deep skill tags checkboxes will go here -->
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
                $.ajax({
                    url: '/companydata/' + companyId,
                    type: 'GET',
                    success: function(response) {
                        response.forEach(function(category) {
                            console.log(category);
                            var categoryId = category.category.id;
                            var categoryName = category.category.category;
                            var value = category.percent;
                            generateCategoryNameTextboxFill(categoryId, categoryName, value,
                                category);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
            fetchDataAndGenerateTextboxes();
            $('#categoryFieldset').on('change', '.primary-service', function() {

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
                            //     for (var i = 0; i < response.length; i++) {
                            //         var subcategoryslug = generateSlug(response[i].subcategory);
                            //         html += '<div><input type="checkbox" id="' + response[i].id +
                            //             '" name="subCategory[]" value="' + response[i].subcategory +
                            //             '" class="subcategory-checkbox" data-subcategory="' +
                            //             subcategoryslug + '" data-name="' + response[i]
                            //             .category_name + '">';
                            //         html += ' <label for="' + response[i].id + '"> ' + response[i]
                            //             .subcategory + '</label></div>';
                            //     }
                            //     html += '</div>';
                            //     subCategoryFieldset.append(html);
                            // }
                            for (var i = 0; i < response.length; i++) {
                                var subcategoryslug = generateSlug(response[i].subcategory);
                                html += '<div><input type="checkbox" id="' + response[i].id +
                                    '" name="subCategory[]" value="' + response[i].subcategory +
                                    '" class="subcategory-checkbox" data-subcategory="' +
                                    subcategoryslug + '" data-name="' + response[i]
                                    .category_name + '">';

                                // Adding a small arrow button next to the label
                                html += '<label for="' + response[i].id + '"> ' + response[i]
                                    .subcategory + '</label>';

                                // Adding data-id attribute to the button
                                html +=
                                    '<input type="button" class="arrayButton" value="&#8594;" data-id="' +
                                    response[i].id + '" data-value="' + response[i]
                                    .subcategory + '"></div>';
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
                                html += '<div><input type="checkbox" id="' + response[i].id +
                                    '" name="subCategory[]" value="' + response[i].subcategory +
                                    '" class="subcategory-checkbox" data-subcategory="' +
                                    subcategoryslug + '" data-name="' + response[i]
                                    .category_name + '">';
                                // html += ' <label for="' + response[i].id + '"> ' + response[i]
                                //     .subcategory + '</label></div>';
                                // Adding a small arrow button next to the label
                                html += '<label for="' + response[i].id + '"> ' + response[i]
                                    .subcategory + '</label>';

                                // Adding data-id attribute to the button
                                html +=
                                    '<input type="button" class="arrayButton" value="&#8594;" data-id="' +
                                    response[i].id + '" data-value="' + response[i]
                                    .subcategory + '"></div>';
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
                console.log("heheheheh");
                $('.selected-label-sub').removeClass('selected-label-sub');
                var selectedLabel = $('label[for="' + $(this).attr('id') + '"]');
                selectedLabel.addClass('selected-label-sub');
                console.log("after input withoy  labael  box  hit api  ")
                var categoryname = $(this).data('name');
                var subCategoryName = $(this).val();
                var subCategoryid = $(this).attr('id');
                const subcategoryslug = generateSlug(subCategoryName);

                var primaryCategory = $('.primary-service[data-category-name="' + categoryname + '"]');
                console.log(primaryCategory, "Primary Category");
                var isChecked = primaryCategory.is(':checked');

                if (isChecked) {
                    if ($(this).is(':checked')) {
                        var categoryslug = generateSlug($(this).data('name'));
                        hitAPIAndCreateCheckbox(subCategoryName, subCategoryid, subcategoryslug,
                            subcategoryslug,
                            categoryslug);
                        generateSubCategoryNameTextbox($(this).data('name'), categoryslug, subcategoryslug,
                            subCategoryName);
                    } else {
                        hitAPIAndCreateCheckbox(subCategoryName, subCategoryid, subcategoryslug,
                            subcategoryslug,
                            categoryslug);
                        removeElementAndParentIfSingleChild(subcategoryslug);
                    }
                } else {
                    alert("Select the Primary Category");
                    $(this).prop('checked', false);
                }
            });

            $('#subCategoryFieldset').on('click', '.arrayButton', async function(event) {
                debugger;

                $('.selected-label-sub').removeClass('selected-label-sub');
                $(this).toggleClass('selected-label-sub');
                var categoryname = $(this).prevAll('.subcategory-checkbox').data('name');
                var subCategoryName = $(this).prevAll('.subcategory-checkbox').val();
                const subcategoryslug = generateSlug(subCategoryName);
                var subCategoryid = $(this).data('id');

                var primaryCategory = $('.primary-service[data-category-name="' + categoryname + '"]');
                var isChecked = primaryCategory.is(':checked');

                if (isChecked) {

                    console.log("after input  box  hit api  ")
                    // if ($(this).is(':checked')) {
                    $(this).prop('checked', false);
                    var categoryslug = generateSlug(categoryname);
                    await hitAPIAndCreateCheckbox(subCategoryName, subCategoryid, subcategoryslug,
                        subcategoryslug,
                        categoryslug);
                    const skillappenddiv = "subCategoryName_" + subcategoryslug;
                    var getsoftskills = $('#' + skillappenddiv).find('.getsoftskill');

                    // Initialize an array to store IDs of getsoftskill elements
                    var softSkillIDs = [];

                    getsoftskills.each(function() {
                        var softSkillID = $(this).attr('id');
                        softSkillIDs.push(softSkillID);
                    });
                    console.log(softSkillIDs, "softSkillIDssoftSkillIDssoftSkillIDs");
                    var checkboxes = $('#Skills').find('.skillsCheckbox');
                    checkboxes.each(function() {
                        var checkboxID = this.id;

                        // Check if the checkboxID exists in the softSkillIDs array
                        if (softSkillIDs.includes(checkboxID)) {
                            // Check the checkbox
                            this.checked = true;
                        }
                    });
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

                    var newDiv = $('<div>');

                    // Set id attribute
                    newDiv.attr('id', softSkillTag);

                    // Set data attributes
                    newDiv.attr({
                        'data-category': $(this).data('name'),
                        'data-subcategory': subcategory,
                        'data-id': $(this).data('id')
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
                var categoryContainer = $('<div class=" category-container" id="' + categoryid +
                    '"></div>'); // Assign categoryid as the ID

                var labelColumn = $('<div class="servicesbox"></div>'); // Label column with col-3 width
                var inputColumn = $('<div class="servicesbox"></div>'); // Input column

                var categoryNameLabel = $('<label class="category-label font-weight-bold" for="' + categoryid +
                    '">' + categoryName + ': </label>'); // Bold label

                var categoryNameInput = $('<input type="text" class="form-control form-control-sm" name="' +
                    categoryid + '" id="' + categoryid + '" >'); // Small text box

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

            function generateSubCategoryNameText(slug, subCategoryName, categoryclass) {
                var subCategoryNameTextbox =
                    '<div class="card-body p-3 mb-3 SubCategoryNameText" id="subCategoryName_' + slug +
                    '" data-subcategoryname="' + subCategoryName + '">' +
                    '<label for="subCategoryName_input' + slug + '">' + subCategoryName + ':</label>' +
                    '<div><input type="text" name="subCategoryName" id="subCategoryName_input' + slug +
                    '" class="form-control form-control-sm ' + categoryclass + '" placeholder="Enter ' +
                    subCategoryName +
                    ' name"></div>' +
                    '</div>';
                return subCategoryNameTextbox;
            }

            function generateSubCategoryNameTextFill(slug, subCategoryName, categoryclass, value) {
                console.log("pppppppppppppppppp", value);
                var subCategoryNameTextbox =
                    '<div class="card-body p-3 mb-3 SubCategoryNameText" id="subCategoryName_' + slug +
                    '" data-subcategoryname="' + subCategoryName + '">' +
                    '<label for="subCategoryName_input' + slug + '">' + subCategoryName + ':</label>' +
                    '<div><input type="text" name="subCategoryName" id="subCategoryName_input' + slug +
                    '" class="form-control form-control-sm ' + categoryclass + '" placeholder="Enter ' +
                    subCategoryName + ' name" value="' + value + '"></div>' + // Added value attribute
                    '</div>';
                return subCategoryNameTextbox;
            }


            function generateCategoryNameTextboxFill(categoryid, categoryName, value, category) {
                var categoryContainer = $('<div class=" category-container" id="' + categoryid +
                    '"></div>'); // Assign categoryid as the ID

                var labelColumn = $('<div class=""></div>'); // Label column with col-3 width
                var inputColumn = $('<div class=""></div>'); // Input column

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
             
                $.each(category.category.subcategory, function(index, subcategory) {
                    console.log(subcategory);
                    generateSubCategoryNameTextboxFill(categoryName, generateSlug(categoryName),
                        generateSlug(subcategory.subcategory), subcategory.subcategory, subcategory
                        ?.add_focus[0]?.percent);
                });
            }




            function generateSubCategoryNameTextboxFill(categoryname, categoryslug, subcategoryslug,
                subCategoryName, value) {
                console.log(value, "tttttttttttttttttttttttttttttttttttt");
                var categoryClass = categoryslug + '_subCategorydiv'
                var subCategoryDivExists = checkSubCategoryDivExistence(categoryslug);
                console.log(subCategoryDivExists);
                if (!subCategoryDivExists) {
                    var subCategoryDivId = categoryslug + '_subCategorydiv';
                    var subCategoryContainer = $(
                        '<div class="card p-3 mb-3" style="display:block; text-align:left" id="' +
                        subCategoryDivId +
                        '" data-categoryname="' + categoryname + '"></div>'); // Added padding and margin
                    var subCategoryCardBody = $('<div class="card-body"></div>');
                    var subCategoryHeading = $('<h5 class="card-title font-weight-bold">' + categoryname +
                        '</h5>'); // Made the card-title bold

                    subCategoryCardBody.append(subCategoryHeading);
                    subCategoryContainer.append(subCategoryCardBody);

                    $('#sessionSubcategory').append(subCategoryContainer);
                }
                $('#' + categoryslug + '_subCategorydiv').append(generateSubCategoryNameTextFill(subcategoryslug,
                    subCategoryName, categoryClass, value));
            }

            function generateSubCategoryNameTextbox(categoryname, categoryslug, subcategoryslug,
                subCategoryName) {
                console.log(categoryslug, "slug");
                var categoryClass = categoryslug + '_subCategorydiv'

                var subCategoryDivExists = checkSubCategoryDivExistence(categoryslug);
                console.log(subCategoryDivExists);

                if (!subCategoryDivExists) {
                    var subCategoryDivId = categoryslug + '_subCategorydiv';
                    var subCategoryContainer = $(
                        '<div class="card p-3 mb-3" style="display:block; text-align:left" id="' +
                        subCategoryDivId +
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


            async function hitAPIAndCreateCheckbox(subCategoryName, subCategoryid, subcategoryslug, categoryslug) {

                var skills = $('#Skills');
                skills.empty();

                try {
                    const response = await $.ajax({
                        url: '/api/skill',
                        type: 'get',
                        data: {
                            id: subCategoryid
                        }
                    });
                    response.forEach(function(skill) {
                        const skilId = generateSlug(skill.name);
                        var checkbox = $('<div class="form-check Skills ' +
                            subcategoryslug +
                            '">' +
                            '<input class="form-check-input skillsCheckbox" type="checkbox" name="softSkills[]" id="' +
                            skilId + '" value="' + skill.name +
                            '" data-subcategory="' +
                            subcategoryslug + '" data-name="' + categoryslug + '" data-id="' + skill
                            .id + '">' +
                            '<label class="form-check-label" for="softSkill_' + skill.id + '">' +
                            skill.name + '</label>' +
                            '</div>');

                        skills.append(checkbox);
                    });

                } catch (error) {
                    // Handle error
                    console.error(error);
                }
            }

            function checkIfSubCategoryExists(selectedCategory) {
                var foundId = false;
                $('#sessionSubcategory > div[data-categoryname="' + selectedCategory + '"]').each(function() {
                    foundId = $(this).attr('id');
                    return false;
                });

                return foundId;
            }

            function validateInputValues() {
                var totalValue = 0;
                var $errorMessage = $(
                    '<div class="error-message"></div>'); // Create a new error message element
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

                // If any value is invalid, show error message
                if (!allValuesValid) {
                    $errorMessage.text('Please enter values of 1 or greater for all textboxes.');
                    $('#sessionMessage').append($errorMessage);
                    return false;
                }

                // If total value exceeds 100, show error message
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
                    return false;
                }

                return true; // Validation passed
            }

            // Event listener for mouse leave on sessionMessage
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

            // $('#sessionSubcategory').on('mouseleave', function() {
            //     validateSubcategoryInputs();
            // });

            // function validateSubcategoryInputs() {
            //     var isValid = true;

            //     // Iterate through each subcategory container
            //     $('.card-body.SubCategoryNameText').each(function() {
            //         var totalValue = 0;
            //         var subcategoryName = $(this).data('subcategoryname');

            //         // Find all input elements within the current subcategory container
            //         $(this).find('input[type="text"]').each(function() {
            //             var inputValue = parseFloat($(this).val()); // Parse input value as float
            //             if (!isNaN(inputValue)) {
            //                 totalValue += inputValue; // Add input value to totalValue
            //             }
            //         });

            //         // Check if the total value exceeds 100 or is less than 100
            //         if (totalValue !== 100) {
            //             // alert('Total value for subcategory "' + subcategoryName +
            //             // '" must be equal to 100.');
            //             isValid = false;
            //             return false; // Exit the loop if validation fails for any subcategory
            //         }
            //     });

            //     return isValid; // Return validation result
            // }

            $('#submitFormButton').click(function() {
                var companyId = $('#companyIdInput').val(); // Retrieve the company ID

                var categoryDataArray = []; // Array to store category data

                $('#sessionMessage .category-container').each(function() {
                    var categoryId = $(this).attr('id'); // Get category ID
                    var categoryName = $(this).find('.category-label').text();
                    var categoryslug = generateSlug(categoryName);
                    var categoryNameInput = $(this).find('input[type="text"]').val()
                        .trim(); // Get category input value



                    // Array to store subcategory data for the current category
                    var subcategories = [];

                    // Iterate through each subcategory container within the current category
                    $('#' + categoryslug + '_subCategorydiv .SubCategoryNameText').each(
                        function() {
                            var subcategoryId = $(this).attr('id'); // Get subcategory ID
                            var subcategoryName = $(this).data(
                                'subcategoryname'); // Get subcategory name
                            var subcategoryNameInput = $(this).find('input[type="text"]')
                                .val()
                                .trim(); // Get subcategory input value

                            var skills = [];
                            $(this).find('.getsoftskill').each(function() {
                                var skillId = $(this).data('id');
                                var skillName = $(this).text().trim();
                                skills.push({
                                    id: skillId,
                                    name: skillName
                                });
                            });

                            var subcategoryData = {
                                id: subcategoryId,
                                name: subcategoryName,
                                inputValue: subcategoryNameInput,
                                skills: skills
                            };

                            subcategories.push(
                                subcategoryData); // Push subcategory data to the array
                        });
                    var categoryData = {
                        companyId: companyId,
                        id: categoryId,
                        name: categoryName,
                        inputValue: categoryNameInput,
                        subcategories: subcategories
                    };

                    categoryDataArray.push(categoryData); // Push category data to the array
                });
                $.ajax({
                    url: '/company/save-Service/' + companyId,
                    method: 'POST',
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify(categoryDataArray),
                    success: function(response) {

                        // var redirectURL = '/company/' + companyId + '/industry';
                        // window.location.href = redirectURL;
                        console.log("Asdfasdfasdfasdf");

                        console.log('Data saved successfully:', response);
                    },
                    error: function(xhr, status, error) {
                        console.log("Dkkkkkkkkkkkkkkkkkkkkkk")
                        console.error('Error saving data:', error);
                    }
                });
            });
        });
    </script>
@endsection
