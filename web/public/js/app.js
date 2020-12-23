$(function () {

    // default setup
    $('.js-review-response').hide();
    $('.js-review-error-response').hide();

    $('body').on('focus', ".date", function () {
        $(this).datepicker({
            format: 'dd.mm.yyyy',
            autoclose: true,
        });
    });

    $('#delete-entity').on('show.bs.modal', function (e) {
        //populate the form action
        $('#modal-question').html($(e.relatedTarget).data('question'));
        $('#destroy-entity').attr('action', $(e.relatedTarget).data('url'));
    });

    $("#addMoreItems").on('click', function (e) {
        e.preventDefault();

        let html = `<div class="position-relative margin-top20 row">
            <div class="col-10">
                <label>Image <small>(max size 2 MB)</small></label>
                <input type="file" name="images[]" class="minimal"/>
            </div>
        </div>`;
        $("#moreFields").append(html);
    });

    $("#moreFields").on("click", "a.remove-item", function (e) {
        e.preventDefault();
        $(this).parent().remove();
    });

    $(document).on('click', '[data-toggle="lightbox"]', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });

    // send product review
    $('#review-submit').on('click', function (e) {
        e.preventDefault();
        $('.js-review-response').hide();
        $('.js-review-error-response').hide();

        var data = $('#reviewform').serialize();

        $.ajax({
            type: "POST",
            url: $('#reviewform').data('url'),
            async: true,
            data: data,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.status == 1) {
                    $('.js-review-response').html(response.msg).show();
                    $('.js-review-error-response').hide();
                    $("#reviewform").trigger('reset');
                } else {
                    $('.js-review-error-response').html(response.msg).show();
                    $('.js-review-response').hide();
                }
            },
            error: function (xhr) {
                $('.js-review-error-response').html('');
                $.each(xhr.responseJSON.errors, function (key, value) {
                    $('.js-review-error-response').append('<div class="alert alert-danger">' + value + '</div');
                });
                $('.js-review-error-response').show();
            }
        });
    });
})