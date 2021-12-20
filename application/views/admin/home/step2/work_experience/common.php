<div style="padding-top: 40px;">
    <div class="form__fields" style="display: block;">
        <div class="form__fields-group">
            <div class="form-element col-2">
                <label class="">Job Title</label>
                <div style="position: relative;">
                    <input name="work_experience[job_title][]" col="col-2" type="text" maxlength="100" placeholder="e.g. Sales Manager" class="" value="<?php echo @$current_record->job_title; ?>">
                </div>
            </div>
            <div class="form-element col-2">
                <label class="">City/Town</label>
                <div style="position: relative;">
                    <input name="work_experience[job_city][]" col="col-2" type="text" maxlength="100" placeholder="e.g. San francisco" class="" value="<?php echo @$current_record->job_city; ?>">
                </div>
            </div>
        </div>
        <div class="form__fields-group">
            <div class="form-element col-1">
                <label for="items[4].employer" class="">Employer</label>
                <div style="position: relative;">
                    <input name="work_experience[employer][]" col="col-1" type="text" maxlength="100" placeholder="e.g. PwC" class="" value="<?php echo @$current_record->job_city; ?>">
                    <div class="form__element-counter fade fade-exited">100</div>
                </div>
            </div>
        </div>
        <div class="form__fields-group col-2">
            <div class="form-element col-2">
                <label class="">Start Date</label>
                <select class="form-select-custom" name="work_experience[start_month][]">
                    <option value="">Don't show</option>
                    <option value="hidden">Show year only</option>
                    <option value="01" <?php if (@$current_record->start_month == '01') { ?> selected <?php } ?>>January</option>
                    <option value="02" <?php if (@$current_record->start_month == '02') { ?> selected <?php } ?>>February</option>
                    <option value="03" <?php if (@$current_record->start_month == '03') { ?> selected <?php } ?>>March</option>
                    <option value="04" <?php if (@$current_record->start_month == '04') { ?> selected <?php } ?>>April</option>
                    <option value="05" <?php if (@$current_record->start_month == '05') { ?> selected <?php } ?>>May</option>
                    <option value="06" <?php if (@$current_record->start_month == '06') { ?> selected <?php } ?>>June</option>
                    <option value="07" <?php if (@$current_record->start_month == '07') { ?> selected <?php } ?>>July</option>
                    <option value="08" <?php if (@$current_record->start_month == '08') { ?> selected <?php } ?>>August</option>
                    <option value="09" <?php if (@$current_record->start_month == '09') { ?> selected <?php } ?>>September</option>
                    <option value="10" <?php if (@$current_record->start_month == '10') { ?> selected <?php } ?>>October</option>
                    <option value="11" <?php if (@$current_record->start_month == '11') { ?> selected <?php } ?>>November</option>
                    <option value="12" <?php if (@$current_record->start_month == '12') { ?> selected <?php } ?>>December</option>
                </select>
                <i class="form-select-custom--arrow"></i>
            </div>
            <div class="form-element col-2">
                <label class="">&nbsp;</label>
                <select class="form-select-custom form__select-element" name="work_experience[start_year][]">
                    <?php

                    $year = date('Y');

                    $year_start = $year - 80;

                    for ($i = $year; $i >= $year_start; $i--) { ?>

                        <option value="<?php echo $i; ?>" <?php if (@$current_record->start_year == $i) { ?> selected <?php } ?>><?php echo $i; ?></option>

                    <?php

                    }

                    ?>
                </select>
                <i class="form-select-custom--arrow"></i>
            </div>
        </div>
        <div class="form__fields-group col-2">
            <div class="form-element col-2">
                <label class="">End Date</label>
                <select class="form-select-custom" name="work_experience[end_month][]">
                    <option value="present">Present</option>
                    <option>Don't show</option>
                    <option value="hidden">Show year only</option>
                    <option value="01" <?php if (@$current_record->end_month == '01') { ?> selected <?php } ?>>January</option>
                    <option value="02" <?php if (@$current_record->end_month == '02') { ?> selected <?php } ?>>February</option>
                    <option value="03" <?php if (@$current_record->end_month == '03') { ?> selected <?php } ?>>March</option>
                    <option value="04" <?php if (@$current_record->end_month == '04') { ?> selected <?php } ?>>April</option>
                    <option value="05" <?php if (@$current_record->end_month == '05') { ?> selected <?php } ?>>May</option>
                    <option value="06" <?php if (@$current_record->end_month == '06') { ?> selected <?php } ?>>June</option>
                    <option value="07" <?php if (@$current_record->end_month == '07') { ?> selected <?php } ?>>July</option>
                    <option value="08" <?php if (@$current_record->end_month == '08') { ?> selected <?php } ?>>August</option>
                    <option value="09" <?php if (@$current_record->end_month == '09') { ?> selected <?php } ?>>September</option>
                    <option value="10" <?php if (@$current_record->end_month == '10') { ?> selected <?php } ?>>October</option>
                    <option value="11" <?php if (@$current_record->end_month == '11') { ?> selected <?php } ?>>November</option>
                    <option value="12" <?php if (@$current_record->end_month == '12') { ?> selected <?php } ?>>December</option>
                </select>
                <i class="form-select-custom--arrow"></i>
            </div>
            <div class="form-element col-2">
                <label class="">&nbsp;</label>
                <select class="form-select-custom form__select-element" name="work_experience[end_year][]">
                    <?php

                    $year = date('Y');

                    $year_start = $year - 80;

                    for ($i = $year; $i >= $year_start; $i--) { ?>

                        <option value="<?php echo $i; ?>" <?php if (@$current_record->end_year == $i) { ?> selected <?php } ?>><?php echo $i; ?></option>

                    <?php

                    }

                    ?>
                </select>
                <i class="form-select-custom--arrow"></i>
            </div>
        </div>
        <div class="form__fields-group">
            <div class="form-element col-1">
                <label class="">Description</label>

                <textarea name="work_experience[description][]" class="tiny_editor"><?php echo @$current_record->description; ?></textarea>
            </div>
        </div>
        <div class="form__fields-group form__fields-group--buttons">

            <button type="submit" class="button--white button--save-section-item">
                <div class="spinner--hidden"></div>
                <div class="icon--visible">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg--save" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm-5 16c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-10H5V5h10v4z"></path>
                    </svg>
                </div>
                Save
            </button>

        </div>
    </div>
</div>