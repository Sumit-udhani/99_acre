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
        const field = $btn.attr('onclick')?.includes('availability_status')
            ? 'availability_status'
            : 'ownership';

        // better way: detect by closest section
        if ($btn.closest('div').prev('h3').text().includes('Availability')) {
            setActive($('.chip-btn').filter(function () {
                return $(this).closest('div').prev('h3').text().includes('Availability');
            }), $btn);

            $('input[name="availability_status"]').val($btn.text());
        } else {
            setActive($('.chip-btn').filter(function () {
                return $(this).closest('div').prev('h3').text().includes('Ownership');
            }), $btn);

            $('input[name="ownership"]').val($btn.text());
        }

    });


    // ================================
    // FORM SUBMIT (AJAX)
    // ================================
    window.editLocationStep = function() {

    $('#profileStep').hide();
    $('#locationStep').show();

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