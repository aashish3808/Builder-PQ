!function(e){var t={};function r(n){if(t[n])return t[n].exports;var o=t[n]={i:n,l:!1,exports:{}};return e[n].call(o.exports,o,o.exports,r),o.l=!0,o.exports}r.m=e,r.c=t,r.d=function(e,t,n){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(r.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)r.d(n,o,function(t){return e[t]}.bind(null,o));return n},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="/",r(r.s=16)}({16:function(e,t,r){e.exports=r("qla3")},qla3:function(e,t,r){"use strict";$(document).on("click",".addRequiredDegreeLevelTypeModal",(function(){$("#addModal").appendTo("body").modal("show")})),$(document).on("submit","#addNewForm",(function(e){e.preventDefault(),processingBtn("#addNewForm","#btnSave","loading"),$.ajax({url:requiredDegreeLevelSaveUrl,type:"POST",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#addModal").modal("hide"),window.livewire.emit("refresh"))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#addNewForm","#btnSave")}})})),$(document).on("click",".edit-btn",(function(e){var t=$(e.currentTarget).attr("data-id");renderData(t)})),window.renderData=function(e){$.ajax({url:requiredDegreeLevelUrl+e+"/edit",type:"GET",success:function(e){if(e.success){var t=document.createElement("textarea");t.innerHTML=e.data.name,$("#requiredDegreeLevelId").val(e.data.id),$("#editName").val(t.value),$("#editModal").appendTo("body").modal("show")}},error:function(e){displayErrorMessage(e.responseJSON.message)}})},$(document).on("submit","#editForm",(function(e){e.preventDefault(),processingBtn("#editForm","#btnEditSave","loading");var t=$("#requiredDegreeLevelId").val();$.ajax({url:requiredDegreeLevelUrl+t,type:"put",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#editModal").modal("hide"),window.livewire.emit("refresh"))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#editForm","#btnEditSave")}})})),$(document).on("click",".delete-btn",(function(e){var t=$(e.currentTarget).attr("data-id");swal({title:"Delete !",text:'Are you sure want to delete this "Degree Level" ?',type:"warning",showCancelButton:!0,closeOnConfirm:!1,showLoaderOnConfirm:!0,confirmButtonColor:"#6777ef",cancelButtonColor:"#d33",cancelButtonText:"No",confirmButtonText:"Yes"},(function(){window.livewire.emit("deleteDegree",t)}))})),document.addEventListener("delete",(function(){swal({title:"Deleted!",text:"Degree Level has been deleted.",type:"success",confirmButtonColor:"#6777ef",timer:2e3})})),$("#addModal").on("hidden.bs.modal",(function(){resetModalForm("#addNewForm","#validationErrorsBox")})),$("#editModal").on("hidden.bs.modal",(function(){resetModalForm("#editForm","#editValidationErrorsBox")}))}});