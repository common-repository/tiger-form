<?php
function difu_data_insert_form_ultimate_add_new_form()
{
    global $tiger_form_materials;
    if (!current_user_can('administrator')) {
        echo '<h1>You have no permission to access this page.</h1>';
        return;
    } else {
        ?>
        <div class="wrap">
            <h1 class="wp-heading-inline"><?php esc_html_e(get_admin_page_title()); ?></h1>
            <hr class="wp-header-end">
            <div class="error-occured">
            </div>
            <form action="" method="POST" class="dfu-form-main" name="dfu-form-main">
                <input type="hidden" name="dfu-nonce" value="<?php echo wp_create_nonce('dfu-validate-my-nonce'); ?>">
                <div id="poststuff">
                    <div id="post-body" class="metabox-holder columns-2">
                        <div id="post-body-content" style="position: relative;">
                            <div id="titlediv">
                                <div id="titlewrap">
                                    <label class="" id="title-prompt-text" for="title"></label>
                                    <input type="text" name="data_form_title" size="30"
                                           placeholder="Enter Your Title Here" value="" id="title" spellcheck="true"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="data-form-ultimate-content " oncontextmenu="return false">
                                <div class="form-tab">
                                    <ul>
                                        <li><a href="javascript:void(0)" class="content-type" data-id="form"
                                               style="background: #fff; border-bottom: 1px solid #fff;">Form</a></li>
                                        <li><a href="javascript:void(0)" class="content-type" data-id="messages"
                                               style="border-right: 1px solid #7e8993;">Alert Messages</a></li>
                                        <li><a href="javascript:void(0)" class="content-type" data-id="notify"
                                               style="border-right: 1px solid #7e8993;">Notification</a></li>
                                    </ul>
                                </div>
                                <div class="form-content-common" id="form">
                                    <p class="form-title">Data Form</p>
                                    <ul class="short-tab">
                                        <li class="short-tab-li"><a href="javascript:void(0)" data-id="text"
                                                                    class="short-tab-added">text</a></li>
                                        <li class="short-tab-li"><a href="javascript:void(0)" data-id="email"
                                                                    class="short-tab-added">email</a></li>
                                        <li class="short-tab-li"><a href="javascript:void(0)" data-id="url"
                                                                    class="short-tab-added">url</a></li>
                                        <li class="short-tab-li"><a href="javascript:void(0)" data-id="date"
                                                                    class="short-tab-added">date</a></li>
                                        <li class="short-tab-li"><a href="javascript:void(0)" data-id="number"
                                                                    class="short-tab-added">number</a></li>
                                        <li class="short-tab-li"><a href="javascript:void(0)" data-id="textarea"
                                                                    class="short-tab-added">text area</a></li>
                                        <li class="short-tab-li"><a href="javascript:void(0)" data-id="select"
                                                                    class="short-tab-added">select dropdown</a></li>
                                        <li class="short-tab-li"><a href="javascript:void(0)" data-id="radio"
                                                                    class="short-tab-added">radio button</a></li>
                                        <li class="short-tab-li"><a href="javascript:void(0)" data-id="checkbox"
                                                                    class="short-tab-added">check box</a></li>
                                        <li class="short-tab-li"><a href="javascript:void(0)" data-id="submit"
                                                                    class="short-tab-added">submit button</a></li>
                                    </ul>
                                    <div class="data-form-content-inner content-form-demo">
                                        <div class="difu-form-demo difu-add-newform">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-content-common" id="messages" style="display: none;">
                                    <p class="form-title">Alert Messages</p>
                                    <div class="data-form-content-inner">
                                        <label>If data sent successfully</label>
                                        <input type="text" name="successful-msg"
                                               value="Your data has been sent successfully." maxlength="250" class="msg"
                                               id="success-msg">
                                        <label>If data failed to send</label>
                                        <input type="text" name="faild-msg"
                                               value="There was an error trying to send your data. Please try again later."
                                               maxlength="250" class="msg" id="failed-msg">
                                        <label>If validation errors occurred</label>
                                        <input type="text" name="error-msg"
                                               value="One or more fields have an error. Please check and try again."
                                               maxlength="250" class="msg" id="error-msg">
                                        <label>Field must fill in</label>
                                        <input type="text" name="required-msg" value="*Required field." maxlength="250"
                                               class="msg" id="required-msg">
                                        <label>If email that sender entered is invalid format</label>
                                        <input type="text" name="email-invalid-msg" value="Invalid email address."
                                               maxlength="250" class="msg" id="email-msg">
                                        <label>If URL that the sender entered is invalid</label>
                                        <input type="text" name="url-invalid-msg" value="URL is Invalid."
                                               maxlength="250" class="msg" id="url-msg">
                                        <label>If Number is larger than maximum limit</label>
                                        <input type="text" name="number-max-msg"
                                               value="Number is larger than the maximum allowed." maxlength="250"
                                               class="msg" id="number-msg-1">
                                        <label>If Number is smaller than minimum limit</label>
                                        <input type="text" name="number-min-msg"
                                               value="Number is smaller than the minimum allowed." maxlength="250"
                                               class="msg" id="number-msg-2">
                                    </div>
                                </div>
                                <div class="form-content-common" id="notify" style="display: none;">
                                    <p class="form-title">Notification Setting</p>
                                    <div class="data-form-content-inner">
                                        <label style="display: block;">Send me notification email when data
                                            inserted </label>
                                        <input type="checkbox" name="notify-allow" value="yes" class="dfu-notification"
                                               style="width: 10px; margin-left: 10px; margin-top: 8px;">
                                        <div class="notify-hidden" style="display: none; margin-top: 15px;">
                                            <label>Enter email address</label>
                                            <input type="email" name="notify-email" value="" class="notify-email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="postbox-container-1" class="postbox-container">
                            <div id="side-sortables" class="meta-box-sortables ui-sortable" style="">
                                <div id="submitdiv" class="postbox ">
                                    <h3>Status</h3>
                                    <div class="inside">
                                        <div class="submitbox" id="submitpost">
                                            <div id="minor-publishing-actions">
                                            </div>
                                            <div id="misc-publishing-actions">
                                            </div>
                                            <div id="major-publishing-actions">
                                                <div id="publishing-action">
                                                    <span class="spinner spinner-save"></span>
                                                    <button type="button" class="button-primary dfu-form-save"
                                                            name="dfu-form-save"> Save
                                                    </button>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="informationdiv" class="postbox">
                                    <h3>Do you need help?</h3>
                                    <div class="inside">
                                        <p>Here are some available options to help solve your problems.</p>
                                        <ol>
                                            <li><a href="https://wordpress.org/plugins/tiger-form/"
                                                   target="_blank">FAQ</a> and <a
                                                        href="https://wordpress.org/plugins/tiger-form/"
                                                        target="_blank">docs</a></li>
                                            <li>Developer Support: <a href="mailto:jakirhosen@yahoo.com">jakirhosen@yahoo.com</a>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                                <div id="informationdiv" class="postbox">
                                    <h3>Developer Info</h3>
                                    <div class="inside">
                                        <center>
                                            <h2>MD. Jakir Hosen</h2>
                                            <span>Dhaka, Bangladesh.
                                        <center><a href="https://www.linkedin.com/in/jakir-rony" target="_blank">More info</a></center></span>
                                            <p><a href="mailto:jakirhosen@yahoo.com">Donate</a> to more better update.
                                            </p>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="hidden-div" id="text" style="display: none;" oncontextmenu="return false">
            <div class="hidden-content">
                <div class="dfu-content-heading">
                    <p class="dfu-hidden-content-title">Tiger Form Text Field Generator</p>
                    <span class="dashicons dashicons-no-alt dfu-hidden-content-close"></span>
                </div>
                <div class="dfu-content-inner">
                    <table class="dfu-jquery-action-table">
                        <tbody>
                        <tr scope="row">
                            <td class="cel-1"><label>Field is Required:</label></td>
                            <td class="cel-2"><input type="checkbox" name="text-field-required" data-type="text"
                                                     class="required-field difu-field-reset-check" value="yes"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="It specifies that input field must be filled out before submitting the form."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field Label:</label></td>
                            <td class="cel-2"><input type="text" name="text-field-label"
                                                     class="label-field text-common-feild difu-field-reset"
                                                     data-type="text" data-field="label"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The label element appear above an input field. It specifies a hint that describes the expected value of input element."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field Name:</label></td>
                            <td class="cel-2"><input type="text" name="text-field-name"
                                                     class="name-field text-name-field difu-field-reset"
                                                     data-type="text" value=""></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The field name will be appearing on your table column name."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Default Value:</label></td>
                            <td class="cel-2"><input type="text" name="text-field-value"
                                                     class="value-field text-common-feild difu-field-reset"
                                                     data-type="text" data-field="value"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="Default value specifies the value of an input element."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field is Readonly:</label></td>
                            <td class="cel-2"><input type="checkbox" name="text-field-readonly" data-type="text"
                                                     class="readonly-field text-common-feild difu-field-reset-check"
                                                     value="" data-field="readonly"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="It specifies that an input field is read-only. A read-only input field cannot be modified."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Placeholder:</label></td>
                            <td class="cel-2"><input type="text" name="text-field-placeholder"
                                                     class="placeholder-field text-common-feild difu-field-reset"
                                                     data-type="text" data-field="placeholder"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The placeholder attribute specifies a short hint that describes the expected value of input element."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Class Attribute:</label></td>
                            <td class="cel-2"><input type="text" name="text-field-class"
                                                     class="class-field text-common-feild difu-field-reset"
                                                     data-type="text" data-field="class"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The class attribute specifies one or more classnames to the field."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Insert Only<br>Unique Data:</label></td>
                            <td class="cel-2"><input type="checkbox" name="text-field-unique" data-type="text"
                                                     class="unique-field text-common-feild difu-field-reset-check"
                                                     value="" data-field="unique"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="If you checked this box, only unique data will be inserted in the column in this field."
                                                   class="hint-icon"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="insert-content-data">
                    <input type="hidden" value="" id="text-data-contain" class="difu-field-reset">
                    <input type="hidden" value="[dfu_text" id="text-data-contain1" class="field-reset-shortcode">
                    <input type="hidden" name="text-field-shortcode" value="[dfu_text"
                           class="fieldInsertion-text field-reset-shortcode" readonly>
                    <button type="button" data-type="text"
                            class="btn btn-primary difu-fieldInsertionbtn text-fieldInsertion">Insert Field
                    </button>
                </div>
            </div>
        </div>
        <div class="hidden-div" id="email" style="display: none;" oncontextmenu="return false">
            <div class="hidden-content">
                <div class="dfu-content-heading">
                    <p class="dfu-hidden-content-title">Tiger Form Email Field Generator</p>
                    <span class="dashicons dashicons-no-alt dfu-hidden-content-close"></span>
                </div>
                <div class="dfu-content-inner">
                    <table class="dfu-jquery-action-table">
                        <tbody>
                        <tr scope="row">
                            <td class="cel-1"><label>Field is Required:</label></td>
                            <td class="cel-2"><input type="checkbox" name="email-field-required" data-type="email"
                                                     class="required-field difu-field-reset-check"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="It specifies that input field must be filled out before submitting the form."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field Label:</label></td>
                            <td class="cel-2"><input type="text" name="email-field-label"
                                                     class="label-field email-common-feild difu-field-reset"
                                                     data-type="email" data-field="label"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The label element appear above an input field. It specifies a hint that describes the expected value of input element."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field Name:</label></td>
                            <td class="cel-2"><input type="text" name="email-field-name"
                                                     class="name-field email-name-field difu-field-reset"
                                                     data-type="email" value=""></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The field name will be appearing on your table column name."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Default Value:</label></td>
                            <td class="cel-2"><input type="text" name="email-field-value"
                                                     class="value-field email-common-feild difu-field-reset"
                                                     data-type="email" data-field="value"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="Default value specifies the value of an input element."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field is Readonly:</label></td>
                            <td class="cel-2"><input type="checkbox" name="email-field-readonly" data-type="email"
                                                     class="readonly-field email-common-feild difu-field-reset-check"
                                                     value="" data-field="readonly"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="It specifies that an input field is read-only. A read-only input field cannot be modified."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Placeholder:</label></td>
                            <td class="cel-2"><input type="text" name="email-field-placeholder"
                                                     class="placeholder-field email-common-feild difu-field-reset"
                                                     data-type="email" data-field="placeholder"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The placeholder attribute specifies a short hint that describes the expected value of input element."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Class Attribute:</label></td>
                            <td class="cel-2"><input type="text" name="email-field-class"
                                                     class="class-field email-common-feild difu-field-reset"
                                                     data-type="email" data-field="class"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The class attribute specifies one or more classnames to the field."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Insert Only<br>Unique Data:</label></td>
                            <td class="cel-2"><input type="checkbox" name="email-field-unique" data-type="email"
                                                     class="unique-field email-common-feild difu-field-reset-check"
                                                     value="" data-field="unique"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="If you checked this box, only unique data will be inserted in the column in this field."
                                                   class="hint-icon"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="insert-content-data">
                    <input type="hidden" value="" id="email-data-contain" class="difu-field-reset">
                    <input type="hidden" value="[dfu_email" id="email-data-contain1" class="field-reset-shortcode">
                    <input type="hidden" name="email-field-shortcode" value="[dfu_email"
                           class="fieldInsertion-email field-reset-shortcode" readonly>
                    <button type="button" data-type="email"
                            class="btn btn-primary difu-fieldInsertionbtn email-fieldInsertion">Insert Field
                    </button>
                </div>
            </div>
        </div>
        <div class="hidden-div" id="url" style="display: none;" oncontextmenu="return false">
            <div class="hidden-content">
                <div class="dfu-content-heading">
                    <p class="dfu-hidden-content-title">Tiger Form URL Field Generator</p>
                    <span class="dashicons dashicons-no-alt dfu-hidden-content-close"></span>
                </div>
                <div class="dfu-content-inner">
                    <table class="dfu-jquery-action-table">
                        <tbody>
                        <tr scope="row">
                            <td class="cel-1"><label>Field is Required:</label></td>
                            <td class="cel-2"><input type="checkbox" name="url-field-required" data-type="url"
                                                     class="required-field difu-field-reset-check"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="It specifies that input field must be filled out before submitting the form."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field Label:</label></td>
                            <td class="cel-2"><input type="text" name="url-field-label"
                                                     class="label-field url-common-feild difu-field-reset"
                                                     data-type="url" data-field="label"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The label element appear above an input field. It specifies a hint that describes the expected value of input element."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field Name:</label></td>
                            <td class="cel-2"><input type="text" name="url-field-name"
                                                     class="name-field url-name-field difu-field-reset" data-type="url"
                                                     value=""></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The field name will be appearing on your table column name."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Default Value:</label></td>
                            <td class="cel-2"><input type="text" name="url-field-value"
                                                     class="value-field url-common-feild difu-field-reset"
                                                     data-type="url" data-field="value"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="Default value specifies the value of an input element."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field is Readonly:</label></td>
                            <td class="cel-2"><input type="checkbox" name="url-field-readonly" data-type="url"
                                                     class="readonly-field url-common-feild difu-field-reset-check"
                                                     value="" data-field="readonly"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="It specifies that an input field is read-only. A read-only input field cannot be modified."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Placeholder:</label></td>
                            <td class="cel-2"><input type="text" name="url-field-placeholder"
                                                     class="placeholder-field url-common-feild difu-field-reset"
                                                     data-type="url" data-field="placeholder"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The placeholder attribute specifies a short hint that describes the expected value of input element."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Class Attribute:</label></td>
                            <td class="cel-2"><input type="text" name="url-field-class"
                                                     class="class-field url-common-feild difu-field-reset"
                                                     data-type="url" data-field="class"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The class attribute specifies one or more classnames to the field."
                                                   class="hint-icon"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="insert-content-data">
                    <input type="hidden" value="" id="url-data-contain" class="difu-field-reset">
                    <input type="hidden" value="[dfu_url" id="url-data-contain1" class="field-reset-shortcode">
                    <input type="hidden" name="url-field-shortcode" value="[dfu_url"
                           class="fieldInsertion-url field-reset-shortcode" readonly>
                    <button type="button" data-type="url"
                            class="btn btn-primary difu-fieldInsertionbtn url-fieldInsertion">Insert Field
                    </button>
                </div>
            </div>
        </div>
        <div class="hidden-div" id="date" style="display: none;" oncontextmenu="return false">
            <div class="hidden-content">
                <div class="dfu-content-heading">
                    <p class="dfu-hidden-content-title">Tiger Form Date Field Generator</p>
                    <span class="dashicons dashicons-no-alt dfu-hidden-content-close"></span>
                </div>
                <div class="dfu-content-inner">
                    <table class="dfu-jquery-action-table">
                        <tbody>
                        <tr scope="row">
                            <td class="cel-1"><label>Field is Required:</label></td>
                            <td class="cel-2"><input type="checkbox" name="date-field-required" data-type="date"
                                                     class="required-field difu-field-reset-check"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="It specifies that input field must be filled out before submitting the form."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field Label:</label></td>
                            <td class="cel-2"><input type="text" name="date-field-label"
                                                     class="label-field date-common-feild difu-field-reset"
                                                     data-type="date" data-field="label">
                            </td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The label element appear above an input field. It specifies a hint that describes the expected value of input element."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field Name:</label></td>
                            <td class="cel-2"><input type="text" name="date-field-name"
                                                     class="name-field date-name-field difu-field-reset"
                                                     data-type="date" value=""></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The field name will be appearing on your table column name."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Class Attribute:</label></td>
                            <td class="cel-2"><input type="text" name="date-field-class"
                                                     class=" difu-field-reset class-field date-common-feild"
                                                     data-type="date" data-field="class"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The class attribute specifies one or more classnames to the field."
                                                   class="hint-icon"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="insert-content-data">
                    <input type="hidden" value="" id="date-data-contain" class="difu-field-reset">
                    <input type="hidden" value="[dfu_date" id="date-data-contain1" class="field-reset-shortcode">
                    <input type="hidden" name="date-field-shortcode" value="[dfu_date"
                           class="fieldInsertion-date field-reset-shortcode" readonly>
                    <button type="button" data-type="date"
                            class="btn btn-primary difu-fieldInsertionbtn date-fieldInsertion">Insert Field
                    </button>
                </div>
            </div>
        </div>
        <div class="hidden-div" id="number" style="display: none;" oncontextmenu="return false">
            <div class="hidden-content">
                <div class="dfu-content-heading">
                    <p class="dfu-hidden-content-title">Tiger Form Number Field Generator</p>
                    <span class="dashicons dashicons-no-alt dfu-hidden-content-close"></span>
                </div>
                <div class="dfu-content-inner">
                    <table class="dfu-jquery-action-table">
                        <tbody>
                        <tr scope="row">
                            <td class="cel-1"><label>Field is Required:</label></td>
                            <td class="cel-2"><input type="checkbox" name="number-field-required" data-type="number"
                                                     class="required-field difu-field-reset-check"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="It specifies that input field must be filled out before submitting the form."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field Label:</label></td>
                            <td class="cel-2"><input type="text" name="number-field-label"
                                                     class="label-field number-common-feild difu-field-reset"
                                                     data-type="number" data-field="label">
                            </td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The label element appear above an input field. It specifies a hint that describes the expected value of input element."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field Name:</label></td>
                            <td class="cel-2"><input type="text" name="number-field-name"
                                                     class="name-field number-name-field difu-field-reset"
                                                     data-type="number" value=""></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The field name will be appearing on your table column name."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Default Value:</label></td>
                            <td class="cel-2"><input type="text" name="number-field-value"
                                                     class="value-field number-common-feild difu-field-reset"
                                                     data-type="number" data-field="value"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="Default value specifies the value of an input element."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Length:</label></td>
                            <td class="cel-2">Min <input type="number" name="number-field-max"
                                                         class="max-field number-common-feild difu-field-reset"
                                                         data-type="number" data-field="max" style="width: 60px;"> --
                                Max <input type="number" name="number-field-min"
                                           class="min-field number-common-feild difu-field-reset" data-type="number"
                                           data-field="min" style="width: 60px;"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The minlength and maxlength attribute specifies the minimum and maximum number of digits allowed in the this element."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field is Readonly:</label></td>
                            <td class="cel-2"><input type="checkbox" name="number-field-readonly" data-type="number"
                                                     class="readonly-field number-common-feild difu-field-reset-check"
                                                     value="" data-field="readonly"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="It specifies that an input field is read-only. A read-only input field cannot be modified."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Placeholder:</label></td>
                            <td class="cel-2"><input type="text" name="number-field-placeholder"
                                                     class="placeholder-field number-common-feild difu-field-reset"
                                                     data-type="number" data-field="placeholder"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The placeholder attribute specifies a short hint that describes the expected value of input element."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Class Attribute:</label></td>
                            <td class="cel-2"><input type="text" name="number-field-class"
                                                     class="class-field number-common-feild difu-field-reset"
                                                     data-type="number" data-field="class"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The class attribute specifies one or more classnames to the field."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Insert Only<br>Unique Data:</label></td>
                            <td class="cel-2"><input type="checkbox" name="number-field-unique" data-type="number"
                                                     class="unique-field number-common-feild difu-field-reset-check"
                                                     value="" data-field="unique"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="If you checked this box, only unique data will be inserted in the column in this field."
                                                   class="hint-icon"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="insert-content-data">
                    <input type="hidden" value="" id="number-data-contain" class="difu-field-reset">
                    <input type="hidden" value="[dfu_number" id="number-data-contain1" class="field-reset-shortcode">
                    <input type="hidden" name="number-field-shortcode" value="[dfu_number"
                           class="fieldInsertion-number field-reset-shortcode" readonly>
                    <button type="button" data-type="number"
                            class="btn btn-primary difu-fieldInsertionbtn number-fieldInsertion">Insert Field
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden-div" id="textarea" style="display: none;" oncontextmenu="return false">
            <div class="hidden-content">
                <div class="dfu-content-heading">
                    <p class="dfu-hidden-content-title">Tiger Form Textarea Field Generator</p>
                    <span class="dashicons dashicons-no-alt dfu-hidden-content-close"></span>
                </div>
                <div class="dfu-content-inner">
                    <table class="dfu-jquery-action-table">
                        <tbody>
                        <tr scope="row">
                            <td class="cel-1"><label>Field is Required:</label></td>
                            <td class="cel-2"><input type="checkbox" name="textarea-field-required" data-type="textarea"
                                                     class="required-field difu-field-reset-check"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="It specifies that input field must be filled out before submitting the form."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field Label:</label></td>
                            <td class="cel-2"><input type="text" name="textarea-field-label"
                                                     class="label-field textarea-common-feild difu-field-reset"
                                                     data-type="textarea" data-field="label">
                            </td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The label element appear above an input field. It specifies a hint that describes the expected value of input element."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field Name:</label></td>
                            <td class="cel-2"><input type="text" name="textarea-field-name"
                                                     class="difu-field-reset name-field textarea-name-field"
                                                     data-type="textarea" value=""></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The field name will be appearing on your table column name."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Default Value:</label></td>
                            <td class="cel-2"><input type="text" name="textarea-field-value"
                                                     class="value-field textarea-common-feild difu-field-reset"
                                                     data-type="textarea" data-field="value"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="Default value specifies the value of an input element."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field is Readonly:</label></td>
                            <td class="cel-2"><input type="checkbox" name="textarea-field-readonly" data-type="textarea"
                                                     class="readonly-field textarea-common-feild difu-field-reset-check"
                                                     value="" data-field="readonly"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="It specifies that an input field is read-only. A read-only input field cannot be modified."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Placeholder:</label></td>
                            <td class="cel-2"><input type="text" name="textarea-field-placeholder"
                                                     class="placeholder-field textarea-common-feild difu-field-reset"
                                                     data-type="textarea" data-field="placeholder"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The placeholder attribute specifies a short hint that describes the expected value of input element."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Class Attribute:</label></td>
                            <td class="cel-2"><input type="text" name="textarea-field-class"
                                                     class="class-field textarea-common-feild difu-field-reset"
                                                     data-type="textarea" data-field="class"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The class attribute specifies one or more classnames to the field."
                                                   class="hint-icon"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="insert-content-data">
                    <input type="hidden" value="" id="textarea-data-contain" class="difu-field-reset">
                    <input type="hidden" value="[dfu_textarea" id="textarea-data-contain1"
                           class="field-reset-shortcode">
                    <input type="hidden" name="textarea-field-shortcode" value="[dfu_textarea"
                           class="field-reset-shortcode fieldInsertion-textarea" readonly>
                    <button type="button" data-type="textarea"
                            class="btn btn-primary difu-fieldInsertionbtn textarea-fieldInsertion">Insert Field
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden-div" id="select" style="display: none;" oncontextmenu="return false">
            <div class="hidden-content">
                <div class="dfu-content-heading">
                    <p class="dfu-hidden-content-title">Tiger Form Select Field Generator</p>
                    <span class="dashicons dashicons-no-alt dfu-hidden-content-close"></span>
                </div>
                <div class="dfu-content-inner">
                    <table class="dfu-jquery-action-table">
                        <tbody>
                        <tr scope="row">
                            <td class="cel-1"><label>Field is Required:</label></td>
                            <td class="cel-2"><input type="checkbox" name="select-field-required" data-type="select"
                                                     class="required-field difu-field-reset-check"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="It specifies that select field must be selected one option before submitting the form."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field Label:</label></td>
                            <td class="cel-2"><input type="text" name="select-field-label"
                                                     class="difu-field-reset label-field select-common-feild"
                                                     data-type="select" data-field="label">
                            </td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The label element appear above select field."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field Name:</label></td>
                            <td class="cel-2"><input type="text" name="select-field-name"
                                                     class="difu-field-reset name-field select-name-field"
                                                     data-type="select" value=""></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The field name will be appearing on your table column name."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Options:</label></td>
                            <td class="cel-2"><textarea name="select-field-option"
                                                        class="difu-field-reset option-field select-common-feild"
                                                        data-type="select" data-field="options"></textarea>
                                <br>
                                Example: option1/option2/etc.
                            </td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The Options defines an option in a select list. Here all options must be separated by a forwardslash ( / )."
                                                   class="hint-icon"></td>
                        </tr>
                        <!--<tr scope="row">
    <td class="cel-1"><label>Allow Multiple Select:</label></td>
    <td class="cel-2"><input type="checkbox" name="select-field-multiple" data-type="select" class="multiselect-field select-common-feild difu-field-reset-check" value="" data-field="multiselect"></td>
    <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>" alt="info icon" data-info="When allow multiple select, it specifies that multiple options can be selected at once." class="hint-icon"></td>
    </tr>-->
                        <tr scope="row">
                            <td class="cel-1"><label>Default Selected:</label></td>
                            <td class="cel-2"><input type="text" name="select-field-default"
                                                     class="defaultselect-field select-common-feild difu-field-reset"
                                                     data-type="select" data-field="selected">
                                <br>
                                Example: option1.
                            </td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="Enter an option name which you want that should be pre-selected when the page loads. If this field is empty, by default 'Select Option' as the first option."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Class Attribute:</label></td>
                            <td class="cel-2"><input type="text" name="select-field-class"
                                                     class="difu-field-reset class-field select-common-feild"
                                                     data-type="select" data-field="class"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The class attribute specifies one or more classnames to the field."
                                                   class="hint-icon"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="insert-content-data">
                    <input type="hidden" value="" id="select-data-contain" class="difu-field-reset">
                    <input type="hidden" value="[dfu_select" id="select-data-contain1" class="field-reset-shortcode">
                    <input type="hidden" name="select-field-shortcode" value="[dfu_select"
                           class="fieldInsertion-select field-reset-shortcode" readonly>
                    <button type="button" data-type="select"
                            class="btn btn-primary difu-fieldInsertionbtn select-fieldInsertion">Insert Field
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden-div" id="radio" style="display: none;" oncontextmenu="return false">
            <div class="hidden-content">
                <div class="dfu-content-heading">
                    <p class="dfu-hidden-content-title">Tiger Form Radio Field Generator</p>
                    <span class="dashicons dashicons-no-alt dfu-hidden-content-close"></span>
                </div>
                <div class="dfu-content-inner">
                    <table class="dfu-jquery-action-table">
                        <tbody>
                        <tr scope="row">
                            <td class="cel-1"><label>Field Label:</label></td>
                            <td class="cel-2"><input type="text" name="radio-field-label"
                                                     class="label-field radio-common-feild difu-field-reset"
                                                     data-type="radio" data-field="label">
                            </td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The label element appear above radio field."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Field Name:</label></td>
                            <td class="cel-2"><input type="text" name="radio-field-name"
                                                     class="name-field radio-name-field difu-field-reset"
                                                     data-type="radio" value=""></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The field name will be appearing on your table column name."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Options:</label></td>
                            <td class="cel-2"><textarea name="radio-field-option"
                                                        class="option-field radio-common-feild difu-field-reset"
                                                        data-type="radio" data-field="options"></textarea>
                                <br>
                                Example: option1/option2/etc.
                            </td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The Options defines a radio option. Here all options must be separated by a forwardslash ( / )."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Default Checked:</label></td>
                            <td class="cel-2"><input type="text" name="radio-field-default"
                                                     class="defaultselect-field radio-common-feild difu-field-reset"
                                                     data-type="radio" data-field="checked">
                                <br>
                                Example: option1.
                            </td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="Enter an option name which you want that should be pre-selected when the page loads. If this field is empty, by default 'Select Option' as the first option."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Class Attribute:</label></td>
                            <td class="cel-2"><input type="text" name="radio-field-class"
                                                     class="class-field radio-common-feild difu-field-reset"
                                                     data-type="radio" data-field="class"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The class attribute specifies one or more classnames to the field."
                                                   class="hint-icon"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="insert-content-data">
                    <input type="hidden" value="" id="radio-data-contain" class="difu-field-reset">
                    <input type="hidden" value="[dfu_radio" id="radio-data-contain1" class="field-reset-shortcode">
                    <input type="text" name="radio-field-shortcode" value="[dfu_radio"
                           class="fieldInsertion-radio field-reset-shortcode" readonly>
                    <button type="button" data-type="radio"
                            class="btn btn-primary difu-fieldInsertionbtn radio-fieldInsertion">Insert Field
                    </button>
                </div>
            </div>
        </div>
        <div class="hidden-div" id="checkbox" style="display: none;" oncontextmenu="return false">
            <div class="hidden-content">
                <div class="dfu-content-heading">
                    <p class="dfu-hidden-content-title">Tiger Form Checkbox Field Generator</p>
                    <span class="dashicons dashicons-no-alt dfu-hidden-content-close"></span>
                </div>
                <div class="dfu-content-inner">
                    <table class="dfu-jquery-action-table">
                        <tbody>
                        <tr scope="row">
                            <td class="cel-1"><label>Field Label:</label></td>
                            <td class="cel-2"><input type="text" name="checkbox-field-label"
                                                     class="label-field checkbox-common-feild difu-field-reset"
                                                     data-type="checkbox" data-field="label">
                            </td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The label element appear above checkbox field."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Options:</label></td>
                            <td class="cel-2"><textarea name="checkbox-field-option"
                                                        class="option-field checkbox-common-feild difu-field-reset"
                                                        data-type="checkbox" data-field="options"></textarea>
                                <br>
                                Example: option1/option2/etc.
                            </td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The Options defines a checkbox option. Here all options must be separated by a forwardslash ( / )."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Default Value:</label></td>
                            <td class="cel-2"><textarea name="checkbox-field-value"
                                                        class="value-field checkbox-common-feild difu-field-reset"
                                                        data-type="checkbox" data-field="value"></textarea>
                                <br>
                                Example: value1/value2/etc.
                            </td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The Default Value defines a checkbox each option value. If the Deafult Value field is empty then the option names will be counted as values. Here all options value must be separated by a forwardslash ( / )."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Default Checked:</label></td>
                            <td class="cel-2"><input type="text" name="checkbox-field-default"
                                                     class="defaultselect-field checkbox-common-feild difu-field-reset"
                                                     data-type="checkbox" data-field="checked">
                                <br>
                                Example: option1.
                            </td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="Enter an option name which you want that should be pre-selected when the page loads. If this field is empty, by default 'Select Option' as the first option."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Class Attribute:</label></td>
                            <td class="cel-2"><input type="text" name="checkbox-field-class"
                                                     class="class-field checkbox-common-feild difu-field-reset"
                                                     data-type="checkbox" data-field="class"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The class attribute specifies one or more classnames to the field."
                                                   class="hint-icon"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="insert-content-data">
                    <input type="hidden" value="" id="checkbox-data-contain" class="difu-field-reset">
                    <input type="hidden" value="[dfu_checkbox]" id="checkbox-data-contain1"
                           class="field-reset-shortcode">
                    <input type="hidden" name="checkbox-field-shortcode" value="[dfu_checkbox]"
                           class="fieldInsertion-checkbox field-reset-shortcode" readonly>
                    <button type="button" data-type="checkbox"
                            class="btn btn-primary difu-fieldInsertionbtn checkbox-fieldInsertion">Insert Field
                    </button>
                </div>
            </div>
        </div>
        <div class="hidden-div" id="submit" style="display: none;" oncontextmenu="return false">
            <div class="hidden-content">
                <div class="dfu-content-heading">
                    <p class="dfu-hidden-content-title">Tiger Form Submit Button Generator</p>
                    <span class="dashicons dashicons-no-alt dfu-hidden-content-close"></span>
                </div>
                <div class="dfu-content-inner">
                    <table class="dfu-jquery-action-table">
                        <tbody>
                        <tr scope="row">
                            <td class="cel-1"><label>Button Display Name:</label></td>
                            <td class="cel-2"><input type="text" name="submit-field-label"
                                                     class="label-field submit-common-feild difu-field-reset"
                                                     data-type="submit" data-field="label">
                            </td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The button display name appear as button display name."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Button Name:</label></td>
                            <td class="cel-2"><input type="text" name="submit-field-name"
                                                     class="name-field submit-name-field difu-field-reset"
                                                     data-type="submit" value=""></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The field name will be appearing on your table column name."
                                                   class="hint-icon"></td>
                        </tr>
                        <tr scope="row">
                            <td class="cel-1"><label>Class Attribute:</label></td>
                            <td class="cel-2"><input type="text" name="submit-field-class"
                                                     class="class-field submit-common-feild difu-field-reset"
                                                     data-type="submit" data-field="class"></td>
                            <td class="cel-3"><img src="<?php $tiger_form_materials->tiger_form_info_icon_produce(); ?>"
                                                   alt="info icon"
                                                   data-info="The class attribute specifies one or more classnames to the field."
                                                   class="hint-icon"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="insert-content-data">
                    <input type="hidden" value="" id="submit-data-contain" class="difu-field-reset">
                    <input type="hidden" value="[dfu_submit" id="submit-data-contain1" class="field-reset-shortcode">
                    <input type="hidden" name="submit-field-shortcode" value="[dfu_submit"
                           class="fieldInsertion-submit field-reset-shortcode" readonly>
                    <button type="button" data-type="submit"
                            class="btn btn-primary difu-fieldInsertionbtn submit-fieldInsertion">Insert Field
                    </button>
                </div>
            </div>
        </div>
        <?php
    }
}