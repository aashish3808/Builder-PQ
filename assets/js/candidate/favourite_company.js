!function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=43)}({43:function(e,t,n){e.exports=n("Z6nV")},Z6nV:function(e,t,n){"use strict";document.addEventListener("livewire:load",(function(e){window.livewire.hook("afterDomUpdate",(function(){setTimeout((function(){$(".alert").fadeOut("fast")}),4e3)}))})),$(document).on("click",".favorite-companies-delete",(function(e){var t=$(e.currentTarget).attr("data-id");swal({title:"Delete !",text:'Are you sure want to remove "Favourite Company" ?',type:"warning",showCancelButton:!0,closeOnConfirm:!1,showLoaderOnConfirm:!0,confirmButtonColor:"#6777ef",cancelButtonColor:"#d33",cancelButtonText:"No",confirmButtonText:"Yes"},(function(){window.livewire.emit("removeFavouriteCompany",t)}))})),document.addEventListener("deleted",(function(){swal({title:"Deleted!",text:"Favourite company has been deleted.",type:"success",timer:2e3})}))}});