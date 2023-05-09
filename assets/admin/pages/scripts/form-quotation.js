var FormQuotation = function () {


    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }

            function format(state) {
                if (!state.id) return state.text; // optgroup
                return "<img class='flag' src='https://provilink.com/secure/assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
            }

            $("#country_list").select2({
                placeholder: "Select",
                allowClear: true,
                formatResult: format,
                formatSelection: format,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    //account
                    property_id: {
                        required: true
                    },
                    category_id: {
                        required: true
                    },
                    discription: {
                        minlength: 5,
                        required: true
                    },
                    //profile
                    start_date: {
                        required: true,
						date:true
                    },
					endtype: {
                        required: true
                    },
                    end_date: {
                        required: true,
                        date:true
                    },
                    servicetype: {
                        required: true
                    }
                    //payment
                                       
                },

                messages: { // custom messages for radio buttons and checkboxes
                   /* 'quest[]': {
                        required: "Please provide answer to the all the question"
                    }*/
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "gender") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#form_gender_error");
                    } else if (element.attr("name") == "payment[]") { // for uniform checkboxes, insert the after the given container
                        error.insertAfter("#form_payment_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    Metronic.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                            .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid') // mark the current input as valid and display OK icon
                        .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    }
                },

                submitHandler: function (form) {
					
					
					form.submit();
                    success.show();
                    error.hide();
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                }

            });

            var displayConfirm = function() {
                $('#tab4 .form-control-static', form).each(function(){
                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    } else if ($(this).attr("data-display") == 'payment[]') {
                        var payment = [];
                        $('[name="payment[]"]:checked', form).each(function(){ 
                            payment.push($(this).attr('data-title'));
                        });
                        $(this).html(payment.join("<br>"));
                    }
                });
            }

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#form_wizard_1')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_wizard_1').find('.button-previous').hide();
                } else {
                    $('#form_wizard_1').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_wizard_1').find('.button-next').hide();
                    $('#form_wizard_1').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard_1').find('.button-next').show();
                    $('#form_wizard_1').find('.button-submit').hide();
                }
                Metronic.scrollTo($('.page-title'));
            }

            // default form wizard
            $('#form_wizard_1').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    return false;
                    /*
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }
                    handleTitle(tab, navigation, clickedIndex);
                    */
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();
					
                    if (index != 2 && form.valid() == false) {
                        return false;
                    }
				
					//alert(index);
					 if(index == 2) {
						 
						var tQid = $("input[name='qId[]']").length;
						//alert(tQid);
						var $textboxes = $('input[name="qId[]"]');
						 if(tQid > 0) {
							 var totalAns = ''
							 for(s = 0;s < tQid;s++){
								 var value1 = $textboxes.eq(s).val();
								  var result = 0; 
								 var inputType = $('#quest'+value1).attr('type');
								  
								 if(inputType == 'radio'){
									 var cStr = '';
									 var radioObj = document.getElementsByName('quest'+value1);
									 for(r = 0;r < (radioObj.length);r++){
										 if(radioObj[r].checked == true) {
											 
											var rId = radioObj[r].value;
											var str = $('#aquest'+rId).val().toLowerCase();
	
											if(str.trim() == "other"){
												cStr = cStr+radioObj[r].value+'|'+$('#other'+value1).val()+'|';
											}else{
												cStr = cStr+$('#aquest'+rId).val()+'|';
											}
											  
											 result = 1;
											 break;
										 }
									 }
									 
									 
										totalAns = totalAns+cStr+'#';
									 
								 }else if(inputType == 'checkbox'){
									 			
									  var checkObj = document.getElementsByName('quest'+value1+'[]');
									  var cStr = '';
									  for(r = 0;r < checkObj.length;r++){
										 
										 if(checkObj[r].checked == true) {
											 var cId = checkObj[r].value;
											 var str = $('#aquest'+cId).val();
											 cStr = cStr+str+'|';
											 result = 1;
											// break;
										 }
										 
									 }
									  totalAns = totalAns+cStr+'#';
								 }else if(inputType == 'text'){
									
									 if($('#quest'+value1).val() != ''){
										 totalAns = totalAns+$('#quest'+value1).val()+'#';
										 result = 1;
									 }
									 
									 
								 }else{
									// alert($('#quest'+value1+' option:selected').text());
									  if($('#quest'+value1).val() != ''){
										var sId = $('#quest'+value1).val();
										 var str = $("#quest"+value1+" option:selected").text();
										 $('#aquest'+sId).val(str);
										 totalAns = totalAns+str+'#';
										 result = 1;
									 }
								 }
								 
								  if(result == 0) {
										bootbox.alert("Provide answer to all the question");
										return false; 
								 }
							 }//end loop
							// bootbox.alert("Provide answer to all the question");
							$('#totAns').val(totalAns);
						 }// question exis
                    }// step 2
					 
					 if(index == 3) {
						var tQid = $("input[name='qId[]']").length;
						if(tQid > 0) {
							 var qdis = $('#totAns').val();
							 var arrStr = qdis.split('#');
							 var srt = '';
							 var qObj = document.getElementsByName('questionall[]');
							
							 for(r = 0;r < arrStr.length - 1;r++){
								  var newAnd = '';
								 var a1 = arrStr[r].trim();
								 if(a1.charAt(a1.length - 1) == '|'){
									 var arrAnd = a1.split('|');
									 for(k = 0;k < arrAnd.length;k++){
										 newAnd = newAnd+arrAnd[k]+'<br/>';
									 }
								 }else{
									 newAnd = arrStr[r];
								 }
								
								 srt = srt+'<p style="width:500px" class="form-control-static" data-display=""><b>'+qObj[r].value+'</b><br/>'+newAnd+'</p>';
							 }
							 
							 $('#qdisplay').html(srt);
						}
						
						var now = new Date($('#start_date').val());
						now.setDate(now.getDate() + 3); // minus the date
						newDate = formatDate(now);
						
						 if (newDate > $('#end_date').val()) {
								 bootbox.alert("The expiry date minimum three days greater than the start date");
								 return false; 
							 }
						
						 var sStr = '';
						 var sObj = document.getElementsByName('site_visite[]');
						 var stObj = document.getElementsByName('from_time[]');
						 var seObj = document.getElementsByName('to_time[]');
						 for(r = 0;r < sObj.length;r++){
							/* if (sObj[r].value == '' || sObj[r].value > $('#end_date').val()) {
								 bootbox.alert("The site visit date cannot be empty or greater than the expiry date");
								 return false; 
							 }*/
							 if(sObj[r].value != ''){
							 sStr = sStr+'<p style="width:500px" class="form-control-static" data-display="">'+sObj[r].value+'&nbsp;&nbsp;From &nbsp;'+stObj[r].value+'&nbsp;&nbsp;To &nbsp;'+seObj[r].value+'</p>';
							 }
						 }
						 if(sStr == ''){
							 sStr = 'No Site Visit timing selected';
						 }
						 
						 $('#siteDisplay').html(sStr);
						 
						 
						 
					 }//end step 4
					
                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_1').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_1').find('.button-previous').hide();
			$('#form_wizard_1 .button-submit').hide();
          /*  $('#form_wizard_1 .button-submit').click(function () {
                
            }).hide(); */

			$('#form_wizard_1 .button-submit').click(function () {
                return true;
            });
            //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
            $('#country_list', form).change(function () {
                form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });
        }

    };

}();