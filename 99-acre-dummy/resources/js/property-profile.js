import $ from 'jquery';
let selectedTypeName = '';
$(document).ready(function () {

    // COMMON FUNCTION → set active class
    function setActive(group, activeBtn) {
        group.removeClass('active');
        activeBtn.addClass('active');
    }

    // ================================
    // ROOM BUTTONS (Bedrooms, Bathrooms, Balconies)
    // ================================
$(document).on('propertyTypeChanged', function (e, typeName) {

    if (!typeName) return;

    selectedTypeName = typeName;

    const type = typeName.toLowerCase();

  const category = $('#category_name').val(); 
const $furnishing = $('#furnishingWrapper');
const $ageBlock = $('#ageBlock');

$('#rentSection').append($furnishing);
$('#rentSection').append($ageBlock);
    const isPlot = type.includes('plot') || type.includes('land');
    const isStudio = type.includes('rk') || type.includes('studio');
    const isOffice = type.includes('office');
const isHospitality = type.includes('hospitality');
const isRetail = type.includes('retail');
    const purpose = parseInt($('#purpose_id').val());
    const isSell = purpose === 3;

    const bedroomBtns = $('.room-btn[data-field="bedrooms"]');
    const bathroomBtns = $('.room-btn[data-field="bathrooms"]');

    // =========================
    // ✅ STUDIO LOGIC
    // =========================
    if (isStudio) {

        bedroomBtns.each(function () {
            if ($(this).data('value') != 1) {
                $(this).prop('disabled', true).addClass('opacity-50 cursor-not-allowed');
            } else {
                $(this).prop('disabled', false).click();
            }
        });

        bathroomBtns.each(function () {
            if ($(this).data('value') != 1) {
                $(this).prop('disabled', true).addClass('opacity-50 cursor-not-allowed');
            } else {
                $(this).prop('disabled', false).click();
            }
        });

    } else {
        $('.room-btn').prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
    }

    // =========================
    // ✅ CALL PURPOSE LOGIC
    // =========================
    checkPurposeAndToggleRent();

    // =========================
    // 🔁 RESET EVERYTHING FIRST
    // =========================
    $('#plotLandSection').hide();
    $('#room-section').hide();
    $('#officeSection').addClass('hidden');
$('#hospitalitySection').hide();
$('#retailExtraSection').addClass('hidden');
    // =========================
    // 🟢 OFFICE LOGIC
    // =========================
    if (category === 'residential' && isStudio) {
        $('#room-section').show();
        return;
    }

    if (category === 'commercial' && isOffice) {
        $('#officeSection').removeClass('hidden');
          $('#officeSection').append($furnishing);

    $furnishing.removeClass('hidden');
        return;
    } else {

    // 👉 Normal flow (rent / pg)
    if (parseInt($('#purpose_id').val()) === 4 || parseInt($('#purpose_id').val()) === 5) {
        $furnishing.removeClass('hidden');
    } else {
        $furnishing.addClass('hidden');
    }

}
if (category === 'commercial' && isHospitality) {

    $('#hospitalitySection').show();

    // 🔹 Move furnishing
    $('#hospitalitySection').append($furnishing);
    $furnishing.removeClass('hidden');

    // 🔹 Move age block
    $('#hospitalitySection').append($ageBlock);
    $ageBlock.removeClass('hidden');

    return;
}
   
if (category === 'commercial' && isRetail) {

    $('#room-section').hide(); // ❌ hide rooms

    $('#retailExtraSection').removeClass('hidden'); // ✅ show washroom + parking

    return;
}
// =========================
    // 🟢 PLOT / LAND LOGIC
    // =========================
    if (isSell && isPlot) {
        $('#plotLandSection').show();
        return;
    }

    // =========================
    // 🟢 DEFAULT (ROOM SECTION)
    // =========================
    $('#room-section').show();

});
// Toggle input
$(document).on('click', '#addWashroom', function () {
    $('#washroomInputWrap').toggleClass('hidden');

    // reset chip selection
    $('.option-btn[data-field="no_of_washroom"]').removeClass('active');
});

// When user types custom value
$(document).on('input', '#customWashroom', function () {

    let value = $(this).val();

    if (value) {
        $('input[name="no_of_washroom"]').val(value);
    }
});

$(document).on('click', '.option-btn', function () {

    const field = $(this).data('field');
    const value = $(this).data('value');

    const group = $(`.option-btn[data-field="${field}"]`);

    setActive(group, $(this));
        if (field === 'no_of_washroom') {
                $('#washroomInputWrap').addClass('hidden');
                $('#customWashroom').val('');
            }

    $(`input[name="${field}"]`).val(value);
});
    $(document).on('click', '.room-btn', function () {

        const $btn = $(this);
        const field = $btn.data('field');   // bedrooms / bathrooms / balconies
        const value = $btn.data('value');

        // group = all buttons with same field
        const group = $(`.room-btn[data-field="${field}"]`);

        setActive(group, $btn);

        // set hidden input value
        $(`input[name="${field}"]`).val(value);

    });
$(document).ready(function () {

    function updateFloorDropdown() {

        let total = parseInt($('input[name="total_floors"]').val());
        let selectedFloor = $('select[name="floor_no"]').data('selected');

        let $dropdown = $('#floor_no');

        // Clear and add static options
        $dropdown.html(`
            <option value="">Property on floor</option>
            <option value="Basement">Basement</option>
            <option value="Ground">Ground</option>
        `);

        // ❗ Validation: max 90
        if (!total || total < 1) return;

        if (total > 90) {
            total = 90;
            $('input[name="total_floors"]').val(90); // reset input
        }

        // Add dynamic floors
        for (let i = 1; i <= total; i++) {
            let selected = (selectedFloor == i) ? 'selected' : '';
            $dropdown.append(`<option value="${i}" ${selected}>${i}</option>`);
        }

        // Handle Basement / Ground selection
        if (selectedFloor === 'Basement' || selectedFloor === 'Ground') {
            $dropdown.val(selectedFloor);
        }
    }

    // 🔥 Run on page load
    updateFloorDropdown();

    // 🔥 Run when user types
    $(document).on('input', 'input[name="total_floors"]', function () {
        updateFloorDropdown();
    });

});

    // ================================
    // CHIP BUTTONS (Availability & Ownership)
    // ================================
// CHIP BUTTON CLICK (UPDATED)
$(document).on('click', '.chip-btn', function () {

    const $btn = $(this);

    // ✅ SUPPORT BOTH
    const key = $btn.data('group') || $btn.data('field');
    const value = $btn.data('value');

    if (!key) {
        console.warn('Missing data-group/data-field on chip-btn');
        return;
    }

    // ✅ TARGET SAME GROUP BUTTONS
    const groupBtns = $(`.chip-btn[data-group="${key}"], .chip-btn[data-field="${key}"]`);

    groupBtns.removeClass('active');
    $btn.addClass('active');

    // ✅ SET VALUE
    $(`input[name="${key}"]`).val(value);

    // =========================
    // 🎯 SPECIAL CASE: FURNISHING
    // =========================
    if (key === 'furnishing') {

        if (value === 'Furnished' || value === 'Semi-furnished') {

            $('#furnishingDropdown')
                .removeClass('hidden');

        } else {

            $('#furnishingDropdown')
                .addClass('hidden');

            $('#furnishing_items').val('');
            $('.furnishing-item-checkbox').prop('checked', false);
        }
    }

});
// $(document).on('change', '.furnishing-item-checkbox', function () {

//     let selected = [];

//     $('.furnishing-item-checkbox:checked').each(function () {
//         selected.push($(this).val());
//     });

//     $('#furnishing_items').val(JSON.stringify(selected));

// });
    // ================================
    // FORM SUBMIT (AJAX)
    // ================================
    window.showStep = function(step) {

    $('#basicStep').hide();
    $('#locationStep').hide();
    $('#profileStep').hide();

    if (step === 'basic') {
        $('#basicStep').show();
    }

    if (step === 'location') {
        $('#locationStep').show();
    }

    if (step === 'profile') {
        $('#profileStep').show();
    }
};
window.editBasicStep = function(el) {

    let propertyId = el.getAttribute('data-id');
 let typeId = parseInt(el.getAttribute('data-type-id'));

    if (!propertyId) return;

    showStep('basic');
    goToBasic();

    $('#property_id').val(propertyId);
    $('#property_type').val(typeId);

    // ✅ CALL FUNCTION HERE
    
    let updateUrl = `/property/${propertyId}/basic/update`;
    $('#basicPropertyForm').attr('action', updateUrl);
   
      setTimeout(() => {
        checkPurposeAndToggleRent();
    }, 300);
    
};
    window.editLocationStep = function() {

    showStep('location');

};
$(document).ready(function () {

    // SHOW BUILT-UP FIELD
    $('#addBuiltup').on('click', function () {
        $('#builtupWrap').removeClass('hidden');
        $(this).hide(); // hide text after click
    });

    // SHOW SUPER BUILT-UP FIELD
    $('#addSuperBuiltup').on('click', function () {
        $('#superBuiltupWrap').removeClass('hidden');
        $(this).hide(); // hide text after click
    });

});
window.goToProfile = function(propertyId) {

    document.getElementById('locationStep').style.display = 'none';
    document.getElementById('profileStep').style.display = 'block';

    $('#property_id').val(propertyId);

    // ✅ IMPORTANT: re-check after step switch
    checkPurposeAndToggleRent();
};
// ROOM TYPE CLICK
$(document).on('click', '.room-type-btn', function () {

    $('.room-type-btn').removeClass('active');
    $(this).addClass('active');

    let value = $(this).data('value');

    $('#room_type').val(value);

    if (value === 'Sharing') {
        $('#sharingCountBlock').removeClass('hidden');
    } else {
        $('#sharingCountBlock').addClass('hidden');

        // reset
        $('.share-count-btn').removeClass('active');
        $('#room_type').val('Private');
    }
});


// SHARE COUNT CLICK
$(document).on('click', '.share-count-btn', function () {

    $('.share-count-btn').removeClass('active');
    $(this).addClass('active');

    let count = $(this).data('value');

    // combine → Sharing,3
    $('#room_type').val('Sharing,' + count);
});
// ================= PARKING =================
let covered = 0;
let open = 0;

const MAX_LIMIT = 20;

$(document).on('click', '.parking-plus', function () {
    let type = $(this).data('type');

    if (type === 'covered') {
        if (covered < MAX_LIMIT) {
            covered++;
            $('#coveredCount').text(covered);
        }
    } else {
        if (open < MAX_LIMIT) {
            open++;
            $('#openCount').text(open);
        }
    }

    updateParking();
});

$(document).on('click', '.parking-minus', function () {
    let type = $(this).data('type');

    if (type === 'covered' && covered > 0) {
        covered--;
        $('#coveredCount').text(covered);
    } else if (type === 'open' && open > 0) {
        open--;
        $('#openCount').text(open);
    }

    updateParking();
});

function updateParking() {
    let values = [];

    if (covered > 0) values.push(`Covered:${covered}`);
    if (open > 0) values.push(`Open:${open}`);

    $('#parkingInput').val(values.join(','));
}
function checkPurposeAndToggleRent() {

    let purpose = parseInt($('#purpose_id').val());

    // 🔁 RESET FIRST
    $('#rentSection').addClass('hidden');
    $('#pgOnlyFields').addClass('hidden');
    $('#rentOnlyFields').hide();

    if (purpose === 4) { // Rent

        $('#rentSection').removeClass('hidden');

        $('#furnishingBlock, #ageBlock, #availableBlock').show();

        $('#rentOnlyFields').show();
    }

    else if (purpose === 5) { // PG

        $('#rentSection').removeClass('hidden');

        $('#furnishingBlock, #ageBlock, #availableBlock').show();

        $('#rentOnlyFields').hide();

        $('#pgOnlyFields').removeClass('hidden'); // ✅ works now
    }

    else if (purpose === 3) { // Sell

        $('#rentSection').addClass('hidden');
        $('#pgOnlyFields').addClass('hidden');
    }
}
function validateProfileForm() {

    let isValid = true;

    // 🔁 Clear old errors
    $('[id^="error-"]').html('');

    function showError(field, message) {
        $(`#error-${field}`).html(message);
        isValid = false;
    }

    const purpose = parseInt($('#purpose_id').val());

    const carpet = $('input[name="carpet_area"]').val();
    // const totalFloors = $('input[name="total_floors"]').val();
    // const floorNo = $('select[name="floor_no"]').val();
    // const availability = $('input[name="availability_status"]').val();
    // const ownership = $('input[name="ownership"]').val();

    // =========================
    // BASIC VALIDATION
    // =========================
    if (!carpet) showError('carpet_area', 'Carpet area is required');

 if ($('#room-section').is(':visible')) {

        const bedrooms = $('input[name="bedrooms"]').val();
        const bathrooms = $('input[name="bathrooms"]').val();
        const balconies = $('input[name="balconies"]').val();

        if (!bedrooms) showError('bedrooms', 'Select bedrooms');
        if (!bathrooms) showError('bathrooms', 'Select bathrooms');
        if (!balconies) showError('balconies', 'Select balconies');
    }

 if ($('#rentSection').is(':visible')) {

        // 🔹 Furnishing
        if ($('#furnishingWrapper').is(':visible')) {

            const furnishing = $('input[name="furnishing"]').val();

            if (!furnishing) {
                showError('furnishing', 'Select furnishing');
            }

            // 🔹 Furnishing items (only if dropdown visible)
            if ($('#furnishingDropdown').is(':visible')) {

                const checkedItems = $('.furnishing-item-checkbox:checked').length;

                if (checkedItems === 0) {
                    showError('furnishing_items', 'Select at least one furnishing item');
                }
            }
        }

        // 🔹 Property Age
        if ($('#ageBlock').is(':visible')) {

            const age = $('input[name="property_age"]').val();

            if (!age) showError('property_age', 'Select property age');
        }

        // 🔹 Available Date
        if ($('#availableBlock').is(':visible')) {

            const date = $('input[name="property_date"]').val();

            if (!date) showError('property_date', 'Select available date');
        }

        // 🔹 Rent Only Fields
        if ($('#rentOnlyFields').is(':visible')) {

            const rentOut = $('input[name="rent_out"]').val();
            const agreement = $('input[name="agreement_type"]').val();
            const broker = $('input[name="broker_contact"]').val();

            if (!rentOut) showError('rent_out', 'Select rent out option');
            if (!agreement) showError('agreement_type', 'Select agreement type');
            if (!broker) showError('broker_contact', 'Select broker option');
        }
    }

   
// =========================
// ✅ PG SECTION VALIDATION
// =========================
if ($('#pgOnlyFields').is(':visible')) {

    // 🔹 Room Type
    if ($('#roomTypeBlock').is(':visible')) {

        const roomType = $('input[name="room_type"]').val();

        if (!roomType) {
            showError('room_type', 'Select room type');
        }

        // 🔹 Sharing count (only if sharing selected)
        if (roomType === 'Sharing' && $('#sharingCountBlock').is(':visible')) {

            const sharingCount = $('#sharingCountBlock .active').data('value');

            if (!sharingCount) {
                showError('sharing_count', 'Select sharing capacity');
            }
        }
    }

    // 🔹 Available Gender
    const gender = $('input[name="available_gender"]').val();

    if (!gender) {
        showError('available_gender', 'Select available for');
    }

    // 🔹 Suitable For (checkbox)
    const suitableChecked = $('input[name="suitable_for[]"]:checked').length;

    if (suitableChecked === 0) {
        showError('suitable_for', 'Select at least one option');
    }

}
// =========================
// ✅ FLOOR SECTION VALIDATION
// =========================
       if ($('#floorSection').is(':visible')) {

    const totalFloors = $('input[name="total_floors"]').val();
    const floorNo = $('select[name="floor_no"]').val();

    
    if (!totalFloors && totalFloors !== "0") {
        showError('total_floors', 'Enter total floors');
     
    }

   
    if (!floorNo) {
        showError('floor_no', 'Select floor');
       
    }
}

// =========================
// PLOT LAND VALIDATION
// =========================
if ($('#plotLandSection').is(':visible')) {

    const boundary = $('input[name="boundary_wall"]').val();
    const openSides = $('input[name="open_sides"]').val();
    const construction = $('input[name="is_construction"]').val();
    const possession = $('select[name="property_possesion"]').val();

    if (!boundary) {
        showError('boundary_wall', 'Select boundary wall option');
    }

    if (!openSides) {
        showError('open_sides', 'Select open sides');
    }

    if (!construction) {
        showError('is_construction', 'Select construction status');
    }

    if (!possession) {
        showError('property_possesion', 'Select possession');
    }
}

// =========================
// ✅ AVAILABILITY VALIDATION
// =========================
// =========================
// AVAILABILITY
// =========================
if ($('#availabilitySection').is(':visible')) {

    const availability = $('input[name="availability_status"]').val();

    if (!availability) {
        showError('availability_status', 'Select availability status');
    }
}

// =========================
// OWNERSHIP
// =========================
if ($('#ownershipSection').is(':visible')) {

    const ownership = $('input[name="ownership"]').val();

    if (!ownership) {
        showError('ownership', 'Select ownership');
    }
}

// ✅ HOSPITALITY VALIDATION

if ($('#hospitalitySection').is(':visible')) {

    const quality = $('input[name="quality_ratings"]').val();
    const washroom = $('input[name="no_of_washroom"]').val();
    // const customWashroom = $('#customWashroom').val();

    // 🔹 Quality Rating
    if (!quality) {
        showError('quality_ratings', 'Select quality rating');
    }

    // 🔹 Washroom logic
    if (!washroom ) {
        showError('no_of_washroom', 'Select  washrooms');
    }
}
    return isValid;
}

$(document).on('input change', 'input, select', function () {
    const name = $(this).attr('name');
    $(`#error-${name}`).html('');
});
// call on page load
$(document).ready(function () {
    checkPurposeAndToggleRent();
});
    $('#propertyProfileForm').on('submit', function (e) {

        e.preventDefault();
        if (!validateProfileForm()) {
                return;
            }
        let form = $(this);
        let formData = form.serialize();

        let propertyId = $('#property_id').val();
console.log($('#propertyProfileForm').serialize());
        $.ajax({
            url: `/property/${propertyId}/profile`,
            type: "POST",
            data: formData,

            success: function (response) {

                if (response.success) {

                    alert('Property Profile Saved ✅');

                    // 👉 next step (optional future)
                    // goToNextStep();

                }

            },

            error: function (xhr) {
                console.log(xhr.responseText);
            }

        });

    });

});