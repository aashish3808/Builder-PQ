!function(e){var t={};function a(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,a),o.l=!0,o.exports}a.m=e,a.c=t,a.d=function(e,t,r){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(a.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)a.d(r,o,function(t){return e[t]}.bind(null,o));return r},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="/",a(a.s=22)}({22:function(e,t,a){e.exports=a("Rqfw")},Rqfw:function(e,t){$(document).ready((function(){"use strict";new AutoNumeric("#toSalary",{maximumValue:2e5,currencySymbol:"",digitGroupSeparator:",",decimalPlaces:1,currencySymbolPlacement:AutoNumeric.options.currencySymbolPlacement.suffix}),new AutoNumeric("#fromSalary",{maximumValue:9e4,currencySymbol:"",digitGroupSeparator:",",decimalPlaces:1,currencySymbolPlacement:AutoNumeric.options.currencySymbolPlacement.suffix}),$("#toSalary").on("keyup",(function(){var e=parseInt(Math.trunc(removeCommas($("#fromSalary").val())));parseInt(Math.trunc(removeCommas($("#toSalary").val())))<e?($("#toSalary").focus(),$("#salaryToErrorMsg").text("Please enter Salary Range To greater than Salary Range From."),$(".actions [href='#next']").css({opacity:"0.7","pointer-events":"none"}),$("#saveJob").attr("disabled",!0)):($("#salaryToErrorMsg").text(""),$(".actions [href='#next']").css({opacity:"1","pointer-events":"inherit"}),$("#saveJob").attr("disabled",!1))})),$("#toSalary").on("wheel",(function(e){$(this).trigger("keyup")})),$("#fromSalary").on("keyup",(function(){var e=parseInt(Math.trunc(removeCommas($("#fromSalary").val())));parseInt(Math.trunc(removeCommas($("#toSalary").val())))<e?($("#fromSalary").focus(),$("#salaryToErrorMsg").text("Please enter Salary Range To greater than Salary Range From."),$(".actions [href='#next']").css({opacity:"0.7","pointer-events":"none"}),$("#saveJob").attr("disabled",!0)):($("#salaryToErrorMsg").text(""),$(".actions [href='#next']").css({opacity:"1","pointer-events":"inherit"}),$("#saveJob").attr("disabled",!1))})),$("#fromSalary").on("wheel",(function(e){$(this).trigger("keyup")})),$("#jobTypeId,#careerLevelsId,#jobShiftId,#currencyId,#countryId,#stateId,#cityId").select2({width:"100%"}),$("#salaryPeriodsId,#functionalAreaId,#requiredDegreeLevelId,#preferenceId,#jobCategoryId").select2({width:"100%"}),$("#SkillId").select2({width:"100%",placeholder:"Select Job Skill"}),$("#tagId").select2({width:"100%",placeholder:"Select Job Tag"}),!$("#companyId").hasClass(".select2-hidden-accessible")&&$("#companyId").is("select")&&$("#companyId").select2({width:"100%",placeholder:"Select Company"});var e=new Date;e.setDate(e.getDate()+1),$(".expiryDatepicker").datetimepicker(DatetimepickerDefaults({format:"YYYY-MM-DD",useCurrent:!1,sideBySide:!0,minDate:new Date})),$("#createJobForm, #editJobForm").on("submit",(function(e){return $("#saveJob,#draftJob").attr("disabled",!0),checkSummerNoteEmpty("#details","Job Description field is required.",1)?""!==$("#salaryToErrorMsg").text()?($("#toSalary").focus(),$("#saveJob,#draftJob").attr("disabled",!1),!1):void 0:(e.preventDefault(),$("#saveJob,#draftJob").attr("disabled",!1),!1)})),$("#details").summernote({minHeight:200,height:200,toolbar:[["style",["bold","italic","underline","clear"]],["font",["strikethrough"]],["para",["paragraph"]]]}),$("#editDetails").summernote({minHeight:200,height:200,toolbar:[["style",["bold","italic","underline","clear"]],["font",["strikethrough"]],["para",["paragraph"]]]}),$("#countryId").on("change",(function(){$.ajax({url:jobStateUrl,type:"get",dataType:"json",data:{postal:$(this).val()},success:function(e){$("#stateId").empty(),$("#stateId").append($('<option value=""></option>').text("Select State")),$.each(e.data,(function(e,t){$("#stateId").append($("<option></option>").attr("value",e).text(t))}))}})})),$("#stateId").on("change",(function(){$.ajax({url:jobCityUrl,type:"get",dataType:"json",data:{state:$(this).val(),country:$("#countryId").val()},success:function(e){$("#cityId").empty(),$.each(e.data,(function(e,t){$("#cityId").append($("<option></option>").attr("value",e).text(t))}))}})})),window.autoNumeric=function(e,t){$(e)[0].reset(),$("select.select2Selector").each((function(e,t){var a="#"+$(this).attr("id");$(a).val(""),$(a).trigger("change")})),$(t).hide()}}))}});