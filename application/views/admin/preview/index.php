<html>

<head>
<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,400i,700,800|Varela+Round" rel="stylesheet">
      <link rel="stylesheet" href="assets/css/iziToast.min.css">
      <!-- CSS links -->
      <title> Preview | CV </title>
      
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
     
   

          
    <link href="https://www.uttammitra.com/cvmaker/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://www.uttammitra.com/cvmaker/assets/css/select2.min.css" rel="stylesheet" type="text/css"/>


    <link rel="stylesheet" href="https://www.uttammitra.com/cvmaker/assets/css/iziToast.min.css">
    <link rel="stylesheet" href="https://www.uttammitra.com/cvmaker/assets/css/font-awesome.min.css">
    <link href="https://www.uttammitra.com/cvmaker/assets/css/sweetalert.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://www.uttammitra.com/cvmaker/assets/css/custom.css">

    <link href="https://www.uttammitra.com/cvmaker/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://www.uttammitra.com/cvmaker/assets/css/select2.min.css" rel="stylesheet" type="text/css"/>


    <link rel="stylesheet" href="https://www.uttammitra.com/cvmaker/assets/web/css/style.css">
    <link rel="stylesheet" href="https://www.uttammitra.com/cvmaker/assets/web/css/components.css">
    <link rel="stylesheet" href="https://www.uttammitra.com/cvmaker/assets/css/custom.css?var=123s"  type="text/css" media="screen, print">
      <![endif]-->
      <style>

          .resumes {
   width: 800px;
    
    position: relative;
    background-color: #fff;   
    padding:20px;
    border-top: 5px solid #8501ed;
    margin:0 auto;
          }
          .resumes .row {
    border-bottom: 1px dashed #e6e6e6 !important;
    
}
.inner-box {
    padding-top: 15px !important;
    padding-bottom: 15px !important;
}
.time-line ul li:nth-child(5) {
    border-right: 8px solid #3b068e !important;
    
}
      </style>
       <script src="https://www.uttammitra.com/cvmaker/html2pdfmaster/dist/html2pdf.bundle.js"></script>



</head>

