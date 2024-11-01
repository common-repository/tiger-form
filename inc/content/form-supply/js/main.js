jQuery(document).ready(function ($) {

    if ($('.dfu-form').find('.dfu-missing-error').length > 0) {
        $('.dfu-missing-error').parents('form').find('button').prop('disabled', true);
    }
    $('.dfu-number-field').on('input keyup blur', function () {
        $(this).next('.inline-err').remove();
        if ($(this).attr('readonly') == undefined) {
            if (!/^\d+$/.test($(this).val())) {
                $(this).css('box-shadow', '0px 0px 3px #ff7a7a');
                $(this).parent('div').append('<div class="inline-err">Please enter a numeric value.</div>');
                $(this).val('');
            } else {
                $(this).css('box-shadow', '');
                $(this).next('.inline-err').remove();
            }
        }
    });
    $('.dfu-input').on('click', function () {
        $(this).css('box-shadow', '');
        if ($(this).next('.inline-err').length > 0) {
            $(this).next('.inline-err').remove();
        }
    });
    $('.dfu-number-field').on('click', function () {
        $(this).prev('.dfu-label').find('.dfu-length-text').remove();
        if ($(this).attr('maxlength') != undefined) {
            $(this).prev('.dfu-label').append('<span class="dfu-length-text"> Allowed Max length:' + $(this).attr('maxlength') + ',');
        }
        if ($(this).attr('minlength') != undefined) {
            $(this).prev('.dfu-label').append('<span class="dfu-length-text"> Allowed Min length:' + $(this).attr('minlength'));
        }
    });
    $('.dfu-input-btn').on('click', function (evt) {
        evt.preventDefault();
        var err = [];
        $(this).next('.dfu-spiner').css('display', 'inline');
        $(this).parents('form').find('.inline-err').remove();
        $(this).attr("disabled", true);
        var inputBtnSelf = $(this).parents('form');
        $(this).parents('form').find('.dfu-input-div').each(function () {
            if ($(this).hasClass('dfu-required') && $.trim($(this).find('.dfu-input').val()) == '') {
                $(this).find('.dfu-input').css('box-shadow', '0px 0px 3px #ff7a7a');
                $(this).append('<div class="inline-err required-err"></div>');
                err.push('required-Err');
            } else if ($(this).find('.dfu-input').hasClass('dfu-email-field') && $.trim($(this).find('.dfu-input').val()) != '') {
                var getEmail = $(this).find('.dfu-email-field').val();
                var emailRegex = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if (!emailRegex.test(getEmail)) {
                    $(this).append('<div class="inline-err email-err"></div>');
                    $(this).find('.dfu-email-field').css('box-shadow', '0px 0px 3px #ff7a7a');
                    err.push('email-Err');
                }
            } else if ($(this).find('.dfu-input').hasClass('dfu-number-field') && $.trim($(this).find('.dfu-input').val()) != '') {
                if ($(this).find('.dfu-number-field').attr('maxlength') != undefined) {
                    var getMaxLength = $(this).find('.dfu-number-field').attr('maxlength');
                    var getValLength = $(this).find('.dfu-number-field').val().length;
                    if (getValLength > getMaxLength) {
                        $(this).append('<div class="inline-err maxlength-err"></div>');
                        $(this).find('.dfu-email-field').css('box-shadow', '0px 0px 3px #ff7a7a');
                        err.push('maxlength-Err');
                    }
                }
                if ($(this).find('.dfu-number-field').attr('minlength') != undefined) {
                    var getminLength = $(this).find('.dfu-number-field').attr('minlength');
                    var getValLength = $(this).find('.dfu-number-field').val().length;
                    if (getValLength < getminLength) {
                        $(this).append('<div class="inline-err minlength-err"></div>');
                        $(this).find('.dfu-email-field').css('box-shadow', '0px 0px 3px #ff7a7a');
                        err.push('minlength-Err');
                    }
                }
            } else if ($(this).find('.dfu-input').hasClass('dfu-url-field') && $.trim($(this).find('.dfu-input').val()) != '') {
                var getUrl = $(this).find('.dfu-url-field').val();
                var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|http:\/\/|https:\/\/){1}([0-9A-Za-z]+\.)");
                if (!urlregex.test(getUrl)) {
                    $(this).append('<div class="inline-err url-err"></div>');
                    $(this).find('.dfu-url-field').css('box-shadow', '0px 0px 3px #ff7a7a');
                    err.push('url-Err');
                }
            }

        });
        var getNonce = $(this).parents('form').find('.wp_nonce').val();
        var getcurrentpost = $(this).parents('form').find('.postid').val();
        var getFormId = $(this).parents('form').find('.form-id').val();
        var getAnotherId = $(this).parents('form').data('formname');
        var idRedefine = getAnotherId.split('-');
        if (getFormId == '') {
            getFormId = idRedefine[2];
        }
        if (err.length > 0) {
            $.ajax({
                type: "POST",
                url: dfuFrontAlert.admin_ajax,
                dataType: "json",
                data: {action: 'difu_form_alert_messages', nonce: getNonce, formId: getFormId},
                success: function (returnAllert) {
                    if (returnAllert['value'] == 'failednonce') {
                        inputBtnSelf.prev('.dfu-alert-msg-' + idRedefine[2]).find('.dfu-validate-error').remove();
                        inputBtnSelf.prev('.dfu-alert-msg-' + idRedefine[2]).find('.dfu-validate-success').remove();
                        inputBtnSelf.prev('.dfu-alert-msg-' + idRedefine[2]).append('<div class="dfu-validate-error">Change detected ! Security token verification failed, reload and try again.</div>');
                    }
                    if (returnAllert['value'] == 'success') {
                        var getAllAlert = returnAllert['data'].split('-');
                        if (inputBtnSelf.find('.required-err').length > 0) {
                            $('.required-err').html(getAllAlert[3]);
                        }
                        if (inputBtnSelf.find('.email-err').length > 0) {
                            $('.email-err').html(getAllAlert[4]);
                        }
                        if (inputBtnSelf.find('.maxlength-err').length > 0) {
                            $('.maxlength-err').html(getAllAlert[6]);
                        }
                        if (inputBtnSelf.find('.minlength-err').length > 0) {
                            $('.minlength-err').html(getAllAlert[7]);
                        }
                        if (inputBtnSelf.find('.url-err').length > 0) {
                            $('.url-err').html(getAllAlert[5]);
                        }
                        inputBtnSelf.prev('.dfu-alert-msg-' + getFormId).find('.dfu-validate-error').remove();
                        inputBtnSelf.prev('.dfu-alert-msg-' + idRedefine[2]).find('.dfu-validate-success').remove();
                        inputBtnSelf.prev('.dfu-alert-msg-' + getFormId).append('<div class="dfu-validate-error">' + getAllAlert[2] + '</div>');
                    }
                    inputBtnSelf.find('.dfu-spiner').css('display', '');
                    var formHeight = inputBtnSelf.height();
                    if (formHeight > $(window).height()) {
                        $('html, body').animate({
                            scrollTop: inputBtnSelf.prev('.dfu-alert-msg-' + getFormId).offset().top - 50
                        }, 1000);
                    }
                }
            });
        }
        if (err.length == 0) {
            var pushArr = [];
            var count = 1;
            var getFormName = $(this).parents('form').data('formname');
            $(this).parents('form').find('.dfu-input').each(function () {
                if ($(this).attr('data-unique') != undefined && $(this).data('unique') == 'yes') {
                    var getAttrName = $(this).attr('name');
                    var getAttrType = $(this).attr('type');
                    var getVal = $(this).val();
                    $(this).attr('id', getAttrName);
                    $.ajax({
                        type: "POST",
                        url: dfuFrontAlertEx.admin_ajax,
                        dataType: "json",
                        async: false,
                        data: {
                            action: 'difu_form_alert_unique_validate',
                            fieldId: getAttrName,
                            name: getAttrType + '-' + getAttrName,
                            val: getVal,
                            formId: getFormId,
                            wp_nonce: getNonce,
                            getcurrentpost: getcurrentpost
                        },
                        success: function (returnAllertEx) {
                            $('#' + getFormName).find('.dfu-spiner').css('display', '');
                            if (returnAllertEx['status'] == 'failed') {
                                err.push('validate-err');
                                inputBtnSelf.prev('.dfu-alert-msg-' + idRedefine[2]).find('.dfu-validate-error').remove();
                                inputBtnSelf.prev('.dfu-alert-msg-' + idRedefine[2]).find('.dfu-validate-success').remove();
                                inputBtnSelf.prev('.dfu-alert-msg-' + idRedefine[2]).append('<div class="dfu-validate-error">Change detected ! Security token verification failed, reload and try again.</div>');
                                inputBtnSelf.find('.dfu-spiner').css('display', '');
                                var formHeight = inputBtnSelf.height();
                                if (formHeight > $(window).height()) {
                                    $('html, body').animate({
                                        scrollTop: -50
                                    }, 1000);
                                }
                            }
                            if (returnAllertEx['status'] == 'success' && returnAllertEx['value'] == 'Found') {
                                pushArr.push('exists-arr');
                                $("#" + returnAllertEx['name']).parent('div').append('<div class="inline-err exists-err">This field data is already exists, try using another one.</div>');
                                inputBtnSelf.prev('.dfu-alert-msg-' + getFormId).find('.dfu-validate-error').remove();
                                inputBtnSelf.prev('.dfu-alert-msg-' + idRedefine[2]).find('.dfu-validate-success').remove();
                                inputBtnSelf.prev('.dfu-alert-msg-' + getFormId).append('<div class="dfu-validate-error">' + returnAllertEx['errorMsg'] + '</div>');
                                inputBtnSelf.find('.dfu-spiner').css('display', '');
                                var formHeight = inputBtnSelf.height();
                                if (formHeight > $(window).height()) {
                                    $('html, body').animate({
                                        scrollTop: inputBtnSelf.prev('.dfu-alert-msg-' + getFormId).offset().top - 50
                                    }, 1000);
                                }
                            }
                        }
                    });
                }
            });
        }
        if (err.length == 0 && pushArr.length == 0) {
            $(this).next('.dfu-spiner').css('display', 'inline');
            var getFormName = $(this).parents('form').data('formname');
            var formData = inputBtnSelf.serializeArray();
            formData.push({name: 'action', value: 'difu_forntend_data_submit'});
            $.ajax({
                type: "POST",
                url: dfuFrontInsert.admin_ajax,
                dataType: "json",
                data: formData,
                success: function (res) {
                    if (res['value'] == 'success') {
                        inputBtnSelf.prev('.dfu-alert-msg-' + getFormId).find('.dfu-validate-error').remove();
                        inputBtnSelf.prev('.dfu-alert-msg-' + idRedefine[2]).find('.dfu-validate-success').remove();
                        inputBtnSelf.find('.dfu-input').val('');
                        inputBtnSelf.find('.dfu-spiner').css('display', 'inline');
                        inputBtnSelf.prev('.dfu-alert-msg-' + idRedefine[2]).append('<div class="dfu-validate-success">' + res["Msg"] + '</div>');
                        inputBtnSelf.find('.dfu-spiner').css('display', '');
                        var formHeight = inputBtnSelf.height();
                        if (formHeight > $(window).height()) {
                            $('html, body').animate({
                                scrollTop: inputBtnSelf.prev('.dfu-alert-msg-' + getFormId).offset().top - 50
                            }, 1000);
                        }
                    }
                }
            });

        }
        $(this).attr("disabled", false);
    });
});