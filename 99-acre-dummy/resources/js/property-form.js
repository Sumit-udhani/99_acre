import $ from 'jquery';

$(function () {

let selectedPurpose=null,
    selectedCategory=null,
    selectedCategoryName=null,
    selectedTypeId=null;

const $types=$('.type-btn'),
      $subWrap=$('.subtypes-wrapper'),
      $subList=$('.subtype-list'),
      $locWrap=$('.location-wrapper'),
      $locList=$('.location-list');


// INIT DEFAULT SELECTION
initDefaults();


// PURPOSE CLICK
$(document).on('click','.purpose-group .purpose-btn',function(){

    $('.purpose-group .purpose-btn').removeClass('active');
    $(this).addClass('active');

    selectedPurpose=$(this).data('name');

    filterCategories();
    filterPurposes();
    filterTypes();

}); 

// CATEGORY CHANGE
$(document).on('change','.category-radio',function(){

    selectedCategory=$(this).val();
    selectedCategoryName=$(this).data('name');

    filterPurposes();
    filterTypes();

});


// TYPE CLICK
$(document).on('click','.type-btn',function(){

    $('.type-btn').removeClass('active');
    $(this).addClass('active');

    selectedTypeId=$(this).data('id');

    $('#subtype-label').text('Your '+$(this).data('name')+' type is ...');

    resetLocations();

    loadSubTypes(selectedTypeId);

});


// SUBTYPE CLICK
$(document).on('click','.subtype-btn',function(){

    $('.subtype-btn').removeClass('active');
    $(this).addClass('active');

    loadLocations(selectedTypeId);

});
$(document).on('click','.location-btn',function(){

    $('.location-btn').removeClass('active');
    $(this).addClass('active');

});
const isAuthenticated =
document.getElementById('propertyApp').dataset.auth === '1';

$(document).on('click', '.phone-field, .start-btn', function(e){



if(!isAuthenticated){

e.preventDefault()

window.dispatchEvent(
new CustomEvent('open-modal', { detail: 'auth-modal' })
)

}

})
// DEFAULT INIT
function initDefaults(){

    let $purpose=$('.purpose-btn[data-name="sell"]');
    let $category=$('.category-radio[data-name="residential"]');

    $purpose.addClass('active');
    selectedPurpose=$purpose.data('name');

    $category.prop('checked',true);
    selectedCategory=$category.val();
    selectedCategoryName=$category.data('name');

    filterCategories();
    filterPurposes();
    filterTypes();
}


// FILTER PURPOSES
function filterPurposes(){

    $('.purpose-btn').show();

    if(selectedCategory==='commercial'){
        $('.purpose-btn[data-name="pg"]').hide();
    }

}


// FILTER CATEGORIES
function filterCategories(){

    $('.category-radio').prop('disabled',false);

    if(selectedPurpose==='pg'){
        $('.category-radio[data-name="commercial"]').prop('disabled',true);
    }

}


// FILTER TYPES
function filterTypes(){

    $types.hide().filter(function(){
        return $(this).data('category')==selectedCategory;
    }).show();

    applyPurposeRules();

}


// PURPOSE RULES
function applyPurposeRules(){

    if(selectedPurpose==='rent / lease' && selectedCategoryName==='residential'){
        $types.filter('[data-name="plot / land"]').hide();
    }

    if(selectedPurpose==='pg'){
        $types.filter('[data-name="plot / land"],[data-name="farmhouse"],[data-name="other"]').hide();
    }

}
document.addEventListener("DOMContentLoaded", function () {

    const params = new URLSearchParams(window.location.search);

    if (params.get("openLoginModal") === "1") {

        window.dispatchEvent(
            new CustomEvent('open-modal', { detail: 'auth-modal' })
        );

    }

});

// LOAD SUBTYPES
function loadSubTypes(typeId){

$.get('/get-subtypes/'+typeId,function(res){

    if(!res.length){
        $subWrap.hide();
        return;
    }

    let html=res.map(s=>`
        <button type="button"
        class="btn purpose-btn subtype-btn"
        data-id="${s.id}">
        ${s.name}
        </button>
    `).join('');

    $subList.html(html);
    $subWrap.show();
    resetLocations();

});

}


// LOAD LOCATIONS
function loadLocations(typeId){

$.get('/get-location-types/'+typeId,function(res){

    if(!res.length){
        resetLocations();
        return;
    }

    let html=res.map(l=>`
        <button type="button"
        class="btn purpose-btn location-btn"
        data-id="${l.id}">
        ${l.name}
        </button>
    `).join('');

    $locList.html(html);
    $locWrap.show();

});

}


// RESET LOCATION
function resetLocations(){
    $locWrap.hide();
    $locList.html('');
}

});