<body>
<div class="resumes" id="resumes">
                     <div class="row">
                        <div class="col-md-2">
                           <div class="profile-pan"> <?php $image_source = get_image_source("admin/thumbs/thumb_" . stripslashes(@$personal_detail->profileImage));?>
                           <img class="img-thumbnail thumbnail-preview" src="<?php echo $image_source;?>" alt="logo"> </div>
                        </div>
                        <div class="col-md-6 profile-pan">
                           <h4><?php echo $personal_detail->first_name;?> <?php echo $personal_detail->last_name;?></h4>
                           <p><?php echo $personal_detail->company;?></p>
                          
                           <?php if(!empty($personal_detail->linkedin)) {?> <p><a href="<?php echo $personal_detail->linkedin;?>" title="Linkedin">
                           <img src="https://phpstack-553339-1975010.cloudwaysapps.com/assets/img/linked-in.jpg" alt="logo">
                           </a></p><?php }?>  
                                              
                         
                        </div>
                        <div class="col-md-4">
                           <div class="top-right">
                              <p><i class="fas fa-phone-alt"></i> <?php echo $personal_detail->phone;?></p>
                              <p><i class="far fa-envelope"></i> <?php echo $personal_detail->contact_email;?></p>
                           </div>
                        </div>
                     </div>

                     
                     <div class="row timelines" <?php if (($section_choice[0]->status)=="0") { echo "style=display:none !imporatnt"; } ?>>
                        <div class="col-md-12">
                           <div class="time-line">
                              <h3><?php if (!empty($section_choice[0]->value)) { echo $section_choice[0]->value; } else { ?>TIME-LINE<?php }?></h3>
                              <ul>

                             <?php  if(is_array($education) && count($education)) {
                                       foreach($education as $edu) {
                ?>
                <li>               
                                    <span class="year"><?php echo $edu->start_year;?></span>
                                    <div class="border"></div>
                                    <div class="time-line-innercon">  <span><?php echo $edu->degree;?></span><span><?php echo strip_tags($edu->description);?></span> <span><span><?php echo $edu->school;?> <?php echo $edu->from_city;?>
                                    <p><?php echo $edu->start_year;?> - <?php echo $edu->end_year;?></p></span></span>
                                    </div>
                                 </li>
                <?php
            }

        } ?>
                                 
                                
                              </ul>
                           </div>
                        </div>
                     </div>



                     <div class="row exsum" <?php if (($section_choice[1]->status)=="0") { echo "style=display:none !imporatnt"; } ?>>
                        <div class="col-md-12">
                           <div class="inner-box">
                              <h2><?php if (!empty($section_choice[1]->value)) { echo $section_choice[1]->value; } else { ?>EXECUTIVE SUMMARY<?php }?></h2>
                              <ul>
                              <?php  if(is_array($executive_summary) && count($executive_summary)) {
            foreach($executive_summary as $reso) {
                ?>
                <li><?php echo $reso->description;?> </li>
                <?php
            }

        } ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="row" <?php if (($section_choice[2]->status)=="0") { echo "style=display:none !imporatnt"; } ?>>
                        <div class="col-md-6">
                           <div class="inner-box">
                              <h2><?php if (!empty($section_choice[2]->value)) { echo $section_choice[2]->value; } else { ?>INDUSTRIES WORKED IN<?php }?></h2>
                              <ul>
                              <?php  if(is_array($industries) && count($industries)) {
            foreach($industries as $hob) {
                ?>
                <li><?php echo $hob->name;?> </li>
                <?php
            }

        } ?>
                              </ul>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="inner-box">
                              <h2><?php if (!empty($section_choice[3]->value)) { echo $section_choice[3]->value; } else { ?>CORE COMPETENCIES<?php }?></h2>
                              <ul>
                              <?php  if(is_array($competencies) && count($competencies)) {
            foreach($competencies as $ski) {
                ?>
                <li><?php echo $ski->name;?> <p><?php echo $ski->description;?></p> </li>
                <?php
            }

        } ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="row patents" <?php if (($section_choice[4]->status)=="0") { echo "style=display:none !imporatnt"; } ?>>
                        <div class="col-md-12">
                           <div class="inner-box">
                              <h2><?php if (!empty($section_choice[4]->value)) { echo $section_choice[4]->value; } else { ?>PATENTS<?php }?></h2>
                              <ul>
                              <?php  if(is_array($patent) && count($patent)) {
            foreach($patent as $cou) {
                ?>
                <li><?php echo $cou->name;?> <p><?php echo $cou->description;?></p> </li>
                <?php
            }

        } ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="row public" <?php if (($section_choice[5]->status)=="0") { echo "style=display:none !imporatnt"; } ?>>
                        <div class="col-md-12">
                           <div class="inner-box">
                              <h2><?php if (!empty($section_choice[5]->value)) { echo $section_choice[5]->value; } else { ?>PUBLICATIONS<?php }?></h2>
                              <ul>
                              <?php  if(is_array($publication) && count($publication)) {
            foreach($publication as $pub) {
                ?>
                <li><?php echo $pub->name;?> <p><?php echo $pub->description;?></p> </li>
                <?php
            }

        } ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="row acivments" <?php if (($section_choice[6]->status)=="0") { echo "style=display:none !imporatnt"; } ?>>
                        <div class="col-md-12">
                           <div class="inner-box">
                              <h2><?php if (!empty($section_choice[6]->value)) { echo $section_choice[6]->value; } else { ?>ACHIEVEMENT<?php }?></h2>
                              <ul>
                              <?php  if(is_array($achievement) && count($achievement)) {
            foreach($achievement as $achi) {
                ?>
                <li><?php echo $achi->name;?> <p><?php echo $achi->description;?></p> </li>
                <?php
            }

        } ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="row geogr" <?php if (($section_choice[7]->status)=="0") { echo "style=display:none !imporatnt"; } ?>>
                        <div class="col-md-7">
                           <div class="inner-box">
                              <h2><?php if (!empty($section_choice[7]->value)) { echo $section_choice[7]->value; } else { ?>GEOGRAPHIES WORKED IN<?php }?></h2>
                              <ul>
                              <?php  if(is_array($geographies) && count($geographies)) {
            foreach($geographies as $lang) {
                ?>
                <li><?php echo $lang->name;?> </li>
                <?php
            }

        } ?>
                              </ul>
                           </div>
                        </div>
                        <?php if(!empty($personal_detail->globalMap)) { $globalMap = get_image_source("admin/thumbs/thumb_" . stripslashes(@$personal_detail->globalMap)); ?>
                        <div class="col-md-5"><img src="<?php echo $globalMap;?>" alt="map"></div>
                        <?php }?>
                     </div>

                    
                     <div class="row workexp" <?php if (($section_choice[8]->status)=="0") { echo "style=display:none !imporatnt"; } ?>>
                        <div class="col-md-4">
                           <div class="inner-box">
                             
                           <h2><?php if (!empty($section_choice[8]->value)) { echo $section_choice[8]->value; } else { ?>WORK EXPERIENCE<?php }?></h2>
                           </div>
                        </div>
                    </div>

                    <?php  if(is_array($work_experience) && count($work_experience)) {
            foreach($work_experience as $wrkexp) {
                ?>
                <div class="row wok_data">
                        <div class="col-md-3">
                        
                           <div class="inner-box">
                             <?php $monthNum  = $wrkexp->start_month;

$monthName_start = date('M', mktime(0, 0, 0, $monthNum, 10)); 

?> 

<?php $end_month  = $wrkexp->end_month;

$monthName_end = date('M', mktime(0, 0, 0, $end_month, 10)); 

?> 
                              <h3><span class="text-muted"><?php echo $monthName_start;?>  <?php echo $wrkexp->start_year;?>  - <?php echo ucfirst($monthName_end);?><?php if($monthName_end != "present"){ ?>  <?php echo $wrkexp->end_year;?><?php } ?></span> </h3>
                           </div>
                        </div>
                        <div class="col-md-9">
                           <div class="inner-box kkkk">
                             
                              <!-- <h3><?php echo $wrkexp->job_title;?> </h3> -->
                             <?php echo $wrkexp->description;?> 
           
                              
                           </div>
                        </div>
                     </div>
                <?php
            }

        } ?>


