!function(e){var o={};function r(t){if(o[t])return o[t].exports;var a=o[t]={i:t,l:!1,exports:{}};return e[t].call(a.exports,a,a.exports,r),a.l=!0,a.exports}r.m=e,r.c=o,r.d=function(e,o,t){r.o(e,o)||Object.defineProperty(e,o,{enumerable:!0,get:t})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,o){if(1&o&&(e=r(e)),8&o)return e;if(4&o&&"object"==typeof e&&e&&e.__esModule)return e;var t=Object.create(null);if(r.r(t),Object.defineProperty(t,"default",{enumerable:!0,value:e}),2&o&&"string"!=typeof e)for(var a in e)r.d(t,a,function(o){return e[o]}.bind(null,a));return t},r.n=function(e){var o=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(o,"a",o),o},r.o=function(e,o){return Object.prototype.hasOwnProperty.call(e,o)},r.p="/",r(r.s=19)}({19:function(e,o,r){e.exports=r("drf3")},drf3:function(e,o,r){"use strict";$(document).on("submit","#editProfileForm",(function(e){e.preventDefault();var o=jQuery(this).find("#btnPrEditSave");o.button("loading"),$.ajax({url:profileUpdateUrl,type:"post",data:new FormData($(this)[0]),processData:!1,contentType:!1,success:function(e){displaySuccessMessage(e.message),$("#editProfileModal").modal("hide"),location.reload()},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){o.button("reset")}})})),$(document).on("submit","#changePasswordForm",(function(e){e.preventDefault();var o=function(){var e=$("#pfCurrentPassword").val().trim(),o=$("#pfNewPassword").val().trim(),r=$("#pfNewConfirmPassword").val().trim();if(""==e||""==o||""==r)return $("#editPasswordValidationErrorsBox").show().html("Please fill all the required fields."),!1;return!0}();if(console.log(o),!o)return!1;var r=jQuery(this).find("#btnPrPasswordEditSave");r.button("loading"),$.ajax({url:changePasswordUrl,type:"post",data:new FormData($(this)[0]),processData:!1,contentType:!1,success:function(e){e.success&&($("#changePasswordModal").modal("hide"),displaySuccessMessage(e.message))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){r.button("reset")}})})),$("#editProfileModal").on("hidden.bs.modal",(function(){resetModalForm("#editProfileForm","#profilePictureValidationErrorsBox")})),$("#changeLanguageModal").on("hide.bs.modal",(function(){resetModalForm("#changeLanguageForm","#editProfileValidationErrorsBox")})),$(document).on("click",".editProfileModal",(function(e){renderProfileData()})),window.renderProfileData=function(){$.ajax({url:profileUrl,type:"GET",success:function(e){if(e.success){var o=e.data;$("#editUserId").val(o.id),$("#firstName").val(o.first_name),$("#lastName").val(o.last_name),$("#userEmail").val(o.email),$("#phone").val(o.phone),$("#profilePicturePreview").attr("src",o.avatar),$("#editProfileModal").appendTo("body").modal("show")}}})},$(document).on("change","#profilePicture",(function(){isValidFile($(this),"#profilePictureValidationErrorsBox")?(validatePhoto(this,"#profilePicturePreview"),$("#btnPrEditSave").prop("disabled",!1)):$("#btnPrEditSave").prop("disabled",!0)})),window.validatePhoto=function(e,o){var r=!0;if(e.files&&e.files[0]){var t=new FileReader;t.onload=function(e){var t=new Image;t.src=e.target.result,t.onload=function(){if(t.height/t.width!=1)return $("#profilePictureValidationErrorsBox").removeClass("d-none"),$("#profilePictureValidationErrorsBox").html("Image aspect ratio should be 1:1").show(),$("#btnPrEditSave").prop("disabled",!0),!1;$(o).attr("src",e.target.result),r=!0}},r&&(t.readAsDataURL(e.files[0]),$(o).show())}},window.isValidFile=function(e,o){var r=$(e).val().split(".").pop().toLowerCase();return-1==$.inArray(r,["png","jpg","jpeg"])?($(e).val(""),$(o).removeClass("d-none"),$(o).html("The image must be a file of type: jpeg, jpg, png.").show(),!1):($(o).hide(),!0)},$("#changePasswordModal").on("hidden.bs.modal",(function(){resetModalForm("#changePasswordForm","#editPasswordValidationErrorsBox")})),$(document).on("submit","#changeLanguageForm",(function(e){e.preventDefault();var o=jQuery(this).find("#btnLanguageChange");o.button("loading"),$.ajax({url:updateLanguageURL,type:"post",data:new FormData($(this)[0]),processData:!1,contentType:!1,success:function(e){$("#changePasswordModal").modal("hide"),displaySuccessMessage(e.message),setTimeout((function(){location.reload()}),1500)},error:function(e){manageAjaxErrors(e,"editProfileValidationErrorsBox")},complete:function(){o.button("reset")}})})),$(document).on("click",".changePasswordModal",(function(){$("#changePasswordModal").appendTo("body").modal("show")})),$(document).on("click",".changeLanguageModal",(function(){$("#changeLanguageModal").appendTo("body").modal("show")}))}});