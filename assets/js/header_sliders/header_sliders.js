!function(e){var a={};function r(t){if(a[t])return a[t].exports;var d=a[t]={i:t,l:!1,exports:{}};return e[t].call(d.exports,d,d.exports,r),d.l=!0,d.exports}r.m=e,r.c=a,r.d=function(e,a,t){r.o(e,a)||Object.defineProperty(e,a,{enumerable:!0,get:t})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,a){if(1&a&&(e=r(e)),8&a)return e;if(4&a&&"object"==typeof e&&e&&e.__esModule)return e;var t=Object.create(null);if(r.r(t),Object.defineProperty(t,"default",{enumerable:!0,value:e}),2&a&&"string"!=typeof e)for(var d in e)r.d(t,d,function(a){return e[a]}.bind(null,d));return t},r.n=function(e){var a=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(a,"a",a),a},r.o=function(e,a){return Object.prototype.hasOwnProperty.call(e,a)},r.p="/",r(r.s=68)}({68:function(e,a,r){e.exports=r("on0R")},on0R:function(e,a,r){"use strict";$("#headerSlidersTbl").DataTable({processing:!0,serverSide:!0,searching:!1,bSort:!1,ajax:{url:headerSliderUrl,data:function(e){e.is_active=$("#headerFilterStatus").find("option:selected").val()}},columnDefs:[{targets:[0],width:"100%"},{targets:[1,2],className:"text-center",width:"10%"}],columns:[{data:function(e){return'<img src="'+e.header_slider_url+'" class="rounded-circle thumbnail-rounded"</img>'},name:"id"},{data:function(e){var a=0===e.is_active?"":"checked",r=[{id:e.id,checked:a}];return prepareTemplateRender("#isActive",r)},name:"is_active"},{data:function(e){var a=[{id:e.id}];return prepareTemplateRender("#headerSliderActionTemplate",a)},name:"id"}],fnInitComplete:function(){$("#headerFilterStatus").change((function(){$("#headerSlidersTbl").DataTable().ajax.reload(null,!0)}))}}),$(document).ready((function(){$("#headerFilterStatus").select2()})),$(document).on("submit","#addNewForm",(function(e){e.preventDefault(),processingBtn("#addNewForm","#btnSave","loading"),$("#description").summernote("isEmpty")&&$("#description").val(""),$.ajax({url:headerSliderSaveUrl,type:"POST",data:new FormData($(this)[0]),dataType:"JSON",processData:!1,contentType:!1,success:function(e){e.success&&(displaySuccessMessage(e.message),$("#addModal").modal("hide"),$("#headerSlidersTbl").DataTable().ajax.reload(null,!1))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#addNewForm","#btnSave")}})})),$(document).on("click",".edit-btn",(function(e){var a=$(e.currentTarget).data("id");renderData(a)})),window.renderData=function(e){$.ajax({url:headerSliderUrl+e+"/edit",type:"GET",success:function(e){e.success&&($("#headerSliderId").val(e.data.id),isEmpty(e.data.header_slider_url)?$("#editPreviewImage").attr("src",defaultDocumentImageUrl):($("#editPreviewImage").attr("src",e.data.header_slider_url),$("#imageSliderUrl").attr("href",e.data.header_slider_url),$("#imageSliderUrl").text(view)),$("#editModal").appendTo("body").modal("show"))},error:function(e){displayErrorMessage(e.responseJSON.message)}})},$(document).on("submit","#editForm",(function(e){e.preventDefault(),processingBtn("#editForm","#btnEditSave","loading");var a=$("#headerSliderId").val();$.ajax({url:headerSliderUrl+a+"/update",type:"POST",data:new FormData($(this)[0]),dataType:"JSON",processData:!1,contentType:!1,success:function(e){e.success&&(displaySuccessMessage(e.message),$("#editModal").modal("hide"),$("#headerSlidersTbl").DataTable().ajax.reload(null,!1))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#editForm","#btnEditSave")}})})),$(document).on("click",".addHeaderSliderModal",(function(){$("#addModal").appendTo("body").modal("show")})),$(document).on("click",".delete-btn",(function(e){var a=$(e.currentTarget).data("id");deleteItem(headerSliderUrl+a,"#headerSlidersTbl","Header Slider")})),$("#addModal").on("hidden.bs.modal",(function(){resetModalForm("#addNewForm","#validationErrorsBox"),$("#previewImage").attr("src",defaultDocumentImageUrl)})),window.displayImage=function(e,a,r){var t=!0;if(e.files&&e.files[0]){var d=new FileReader;d.onload=function(e){var d=new Image;d.src=e.target.result,d.onload=function(){if(d.height<1080||d.width<1920)return $("#imageSlider").val(""),$(r).removeClass("d-none"),$(r).html(headerSizeMessage).show(),!1;$(a).attr("src",e.target.result),t=!0}},t&&(d.readAsDataURL(e.files[0]),$(a).show())}},window.isValidImage=function(e,a){var r=$(e).val().split(".").pop().toLowerCase();return-1==$.inArray(r,["png","jpg","jpeg"])?($(e).val(""),$(a).removeClass("d-none"),$(a).html(headerSizeMessage).show(),!1):($(a).hide(),!0)},$(document).on("change","#headerSlider",(function(){$("#addModal #validationErrorsBox").addClass("d-none"),isValidImage($(this),"#addModal #validationErrorsBox")&&displayImage(this,"#previewImage","#addModal #validationErrorsBox")})),$(document).on("change","#editHeaderSlider",(function(){$("#editModal #validationErrorsBox").addClass("d-none"),isValidFile($(this),"#editModal #validationErrorsBox")&&displayImage(this,"#editPreviewImage","#editModal #validationErrorsBox")})),$(document).on("change",".isActive",(function(e){var a=$(e.currentTarget).data("id");changeIsActive(a)})),window.changeIsActive=function(e){$.ajax({url:headerSliderUrl+e+"/change-is-active",method:"post",cache:!1,success:function(e){e.success&&(displaySuccessMessage(e.message),$("#headerSlidersTbl").DataTable().ajax.reload(null,!1))},error:function(e){displayErrorMessage(e.responseJSON.message)}})},$(".searchIsActive").on("change",(function(){$.ajax({url:headerSliderUrl+"change-search-disable",method:"post",data:$("#searchIsActive").serialize(),dataType:"JSON",success:function(e){e.success&&(displaySuccessMessage(e.message),$("#imageSlidersTbl").DataTable().ajax.reload(null,!1))},error:function(e){displayErrorMessage(e.responseJSON.message)}})}))}});