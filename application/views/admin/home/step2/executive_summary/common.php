<div style="padding-top: 40px;">
    <div class="form__fields" style="display: block;">
    <div class="form__fields-group">
            <div class="form-element col-1">
                <label class="" style="padding-top: 40px;;"> Description</label>
                <div style="position: relative;">
                    <textarea name="executive_summary[description][]" class="tiny_editor"><?php echo @$current_record->description; ?></textarea>
                </div>
                <div class="form__element-counter fade fade-exited">100</div>
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
