<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


<?php init_head(); ?>

<!-- BEGIN: Page Level CSS-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/themes/horizontal-menu-template/materialize.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/themes/horizontal-menu-template/style.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/layouts/style-horizontal.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/pages/app-sidebar.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/pages/app-email.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/mailbox.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/select2/select2-materialize.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/pages/app-email-content.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/sweetalert/sweetalert.css">



<!-- END: Page Level CSS-->

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">


<?php 
$session_email = $this->session->userdata('session_email');	
$firstname = $this->session->userdata('firstname');
$lastname = $this->session->userdata('lastname');
//$session_user = $session_email .' - '. $firstname .' '. $lastname;

$session_name = "";
if($firstname != "" && $lastname !='')
{
	$session_name = $session_email .' - '. $firstname .' '. $lastname;
}
else if($lastname == '')
{
	$session_name = $session_email .' - '. $firstname;
}
else
{
	
}


if($firstname != "" && $lastname !='')
{
	$total_session_variable = $session_email .' - '. $firstname .' '. $lastname;
}
else if($lastname == '')
{
	$total_session_variable = $session_email .' - '. $firstname;
}
else
{
	
}

$admin_user_id = $this->session->userdata('userid');
//$lastname = $this->session->userdata('lastname');
?>


<div id="main">
    <div class="row">
        <div class="pt-1 pb-0" id="breadcrumbs-wrapper" style="border-bottom:1px solid #ebebeb">
            <div class="container">
                 <div class="row">
                    <div class="col s12 m6 l6">
                        <h5 class="breadcrumbs-title" style="text-align:left;"><span><?php echo _l('Mail Box'); ?> <?php  ?></span></h5>
                    </div>
                    <div class="col s12 m6 l6 right-align-md">
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo admin_url(); ?>"><?php echo _l('dashboard_string'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo _l('Mail Box'); ?></li>
                        </ol>
                    </div>
                </div>
            </div>
			<br>
        </div>
		
		
		
		
		<div class="content-wrapper-before lighten-5"></div>
			<div class="col s12">
				<div class="container">
				
				
				
					
					<?php include('sidebar-area.php'); ?>
					
					
					<!-- Content Area Starts -->
					<div class="app-email-content">
					  <div class="content-area content-right">
						<div class="app-wrapper">
						  
						  <div class="card card-default scrollspy border-radius-6 fixed-width">
							<div class="card-content pt-0">
							  <div class="row">
								<div class="col s12">
								  <!-- Email Header -->
								  <div class="email-header">
									<div class="subject">									  
									  <div class="email-title" style="font-size:19px">COMPOSE MAIL</div>
									</div>									
								  </div>
								  <!-- Email Header Ends -->
								  <hr style="border: 1px solid #ebebeb;">
								  <br>
								  
									<div id="view-input-fields">
										<div class="row">
											<div class="col s12">
												
											<?php echo form_open_multipart('class="edit-email-item mt-10 mb-10" id="emailForm"'); ?>
				

												<div class="s12"  style="padding-bottom:15px;">
													<div class="input-field">
														<select id="recipient" name="recipient[]" class="select2-customize-result browser-default" multiple="multiple">
																	
																<?php 
																foreach($cc_admin_emails as $cc_admin_email) 
																{
																?>
																<option value="<?php echo trim($cc_admin_email['email']); ?>"><?php echo trim($cc_admin_email['email']); ?> - <?php echo trim($cc_admin_email['firstname']); ?> <?php echo trim($cc_admin_email['lastname']); ?></option>
																<?php
																}
																?>

																<?php 
																foreach($email_contacts as $email_contact) 
																{
																?>
																<option value="<?php echo trim($email_contact['email_address']); ?>"><?php echo trim($email_contact['email_address']); ?> - <?php echo trim($email_contact['name']); ?></option>
																<?php
																}
																?>		
																																		
														</select>
														<label for="">To *</label>
													</div>													
												</div>
												
												<div class="s12" style="padding-bottom:7px;">
													<div class="input-field">
														<input placeholder="Subject" type="text" id="subject" name="subject">
														<label for="">Subject</label>
													</div>													
												</div>
												
												<div class="s12"  style="padding-bottom:15px;">
													<div class="input-field">
														<select id="cc" name="cc[]" class="select2-customize-result browser-default" multiple="multiple">
																	
																<?php 
																foreach($cc_admin_emails as $cc_admin_email) 
																{
																?>
																<option value="<?php echo trim($cc_admin_email['email']); ?>"><?php echo trim($cc_admin_email['email']); ?> - <?php echo trim($cc_admin_email['firstname']); ?> <?php echo trim($cc_admin_email['lastname']); ?></option>
																<?php
																}
																?>

																<?php 
																foreach($email_contacts as $email_contact) 
																{
																?>
																<option value="<?php echo trim($email_contact['email_address']); ?>"><?php echo trim($email_contact['email_address']); ?> - <?php echo trim($email_contact['name']); ?></option>
																<?php
																}
																?>		
																																		
														</select>
														<label for="">CC</label>
													</div>													
												</div>
												
												<div class="s12"  style="padding-bottom:15px;">
													<div class="input-field">
														<select id="bcc" name="bcc[]" class="select2-customize-result browser-default" multiple="multiple">
																	
																<?php 
																foreach($cc_admin_emails as $cc_admin_email) 
																{
																?>
																<option value="<?php echo trim($cc_admin_email['email']); ?>"><?php echo trim($cc_admin_email['email']); ?> - <?php echo trim($cc_admin_email['firstname']); ?> <?php echo trim($cc_admin_email['lastname']); ?></option>
																<?php
																}
																?>	

																<?php 
																foreach($email_contacts as $email_contact) 
																{
																?>
																<option value="<?php echo trim($email_contact['email_address']); ?>"><?php echo trim($email_contact['email_address']); ?> - <?php echo trim($email_contact['name']); ?></option>
																<?php
																}
																?>		
																																		
														</select>
														<label for="">BCC</label>
													</div>													
												</div>
												
												<div class="s12" style="padding-bottom:5px;">
													<label for="" style="font-size: 13.5px">Message *</label>
													<div class="input-field">
														<textarea id="message" name="message"></textarea>
													</div>													
												</div>													
																									
												
												
												<div class="file-field input-field">
													<div class="btn gradient-45deg-light-blue-cyan">
														<span>Attachments</span>
														<input type="file" name="attachments[]" id="attachments" multiple>
													</div>
													<div class="file-path-wrapper">
														<input class="file-path validate" type="text" placeholder="Upload one or more files">
													</div>
												</div>
												
																																					
												<div class="card-action pl-0 pr-0 right-align" style="padding-bottom:0px !important">
													<button style="height:48px;line-height: 48px;padding-left:35px;padding-right:35px;" type="submit" id="send-message" class="waves-effect waves-light  btn btn-large gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1">
														<i class="material-icons left">send</i>
														<span style="font-size:17px;">Send</span>
													</button>
												</div> 		

												
										
											<?php echo form_close(); ?>



												<script>
												$(document).ready(function() 
												{
													// Initialize CKEditor with a custom toolbar
													CKEDITOR.replace('message', {});
	
													$('#emailForm').submit(function(e) 
													{
														e.preventDefault();
														
														// Get the CKEditor instance and its content
														var ckeditorInstance = CKEDITOR.instances.message;
														var ckeditorContent = ckeditorInstance.getData();
														
														// Check if CKEditor content is empty
														if (!ckeditorContent.trim()) 
														{
															$("#errorModalMessage").text("Please enter a message.");
															$("#errorModal").modal("open");
															return false;
														}

														// Set the CKEditor content as the textarea's value
														$("#message").val(ckeditorContent);
														
														// Get selected recipients and format them
														var recipientSelectElement = document.getElementById('recipient');
														var selectedRecipients = Array.from(recipientSelectElement.selectedOptions).map(option => option.value);

														
														// Check if at least one recipient is selected
														if (selectedRecipients.length === 0) 
														{
															$("#errorModalMessage").text("Please select at least one recipient.");
															$("#errorModal").modal("open");
															return false;
														}
														

														// Serialize form data
														var formData = new FormData(this);
														
														// Show the loader overlay
														$("#loader-overlay").show();

														$.ajax({
															type: 'POST',
															url: '<?php echo admin_url('Communications/send_email'); ?>', // Replace with the correct URL path to your controller method
															data: formData,
															processData: false,
															contentType: false,
															success: function(response) 
															{
																
																$("#emailForm")[0].reset();		
																
																//alert(response); // Show a success message

																$("#successModalMessage").text(response);
																$("#successModal").modal("open");
																															
																// Hide the loader overlay
																$("#loader-overlay").hide();

																$("#successModalBtn").click(function () {
																  location.reload();
																  window.location.href = "<?php echo admin_url('Communications/compose'); ?>";
																});

																setTimeout(function () {
																  location.reload();
																  window.location.href = "<?php echo admin_url('Communications/compose'); ?>";
																}, 1000);
																
																
																
																
															},
															error: function(xhr, status, error) 
															{
																// Log error information to the console
																console.error(xhr);
																console.error(status);
																console.error(error);

																// Check for the HTTP status code to determine if it's an error
																if (xhr.status === 500) 
																{
																	// Server returned an error status
																	$("#errorModalMessage").text(xhr.responseText.trim());
																	$("#errorModal").modal("open");
																	
																	
																	$("#errorModalBtn").click(function () 
																	{
																	  location.reload();
																	  window.location.href = "<?php echo admin_url('Communications/compose'); ?>";
																	});

																	setTimeout(function () 
																	{
																	  location.reload();
																	  window.location.href = "<?php echo admin_url('Communications/compose'); ?>";
																	}, 2000);
																	
																	
																} 
																else 
																{
																	// Non-error status, handle as needed
																	console.warn('Non-error status received.');
																}
																
																// Hide the loader overlay
																$("#loader-overlay").hide();
															}
														});
													});
												});
												</script>
																								
												
												
												
												
												
					
												
												
												
												
												
											</div>
										</div>
									</div>
								  
								
								  
								</div>
							  </div>
							</div>
						  </div>
						</div>
					  </div>
					</div>
					<!-- Content Area Ends -->
				
				
				
				
				
				
				</div>					
				
				
				
			</div>
		</div>
		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<?php include('fixed-action-btn.php'); ?>

<!-- Add new email popup
<div style="bottom: 54px; right: 19px;" class="fixed-action-btn direction-top">
  <a class="btn-floating btn-large primary-text gradient-45deg-light-blue-cyan gradient-shadow compose-email-trigger" href="#">
    <i class="material-icons">add</i>
  </a>
</div>
<!-- Add new email popup Ends-->




<script src="<?php echo base_url(); ?>assets/vendors/select2/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/scripts/form-select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/scripts/advance-ui-modals.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/scripts/app-email-content.min.js"></script>
<?php init_tail(); ?>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/scripts/extra-components-sweetalert.min.js"></script>




</body>
</html>


<!-- Add a loader overlay with a loading message -->
<div class="loader-overlay" id="loader-overlay">
    <div class="loader" style="padding:9px; padding-left:50px;padding-right:50px">
        <div class="spinner"></div>
        <p style="color:#fff">Email Sending... Please Wait...</p>
    </div>
</div>


<?php include('modasl-popup.php'); ?>




