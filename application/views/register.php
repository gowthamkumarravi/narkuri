<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?php echo WEB_DIR?>fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="<?php echo WEB_DIR?>vendor/nouislider/nouislider.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo WEB_DIR?>css/style.css">
</head>

<body>
    <style>
        
        .validate {
    border-radius: 20px;
    height: 40px;
    background-color: rgb(64, 80, 224);
    border: 1px solid rgb(255, 255, 255);
    width: 140px
}
    </style>

    <div class="main">

        <div class="container">
            <form method="POST" id="signup-form" class="signup-form" action="<?php echo base_url('Home/registerpage'); ?>" enctype="multipart/form-data">
                <div>
                    <h3>Find a job & grow your career</h3>
                    <fieldset>
                  
                   <h2>Register</h2><br>
                   <div class="fieldset-content">
                       <div class="form-group">
                           <label class="form-label">Full Name</label>
                            <input type="text" name="first_name" id="first_name" />
                       </div>
                       <div class="form-group">
                           <label for="email" class="form-label">Email Id</label>
                           <input type="email" name="email" id="email" />
                           <span class="text-input">we will send your relavant jobs  in your mail</span>
                       </div>
                          <div class="form-group">
                           <label for="Password" class="form-label">Password</label>
                           <input type="Password" name="Password" id="Password" />                                
                           <span style="color:green">Minimum 6 Charaters required </span>
                       </div>
                       <div class="form-group">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" onblur="mobile_verification(this.value)" name="phone" id="phone">
                              <p id="mobilenumber_verify"></p>
                            </div>
                         
                            <div class="form-group">
                                    <label for="phone" class="form-select">Gender</label>
                                    <select class="form-select" name="gender" style="width: 52%;
                                    display: block;
                                    border: 1px solid #ebebeb;
                                    height: 50px;
                                    box-sizing: border-box;
                                    padding: 0 20px;
                                    color: #222;
                                    font-weight: bold;
                                    font-size: 14px;
                                    font-family: 'Roboto Slab';">
                                        <option>Select</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                      </select> 
                                </div>
                    
                           <div class="form-group">
                           <label for="workstatus" class="form-label" >Work Status</label>
                           <div class="form-date-group">       
                           <select name="workstatus" id="workstatus">
                               <option>Select Field</option>
                             <option value="I am fresher">I'm fresher</option>
                             <option value="I am experienced">I'm experienced</option>
                           </select>
                       </div>
                   </div>
                   <div class="form-date">
                       <label for="state" class="form-label">Current City</label>
                       <div class="form-date-group">
                       <select class="form-control" name="city">
                                    <option>Select City </option>
                                    <?php
                                    foreach($this->Home_Model->citylist() as $row)
                                    {
                                    ?>
                                    <option value="<?php echo $row->city_id?>"><?php echo $row->city_name?></option>  
            
                                    <?php  
                                    }
                                    ?>    
                                </select>           
                              </div>
                    </div>
                   <div class="form-date">
                       <label for="state" class="form-label">Current State</label>
                       <div class="form-date-group">
                       <select class="form-control" name="state">
                                    <option>Select state </option>
                                    <?php
                                    foreach($this->Home_Model->statelist() as $row)
                                    {
                                    ?>
                                    <option value="<?php echo $row->state_id?>"><?php echo $row->state_name?></option>  
            
                                    <?php  
                                    }
                                    ?>    
                                </select>           
                              </div>
                    </div>
                            <div class="form-group">
                           <label for="Resume" class="form-label">Resume</label>
                           <input type="file" name="Resume" id="Resume" />                                
                          
                       </div>
                       
                   </div>
               </fieldset>

                    <h3>OTP</h3>
                    <fieldset id="step2">
                        <div class="container height-100 d-flex justify-content-center align-items-center">
                            <div class="position-relative">
                                <div class="card p-2 text-center">
   
                                    <p>Please enter the one time password <br> to verify your account</p>
                                    <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2" name="otp"> 
                                        <input class="m-2 text-center form-control rounded" type="text" name="first" id="first" maxlength="1"  style="width: 50px; display: inline-flex;"/> 
                                        <input class="m-2 text-center form-control rounded" type="text" name="second" id="second" maxlength="1"  style="width: 50px; display: inline-flex;"/> 
                                        <input class="m-2 text-center form-control rounded" type="text" name="third" id="third" maxlength="1"  style="width: 50px; display: inline-flex;"/> 
                                        <input class="m-2 text-center form-control rounded" type="text" name="fourth" id="fourth" maxlength="1"  style="width: 50px; display: inline-flex;"/> 
                                 </div>
                                 <p id="message"></p>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <h3>Employment</h3>
                    <fieldset id="step3">

                        <h2>Add Your Employment</h2>
                        <p class="desc">Employment details help recuiters understand your background</p>
                             <div class="form-group">
                                <label for="phone" class="form-select">Are you currently employed?</label>
                                <select class="form-select" name="Employed" id="employed" style="width: 52%;
                                display: block;
                                border: 1px solid #ebebeb;
                                height: 50px;
                                box-sizing: border-box;
                                padding: 0 20px;
                                color: #222;
                                font-weight: bold;
                                font-size: 14px;
                                font-family: 'Roboto Slab';">
                                    <option>Select</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                  </select> 
                            </div>
                            <div class="fieldset-content">
                                    <div class="form-row">
                                        <label class="form-label">Total Work Experience</label>
                                        <div class="form-flex">
                                            <div class="form-group">
                                                <input type="text" name="Work" id="Work" />
                                                <span class="text-input">Total Work Experience</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                    <label class="form-label">Company</label>
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="text" name="company" id="company" />
                                            <span class="text-input">Company</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label">Jop Title</label>
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="text" name="title" id="title" />
                                            <span class="text-input">Jop Title</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-date">
                       <label for="city" class="form-label">Current City</label>
                       <div class="form-date-group">
                       <select class="form-control" name="precity" >
                                    <option>Select City </option>
                                    <?php
                                    foreach($this->Home_Model->citylist() as $row)
                                    {
                                    ?>
                                    <option value="<?php echo $row->city_id?>">
            <?php echo $row->city_name?></option>  
            
                                    <?php  
                                    }
                                    ?>    
                                </select>
                   </div>
                   </div>
                                <div class="form-row">
                                    <label class="form-label">Work Experience</label>
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="text" name="experience" id="experience" />
                                            <span class="text-input">Work Experience</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label">Working Since</label>
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="date" name="Since" id="date" />
                                            <span class="text-input">Working Since</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label">Annual Salary</label>
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="text" name="annualsalary" id="annualsalary" />
                                            <span class="text-input">Annual Salary</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="form-select">Notice Period</label>
                                    <select class="form-select" name="Notice" style="width: 52%;
                                    display: block;
                                    border: 1px solid #ebebeb;
                                    height: 50px;
                                    box-sizing: border-box;
                                    padding: 0 20px;
                                    color: #222;
                                    font-weight: bold;
                                    font-size: 14px;
                                    font-family: 'Roboto Slab';">
                                        <option>Select</option>
                                        <option>15 Days or less</option>
                                        <option>1 month</option>
                                        <option>2 month</option>
                                        <option>3 month</option>
                                        <option>More than 3 month</option>
                                      </select> 
                                </div>
                                </div>
                    </fieldset>

                    <h3>Education</h3>
                    <fieldset id="step4">
                        <h2>Mention your education</h2>
                        <p class="desc">Adding your educational details will help recuiters know your value as a potential candidate</p>
                             <div class="form-group">
                                <label for="phone" class="form-select">Highest Qualification</label>
                                <select class="form-select" name="Qualification" style="width: 52%;
                                display: block;
                                border: 1px solid #ebebeb;
                                height: 50px;
                                box-sizing: border-box;
                                padding: 0 20px;
                                color: #222;
                                font-weight: bold;
                                font-size: 14px;
                                font-family: 'Roboto Slab';">
                                    <option>Select</option>
                                    <option>Doctorate/PhD</option>
                                    <option>Master/post-Graduation</option>
                                    <option>Graduation/Diploma</option>
                                    <option>12th</option>
                                    <option>10th</option>
                                    <option>Below 10th</option>
                                  </select> 
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-select">Course</label>
                                <select class="form-select" name="Course" style="width: 52%;
                                display: block;
                                border: 1px solid #ebebeb;
                                height: 50px;
                                box-sizing: border-box;
                                padding: 0 20px;
                                color: #222;
                                font-weight: bold;
                                font-size: 14px;
                                font-family: 'Roboto Slab';">
                                    <option>Select</option>
                                    <option>BCA</option>
                                    <option>BSC</option>
                                    <option>EEE</option>
                                    <option>B.TECH</option>
                                    <option>MBA</option>
                                    <option>MCA</option>
                                  </select> 
                            </div>
                                <div class="form-row">
                                    <label class="form-label">Specialization</label>
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="text" name="Specialization" id="specialization" />
                                            <span class="text-input">Jop Title</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="form-select">University/Institute</label>
                                    <select class="form-select" name="University" style="width: 52%;
                                    display: block;
                                    border: 1px solid #ebebeb;
                                    height: 50px;
                                    box-sizing: border-box;
                                    padding: 0 20px;
                                    color: #222;
                                    font-weight: bold;
                                    font-size: 14px;
                                    font-family: 'Roboto Slab';">
                                        <option>Select</option>
                                        <option>Anna University	</option>
                                        <option>Bharathiar University</option>
                                        <option>University of Madras</option>
                                        <option>SRM Institute of Science and Technology</option>
                                        <option>Thiruvalluvar university</option>
                                        <option>MCA</option>
                                      </select> 
                                </div>
                                <div class="form-row">
                                    <label class="form-label">Course Type</label>
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="text" name="Course_Type" id="course" />
                                            <span class="text-input">Course Type</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label">Starting Year</label>
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="date" name="Starting" id="starting" />
                                            <span class="text-input">Starting Year</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label class="form-label">Passing Year</label>
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="date" name="Passing" id="passing" />
                                            <span class="text-input">Passing Year</span>
                                        </div>
                                    </div>
                                </div>
                    </fieldset>

                    <h3>Last Step</h3>
                    <fieldset>
                        <h2>Add headline & preferences</h2>
                        <p class="desc">Add preferences to get relevant job recommandations & make your profile strong</p>
                        <div class="fieldset-content">
                            <div class="form-row">
                                <label class="form-label">Resume Headline</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                        <textarea rows="4" name="Headline" id="Headline" cols="50" placeholder="Describe yourself here..."></textarea>
                                        <span class="text-input">Resume Headline</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-date">
                       <label for="state" class="form-label">Current City</label>
                       <div class="form-date-group">
                       <select class="form-control" name="prefcity[]" multiple>
                                    <option>Select City </option>
                                    <?php
                                    foreach($this->Home_Model->citylist() as $row)
                                    {
                                    ?>
                                    <option value="<?php echo $row->city_id?>"><?php echo $row->city_name?></option>  
            
                                    <?php  
                                    }
                                    ?>    
                                </select>           
                              </div>
                    </div>
                                    <div class="form-row">
                                    <label class="form-label">Preferrd Salary</label>
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="text" name="Salary" id="salary" />
                                            <span class="text-input">Preferrd Salary</span>
                                        </div>
                                    </div>
                                </div>
                               
                                </div>
                    </fieldset>
                </div>
            </form>
        </div>

    </div>

    <script>
         var count = "<?php echo $count?>";
        </script>
    <!-- JS -->
    <script src="<?php echo WEB_DIR?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo WEB_DIR?>vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?php echo WEB_DIR?>vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="<?php echo WEB_DIR?>vendor/jquery-steps/jquery.steps.min.js"></script>
    <script src="<?php echo WEB_DIR?>vendor/minimalist-picker/dobpicker.js"></script>
    <script src="<?php echo WEB_DIR?>vendor/nouislider/nouislider.min.js"></script>
    <script src="<?php echo WEB_DIR?>vendor/wnumb/wNumb.js"></script>
    <script src="<?php echo WEB_DIR?>js/main.js"></script>
    <script>
        console.log(count);
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "step");
        //append to form element that you want .
        if(count == "1"){
            $('#steps-uid-0-p-0').show();
            $('#steps-uid-0-p-1').hide();
            $('#steps-uid-0-p-2').hide();
            $('#steps-uid-0-p-3').hide();
            input.setAttribute("value", "one");
            document.getElementById("steps-uid-0-p-0").appendChild(input);

        }else if(count == "2"){
            $('#steps-uid-0-p-0').hide();
            $('#steps-uid-0-p-1').show();
            $('#steps-uid-0-p-2').hide();
            $('#steps-uid-0-p-3').hide();
            input.setAttribute("value", "two");
            document.getElementById("steps-uid-0-p-1").appendChild(input);

        }else if(count == "3"){
            $('#steps-uid-0-p-0').hide();
            $('#steps-uid-0-p-1').hide();
            $('#steps-uid-0-p-2').show();
            $('#steps-uid-0-p-3').hide();
            input.setAttribute("value", "three");
            document.getElementById("steps-uid-0-p-2").appendChild(input);

        }else if(count == "4"){
            $('#steps-uid-0-p-0').hide();
            $('#steps-uid-0-p-1').hide();
            $('#steps-uid-0-p-2').hide();
            $('#steps-uid-0-p-3').show();
            input.setAttribute("value", "four");
            document.getElementById("steps-uid-0-p-3").appendChild(input);

        }else if(count == "5"){
            $('#steps-uid-0-p-0').hide();
            $('#steps-uid-0-p-1').hide();
            $('#steps-uid-0-p-2').hide();
            $('#steps-uid-0-p-3').hide();
            $('#steps-uid-0-p-4').show();
            input.setAttribute("value", "five");
            document.getElementById("steps-uid-0-p-4").appendChild(input);

        }

        function mobile_verification(mobile){
           $.ajax({url: "<?php echo WEB_URL?>Home/VerifyMobile",type:"POST",data:{mobile:mobile}, success: function(result){
                    $("#mobilenumber_verify").text(result);
                    if( result= 'Mobile number already exist'){
                        $('#phone').val("");
                    }
                }}); 
                
        }

        $("#first").keyup(function(){
            var str = $(this).val();
           
            if(str.length > 0){
                console.log(str.length);
                $("#second").focus();
            }
        });
         $("#second").keyup(function(){
            var str = $(this).val();
            if(str.length > 0){
                console.log(str.length);
                $("#third").focus();
            }
        });
         $("#third").keyup(function(){
            var str = $(this).val();
            if(str.length > 0){
                console.log(str.length);
                $("#fourth").focus();
            }
        });

        $('#first').keypress(function (e) {
    
        var charCode = (e.which) ? e.which : event.keyCode    
        if (String.fromCharCode(charCode).match(/[^0-9]/g))    
        return false;                        
        }); 

        $('#first').keypress(function (e) {    
    
    var charCode = (e.which) ? e.which : event.keyCode    
    if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    return false;                        
    }); 

    $('#second').keypress(function (e) {    
    
    var charCode = (e.which) ? e.which : event.keyCode    
    if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    return false;                        
    }); 

    $('#third').keypress(function (e) {    
    
    var charCode = (e.which) ? e.which : event.keyCode    
    if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    return false;                        
    }); 

    $('#fourth').keypress(function (e) {    
    
    var charCode = (e.which) ? e.which : event.keyCode    
    if (String.fromCharCode(charCode).match(/[^0-9]/g))
    return false;                        
    }); 
        

        </script>
</body>

</html>