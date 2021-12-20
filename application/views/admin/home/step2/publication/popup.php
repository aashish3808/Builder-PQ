<?php
$popup_kount = 6;
$heading_text = 'Publications';

?>
<a class="button" href="#popup<?php echo $popup_kount;?>">
    <div class="button--settings">
        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg--settings" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
            <path d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65C14.46 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"></path>
        </svg>
    </div>
</a>

<div id="popup<?php echo $popup_kount;?>" class="overlay">
    <div class="popup">
        <h2><?php echo $heading_text;?></h2>
        <a class="close" href="#">&times;</a>
        <div class="content">
            <div class="form__fields-group">
                <div class="form-element col-2">
                    <label class="">Customize Text</label>
                    <div style="position: relative;">
                      <?php //pr($choices[1]);?>
                        <input name="customize_text[<?php echo $popup_kount;?>]" col="col-2" type="text" value="<?php echo @$choices[$popup_kount]['value']; ?>" />
                    </div>
                </div>
                
                <div class="form-element col-2">
                &nbsp; &nbsp; &nbsp; &nbsp; <label class="">Section Show Hide Status</label>
                    <div style="position: relative;">
                    &nbsp; &nbsp; &nbsp; &nbsp;<input name="customize_status[<?php echo $popup_kount;?>]" type="radio" col="col-2" <?php if( @$choices[$popup_kount]['status']){ ?> checked <?php }; ?>  value="1">  Show 
                        <input type="radio" col="col-2" name="customize_status[<?php echo $popup_kount;?>]" <?php if( @$choices[$popup_kount]['status'] < 1 ){ ?> checked <?php }; ?> value="0"> Hide
                    </div>
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
</div>