<?php  if(is_array($custom_section) && count($custom_section)) {
            foreach($custom_section as $cussel) {
                ?>

<div class="row custom_se"  <?php if (($section_choice[9]->status)=="0") { echo "style=display:none !imporatnt"; } ?>>
                        <div class="col-md-4">
                           <div class="inner-box hjgj">
                             
                           <h2><?php echo $cussel->heading;?></h2>
                           </div>
                        </div>
                    </div>
                <div class="row cus_se" <?php if (($section_choice[9]->status)=="0") { echo "style=display:none !imporatnt"; } ?>>                       
                        <div class="col-md-12">
                           <div class="inner-box">
                             
                              <ul <?php if (($section_choice[9]->status)=="0") { echo "style=display:none !imporatnt"; } ?>>
                                 <li><?php echo $cussel->description;?> 
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                <?php
            }

        } ?>

                    


                    
                  </div>

                  <div class="modal-footer">
               
                <button class="btn btn-primary" id="downloadPDF" onclick="savePdf()">Download PDF</button>
               
            </div>      
            
            <script>
  function savePdf() {
     
    // Get the element.
    var element = document.getElementById('resumes');

    // Generate the PDF.
    html2pdf().from(element).set({
      margin: 0.2,
      filename: 'cv_builer_<?php echo time();?>.pdf',
      html2canvas: { scale: 2 },
      jsPDF: {orientation: 'portrait', unit: 'in', format: 'letter', compressPDF: true}
    }).save();
  }
</script>

        <?php //pr($data,0);?>


</body>


</html>