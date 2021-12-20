<div style="padding-top: 40px;">
    <div class="form__fields" style="display: block;">
        <div class="form__fields-group">
            <div class="form-element col-2">
                <label class="">Geographies</label>
                <div style="position: relative;">
                    <input name="geography[name][]" col="col-2" type="text"  class="" value="<?php echo @$current_record->name; ?>" />
                    <div class="form__element-counter fade fade-exited">50</div>
                </div>
            </div>
            <div class="form-element col-2">
                <label class="">Level</label>
                <select class="form-select-custom" name="geography[level][]">
                    <option value="0">Select level</option>

                    <option value="100" <?php if (@$current_record->level == '100') { ?> selected <?php } ?>>Native speaker</option>
                    <option value="75" <?php if (@$current_record->level == '75') { ?> selected <?php } ?>>Highly proficient in speaking and writing</option>
                    <option value="50" <?php if (@$current_record->level == '50') { ?> selected <?php } ?>>Very good command</option>
                    <option value="25" <?php if (@$current_record->level == '25') { ?> selected <?php } ?>>Good working knowledge</option>
                    <option value="20" <?php if (@$current_record->level == '20') { ?> selected <?php } ?>>Working knowledge</option>
                    <option value="120" <?php if (@$current_record->level == '120') { ?> selected <?php } ?>>A1</option>
                    <option value="130" <?php if (@$current_record->level == '130') { ?> selected <?php } ?>>A2</option>
                    <option value="140" <?php if (@$current_record->level == '140') { ?> selected <?php } ?>>B1</option>
                    <option value="160" <?php if (@$current_record->level == '160') { ?> selected <?php } ?>>B2</option>
                    <option value="180" <?php if (@$current_record->level == '180') { ?> selected <?php } ?>>C1</option>
                    <option value="200" <?php if (@$current_record->level == '200') { ?> selected <?php } ?>>C2</option>


                </select>
                <i class="form-select-custom--arrow"></i>
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