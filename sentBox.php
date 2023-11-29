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

$tab_active = "sent";
?>


<div id="main">
    <div class="row">
        <div class="pt-1 pb-0" id="breadcrumbs-wrapper" style="border-bottom:1px solid #ebebeb">
            <div class="container">
                 <div class="row">
                    <div class="col s12 m6 l6">
                        <h5 class="breadcrumbs-title" style="text-align:left;"><span><?php echo _l('Mail Box <span style="color:#bdbaba;font-size:17px">- Sent Items</span>'); ?> <?php  ?></span></h5>
                    </div>
                    <div class="col s12 m6 l6 right-align-md">
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo admin_url(); ?>"><?php echo _l('dashboard_string'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo _l('Mail Box  <span style="color:#bdbaba;">- Sent Items</span>'); ?></li>
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
					<div class="app-email">
					  <div class="content-area content-right">
						<div class="app-wrapper">
						  <div class="app-search">
							<i class="material-icons mr-2 search-icon">search</i>
							<input type="text" placeholder="Search Mail" class="app-filter" id="email_filter">
						  </div>
						  <div class="card card card-default scrollspy border-radius-6 fixed-width">
							<div class="card-content p-0 pb-2">
							  <div class="email-header">
								<div class="left-icons">
								  <span class="header-checkbox">
									<label style="display:none">
									  <input type="checkbox" onClick="toggle(this)" />
									  <span></span>
									</label>
								  </span>
								  <span class="action-icons">									
									<i id="refresh-icon" class="material-icons">refresh</i>
									<i  style="display:none" class="material-icons delete-mails">delete</i>
								  </span>
								</div>
								
								
								<div class="list-content"></div>
								
							  </div>
							
							
							<div class="collection email-collection" id="messageContent">
								
								
																
								
								<?php 
								if (empty($email_data))
								{
								?>
									<div style="padding-left:15px;padding-top:25px">
										<?php  echo "No messages in the sent box."; ?>
									</div>
								<?php
								}
								else
								{									
								foreach ($email_data as $sent_email)
								{
								?>
								<div class="email-brief-info collection-item">
									<div class="list-left">
										<label style="display:none">
											<input type="checkbox" name="foo" />
											<span></span>
										</label>									
									</div>
									<a class="list-content modal-trigger" href="<?php echo admin_url('communications/viewSentEmail/' . $sent_email['uid']); ?>" >
										<div class="list-title-area">
											<div class="user-media">
												<div class="list-title">
												
													<p style="font-weight:normal;">
													From : <?= 'ProTrack Sender' . ' &lt;' . $sent_email['from']['email'] . '&gt;'; ?>													</p>
													
													<p style="font-weight:bold; color:#727272">To : 
													<?= 
													implode(', ', array_map(function ($to) 
													{
														return $to['name'] . ' &lt;' . $to['email'] . '&gt;';
													}, $sent_email['to'])); 
													?> 
													</p>
													
													<?php
													if (!empty($sent_email['cc']))
													{
													?>
													<p style="font-weight:normal; color:#727272">
													Cc: 
													<?= 
													implode(', ', array_map(function ($cc) 
													{
														return $cc['name'] . ' &lt;' . $cc['email'] . '&gt;';
													}, $sent_email['cc'])); 
													?>
													</p>
													<?php
													}
													else
													{
													?>
													
													<?php
													}
													?>
													
													<?php
													if (!empty($sent_email['bcc']))
													{
													?>
													<p style="font-weight:normal; color:#727272">
													Bcc: 
													<?= 
													implode(', ', array_map(function ($bcc) 
													{
														return $bcc['name'] . ' &lt;' . $bcc['email'] . '&gt;';
													}, $sent_email['bcc'])); 
													?>
													</p>
													<?php
													}
													else
													{
													?>
													
													<?php
													}
													?>
													
													<?php
													if (!empty($sent_email['subject']))
													{
													?>
													<span style="font-weight:normal"><?= $sent_email['subject']; ?></span>
													<?php
													}
													else
													{
													?>
													
													<span style="font-weight:normal"><?php echo "No Subject"; ?></span>
													<?php
													}
													?>
													
												</div>
												
											</div>	

											<?php
											 if (isset($sent_email['attachments']) && !empty($sent_email['attachments'])) 
											 {
											 ?>
											<div class="title-right">
												<span class="attach-file">
												<i class="material-icons">attach_file</i>
												</span>
											</div>
											<?php
											 }
											 else
											 {
											 }
											 ?>
											 

											
										</div>	
										<div class="list-desc">
											 											
											<?php
												echo "<b>Message:</b> ".$email_body = $sent_email['body']['plain'];
												//$email_body = strip_tags($email_body);
											?>
												
										</div>
									</a>
									
									<div class="list-right">
										<div class="list-date"> 
										<?php 
										
										$date = $sent_email['date']; 
										
										// Convert the original date to a DateTime object
										$date = new DateTime($date);

										// Format the date in the desired format
										$date = $date->format('D, M d Y, g:i A');

										// Update $message['date'] with the formatted date
										echo $message['date'] = $date;
										
										?> 
										
									
										</div>
									</div>
								</div>
								<?php
								}
								}
								?>
								
							

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

<?php include('modasl-popup.php'); ?>

<script>
  document.getElementById('refresh-icon').addEventListener('click', function() {
    // Toggle the 'rotate' class
    this.classList.toggle('rotate');
    
    // Reload the page after a short delay (adjust as needed)
    setTimeout(function() {
      location.reload();
    }, 300);
  });
</script>

<style>
/* Define a CSS class for rotation */
.rotate 
{
  transform: rotate(180deg); /* Adjust the rotation angle as needed */
  transition: transform 0.3s ease; /* Add a smooth transition effect */
}
</style>