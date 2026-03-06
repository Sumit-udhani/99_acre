import $ from 'jquery';

$(document).ready(function(){

let selectedPurpose = null;
let selectedCategory = null;
let selectedCategoryName = null;

// PURPOSE CLICK
$('.purpose-btn').click(function(){

    $('.purpose-btn').removeClass('active');
    $(this).addClass('active');

    selectedPurpose = $(this).data('name');
   filterCategories();  
    filterPurposes();
    filterTypes();

});


// CATEGORY SELECT
$('.category-radio').change(function(){

    selectedCategory = $(this).val();
selectedCategoryName = $(this).data('name');
    filterPurposes();
    filterTypes();

});


// FILTER PURPOSES
function filterPurposes(){

    $('.purpose-btn').show();

    if(selectedCategory === 'commercial'){

        $('.purpose-btn').each(function(){

            let purpose = $(this).data('name');

            if(purpose === 'pg'){
                $(this).hide();
            }

        });

    }

}
function filterCategories(){

    // enable all categories first
    $('.category-radio').prop('disabled', false);

    // if purpose = PG
    if(selectedPurpose === 'pg'){

        $('.category-radio').each(function(){

            let category = $(this).data('name');

            if(category === 'commercial'){
                $(this).prop('disabled', true);
            }

        });

    }

}

// FILTER TYPES
function filterTypes(){

    $('.type-btn').hide();

    $('.type-btn').each(function(){

        let typeCategory = $(this).data('category');

        if(typeCategory == selectedCategory){
            $(this).show();
        }

    });

    applyPurposeRules();

}
function applyPurposeRules(){

    // RENT + RESIDENTIAL
   if(selectedPurpose === 'rent / lease' && selectedCategoryName === 'residential'){

        $('.type-btn').each(function(){

            let type = $(this).data('name');

            if(type === 'plot / land'){
                $(this).hide();
            }

        });

    }

    // PG
    if(selectedPurpose === 'pg'){

        $('.type-btn').each(function(){

            let type = $(this).data('name');

            if(type === 'plot / land' || type === 'farmhouse'){
                $(this).hide();
            }

        });

    }

}

});