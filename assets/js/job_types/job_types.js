!function(e){var t={};function o(n){if(t[n])return t[n].exports;var r=t[n]={i:n,l:!1,exports:{}};return e[n].call(r.exports,r,r.exports,o),r.l=!0,r.exports}o.m=e,o.c=t,o.d=function(e,t,n){o.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},o.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},o.t=function(e,t){if(1&t&&(e=o(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(o.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)o.d(n,r,function(t){return e[t]}.bind(null,r));return n},o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,"a",t),t},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},o.p="/",o(o.s=11)}({11:function(e,t,o){e.exports=o("6RMW")},"6RMW":function(e,t,o){"use strict";$(document).on("click",".addJobTypeModal",(function(){$("#addModal").appendTo("body").modal("show")})),$(document).on("submit","#addNewForm",(function(e){if(e.preventDefault(),!checkSummerNoteEmpty("#description","Description field is required.",1))return!0;processingBtn("#addNewForm","#btnSave","loading"),$.ajax({url:jobTypeSaveUrl,type:"POST",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#addModal").modal("hide"),window.livewire.emit("refresh"))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#addNewForm","#btnSave")}})})),$(document).on("click",".edit-btn",(function(e){var t=$(e.currentTarget).attr("data-id");renderData(t)})),window.renderData=function(e){$.ajax({url:jobTypeUrl+e+"/edit",type:"GET",success:function(e){if(e.success){var t=document.createElement("textarea");t.innerHTML=e.data.name,$("#jobTypeId").val(e.data.id),$("#editName").val(t.value),$("#editDescription").summernote("code",e.data.description),$("#editModal").appendTo("body").modal("show")}},error:function(e){displayErrorMessage(e.responseJSON.message)}})},$(document).on("submit","#editForm",(function(e){if(e.preventDefault(),!checkSummerNoteEmpty("#editDescription","Description field is required.",1))return!0;processingBtn("#editForm","#btnEditSave","loading");var t=$("#jobTypeId").val();$.ajax({url:jobTypeUrl+t,type:"put",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#editModal").modal("hide"),window.livewire.emit("refresh"))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#editForm","#btnEditSave")}})})),$(document).on("click",".show-btn",(function(e){var t=$(e.currentTarget).attr("data-id");$.ajax({url:jobTypeUrl+t,type:"GET",success:function(e){if(e.success){$("#showName").html(""),$("#showDescription").html(""),$("#showName").append(e.data.name);var t=document.createElement("textarea");t.innerHTML=e.data.description,$("#showDescription").append(t.value),$("#showModal").appendTo("body").modal("show")}},error:function(e){displayErrorMessage(e.responseJSON.message)}})})),$(document).on("click",".delete-btn",(function(e){var t=$(e.currentTarget).attr("data-id");swal({title:"Delete !",text:'Are you sure want to delete this "Job Type" ?',type:"warning",showCancelButton:!0,closeOnConfirm:!1,showLoaderOnConfirm:!0,confirmButtonColor:"#6777ef",cancelButtonColor:"#d33",cancelButtonText:"No",confirmButtonText:"Yes"},(function(){window.livewire.emit("deleteJobType",t)}))})),document.addEventListener("delete",(function(){swal({title:"Deleted!",text:"Job Type has been deleted.",type:"success",confirmButtonColor:"#6777ef",timer:2e3})})),$("#addModal").on("hidden.bs.modal",(function(){resetModalForm("#addNewForm","#validationErrorsBox"),$("#description").summernote("code","")})),$("#editModal").on("hidden.bs.modal",(function(){resetModalForm("#editForm","#editValidationErrorsBox")})),$("#description, #editDescription").summernote({minHeight:200,height:200,toolbar:[["style",["bold","italic","underline","clear"]],["font",["strikethrough"]],["para",["paragraph"]]]})}});