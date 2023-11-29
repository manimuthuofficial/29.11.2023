<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


<?php init_head(); ?>

<!-- BEGIN: Page Level CSS-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/themes/horizontal-menu-template/materialize.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/themes/horizontal-menu-template/style.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/layouts/style-horizontal.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/pages/app-sidebar.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/pages/app-email.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/mailbox.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/select2/select2.min.css" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/select2/select2-materialize.css" type="text/css">
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

$tab_active = "inbox";
?>


<div id="main">
    <div class="row">
        <div class="pt-1 pb-0" id="breadcrumbs-wrapper" style="border-bottom:1px solid #ebebeb">
            <div class="container">
                 <div class="row">
                    <div class="col s12 m6 l6">
                        <h5 class="breadcrumbs-title" style="text-align:left;"><span><?php echo _l('Mail Box <span style="color:#bdbaba;font-size:17px">- Inbox Item</span>'); ?> <?php  ?></span></h5>
                    </div>
                    <div class="col s12 m6 l6 right-align-md">
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo admin_url(); ?>"><?php echo _l('dashboard_string'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo _l('Mail Box <span style="color:#bdbaba;font-size:17px'); ?></li>
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
							<div class="card-content pt-0" >
							  <div class="row">
								<div class="col s12">
								
									<!-- Display the conversation -->
									<div class="conversation">
									
										
																																								
										<div class="" style="background-color:#f9f9f9;margin-top:30px;padding:5px 25px;">
											<!-- Email Header -->
											<div class="email-header">
												<div class="subject">
												
												<?php
												$subject = $email_data['subject'];
												if (!empty($subject))
												{
												?>
												
												<div class="email-title" style="font-size:16px;">Subject: <?= $subject; ?></div>
												<?php
												}
												else
												{
												?>
												<div class="email-title"><?php echo "No Subject."; ?></div>	
												<?php
												}
												?>
												  
												</div>
											</div>
											<!-- Email Header Ends -->

											<!-- Email Content -->
											<div class="email-content">
												<div class="list-title-area">
												  <div class="user-media">
													<img style="display:none" src="<?php echo base_url(); ?>assets/images/user/9.jpg" alt=""
													  class="circle z-depth-2 responsive-img avtar">
													<div class="list-title">
													
													
													  <span class="name" style="color:#727272">
													  <b>
													  <?= "From: ".$email_data['from']['name'] . ' &lt;' . $email_data['from']['email'] . '&gt;'; ?>
													  </b>
													  </span>
													  
														<p style="font-weight:normal; color:#727272">
														To:
														<?= 
														implode(', ', array_map(function ($to) 
														{
															return $to['name'] . ' &lt;' . $to['email'] . '&gt;';
														}, $email_data['to'])); 
														?> 
														</p>
														
														<p style="font-weight:normal; color:#727272">
														<?php if (!empty($email_data['cc'])): ?>
															<strong>CC: </strong> <?= implode(', ', array_map(function ($cc) 
															{
																return $cc['name'] . ' &lt;' . $cc['email'] . '&gt;';
															}, $email_data['cc'])); ?>
														<?php endif; ?>
														</p>
														
														<p style="font-weight:normal; color:#727272">
														<?php if (!empty($email_data['bcc'])): ?>
															<strong>BCC: </strong> <?= implode(', ', array_map(function ($bcc) {
																return $bcc['name'] . ' &lt;' . $bcc['email'] . '&gt;';
															}, $email_data['bcc'])); ?><br>
														<?php endif; ?>
														</p>
														
																												
														<p style="font-weight:normal; color:#727272">
														<?php 									
														// Assuming $message['date'] contains the date '2023-09-28 18:49:35'
														$date =  $email_data['date'];
														// Convert the original date to a DateTime object
														$date = new DateTime($date);

														// Format the date in the desired format
														$date = $date->format('D, M d Y, g:i A');

														// Update $message['date'] with the formatted date
														$email_data['date'] = $date;	
														echo $date;
														?> 
														</p>
														
														
																										  
													</div>
												  </div>
												  
												</div>
												<div class="email-desc">												
													<?= $email_data['body']['plain']; ?><br>							
												</div>
												
												
												

												<?php
												if (!empty($email_data['attachments']))
												{
												?>
												<hr>
												<?php
													$attachmentNumber = 1; // Counter for attachments
												?>
													<div class="subject">
														<div class="email-title"><b> Attachments: <?= count($email_data['attachments']) ?> </b> </div>
													</div>
												<?php
													foreach ($email_data['attachments'] as $attachment)
													{
														if (!empty($attachment['content']) && !empty($attachment['name']))
														{
															// Convert the attachment content to base64
															$base64Content = base64_encode($attachment['content']);

															// Create a Data URI for the attachment
															$dataUri = 'data:' . $attachment['type'] . ';base64,' . $base64Content;
												?>
															<p>
																<?= $attachmentNumber ?>. <?php echo $attachment['name']; ?> 
																<!-- Display a link to the attachment -->
																<a href="<?= $dataUri ?>" download="<?= $attachment['name'] ?>">Download</a>
															</p>
												<?php
													$attachmentNumber++;
														}
													}
												}
												else
												{
													// Handle case when there are no attachments
													//echo "No attachments found.";
												}
												?>




												<br>										
											</div>
											<!-- Email Content Ends -->
										</div>	
																	
										
									</div>
									
								  
								  								  
								  <!-- Email Footer -->
								  <div class="email-footer">									
									<div class="footer-action" style="display: flex;  justify-content: flex-end;">									  
									  <div class="footer-buttons">									  
										<a class="reply mb-6 btn waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow" >
											<i class="material-icons left">reply</i><span>Reply</span>
										</a>
									  </div>
									</div>
									<div class="reply-box d-none">
									  
									  <!-- Email Header -->
									  <div class="email-header">
										<div class="subject">									  
										  <div class="email-title" style="font-size:19px">REPLY MAIL</div>
										  
										</div>									
									  </div>
									  <!-- Email Header Ends -->
									  <br>
									
									
									  <?php echo form_open_multipart('class="edit-email-item mt-10 mb-10" id="emailForm"'); ?>
				
										<div class="s12" style="padding-bottom:7px;">
											<div class="input-field">												
												<input placeholder="In Reply To Message ID..." type="text" id="in_reply_to" name="in_reply_to" 
												value="<?= $email_data['message_id'] ?? '' ?>">
												<label for="">In Reply To - Message ID</label>
											</div>													
										</div>
										
										<div class="s12" style="padding-bottom:7px;">
											<div class="input-field">												
												<input placeholder="To Email..." type="text" id="recipient" name="recipient[]" 
												value="<?= $email_data['from']['email']; ?>">
												<label for="">To</label>
											</div>													
										</div>
										
										<?php
										$subject = str_replace('Re: ', '', $subject);
										?>
										
										<div class="s12" style="padding-bottom:7px;">
											<div class="input-field">
												<input placeholder="Subject" type="text" id="subject" name="subject" value="<?php echo $subject; ?>" readonly>
												<label for="">Subject</label>
											</div>													
										</div>
										
										<div class="s12" style="padding-bottom:7px;">
											<div class="input-field">
												
												<input placeholder="To Email..." type="text" id="cc" name="cc[]" 
												value="<?= implode(', ', array_map(function ($cc) {
													return $cc['email'];
												}, $email_data['cc'])); ?> ">
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
												var recipient = document.getElementById('recipient').value;
																									
												// Check if at least one recipient is selected
												if (recipient == "") 
												{
													$("#errorModalMessage").text("Please enter at least one recipient.");
													$("#errorModal").modal("open");
													return false;
												}
												
												

												// Serialize form data
												var formData = new FormData(this);
												
												// Show the loader overlay
												$("#loader-overlay").show();

												$.ajax({
													type: 'POST',
													url: '<?php echo admin_url('Communications/send_email_reply'); ?>', // Replace with the correct URL path to your controller method
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
														  //location.reload();
														  //window.location.href = "<?php echo admin_url('Communications/compose'); ?>";
														});

														setTimeout(function () {
														  //location.reload();
														  //window.location.href = "<?php echo admin_url('Communications/compose'); ?>";
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
															  //location.reload();
															  //window.location.href = "<?php echo admin_url('Communications/compose'); ?>";
															});

															setTimeout(function () 
															{
															  //location.reload();
															  //window.location.href = "<?php echo admin_url('Communications/compose'); ?>";
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
								  <!-- Email Footer Ends -->
								</div>
							  </div>
							</div>
						  </div>
						</div>
					  </div>
					</div>
					<!-- Content Area Ends --><!-- START RIGHT SIDEBAR NAV -->
					
				
				
				
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
Add new email popup Ends-->
		
	

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
        <p style="color:#fff">Reply Email Sending... Please Wait...</p>
    </div>
</div>


<?php include('modasl-popup.php'); ?>

