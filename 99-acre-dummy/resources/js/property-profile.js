import $ from 'jquery';
console.log('Property')
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

    const isStudio = typeName.toLowerCase().includes('rk') || 
                     typeName.toLowerCase().includes('studio');

    const bedroomBtns = $('.room-btn[data-field="bedrooms"]');
    const bathroomBtns = $('.room-btn[data-field="bathrooms"]');

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
    const group = $btn.data('group');
    const value = $btn.data('value');

    const groupBtns = $(`.chip-btn[data-group="${group}"]`);

    groupBtns.removeClass('active');
    $btn.addClass('active');

    $(`input[name="${group}"]`).val(value);

    // ✅ SHOW DROPDOWN ONLY FOR furnishing / semi-furnished
    if (group === 'furnishing') {

        if (value === 'Furnished' || value === 'Semi-furnished') {

            $('#furnishingDropdown')
                .removeClass('hidden')
                .attr('x-show', 'true');

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

    if (purpose === 4) {
        $('#rentSection').removeClass('hidden');

        $('#furnishingBlock, #ageBlock, #availableBlock').show();
        $('#rentOnlyFields').show();
        $('#pgOnlyFields').hide();
    }

    else if (purpose === 5) {
        $('#rentSection').removeClass('hidden');

        $('#furnishingBlock, #ageBlock, #availableBlock').show();
        $('#rentOnlyFields').hide();
        $('#pgOnlyFields').removeClass('hidden'); // ✅ NEW
    }

   else if (purpose === 3) {
        $('#rentSection').addClass('hidden');
        $('#pgOnlyFields').addClass('hidden'); // ✅ NEW

    }
}
// call on page load
$(document).ready(function () {
    checkPurposeAndToggleRent();
});
    $('#propertyProfileForm').on('submit', function (e) {

        e.preventDefault();

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