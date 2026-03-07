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

$('.purpose-btn[data-name="sell"]').trigger('click');

// DEFAULT CATEGORY
$('.category-radio[data-name="residential"]')
.prop('checked', true)
.trigger('change');
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
// TYPE CLICK
$(document).on('click','.type-btn',function(){

    $('.type-btn').removeClass('active');
    $(this).addClass('active');

    let typeId = $(this).data('id');
  let typeName = $(this).data('name');

    
    $('#subtype-label').text('Your ' + typeName + ' type is ...');
    loadSubTypes(typeId);


});
function loadSubTypes(typeId){

$.ajax({

    url:'/get-subtypes/'+typeId,
    type:'GET',

    success:function(response){

        let html = '';

        if(response.length > 0){

            response.forEach(function(subtype){

                html += `
                <button 
                type="button"
                class="btn purpose-btn subtype-btn"
                data-id="${subtype.id}">
                ${subtype.name}
                </button>
                `;

            });

            $('.subtype-list').html(html);
            $('.subtypes-wrapper').show();

        }else{

            $('.subtypes-wrapper').hide();

        }

    }

});

}
});