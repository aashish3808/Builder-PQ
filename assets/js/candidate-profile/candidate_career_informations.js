!function(e){var t={};function a(n){if(t[n])return t[n].exports;var d=t[n]={i:n,l:!1,exports:{}};return e[n].call(d.exports,d,d.exports,a),d.l=!0,d.exports}a.m=e,a.c=t,a.d=function(e,t,n){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(a.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var d in e)a.d(n,d,function(t){return e[t]}.bind(null,d));return n},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="/",a(a.s=37)}({37:function(e,t,a){e.exports=a("KsWQ")},KsWQ:function(e,t,a){"use strict";$(document).ready((function(){$("#countryId, #educationCountryId, #editCountry, #editState, #editCity, #degreeLevelId, #editEducationCountry, #editEducationState, #editEducationCity").select2({width:"100%"}),$("#addExperienceModal").on("shown.bs.modal",(function(){setDatePicker("#startDate","#endDate")})),$("#editExperienceModal").on("shown.bs.modal",(function(){setDatePicker("#editStartDate","#editEndDate")})),window.setDatePicker=function(e,t){$(e).datetimepicker(DatetimepickerDefaults({format:"YYYY-MM-DD",useCurrent:!0,sideBySide:!0,maxDate:new moment})),$(t).datetimepicker(DatetimepickerDefaults({format:"YYYY-MM-DD",sideBySide:!0,maxDate:new moment,useCurrent:!1}))},window.setExperienceSelect2=function(){$("#stateId").select2({width:"100%",placeholder:"Select State"}),$("#cityId").select2({width:"100%",placeholder:"Select City"})},window.setEducationSelect2=function(){$("#educationStateId").select2({width:"100%",placeholder:"Select State"}),$("#educationCityId").select2({width:"100%",placeholder:"Select City"})},$("#startDate").on("dp.change",(function(e){$("#endDate").val(""),$("#endDate").data("DateTimePicker").minDate(e.date)})),$("#editStartDate").on("dp.change",(function(e){setTimeout((function(){$("#editEndDate").data("DateTimePicker").minDate(e.date)}),1e3)})),$("#default").on("click",(function(){1==$(this).prop("checked")?($("#endDate").prop("disabled",!0),$("#endDate").val("")):0==$(this).prop("checked")&&($("#endDate").data("DateTimePicker").minDate($("#startDate").val()),$("#endDate").prop("disabled",!1))})),$("#editWorking").on("click",(function(){1==$(this).prop("checked")?($("#editEndDate").prop("disabled",!0),$("#editEndDate").val("")):0==$(this).prop("checked")&&($("#editEndDate").data("DateTimePicker").minDate($("#editStartDate").val()),$("#editEndDate").prop("disabled",!1))})),$(".addExperienceModal").on("click",(function(){setExperienceSelect2(),$("#addExperienceModal").appendTo("body").modal("show")})),$(".addEducationModal").on("click",(function(){setEducationSelect2(),$("#addEducationModal").appendTo("body").modal("show")})),window.renderExperienceTemplate=function(e){var t=null!=$(".candidate-experience-container .candidate-experience:last").data("experience-id")?$(".candidate-experience-container .candidate-experience:last").data("experience-id")+1:0,a=$.templates("#candidateExperienceTemplate"),n=1==e.currently_working?present:moment(e.end_date,"YYYY-MM-DD").format("Do MMM, YYYY"),d={candidateExperienceNumber:t,id:e.id,title:e.experience_title,company:e.company,startDate:moment(e.start_date,"YYYY-MM-DD").format("Do MMM, YYYY"),endDate:n,description:e.description,country:e.country},i=a.render(d);$(".candidate-experience-container").append(i),$("#notfoundExperience").addClass("d-none")},$(document).on("submit","#addNewExperienceForm",(function(e){e.preventDefault(),processingBtn("#addNewExperienceForm","#btnExperienceSave","loading"),$.ajax({url:addExperienceUrl,type:"POST",data:$(this).serialize(),success:function(e){e.success&&($("#notfoundExperience").addClass("d-none"),displaySuccessMessage(e.message),$("#addExperienceModal").modal("hide"),renderExperienceTemplate(e.data))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#addNewExperienceForm","#btnExperienceSave")}})})),$(document).on("click",".edit-experience",(function(e){var t=$(e.currentTarget).data("id");renderExperienceData(t)})),window.renderExperienceData=function(e){$.ajax({url:candidateUrl+e+"/edit-experience",type:"GET",success:function(e){e.success&&($("#experienceId").val(e.data.id),$("#editTitle").val(e.data.experience_title),$("#editCompany").val(e.data.company),$("#editCountry").val(e.data.country_id).trigger("change",[{stateId:e.data.state_id,cityId:e.data.city_id}]),$("#editStartDate").val(moment(e.data.start_date).format("YYYY-MM-DD")),$("#editDescription").val(e.data.description),1==e.data.currently_working?($("#editWorking").prop("checked",!0),$("#editEndDate").val("")):($("#editWorking").prop("checked",!1),$("#editEndDate").val(moment(e.data.end_date).format("YYYY-MM-DD"))),1==e.data.currently_working&&$("#editEndDate").prop("disabled",!0),$("#editExperienceModal").appendTo("body").modal("show"))},error:function(e){displayErrorMessage(e.responseJSON.message)}})},$(document).on("submit","#editExperienceForm",(function(e){e.preventDefault(),processingBtn("#editExperienceForm","#btnEditExperienceSave","loading");var t=$("#experienceId").val();$.ajax({url:experienceUrl+t,type:"put",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#editExperienceModal").modal("hide"),location.reload(),$(".candidate-experience-container").children(".candidate-experience").each((function(){$(this).attr("data-id")==e.data.id&&$(this).remove()})),renderExperienceTemplate(e.data.candidateExperience))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#editExperienceForm","#btnEditExperienceSave")}})})),$("#addExperienceModal").on("hidden.bs.modal",(function(){resetModalForm("#addNewExperienceForm","#validationErrorsBox"),$("#countryId, #stateId, #cityId").val(""),$("#stateId, #cityId").empty(),$("#countryId").trigger("change.select2")})),$("#addEducationModal").on("hidden.bs.modal",(function(){resetModalForm("#addNewEducationForm","#validationErrorsBox"),$("#degreeLevelId").val(""),$("#degreeLevelId").select2({width:"100%",placeholder:"Select Degree Level"}),$("#educationCountryId, #educationStateId, #educationCityId").val(""),$("#educationStateId, #educationCityId").empty(),$("#educationCountryId").trigger("change.select2")})),$(document).on("click",".delete-experience",(function(e){var t=$(e.currentTarget).data("id");deleteItem(experienceUrl+t,"Experience",".candidate-experience-container",".candidate-experience","#notfoundExperience")})),window.renderEducationTemplate=function(e){var t=null!=$(".candidate-education-container .candidate-education:last").data("education-id")?$(".candidate-education-container .candidate-education:last").data("experience-id")+1:0,a=$.templates("#candidateEducationTemplate"),n={candidateEducationNumber:t,id:e.id,degreeLevel:e.degree_level.name,degreeTitle:e.degree_title,year:e.year,country:e.country,institute:e.institute},d=a.render(n);$(".candidate-education-container").append(d),$("#notfoundEducation").addClass("d-none")},$(document).on("submit","#addNewEducationForm",(function(e){e.preventDefault(),processingBtn("#addNewEducationForm","#btnEducationSave","loading"),$.ajax({url:addEducationUrl,type:"POST",data:$(this).serialize(),success:function(e){e.success&&($("#notfoundEducation").addClass("d-none"),displaySuccessMessage(e.message),$("#addEducationModal").modal("hide"),renderEducationTemplate(e.data))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#addNewEducationForm","#btnEducationSave")}})})),$(document).on("click",".edit-education",(function(e){var t=$(e.currentTarget).data("id");renderEducationData(t)})),window.renderEducationData=function(e){$.ajax({url:candidateUrl+e+"/edit-education",type:"GET",success:function(e){e.success&&($("#educationId").val(e.data.id),$("#editDegreeLevel").val(e.data.degree_level.id).trigger("change"),$("#editDegreeTitle").val(e.data.degree_title),$("#editEducationCountry").val(e.data.country_id).trigger("change",[{stateId:e.data.state_id,cityId:e.data.city_id}]),$("#editInstitute").val(e.data.institute),$("#editResult").val(e.data.result),$("#editYear").val(e.data.year).trigger("change"),$("#editEducationModal").appendTo("body").modal("show"))},error:function(e){displayErrorMessage(e.responseJSON.message)}})},$(document).on("submit","#editEducationForm",(function(e){e.preventDefault(),processingBtn("#editEducationForm","#btnEditEducationSave","loading");var t=$("#educationId").val();$.ajax({url:educationUrl+t,type:"put",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#editEducationModal").modal("hide"),location.reload(),$(".candidate-education-container").children(".candidate-education").each((function(){$(this).attr("data-id")==e.data.id&&$(this).remove()})),renderEducationTemplate(e.data.candidateEducation))},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#editEducationForm","#btnEditEducationSave")}})})),$("#editEducationModal").on("hidden.bs.modal",(function(){resetModalForm("#addNewEducationForm","#validationErrorsBox")})),$(document).on("click",".delete-education",(function(e){var t=$(e.currentTarget).data("id");deleteItem(educationUrl+t,"Education",".candidate-education-container",".candidate-education","#notfoundEducation")})),window.deleteItem=function(e,t,a,n,d){swal({title:"Delete !",text:'Are you sure want to delete this "'+t+'" ?',type:"warning",showCancelButton:!0,closeOnConfirm:!1,showLoaderOnConfirm:!0,confirmButtonColor:"#6777ef",cancelButtonColor:"#d33",cancelButtonText:"No",confirmButtonText:"Yes"},(function(){!function(e,t,a,n,d){$.ajax({url:e,type:"DELETE",dataType:"json",success:function(e){e.success&&($(a).children(n).each((function(){$(this).attr("data-id")==e.data&&$(this).remove()})),$(a).children(n).length<=0&&$(d).removeClass("d-none")),swal({title:"Deleted!",text:t+" has been deleted.",type:"success",confirmButtonColor:"#6777ef",timer:2e3})},error:function(e){swal({title:"",text:e.responseJSON.message,type:"error",confirmButtonColor:"#6777ef",timer:5e3})}})}(e,t,a,n,d)}))},$("#countryId, #educationCountryId, #editCountry, #editEducationCountry").on("change",(function(e,t){var a=$(this).data("modal-type"),n=void 0!==$(this).data("is-edit");$.ajax({url:companyStateUrl,type:"get",dataType:"json",data:{postal:$(this).val()},success:function(e){$("experience"===a?n?"#editState":"#stateId":n?"#editEducationState":"#educationStateId").empty(),$("experience"===a?n?"#editState":"#stateId":n?"#editEducationState":"#educationStateId").append('<option value="" selected>Select State</option>'),$.each(e.data,(function(e,t){$("experience"===a?n?"#editState":"#stateId":n?"#editEducationState":"#educationStateId").append($("<option></option>").attr("value",e).text(t))})),n&&$("experience"===a?"#editState":"#editEducationState").val(void 0!==t?t.stateId:"").trigger("change",void 0!==t?[{cityId:t.cityId}]:"")}})})),$("#stateId, #educationStateId, #editState, #editEducationState").on("change",(function(e,t){var a=$(this).data("modal-type"),n=void 0!==$(this).data("is-edit");$.ajax({url:companyCityUrl,type:"get",dataType:"json",data:{state:$(this).val(),country:$("experience"===a?n?"#editCountry":"#countryId":n?"#editEducationCountry":"#educationCountryId").val()},success:function(e){$("experience"===a?n?"#editCity":"#cityId":n?"#editEducationCity":"#educationCityId").empty(),$("experience"===a?n?"#editCity":"#cityId":n?"#editEducationCity":"#educationCityId").append('<option value="" selected>Select City</option>'),$.each(e.data,(function(e,t){$("experience"===a?n?"#editCity":"#cityId":n?"#editEducationCity":"#educationCityId").append($("<option></option>").attr("value",e).text(t))})),n&&$("experience"===a?"#editCity":"#editEducationCity").val(void 0!==t?t.cityId:"").trigger("change.select2")}})}))}))}});