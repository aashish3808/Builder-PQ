!function(e){var t={};function o(r){if(t[r])return t[r].exports;var n=t[r]={i:r,l:!1,exports:{}};return e[r].call(n.exports,n,n.exports,o),n.l=!0,n.exports}o.m=e,o.c=t,o.d=function(e,t,r){o.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},o.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},o.t=function(e,t){if(1&t&&(e=o(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(o.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)o.d(r,n,function(t){return e[t]}.bind(null,n));return r},o.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return o.d(t,"a",t),t},o.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},o.p="/",o(o.s=42)}({42:function(e,t,o){e.exports=o("wCZG")},wCZG:function(e,t){$(document).ready((function(){isCompanyAddedToFavourite?$(".favouriteText").text(unfollowText):$(".favouriteText").text(followText),$("#addToFavourite").on("click",(function(){var e=$(this).data("favorite-user-id"),t=$(this).data("favorite-company_id");$.ajax({url:addCompanyFavouriteUrl,type:"POST",data:{_token:$('meta[name="csrf-token"]').attr("content"),userId:e,companyId:t},success:function(e){e.success&&(console.log(e.data),e.data?$(".favouriteText").text(unfollowText):$(".favouriteText").text(followText),displaySuccessMessage(e.message))},error:function(e){displayErrorMessage(e.responseJSON.message)}})})),$(document).on("submit","#reportToCompany",(function(e){e.preventDefault(),processingBtn("#reportToCompany","#btnSave","loading"),$.ajax({url:reportToCompanyUrl,type:"POST",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#reportToCompanyModal").modal("hide"),$(".reportToCompany").prop("disabled",!0))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#reportToCompany","#btnSave")}})}))}))}});