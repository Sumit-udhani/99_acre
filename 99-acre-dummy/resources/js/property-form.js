import $ from 'jquery';

$(function () {

const $app = $('#propertyApp');
const isAuthenticated = $app.data('auth') === 1;

let selectedPurpose = null,
    selectedCategory = null,
    selectedCategoryName = null,
    selectedTypeId = null;

const $types = $('.type-btn'),
      $subWrap = $('.subtypes-wrapper'),
      $subList = $('.subtype-list'),
      $locWrap = $('.location-wrapper'),
      $locList = $('.location-list');


// helper: activate button
function setActive($group, $el){
    $group.removeClass('active');
    $el.addClass('active');
}


// helper: ajax loader
function loadOptions(url, $wrapper, $list, btnClass){

    $.get(url, function(res){

        if(!res.length){
            $wrapper.hide();
            return;
        }

        const html = res.map(i => `
            <button type="button"
                class="btn purpose-btn ${btnClass}"
                data-id="${i.id}">
                ${i.name}
            </button>
        `).join('');

        $list.html(html);
        $wrapper.show();

    });

}


// INIT DEFAULT
initDefaults();


// PURPOSE CLICK
$(document).on('click','.purpose-group .purpose-btn',function(){

    const $btn = $(this);

    setActive($('.purpose-group .purpose-btn'), $btn);

    selectedPurpose = $btn.data('name');

    $('#purpose_id').val($btn.data('id'));

    filterCategories();
    filterPurposes();
    filterTypes();

});


// CATEGORY CHANGE
$(document).on('change','.category-radio',function(){

    selectedCategory = $(this).val();
    selectedCategoryName = $(this).data('name');

    filterPurposes();
    filterTypes();

});


// TYPE CLICK
$(document).on('click','.type-btn',function(){

    const $btn = $(this);

    setActive($('.type-btn'), $btn);

    selectedTypeId = $btn.data('id');

    $('#type_id').val(selectedTypeId);

    $('#subtype-label').text('Your '+$btn.data('name')+' type is ...');

    resetLocations();

    loadOptions(`/get-subtypes/${selectedTypeId}`, $subWrap, $subList, 'subtype-btn');

});


// SUBTYPE CLICK
$(document).on('click','.subtype-btn',function(){

    setActive($('.subtype-btn'), $(this));

    loadOptions(`/get-location-types/${selectedTypeId}`, $locWrap, $locList, 'location-btn');

});


// LOCATION CLICK
$(document).on('click','.location-btn',function(){

    const $btn = $(this);

    setActive($('.location-btn'), $btn);

    $('#location_type_id').val($btn.data('id'));

});


// AUTH CHECK
$(document).on('click','.phone-field, .start-btn',function(e){

    if(!isAuthenticated){

        e.preventDefault();

        window.dispatchEvent(
            new CustomEvent('open-modal',{detail:'auth-modal'})
        );

    }

});


// DEFAULT INIT
function initDefaults(){

    const $purpose = $('.purpose-btn[data-name="sell"]');
    const $category = $('.category-radio[data-name="residential"]');

    $purpose.addClass('active');
    selectedPurpose = $purpose.data('name');
    $('#purpose_id').val($purpose.data('id'));

    $category.prop('checked',true);
    selectedCategory = $category.val();
    selectedCategoryName = $category.data('name');

    filterCategories();
    filterPurposes();
    filterTypes();

}


// FILTER PURPOSES
function filterPurposes(){

    $('.purpose-btn').show();

    if(selectedCategory === 'commercial'){
        $('.purpose-btn[data-name="pg"]').hide();
    }

}


// FILTER CATEGORIES
function filterCategories(){

    $('.category-radio').prop('disabled',false);

    if(selectedPurpose === 'pg'){
        $('.category-radio[data-name="commercial"]').prop('disabled',true);
    }

}


// FILTER TYPES
function filterTypes(){

    $types.hide().filter(function(){
        return $(this).data('category') == selectedCategory;
    }).show();

    applyPurposeRules();

}


// PURPOSE RULES
function applyPurposeRules(){

    if(selectedPurpose === 'rent / lease' && selectedCategoryName === 'residential'){
        $types.filter('[data-name="plot / land"]').hide();
    }

    if(selectedPurpose === 'pg'){
        $types.filter('[data-name="plot / land"],[data-name="farmhouse"],[data-name="other"]').hide();
    }

}


// RESET LOCATION
function resetLocations(){

    $locWrap.hide();
    $locList.html('');

}


// AUTO LOGIN MODAL
document.addEventListener("DOMContentLoaded",function(){

    const params = new URLSearchParams(window.location.search);

    if(params.get("openLoginModal") === "1"){

        window.dispatchEvent(
            new CustomEvent('open-modal',{detail:'auth-modal'})
        );

    }

});

});