<div class="wizard">
   <div class="page__header">
      <header class="center">
         <h1>My experiences</h1>
      </header>
   </div>
   <div class="progress-bar">
      <div class="progress-bar__inner">
         <div class="progress-bar__bar">
            <div class="progress-bar__filler" style="width: 50%;"></div>
         </div>
         <div class="progress-bar__buttons">
            <button class="progress-bar__button progress-bar__button--personal progress-bar__button--active" disabled="">
               <div class="progress-bar__icon">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg--person" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                     <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                  </svg>
               </div>
               <div class="progress-bar__label">Personal</div>
            </button>
            <button class="progress-bar__button progress-bar__button--history progress-bar__button--active">
               <div class="progress-bar__icon">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg--Description" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                     <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"></path>
                  </svg>
               </div>
               <div class="progress-bar__label">Experiences</div>
            </button>
            <button class="progress-bar__button progress-bar__button--template">
               <div class="progress-bar__icon">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg--create" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                     <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"></path>
                  </svg>
               </div>
               <div class="progress-bar__label">Template</div>
            </button>
         </div>
      </div>
   </div>


   <section style="margin-top: 104px; position: relative;">
      <?php
      $form_attributes['class'] = "form-horizontal row-border";
      $form_attributes['id']    = "validate-1";
      echo form_open_multipart(BACKEND . "home/update_step_2/", $form_attributes);
      ?>
      <?php echo form_hidden('id', $personal_detail->id); ?>
      <?php echo form_hidden('hidden_image', $personal_detail->profileImage); ?>

      <?php echo form_hidden($csrf); ?>
      <div id="accordion">
         <div class="group" data-section-id="1">
            <h3>
               <div class="form-section__header-icon">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                     <path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"></path>
                  </svg>
               </div>
               TIME-LINE
            </h3>
            <div>
               <div class="form-section__fieldset">
                  <?php include(dirname(__FILE__) . '/step2/education/popup.php'); ?>
                  <div>
                     <div class="form-section__rows  education_details">
                        <div class="form__row">

                           <?php
                           if (!$education) {
                              $current_record = NULL;
                              include(dirname(__FILE__) . '/step2/education/normal_header.php');
                              include(dirname(__FILE__) . '/step2/education/common.php');
                           } else if (is_array($education)) {

                              $kount = 0;

                              foreach ($education as $current_record) {

                                 if ($kount == 0) {
                                    include(dirname(__FILE__) . '/step2/education/normal_header.php');
                                 } else {
                           ?>
                                    <div class="user_data">
                                    <?php
                                    include(dirname(__FILE__) . '/step2/education/repeat_header.php');
                                 }
                                 include(dirname(__FILE__) . '/step2/education/common.php');

                                 if ($kount > 0) { ?>

                                    </div>
                           <?php  }

                                 $kount++;
                              }
                           }

                           ?>

                        </div>
                     </div>
                     <button onclick="add_new_section('education');" class="button--grey button--add-section-item" type="button">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg-add-circle-outline" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                           <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7zm-1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path>
                        </svg>
                        Add another TIME-LINE
                     </button>
                  </div>
               </div>
            </div>
         </div>
         <div class="group" data-section-id="2">
            <h3>
               <div class="form-section__header-icon">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                     <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"></path>
                  </svg>
               </div>
               Executive Summary
            </h3>
            <div>
               <div class="form-section__fieldset">
                  <?php include(dirname(__FILE__) . '/step2/executive_summary/popup.php'); ?>
                  <div class="form__row">
                     <div>
                        <div class="form-section__rows executive_summary_details">

                           <div class="row">

                              <?php
                              if (!$executive_summary) {
                                 $current_record = NULL;
                                 include(dirname(__FILE__) . '/step2/executive_summary/normal_header.php');
                                 include(dirname(__FILE__) . '/step2/executive_summary/common.php');
                              } else if (is_array($executive_summary)) {

                                 $kount = 0;

                                 foreach ($executive_summary as $current_record) {
                                    if ($kount == 0) {
                                       include(dirname(__FILE__) . '/step2/executive_summary/normal_header.php');
                                    } else {

                              ?>
                                       <div class="user_data">
                                       <?php
                                       include(dirname(__FILE__) . '/step2/executive_summary/repeat_header.php');
                                    }
                                    include(dirname(__FILE__) . '/step2/executive_summary/common.php');

                                    if ($kount > 0) { ?>

                                       </div>
                              <?php  }

                                    $kount++;
                                 }
                              }

                              ?>


                           </div>
                        </div>

                        <button onclick="add_new_section('executive_summary');" class="button--grey button--add-section-item" type="button">
                           <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg-add-circle-outline" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                              <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7zm-1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path>
                           </svg>
                           Add another executive summary
                        </button>
                     </div>
                  </div>
               </div>
            </div>


         </div>
         <div class="group" data-section-id="3">
            <h3>
               <div class="form-section__header-icon">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                     <path d="M13 1.07V9h7c0-4.08-3.05-7.44-7-7.93zM4 15c0 4.42 3.58 8 8 8s8-3.58 8-8v-4H4v4zm7-13.93C7.05 1.56 4 4.92 4 9h7V1.07z"></path>
                  </svg>
               </div>
               Industries Worked In
            </h3>
            <div>
               <div class="form-section__fieldset">

                  <?php include(dirname(__FILE__) . '/step2/industries/popup.php'); ?>
                  <div>
                     <div class="form-section__rows industries_details">
                        <div class="form__row">

                           <?php
                           if (!$industries) {
                              $current_record = NULL;
                              include(dirname(__FILE__) . '/step2/industries/normal_header.php');
                              include(dirname(__FILE__) . '/step2/industries/common.php');
                           } else if (is_array($industries)) {

                              $kount = 0;

                              foreach ($industries as $current_record) {
                                 if ($kount == 0) {
                                    include(dirname(__FILE__) . '/step2/industries/normal_header.php');
                                 } else {
                           ?>
                                    <div class="user_data">
                                    <?php
                                    include(dirname(__FILE__) . '/step2/industries/repeat_header.php');
                                 }
                                 include(dirname(__FILE__) . '/step2/industries/common.php');

                                 if ($kount > 0) { ?>

                                    </div>
                           <?php  }

                                 $kount++;
                              }
                           }

                           ?>


                        </div>
                     </div>
                     <button onclick="add_new_section('industries');" class="button--grey button--add-section-item" type="button">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg-add-circle-outline" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                           <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7zm-1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path>
                        </svg>
                        Add another industry
                     </button>
                  </div>
               </div>
            </div>
         </div>
         <div class="group" data-section-id="4">
            <h3>
               <div class="form-section__header-icon">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                     <path d="M13 1.07V9h7c0-4.08-3.05-7.44-7-7.93zM4 15c0 4.42 3.58 8 8 8s8-3.58 8-8v-4H4v4zm7-13.93C7.05 1.56 4 4.92 4 9h7V1.07z"></path>
                  </svg>
               </div>
               Core Competencies
            </h3>
            <div>
               <div class="form-section__fieldset">

                  <?php include(dirname(__FILE__) . '/step2/competencies/popup.php'); ?>
                  <div>
                     <div class="form-section__rows competencies_details">
                        <div class="form__row">

                           <?php
                           if (!$competencies) {
                              $current_record = NULL;
                              include(dirname(__FILE__) . '/step2/competencies/normal_header.php');
                              include(dirname(__FILE__) . '/step2/competencies/common.php');
                           } else if (is_array($competencies)) {

                              $kount = 0;

                              foreach ($competencies as $current_record) {
                                 if ($kount == 0) {
                                    include(dirname(__FILE__) . '/step2/competencies/normal_header.php');
                                 } else {
                           ?>
                                    <div class="user_data">
                                    <?php
                                    include(dirname(__FILE__) . '/step2/competencies/repeat_header.php');
                                 }
                                 include(dirname(__FILE__) . '/step2/competencies/common.php');

                                 if ($kount > 0) { ?>

                                    </div>
                           <?php  }

                                 $kount++;
                              }
                           }

                           ?>


                        </div>
                     </div>
                     <button onclick="add_new_section('competencies');" class="button--grey button--add-section-item" type="button">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg-add-circle-outline" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                           <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7zm-1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path>
                        </svg>
                        Add another competencies
                     </button>
                  </div>
               </div>
            </div>
         </div>
         <div class="group" data-section-id="5">
            <h3>
               <div class="form-section__header-icon">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                     <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"></path>
                  </svg>
               </div>
               Patents
            </h3>
            <div>
               <div class="form-section__fieldset">
                  <?php include(dirname(__FILE__) . '/step2/patent/popup.php'); ?>
                  <div class="form__row">
                     <div>
                        <div class="form-section__rows patent_details">

                           <div class="row">

                              <?php
                              if (!$patent) {
                                 $current_record = NULL;
                                 include(dirname(__FILE__) . '/step2/patent/normal_header.php');
                                 include(dirname(__FILE__) . '/step2/patent/common.php');
                              } else if (is_array($patent)) {

                                 $kount = 0;

                                 foreach ($patent as $current_record) {
                                    if ($kount == 0) {
                                       include(dirname(__FILE__) . '/step2/patent/normal_header.php');
                                    } else {
                              ?>
                                       <div class="user_data">
                                       <?php
                                       include(dirname(__FILE__) . '/step2/patent/repeat_header.php');
                                    }
                                    include(dirname(__FILE__) . '/step2/patent/common.php');

                                    if ($kount > 0) { ?>

                                       </div>
                              <?php  }

                                    $kount++;
                                 }
                              }

                              ?>


                           </div>
                        </div>

                        <button onclick="add_new_section('patent');" class="button--grey button--add-section-item" type="button">
                           <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg-add-circle-outline" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                              <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7zm-1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path>
                           </svg>
                           Add another patent
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="group" data-section-id="6">
            <h3>
               <div class="form-section__header-icon">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                     <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"></path>
                  </svg>
               </div>
               Publications
            </h3>
            <div>
               <div class="form-section__fieldset">
                  <?php include(dirname(__FILE__) . '/step2/publication/popup.php'); ?>
                  <div class="form__row">
                     <div>
                        <div class="form-section__rows publication_details">

                           <div class="row">

                              <?php
                              if (!$publication) {
                                 $current_record = NULL;
                                 include(dirname(__FILE__) . '/step2/publication/normal_header.php');
                                 include(dirname(__FILE__) . '/step2/publication/common.php');
                              } else if (is_array($publication)) {

                                 $kount = 0;

                                 foreach ($publication as $current_record) {
                                    if ($kount == 0) {
                                       include(dirname(__FILE__) . '/step2/publication/normal_header.php');
                                    } else {
                              ?>
                                       <div class="user_data">
                                       <?php
                                       include(dirname(__FILE__) . '/step2/publication/repeat_header.php');
                                    }
                                    include(dirname(__FILE__) . '/step2/publication/common.php');

                                    if ($kount > 0) { ?>

                                       </div>
                              <?php  }

                                    $kount++;
                                 }
                              }

                              ?>


                           </div>
                        </div>

                        <button onclick="add_new_section('publication');" class="button--grey button--add-section-item" type="button">
                           <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg-add-circle-outline" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                              <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7zm-1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path>
                           </svg>
                           Add another publication
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="group" data-section-id="7">
            <h3>
               <div class="form-section__header-icon">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                     <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"></path>
                  </svg>
               </div>
               Achievements
            </h3>
            <div>
               <div class="form-section__fieldset">
                  <?php include(dirname(__FILE__) . '/step2/achievement/popup.php'); ?>
                  <div class="form__row">
                     <div>
                        <div class="form-section__rows achievement_details">

                           <div class="row">

                              <?php
                              if (!$achievement) {
                                 $current_record = NULL;
                                 include(dirname(__FILE__) . '/step2/achievement/normal_header.php');
                                 include(dirname(__FILE__) . '/step2/achievement/common.php');
                              } else if (is_array($achievement)) {

                                 $kount = 0;

                                 foreach ($achievement as $current_record) {
                                    if ($kount == 0) {
                                       include(dirname(__FILE__) . '/step2/achievement/normal_header.php');
                                    } else {
                              ?>
                                       <div class="user_data">
                                       <?php
                                       include(dirname(__FILE__) . '/step2/achievement/repeat_header.php');
                                    }
                                    include(dirname(__FILE__) . '/step2/achievement/common.php');

                                    if ($kount > 0) { ?>

                                       </div>
                              <?php  }

                                    $kount++;
                                 }
                              }

                              ?>


                           </div>
                        </div>

                        <button onclick="add_new_section('achievement');" class="button--grey button--add-section-item" type="button">
                           <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg-add-circle-outline" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                              <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7zm-1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path>
                           </svg>
                           Add another achievement
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="group" data-section-id="8">
            <h3>
               <div class="form-section__header-icon"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                     <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm6.93 6h-2.95c-.32-1.25-.78-2.45-1.38-3.56 1.84.63 3.37 1.91 4.33 3.56zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2 0 .68.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56-1.84-.63-3.37-1.9-4.33-3.56zm2.95-8H5.08c.96-1.66 2.49-2.93 4.33-3.56C8.81 5.55 8.35 6.75 8.03 8zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2 0-.68.07-1.35.16-2h4.68c.09.65.16 1.32.16 2 0 .68-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95c-.96 1.65-2.49 2.93-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2 0-.68-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z"></path>
                  </svg></div>
               Geographies
            </h3>
            <div>
               <div class="form-section__fieldset">

                  <?php include(dirname(__FILE__) . '/step2/geographies/popup.php'); ?>
                  <div>
                     <div class="form-section__rows geographies_details">
                        <div class="form__row">

                           <?php
                           if (!$geographies) {
                              $current_record = NULL;
                              include(dirname(__FILE__) . '/step2/geographies/normal_header.php');
                              include(dirname(__FILE__) . '/step2/geographies/common.php');
                           } else if (is_array($geographies)) {

                              $kount = 0;

                              foreach ($geographies as $current_record) {
                                 if ($kount == 0) {
                                    include(dirname(__FILE__) . '/step2/geographies/normal_header.php');
                                 } else {

                           ?>
                                    <div class="user_data">
                                    <?php
                                    include(dirname(__FILE__) . '/step2/geographies/repeat_header.php');
                                 }
                                 include(dirname(__FILE__) . '/step2/geographies/common.php');

                                 if ($kount > 0) { ?>

                                    </div>
                           <?php  }

                                 $kount++;
                              }
                           }

                           ?>


                        </div>
                     </div>
                     <button onclick="add_new_section('geographies');" class="button--grey button--add-section-item" type="button">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg-add-circle-outline" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                           <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7zm-1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path>
                        </svg>
                        Add another geography location
                     </button>
                  </div>
               </div>
            </div>
         </div>
         <div class="group" data-section-id="9">
            <h3>
               <div class="form-section__header-icon">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                     <path d="M10 16v-1H3.01L3 19c0 1.11.89 2 2 2h14c1.11 0 2-.89 2-2v-4h-7v1h-4zm10-9h-4.01V5l-2-2h-4l-2 2v2H4c-1.1 0-2 .9-2 2v3c0 1.11.89 2 2 2h6v-2h4v2h6c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zm-6 0h-4V5h4v2z"></path>
                  </svg>
               </div>
               Work experience
            </h3>
            <div>
               <div class="form-section__fieldset">
                  <div class="user-details work_experience_details">
                     <div class="form__row">


                        <?php
                        if (!$work_experience) {
                           $current_record = NULL;
                           include(dirname(__FILE__) . '/step2/work_experience/normal_header.php');
                           include(dirname(__FILE__) . '/step2/work_experience/common.php');
                        } else if (is_array($work_experience)) {

                           $kount = 0;

                           foreach ($work_experience as $current_record) {
                              if ($kount == 0) {
                                 include(dirname(__FILE__) . '/step2/work_experience/normal_header.php');
                              } else {
                        ?>
                                 <div class="user_data">
                                 <?php

                                 include(dirname(__FILE__) . '/step2/work_experience/repeat_header.php');
                              }
                              include(dirname(__FILE__) . '/step2/work_experience/common.php');

                              if ($kount > 0) { ?>

                                 </div>
                        <?php  }

                              $kount++;
                           }
                        }

                        ?>
                     </div>
                  </div>
                  <div class="form-group">
                     <button onclick="add_new_section('work_experience');" class="button--grey button--add-section-item add_work_experience" autocomplete="false" type="button">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg-add-circle-outline" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                           <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7zm-1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path>
                        </svg>
                        Add another work experience
                     </button>
                  </div>
                  <?php include(dirname(__FILE__) . '/step2/work_experience/popup.php'); ?>
                  <div>
                  </div>
               </div>

            </div>
         </div>
         <div class="group" data-section-id="10">
            <h3>
               <div class="form-section__header-icon">
                  <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                     <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"></path>
                  </svg>
               </div>
               Custom Section
            </h3>
            <div>
               <div class="form-section__fieldset">
                  <?php include(dirname(__FILE__) . '/step2/custom_section/popup.php'); ?>
                  <div class="form__row">
                     <div>
                        <div class="form-section__rows custom_section_details">

                           <div class="row">

                              <?php
                              if (!$custom_section) {
                                 $current_record = NULL;
                                 include(dirname(__FILE__) . '/step2/custom_section/normal_header.php');
                                 include(dirname(__FILE__) . '/step2/custom_section/common.php');
                              } else if (is_array($custom_section)) {

                                 $kount = 0;

                                 foreach ($custom_section as $current_record) {
                                    if ($kount == 0) {
                                       include(dirname(__FILE__) . '/step2/custom_section/normal_header.php');
                                    } else {
                              ?>
                                       <div class="user_data">
                                       <?php
                                       include(dirname(__FILE__) . '/step2/custom_section/repeat_header.php');
                                    }
                                    include(dirname(__FILE__) . '/step2/custom_section/common.php');

                                    if ($kount > 0) { ?>

                                       </div>
                              <?php  }

                                    $kount++;
                                 }
                              }

                              ?>


                           </div>
                        </div>

                        <button onclick="add_new_section('custom_section');" class="button--grey button--add-section-item" type="button">
                           <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg-add-circle-outline" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                              <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4V7zm-1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path>
                           </svg>
                           Add another custom section
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php echo form_close(); ?>
   </section>
   <div class="form__buttons">
					<div class="form__button">
					<button type="submit" class="btn__large button--purple" onclick="window.location.href='/cvmaker'">
							<div class="spinner--hidden"></div>
							BACK
							<div class="btn__arrow-left">
								<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg-keyboard-arrow-right" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
									<path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"></path>
								</svg>
							</div>
						</button>	
               <button type="submit" class="btn__large button--purple" onclick="window.location.href='/cvmaker/preview'">
							<div class="spinner--hidden"></div>
							PREVIEW
							<div class="btn__arrow-right">
								<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" class="svg-keyboard-arrow-right" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
									<path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"></path>
								</svg>
							</div>
						</button>
					</div>
					
				</div>

</div>

<?php include(dirname(__FILE__) . '/step2/step2_js.php'); ?>