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


    // ================================
    // CHIP BUTTONS (Availability & Ownership)
    // ================================
  $(document).on('click', '.chip-btn', function () {

    const $btn = $(this);
    const group = $btn.data('group'); // ✅ dynamic field name
    const value = $btn.data('value');

    // get all buttons of same group
    const groupBtns = $(`.chip-btn[data-group="${group}"]`);

    // set active
    groupBtns.removeClass('active');
    $btn.addClass('active');

    // set hidden input value
    $(`input[name="${group}"]`).val(value);

});

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

    if (!propertyId) return;
showStep('basic');
    goToBasic();

    $('#property_id').val(propertyId);

    let updateUrl = `/property/${propertyId}/basic/update`;
    $('#basicPropertyForm').attr('action', updateUrl);
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
function checkPurposeAndToggleRent() {

    let purpose = parseInt($('#purpose_id').val());

   
    if (purpose === 4) {
        $('#rentSection').removeClass('hidden');
    } else {
        $('#rentSection').addClass('hidden');
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