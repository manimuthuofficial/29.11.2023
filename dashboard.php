<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


<?php init_head(); ?>

<!-- BEGIN: Page Level CSS-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/themes/horizontal-menu-template/materialize.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/themes/horizontal-menu-template/style.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/layouts/style-horizontal.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/pages/app-sidebar.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/pages/app-email.min.css">

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
?>


<div id="main">
    <div class="row">
        <div class="pt-1 pb-0" id="breadcrumbs-wrapper">
            <div class="container">
                 <div class="row">
                    <div class="col s12 m6 l6">
                        <h5 class="breadcrumbs-title" style="text-align:left;"><span><?php echo _l('Correspondence'); ?> <?php  ?></span></h5>
                    </div>
                    <div class="col s12 m6 l6 right-align-md">
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo admin_url(); ?>"><?php echo _l('dashboard_string'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo _l('Correspondence'); ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
		
		
		
		<div class="content-wrapper-before lighten-5"></div>
			<div class="col s12">
				<div class="container">
				
				
				
					<!-- Sidebar Area Starts -->
					<div class="email-overlay"></div>
					<div class="sidebar-left sidebar-fixed">
					  <div class="sidebar">
						<div class="sidebar-content">
						  <div class="sidebar-header">
							<div class="sidebar-details">
							  <h5 class="m-0 sidebar-title" style="display:none"><i class="material-icons app-header-icon text-top">mail_outline</i> Mailbox</h5>
							  <div class="row valign-wrapper mt-10 pt-2 animate fadeLeft">
								<div class="col s2 media-image">
								  <i class="fa fa-user-circle-o" aria-hidden="true" style="font-size:40px;color:#c1c1c1"></i>
								  <!-- notice the "circle" class -->
								</div>
								<div class="col s10">
								  <p class="m-0 subtitle font-weight-700"><?php echo $firstname . " ". $lastname; ?></p>
								  <p class="m-0 text-muted"><?php echo $session_email; ?></p>
								  <?php
								  
								  ?>
								</div>
							  </div>
							</div>
						  </div>
						  <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft">
							<div class="sidebar-list-padding app-sidebar sidenav" id="email-sidenav">
							
							
								<ul class="email-list display-grid" id="messageTabs">
									<li class="sidebar-title">Folders</li>
									
									<li <?php if (!$this->input->get('tab') || $this->input->get('tab') === 'inbox') echo 'class="active"'; ?>>
										<a href="<?= admin_url('communications/dashboard?tab=inbox') ?>" class="text-sub">
											<i class="material-icons mr-2"> mail_outline </i> Inbox &nbsp; <?php //echo $unread_count; ?>
										</a>
									</li>
															
									<li <?php if ($this->input->get('tab') === 'sent') echo 'class="active"'; ?>>
										<a  href="<?= admin_url('communications/dashboard?tab=sent') ?>" class="text-sub">
											<i class="material-icons mr-2"> send </i> Sent Items &nbsp; <?php //echo $sent_count; ?>
										</a>
									</li>
									
									
								</ul>
							  
							  
							  
							</div>
						  </div>
						  <a href="#" data-target="email-sidenav" class="sidenav-trigger hide-on-large-only"><i
							  class="material-icons">menu</i></a>
						</div>
					  </div>
					</div>
					<!-- Sidebar Area Ends -->

					
					
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
									<label>
									  <input type="checkbox" onClick="toggle(this)" />
									  <span></span>
									</label>
								  </span>
								  <span class="action-icons">									
									<i id="refresh-icon" class="material-icons">refresh</i>
									<i class="material-icons delete-mails">delete</i>
								  </span>
								</div>
								
								
								<div class="list-content"></div>
								
							  </div>
							
							
							<div class="collection email-collection" id="messageContent">
							
								<?php
								if (empty($messages))
								{
								?>									
								
								<div style="padding-left:15px;padding-top:25px">
								<?php  echo "No messages to display."; ?>
								</div>
									
								<?php
								}
								else
								{
								?>
								
								<?php foreach ($messages as $message): ?>								
								<?php 
								if (!$this->input->get('tab') || $this->input->get('tab') === 'inbox')
								{
								$read_status = $message['read_status'];			
								?>	
								<div class="email-brief-info collection-item">
									<div class="list-left">
										<label>
											<input type="checkbox" name="foo" />
											<span></span>
										</label>									
									</div>
									<a class="list-content modal-trigger" href="<?php echo admin_url('communications/view/' . $message['thread_id']); ?>" >
										<div class="list-title-area">
											<div class="user-media">
												<div class="list-title">
												
													<?php
													if($read_status == 'unread')
													{
													?>
													<i style="color: #727272;" class="fa fa-lock" aria-hidden="true"></i> 
													<?php																	
													}
													else
													{
													?>
													<i style="color: #727272;" class="fa fa-unlock" aria-hidden="true"></i> 
													<?php
													}
													?>
													&nbsp;&nbsp;																	
												
													From : <?php echo $message['from_email']; ?> - <?php echo $message['sender_name']; ?> - <?php echo $message['id']; ?>
													<br>
													<p style="font-weight:normal; color:#727272">To : <?php echo $message['to_email']; ?> - <?php echo $message['recipient_name']; ?> </p>
													<p style="font-weight:normal; color:#727272">CC : <?php echo $message['cc_emails']; ?></p>
													<span style="font-weight:bold"><?php echo $message['subject']; ?></span>
												</div>
												
											</div>									  
										</div>
										<div class="list-desc">
											<?php echo $message['message']; ?>
										</div>
									</a>
									<?php 									
									// Assuming $message['created_at'] contains the date '2023-09-28 18:49:35'
									$created_at = $message['created_at'];
									// Convert the original date to a DateTime object
									$created_at = new DateTime($created_at);

									// Format the date in the desired format
									$created_at = $created_at->format('D, M d Y, g:i A');

									// Update $message['created_at'] with the formatted date
									$message['created_at'] = $created_at;													
									?> 
									<div class="list-right">
										<div class="list-date"> <?php echo $created_at; ?></div>
									</div>
								</div>
								<?php
								}
								else if ($this->input->get('tab') === 'sent')
								{
								?>
																
								<div class="email-brief-info collection-item">
									<div class="list-left">
										<label>
											<input type="checkbox" name="foo" />
											<span></span>
										</label>									
									</div>
									<a class="list-content modal-trigger" href="#modal2" data-message='<?php echo json_encode($message); ?>'>
										<div class="list-title-area">
											<div class="user-media">
												<div class="list-title">
													<?php echo $message['to_email']; ?> - <?php echo $message['recipient_name']; ?>  <?php //echo $message['id']; ?>
													<br>
													<?php
													if (empty($message['cc_emails'])) 
													{
														
													} 
													else 
													{
													?>
													<p style="font-weight:normal; color:#727272">CC : <?php echo $message['cc_emails']; ?></p>
													<?php
													}
													?>
													
													<span style="font-weight:bold"><?php echo $message['subject']; ?></span>
													
												</div>												
											</div>									  
										</div>
										<div class="list-desc">
											<?php echo $message['message']; ?>
										</div>
										
																				
									</a>
									<?php 									
									// Assuming $message['created_at'] contains the date '2023-09-28 18:49:35'
									$created_at = $message['created_at'];
									// Convert the original date to a DateTime object
									$created_at = new DateTime($created_at);

									// Format the date in the desired format
									$created_at = $created_at->format('D, M d Y, g:i A');

									// Update $message['created_at'] with the formatted date
									$message['created_at'] = $created_at;													
									?> 
									<div class="list-right">
										<div class="list-date"> <?php echo $created_at; ?></div>
										
										
										<?php
										if($message['viewed'] == 'Not Opened')
										{										
										?>
										
										<p class="not-viewed"><i class="fa fa-eye-slash" aria-hidden="true"></i> &nbsp;<?php echo $message['viewed']; ?></p>
										
										<?php
										}
										else
										{										
										?>
										
										<p class="not-viewed-yes"><i class="fa fa-eye" aria-hidden="true"></i> &nbsp;<?php echo $message['viewed']; ?></p>
										
										<?php
										}
										?>
										
										
										
									</div>
								</div>
								<?php
								}													
								else
								{
								}
								?>
																
								<?php endforeach; ?>
								
								<?php
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

<!-- Add new email popup -->
<div style="bottom: 54px; right: 19px;" class="fixed-action-btn direction-top">
  <a class="btn-floating btn-large primary-text gradient-45deg-light-blue-cyan gradient-shadow compose-email-trigger" href="#">
    <i class="material-icons">add</i>
  </a>
</div>
<!-- Add new email popup Ends-->


<!-- email compose sidebar -->
<div class="email-compose-sidebar">
  <div class="card quill-wrapper">
    <div class="card-content pt-0">
      <div class="card-header display-flex pb-2">
        <h3 class="card-title">COMPOSE CORRESPONDENCE </h3>
        <div class="close close-icon">
          <i class="material-icons">close</i>
        </div>
		
      </div>
      <div class="divider"></div>
      <!-- form start -->
	  
		<br>
		<?php echo form_open('class="edit-email-item mt-10 mb-10" id="email-form"'); ?>
				
			<div class="row" style="display:none">		
				<div class="input-field col s12">
					<i class="material-icons prefix">account_circle</i>
					<input type="text" id="from_email" name="from_email" value="<?php echo $session_email." - ".$firstname." ".$lastname; ?>">
					<label for="icon_prefix3">From Email</label>
				</div>
			</div>
			
			
			
			<div class="input-field col s12" style="padding-bottom:20px;">
				<select id="to_email" name="to_email">
					<option value="" selected>Select Client's Email</option>

					<?php foreach ($emails as $email): ?>

					<option value="<?php echo $email['email']; ?> - <?php echo $email['firstname']; ?> <?php echo $email['lastname']; ?>"> <?php echo $email['email']; ?> - <?php echo $email['firstname']; ?> <?php echo $email['lastname']; ?> </option>

					<?php endforeach; ?>
					
					
					<?php foreach ($admin_emails as $admin_email): ?>

					<option value="<?php echo $admin_email['email']; ?> - <?php echo $admin_email['firstname']; ?> <?php echo $admin_email['lastname']; ?>"> <?php echo $admin_email['email']; ?> - <?php echo $admin_email['firstname']; ?> <?php echo $admin_email['lastname']; ?> </option>

					<?php endforeach; ?>
				

				</select>
				<label for="name2">To Email *</label>
			</div>

			
			<div class="input-field col s12" style="padding-bottom:20px;">
				<input placeholder="Enter Subject" type="text" id="subject" name="subject">
				<label for="name2">Subject *</label>
			</div>
						
									
			<div class="input-field col s12" style="padding-bottom:20px;">
				<select id="cc_emails[]" name="cc_emails[]" class="select2-customize-result browser-default" multiple="multiple" id="select2-customize-result">
					<option value=""></option>
					<?php foreach ($cc_admin_emails as $cc_admin_email): ?>

					<option value="<?php echo $cc_admin_email['email']; ?> - <?php echo $cc_admin_email['firstname']; ?> <?php echo $cc_admin_email['lastname']; ?>"> <?php echo $cc_admin_email['email']; ?> - <?php echo $cc_admin_email['firstname']; ?> <?php echo $cc_admin_email['lastname']; ?> </option>

					<?php endforeach; ?>
				</select>
				<label for="name2">Add CC</label>
			</div>
			
									
			<div class="input-field  col s12" style="padding-bottom:20px;">
				<textarea id="message" name="message"></textarea>
			</div>
			
						
			<div class="card-alert card green-card green lighten-5" style="display: none;margin-top: 0 1rem;margin-bottom: 0 1rem;">
				<div class="card-content green-text">
					<p></p>
				</div>
				<button type="button" class="close green-text" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
			</div>

			<div class="card-alert card red-card red lighten-5" style="display: none;margin-top: 0 1rem;margin-bottom: 0 1rem;;">
				<div class="card-content red-text">
					<p></p>
				</div>
				<button type="button" class="close red-text" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true"></span>
				</button>
			</div>
			
															
			<div class="card-action pl-0 pr-0 right-align" style="padding-bottom:0px !important">
				<!--
				<button type="reset" class="btn-small waves-effect waves-light cancel-email-item mr-1">
					<i class="material-icons left">close</i>
					<span>Cancel</span>
				</button>
				
				<button type="button" id="draft-btn" class="btn-small waves-effect waves-light mr-1">
					<i class="material-icons left">description</i>
					<span>Draft</span>
				</button>
				-->
				
				<button type="button" id="send-btn" class="btn-small waves-effect waves-light send-email-item">
					<i class="material-icons left">send</i>
					<span>Send</span>
				</button>
					

			</div> 		
		<?php echo form_close(); ?>
		
		
		
      
      <!-- form start end-->
    </div>
  </div>
</div>

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

<script>
$(document).ready(function() {
	
	// Initialize CKEditor with a custom toolbar
	CKEDITOR.replace('message', {
		
		toolbar: [
			{ name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
			{ name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote', '-', 'Link', 'Placeholder'] }
		]
	});

	$("#send-btn").click(function(event) {
		event.preventDefault();

		// Get the CKEditor instance and its content
		var ckeditorInstance = CKEDITOR.instances.message;
		var ckeditorContent = ckeditorInstance.getData();

		// Set the CKEditor content as the textarea's value
		$("#message").val(ckeditorContent);
		
		var selectedCcEmails = [];
        var selectElement = document.getElementById('cc_emails[]');

        for (var i = 0; i < selectElement.options.length; i++) 
		{
            if (selectElement.options[i].selected) 
			{
                selectedCcEmails.push(selectElement.options[i].value);
            }
        }

        // If no options are selected, set selectedCcEmails to an empty array
        if (selectedCcEmails.length === 0) 
		{
            selectedCcEmails = [];
        }


		// Rest of your form validation and submission code...
		// (Replace this with your existing validation and AJAX submission code)
		// Example validation:
		var from_email = $("#from_email").val();
		var to_email = $("#to_email").val();
		var subject = $("#subject").val();
		var message = $("#message").val();

		if (from_email.trim() === "") {
			// Display a validation error message
			//displayErrorAlert("Error : Please fill From Email field.");
			//$("#from_email").focus();
			location.reload();
			return;
		}

		if (!to_email) {
			// Display a validation error message
			displayErrorAlert("Error : Select client's email.");
			$("#to_email").focus();
			return;
		}

		if (subject.trim() === "") 
		{
			// Display a validation error message
			displayErrorAlert("Error : Please fill Subject field.");
			$("#subject").focus();
			return;
		}
		
		
		if (message.trim() === "") {
			// Display a validation error message
			displayErrorAlert("Error : Please fill Message field.");
			CKEDITOR.instances.message.focus();
			return;
		}
		
		
		
		
		var selectedCcEmails = [];
		var selectElement = document.getElementById('cc_emails[]');

		for (var i = 0; i < selectElement.options.length; i++) {
			if (selectElement.options[i].selected) {
				selectedCcEmails.push(selectElement.options[i].value);
			}
		}

		// If no options are selected, set selectedCcEmails to an empty array
		if (selectedCcEmails.length === 0) {
			selectedCcEmails = [];
		}

		// Include selectedCcEmails in the form data
		formData += "&cc_emails[]=" + selectedCcEmails.join("&cc_emails[]=");
		
		
		
		
		

		// Serialize the form data
		var formData = $(this).serialize();

		// Send an AJAX POST request to the server
		$.ajax({
			type: "POST",
			url: "<?php echo admin_url('Communications/sendCommunications'); ?>",
			data: $("#email-form").serialize(),
			dataType: "json",
			success: function(response) {
				if (response.success) 
				{
					// Clear the form
					$("#email-form")[0].reset();
					$("#to_email").val('');
					$("#to_email").formSelect();
					$("#subject").val('');
					$("#message").val('');
					$("#from_email").focus();
					
					// Display a success message
					//displaySuccessAlert(response.message);
					
					// Hide the email-compose-sidebar
					$(".email-compose-sidebar").hide();
					
					swal({
					  title: "Sent!",
					  text: "Your message has been successfully sent.",
					  icon: "success",
					  buttons: {
						confirm: "OK",
					  },
					}).then(() => {
					  // Page reload when the dialog is closed
					  location.reload();
					});

					// Reload the page after a short delay (e.g., 2 seconds)
					setTimeout(function() 
					{
						location.reload();
					}, 3000); // Adjust the delay as needed

				} 
				else 
				{
					// Display an error message
					displayErrorAlert(response.message);
				}
			},
			error: function(xhr, textStatus, errorThrown) {
				console.error(xhr.responseText);
				// Handle the error here if needed
				displayErrorAlert("An error occurred while processing your request.");
			}
		});
	});

	// Function to display success alert
	function displaySuccessAlert(message) 
	{
		var successAlert = $(".green-card");
		successAlert.find(".card-content p").text(message);
		successAlert.fadeIn();
		
		setTimeout(function() 
		{
			successAlert.fadeOut();
		}, 3000);
	}

	// Function to display error alert
	function displayErrorAlert(message) {
		var errorAlert = $(".red-card");
		errorAlert.find(".card-content p").text(message);
		errorAlert.fadeIn();
		setTimeout(function() {
			errorAlert.fadeOut();
		}, 2000);
	}
});
</script>


<script>
function toggle(e) {
    checkboxes = document.getElementsByName("foo");
    for (var i = 0, o = checkboxes.length; i < o; i++) checkboxes[i].checked = e.checked;
}
function resizetable() {
    0 < $(".vertical-layout").length ? $(".app-email .collection").css({ maxHeight: $(window).height() - 350 + "px" }) : $(".app-email .collection").css({ maxHeight: $(window).height() - 410 + "px" });
}
$(document).ready(function () {
    "use strict";
    900 < $(window).width() && $("#email-sidenav").removeClass("sidenav");
    new Quill(".snow-container .compose-editor", { modules: { toolbar: ".compose-quill-toolbar" }, placeholder: "Write a Message... ", theme: "snow" });
    if (
        ($("#email-sidenav").sidenav({
            onOpenStart: function () {
                $("#sidebar-list").addClass("sidebar-show");
            },
            onCloseEnd: function () {
                $("#sidebar-list").removeClass("sidebar-show");
            },
        }),
        0 < $("#sidebar-list").length)
    )
        new PerfectScrollbar("#sidebar-list", { theme: "dark", wheelPropagation: !1 });
    if (0 < $(".app-email .collection").length) new PerfectScrollbar(".app-email .collection", { theme: "dark", wheelPropagation: !1 });
    if (
        ($(".email-list li").click(function () {
            var e = $(this);
            e.hasClass("sidebar-title") || ($("li").removeClass("active"), e.addClass("active"));
        }),
        $('.app-email i[type="button"]').click(function (e) {
            $(this).closest("tr").remove();
        }),
        $(".app-email .favorite i").on("click", function (e) {
            e.preventDefault(), $(this).toggleClass("amber-text");
        }),
        $(".app-email .email-label i").on("click", function (e) {
            e.preventDefault(), $(this).toggleClass("amber-text"), "label_outline" == $(this).text() ? $(this).text("label") : $(this).text("label_outline");
        }),
        $(".app-email .delete-mails").on("click", function () {
            $(".collection-item").find("input:checked").closest(".collection-item").remove();
        }),
        $(".app-email .delete-task").on("click", function () {
            $(this).closest(".collection-item").remove();
        }),
        $(".sidenav-trigger").on("click", function () {
            $(window).width() < 960 && ($(".sidenav").sidenav("close"), $(".app-sidebar").sidenav("close"));
        }),
        $("#email_filter").on("keyup", function () {
            $(".email-brief-info").css("animation", "none");
            var e = $(this).val().toLowerCase();
            "" != e
                ? ($(".email-collection .email-brief-info").filter(function () {
                      $(this).toggle(-1 < $(this).text().toLowerCase().indexOf(e));
                  }),
                  0 == $(".email-brief-info:visible").length ? $(".no-data-found").hasClass("show") || $(".no-data-found").addClass("show") : $(".no-data-found").removeClass("show"))
                : $(".email-collection .email-brief-info").show();
        }),
        $(".compose-email-trigger").on("click", function () {
            $(".email-overlay").addClass("show"), $(".email-compose-sidebar").addClass("show");
        }),
		
		
        $(".email-compose-sidebar .cancel-email-item, .email-compose-sidebar .close-icon, .email-overlay").on("click", function () {
			// Reset the select element to its default value
			//$("#to_email").val(""); // This line resets the select element to its default option
    
	
            $(".email-overlay").removeClass("show"), $(".email-compose-sidebar").removeClass("show"), $(".compose-editor .ql-editor p").html(""), $("#edit-item-from").val("<?php echo $user_email; ?>");
        }),
        0 < $(".email-compose-sidebar").length)
    )
        new PerfectScrollbar(".email-compose-sidebar", { theme: "dark", wheelPropagation: !1 });
    0 < $("html[data-textdirection='rtl']").length &&
        $("#email-sidenav").sidenav({
            edge: "right",
            onOpenStart: function () {
                $("#sidebar-list").addClass("sidebar-show");
            },
            onCloseEnd: function () {
                $("#sidebar-list").removeClass("sidebar-show");
            },
        });
		
		
		
}),
    $(window).on("resize", function () {
        resizetable(),
            $(".email-compose-sidebar").removeClass("show"),
            $(".email-overlay").removeClass("show"),
            $("input").val(""),
            $(".compose-editor .ql-editor p").html(""),
            $("#edit-item-from").val("<?php echo $user_email; ?>"),
            899 < $(window).width() && $("#email-sidenav").removeClass("sidenav"),
            $(window).width() < 900 && $("#email-sidenav").addClass("sidenav");
    }),
    resizetable();

</script>

<!-- Modal Structure -->
<div id="modal1" class="modal">
	<div class="modal-header">
		<h4>Message Details</h4>		
    </div>
    <div class="modal-content">
	
	
	
	
	
	
		<!-- BEGIN: Page Main-->
		<div id="main">
			<div class="row">
				
				<!-- Content Area Starts -->
				<div class="app-email-content">
					<div class="content-area content-right" style="width:100% !important;margin-top:0px;">
						<div class="app-wrapper">               
						<div class="card card-default scrollspy border-radius-6 fixed-width" style="box-shadow:none">
							<div class="card-content pt-0">
							<div class="row">
								<div class="col s12">
								<!-- Email Header -->
								<div class="email-header">
									<div class="subject">
										<!--
										<div class="back-to-mails">
											<a href="app-email.html"><i class="material-icons">arrow_back</i></a>
										</div>
										-->
										<div class="email-title"><p href="" id="modalSubject"></p></div>
									</div>
									
									<!--
									<div class="header-action">
										<span class="badge grey lighten-2"><i class="amber-text material-icons small-icons mr-2">
										fiber_manual_record </i>Paypal</span>
										<div class="favorite">
											<i class="material-icons">star_border</i>
										</div>
										<div class="email-label">
											<i class="material-icons">label_outline</i>
										</div>
									</div>
									-->
								</div>
								<!-- Email Header Ends -->
								<hr>
								<!-- Email Content -->
								<div class="email-content">
									<div class="list-title-area">
									<div class="user-media">
										<img src="<?php echo base_url(); ?>assets/images/user/9.jpg" alt=""
										class="circle z-depth-2 responsive-img avtar">
										<div class="list-title">
										<span class="to-person">From</span>
										<span class="name"><a href="#" id="modalFromEmail"></a></span>										
										</div>
									</div>
									<div class="title-right">
										<!--<span class="mail-time " id="modalCreatedAt"></span>--><p id="modalID"></p>
										<!--
										<span class="mail-time">Fri, Jan 11, 9:01 AM(4 days ago)</span>
										<i class="material-icons">reply</i>
										<i class="material-icons">more_vert</i-->
									</div>
									</div>
									<div class="email-desc">
										<p	id="modalMessage"></p>
									</div>
									
									<hr>
																	
								</div>
								<!-- Email Content Ends -->
								
								
																	
								<!-- Email Footer -->
								<div class="email-footer">
								
																	
									<!--<h6 class="footer-title"> (3)</h6>-->
									<div class="footer-action">									
									<div class="footer-buttons">										
										<a class="reply mb-6 btn waves-effect waves-light gradient-45deg-amber-amber gradient-shadow"><i class="material-icons left">reply</i><span>Reply</span></a>
										<!--
										<a class="btn forward mb-1"><i class="material-icons left">reply</i><span>Forward</span></a>
										-->
									</div>
									</div>
									<div class="reply-box d-none">
									
									
									<?php echo form_open('class="edit-email-item mt-10 mb-10" id="reply-email-form"'); ?>
									
										<div class="row" style="display: none;">		
											<div class="input-field col s12">
												<i class="material-icons prefix">message</i>
												<input type="text" id="reply_message_id" name="reply_message_id" value="<?php echo htmlspecialchars($modalID, ENT_QUOTES, 'UTF-8'); ?>" >
											</div>
										</div>
				
										<div class="row" style="display: none;">		
											<div class="input-field col s12">
												<i class="material-icons prefix">account_circle</i>
												<input type="text" id="reply_from_email" name="reply_from_email" value="<?php echo $session_email; ?>" >
											</div>
										</div>
										
										<div class="row" style="display: none;">		
											<div class="input-field col s12">
												<i class="material-icons prefix">account_circle</i>
												<input type="text" id="reply_to_email" name="reply_to_email" value="<?php echo htmlspecialchars($modalFromEmail, ENT_QUOTES, 'UTF-8'); ?>">
											</div>
										</div>
																				
										<div class="row">	
											<div class="input-field  col s12">
												<textarea id="reply_message" name="reply_message"></textarea>
											</div>
										</div>
										
										<div class="row">
											<div class="card-alert card green-card green lighten-5" style="display: none;margin: 0 1rem;">
												<div class="card-content green-text">
													<p></p>
												</div>
												<button type="button" class="close green-text" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true"></span>
												</button>
											</div>

											<div class="card-alert card red-card red lighten-5" style="display: none;margin: 0 1rem;">
												<div class="card-content red-text">
													<p></p>
												</div>
												<button type="button" class="close red-text" data-dismiss="alert" aria-label="Close">
												  <span aria-hidden="true"></span>
												</button>
											</div>
										</div>
																						
										<div class="card-action pl-0 pr-0 right-align" style="padding-bottom:0px !important">								
											<div class="row" style="margin: 0 1rem;">
												<button type="button" id="reply-btn" class="btn waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow">
													<i class="material-icons left">send</i>
													<span>Send</span>
												</button>
											</div> 	

										</div> 		
									<?php echo form_close(); ?>
																	
									
									
									</div>
									<div class="forward-box d-none">
									<hr>
									<form action="#">
										<div class="input-field col s12">
										<i class="material-icons prefix"> person_outline </i>
										<input id="email" type="email" class="validate">
										<label for="email">To</label>
										</div>
										<div class="input-field col s12">
										<i class="material-icons prefix"> title </i>
										<input id="subject" type="text" class="validate">
										<label for="subject">Subject</label>
										</div>
										<div class="input-field col s12">
										<div class="snow-container mt-2">
											<div class="forward-email"></div>
											<div class="forward-email-toolbar">
											<span class="ql-formats mr-0">
												<button class="ql-bold"></button>
												<button class="ql-italic"></button>
												<button class="ql-underline"></button>
												<button class="ql-link"></button>
												<button class="ql-image"></button>
											</span>
											</div>
										</div>
										</div>
										<div class="input-field col s12">
										<a class="btn forward-btn right">Forward</a>
										</div>
									</form>
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
	<div class="modal-footer">
		<a href="#!" class="modal-close mb-6 btn waves-effect waves-light gradient-45deg-red-pink gradient-shadow"><i class="material-icons left">close</i>Close</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () 
	{
        const modal = document.getElementById('modal1');
		const modalSubject = document.getElementById('modalSubject');
        const modalFromEmail = document.getElementById('modalFromEmail');
        const modalID = document.getElementById('modalID');
        const modalMessage = document.getElementById('modalMessage');
        const modalCreatedAt = document.getElementById('modalCreatedAt');
		const modalReplyMessage = document.getElementById('modalReplyMessage');
		
		
        const modalLinks = document.querySelectorAll('.modal-trigger');
        modalLinks.forEach(link => 
		{
            link.addEventListener('click', function () {
                const messageData = JSON.parse(this.getAttribute('data-message'));
				 modalSubject.textContent = messageData.subject;
                modalFromEmail.textContent = messageData.from_email;
                modalID.textContent = messageData.id;
                modalMessage.innerHTML = messageData.message;
                //modalCreatedAt.textContent = messageData.created_at;
				
				// Set the value of the emailTextBox to modalToEmail1
				reply_message_id.value = messageData.id;
				
				// Set the value of the from_email to modalToEmail1
				reply_to_email.value = messageData.from_email;
				
				 modalReplyMessage.innerHTML = messageData.reply_message;
				
            });
        });

        // Initialize the modal
        const modalInstance = M.Modal.init(modal, {
            dismissible: true, // Allow modal to be dismissed by clicking outside
        });
    });
</script>

<script>
$(document).ready(function() {
	
	// Initialize CKEditor with a custom toolbar
	CKEDITOR.replace('reply_message', {
		
		toolbar: [
			{ name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
			{ name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote', '-', 'Link', 'Placeholder'] }
		]
	});

	$("#reply-btn").click(function(event) {
		event.preventDefault();

		
		// Get the CKEditor instance and its content
		var ckeditorInstance = CKEDITOR.instances.reply_message;
		var ckeditorContent = ckeditorInstance.getData();

		// Set the CKEditor content as the textarea's value
		$("#reply_message").val(ckeditorContent);
				
		var reply_message_id = $("#reply_message_id").val();
		var reply_from_email = $("#reply_from_email").val();
		var reply_to_email = $("#reply_to_email").val();
		var reply_message = $("#reply_message").val();
				
		
		if (reply_message_id.trim() === "") {
			// Display a validation error message
			displayErrorAlert("Error : 1");
			$("#reply_message_id").focus();
			return;
		}
		
		if (reply_from_email.trim() === "") {
			// Display a validation error message
			displayErrorAlert("Error : 2");
			$("#reply_from_email").focus();
			return;
		}
		
		if (reply_to_email.trim() === "") {
			// Display a validation error message
			displayErrorAlert("Error : 3");
			$("#reply_to_email").focus();
			return;
		}

		if (reply_message.trim() === "") {
			// Display a validation error message
			displayErrorAlert("Error : Please fill Message field.");
			CKEDITOR.instances.reply_message.focus();
			return;
		}

		// Serialize the form data
		var formData = $("#reply-email-form").serialize();
		
				
		// Send an AJAX POST request to the server
		$.ajax({
			type: "POST",
			url: "<?php echo admin_url('Communications/sendReplyCommunications'); ?>",
			data: $("#reply-email-form").serialize(),
			dataType: "json",
			success: function(response) 
			{
				if (response.success) {
					// Clear the form
					$("#reply-email-form")[0].reset();					
					// Display a success message
					displaySuccessAlert(response.message);
					// Reload the page after a short delay (e.g., 2 seconds)
					setTimeout(function() 
					{
						location.reload();
					}, 3000); // Adjust the delay as needed

				} 
				else 
				{
					// Display an error message
					displayErrorAlert(response.message);
				}
			},
			error: function(xhr, textStatus, errorThrown) {
				console.error(xhr.responseText);
				// Handle the error here if needed
				displayErrorAlert("An error occurred while processing your request.");
			}
		});
		
		
		
		
		
		
	});

	// Function to display success alert
	function displaySuccessAlert(message) {
		var successAlert = $(".green-card");
		successAlert.find(".card-content p").text(message);
		successAlert.fadeIn();
		setTimeout(function() {
			successAlert.fadeOut();
		}, 5000);
	}

	// Function to display error alert
	function displayErrorAlert(message) {
		var errorAlert = $(".red-card");
		errorAlert.find(".card-content p").text(message);
		errorAlert.fadeIn();
		setTimeout(function() {
			errorAlert.fadeOut();
		}, 5000);
	}
});
</script>


<!-- Modal Structure -->
<div id="modal2" class="modal">
	<div class="modal-header">
		<h4>Correspondence Details</h4>
    </div>
    <div class="modal-content">
		
	
		<!-- BEGIN: Page Main-->
		<div id="main">
			<div class="row">
				
				<!-- Content Area Starts -->
				<div class="app-email-content">
					<div class="content-area content-right" style="width:100% !important;margin-top:0px;">
						<div class="app-wrapper">               
						<div class="card card-default scrollspy border-radius-6 fixed-width custom-box-shaow"  style="">
							<div class="card-content pt-0">
							<div class="row">
								<div class="col s12">
								<!-- Email Header -->
								<div class="email-header">
									<div class="subject">
										<!--
										<div class="back-to-mails">
											<a href="app-email.html"><i class="material-icons">arrow_back</i></a>
										</div>
										-->
										<div class="email-title"><p id="modalSubject1"></p></div>
									</div>
									
									<!--
									<div class="header-action">
										<span class="badge grey lighten-2"><i class="amber-text material-icons small-icons mr-2">
										fiber_manual_record </i>Paypal</span>
										<div class="favorite">
											<i class="material-icons">star_border</i>
										</div>
										<div class="email-label">
											<i class="material-icons">label_outline</i>
										</div>
									</div>
									-->
								</div>
								<!-- Email Header Ends -->
								<hr>
								<!-- Email Content -->
								<div class="email-content">
									<div class="list-title-area">
									<div class="user-media">
										<img style="display:none" src="<?php echo base_url(); ?>assets/images/user/9.jpg" alt=""
										class="circle z-depth-2 responsive-img avtar">
										<div class="list-title">
										<span class="name"><a href="#" id="modalToEmail1"></a> - <a href="#" id="modalRecipientName1"></a></span>
										
										<style>
										#modalToEmail1::before
										{
											content:'To : ';
										}
										</style>

										
										<span style="color:#727272"><span class="name" id="modalCCEmails1"></span></span>
										
										</div>
									</div>
									<div class="title-right">
										<!--<span class="mail-time " id="modalCreatedAt1"></span><p id="modalID1"></p>-->
										<!--
										<span class="mail-time">Fri, Jan 11, 9:01 AM(4 days ago)</span>
										<i class="material-icons">reply</i>
										<i class="material-icons">more_vert</i-->
									</div>
									</div>
									<div class="email-desc">
									<p	id="modalMessage1"></p>
									</div>
									<p id="modalViewed1" class="not-viewed"></p>
									
								</div>
								<!-- Email Content Ends -->
								<hr>
								<!-- Email Footer -->
								<div class="email-footer">
								
									<!--<h6 class="footer-title"> (3)</h6>-->
									<div class="footer-action">
									<!--
									<div class="attachment-list">
										<div class="attachment">
										<img src="<?php echo base_url(); ?>assets/images/gallery/35.png" alt="" class="responsive-img attached-image">
										<div class="size">
											<span class="grey-text">(0.75Mb)</span>
										</div>
										<div class="links">
											<a href="#" class="left">
											<i class="material-icons">remove_red_eye</i>
											</a>
											<a href="#" class="Right">
											<i class="material-icons">file_download</i>
											</a>
										</div>
										</div>
										<div class="attachment">
										<img src="<?php echo base_url(); ?>assets/images/gallery/36.png" alt="" class="responsive-img attached-image">
										<div class="size">
											<span class="grey-text">(1Mb)</span>
										</div>
										<div class="links">
											<a href="#" class="left">
											<i class="material-icons">remove_red_eye</i>
											</a>
											<a href="#" class="Right">
											<i class="material-icons">file_download</i>
											</a>
										</div>
										</div>
										<div class="attachment">
										<img src="<?php echo base_url(); ?>assets/images/gallery/39.png" alt="" class="responsive-img attached-image">
										<div class="size">
											<span class="grey-text">(1.2Mb)</span>
										</div>
										<div class="links">
											<a href="#" class="left">
											<i class="material-icons">remove_red_eye</i>
											</a>
											<a href="#" class="Right">
											<i class="material-icons">file_download</i>
											</a>
										</div>
										</div>
									</div>
									-->
									<div class="footer-buttons">
										<!--
										<a class="btn reply mb-1"><i class="material-icons left">reply</i><span>Reply</span></a>
										<a class="btn forward mb-1"><i class="material-icons left">reply</i><span>Forward</span></a>
										-->
									</div>
									</div>
									<div class="reply-box d-none">
									<form action="#">
										<div class="input-field col s12">
										<div class="snow-container mt-2">
											<div class="compose-editor"></div>
											<div class="compose-quill-toolbar">
											<span class="ql-formats mr-0">
												<button class="ql-bold"></button>
												<button class="ql-italic"></button>
												<button class="ql-underline"></button>
												<button class="ql-link"></button>
												<button class="ql-image"></button>
											</span>
											</div>
										</div>
										</div>
										<div class="input-field col s12">
										<a class="btn reply-btn right">Reply</a>
										</div>
									</form>
									</div>
									<div class="forward-box d-none">
									<hr>
									<form action="#">
										<div class="input-field col s12">
										<i class="material-icons prefix"> person_outline </i>
										<input id="email" type="email" class="validate">
										<label for="email">To</label>
										</div>
										<div class="input-field col s12">
										<i class="material-icons prefix"> title </i>
										<input id="subject" type="text" class="validate">
										<label for="subject">Subject</label>
										</div>
										<div class="input-field col s12">
										<div class="snow-container mt-2">
											<div class="forward-email"></div>
											<div class="forward-email-toolbar">
											<span class="ql-formats mr-0">
												<button class="ql-bold"></button>
												<button class="ql-italic"></button>
												<button class="ql-underline"></button>
												<button class="ql-link"></button>
												<button class="ql-image"></button>
											</span>
											</div>
										</div>
										</div>
										<div class="input-field col s12">
										<a class="btn forward-btn right">Forward</a>
										</div>
									</form>
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
	<div class="modal-footer">
		<a href="#!" class="modal-close mb-4 btn waves-effect waves-light gradient-45deg-light-blue-cyan gradient-shadow"><i class="material-icons left">close</i>Close</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () 
	{
        const modal = document.getElementById('modal2');
		const modalSubject1 = document.getElementById('modalSubject1');
        const modalToEmail1 = document.getElementById('modalToEmail1');
        const modalID1 = document.getElementById('modalID1');
        const modalMessage1 = document.getElementById('modalMessage1');
        const modalCreatedAt1 = document.getElementById('modalCreatedAt1');
		const modalViewed1 = document.getElementById('modalViewed1');
		const modalRecipientName1 = document.getElementById('modalRecipientName1');
		const modalCCEmails1 = document.getElementById('modalCCEmails1');
		
		

        const modalLinks = document.querySelectorAll('.modal-trigger');
        modalLinks.forEach(link => 
		{
            link.addEventListener('click', function () 
			{
				const messageData = JSON.parse(this.getAttribute('data-message'));
				modalSubject1.textContent = messageData.subject;
				modalToEmail1.textContent = messageData.to_email;
				//modalID1.textContent = messageData.id;
				modalMessage1.innerHTML = messageData.message;
				//modalCreatedAt1.textContent = messageData.created_at;
				modalViewed1.innerHTML = messageData.viewed;
				modalRecipientName1.innerHTML = messageData.recipient_name;
				
				modalCCEmails1.textContent = ''; // Clear any previous content

				if (messageData.cc_emails) 
				{
					modalCCEmails1.textContent = 'CC : ' + messageData.cc_emails;
				}
				
				
				
				
            });
        });

        // Initialize the modal
        const modalInstance = M.Modal.init(modal, {
            dismissible: true, // Allow modal to be dismissed by clicking outside
        });
    });
</script>


<script>
// Find the refresh icon by its id
const refreshIcon = document.getElementById('refresh-icon');

// Add a click event listener to the icon
refreshIcon.addEventListener('click', function () 
{
	// Refresh the page
	location.reload();
});
</script>









<!--
<script>

$(document).ready(function() {
    $("#draft-btn").click(function(event) 
	{
        event.preventDefault(); // Prevent the form from submitting normally

        // Get the values from To_email, Subject and Message fields
		// Get the selected option's value
		var from_email = $("#from_email").val();
        var to_email = $("#to_email").val();
        var subject = $("#subject").val();
        var message = $("#message").val();
		
		// Check if subject is empty
        if (from_email.trim() === "") 
		{
            // Display a validation error message
            displayErrorAlert("Error : Please fill From Email field.");
			$("#from_email").focus();
            return; // Prevent form submission
        }
		
		// Check if to_email is empty
        if (!to_email) 
		{
            // Display a validation error message
            displayErrorAlert("Error : Select client's email.");
			$("#to_email").focus();
            return; // Prevent form submission
        }

        // Check if subject is empty
        if (subject.trim() === "") 
		{
            // Display a validation error message
            displayErrorAlert("Error : Please fill Subject field.");
			$("#subject").focus();
            return; // Prevent form submission
        }
		
		// Check if message is empty
        if (message.trim() === "") 
		{
            // Display a validation error message
            displayErrorAlert("Error : Please fill Message field.");
			$("#message").focus();
            return; // Prevent form submission
        }

        // Serialize the form data
        var formData = $(this).serialize();

        // Send an AJAX POST request to the server
        $.ajax({
            type: "POST",			
            url: "<?php echo admin_url('Communications/draftCommunications'); ?>",
            data: $("#email-form").serialize(),
            dataType: "json",
            success: function(response) 
			{
                if (response.success) 
				{
                    // Clear the form
                    //$("#email-form")[0].reset();
					$("#email-form")[0].reset();
					$("#to_email").val('');
					$("#to_email").formSelect();
					$("#subject").val('');
					$("#message").val('');
					$("#from_email").focus();
                    // Display a success message
                    displaySuccessAlert(response.message);
					
					// Reload the page after a short delay (e.g., 2 seconds)
                    setTimeout(function() 
					{
                        location.reload();
                    }, 2000); // Adjust the delay as needed
					
					
                } 
				else 
				{
                    // Display an error message
                    displayErrorAlert(response.message);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error(xhr.responseText);
                // Handle the error here if needed
                displayErrorAlert("An error occurred while processing your request.");
            }
        });
    });

    // Function to display success alert
    function displaySuccessAlert(message) {
        var successAlert = $(".green-card");
        successAlert.find(".card-content p").text(message);
        successAlert.fadeIn();
        setTimeout(function() {
            successAlert.fadeOut();
        }, 5000);
    }

    // Function to display error alert
    function displayErrorAlert(message) {
        var errorAlert = $(".red-card");
        errorAlert.find(".card-content p").text(message);
        errorAlert.fadeIn();
        setTimeout(function() {
            errorAlert.fadeOut();
        }, 5000);
    }
});

</script>
-->


<style>
    
	
	.email-tabs li
	{
        margin-left: -1.8rem;
        padding-left: 1.8rem;
        border-top-right-radius: 2rem;
        border-bottom-right-radius: 2rem;
        background-color: #f9f9f9;
        /box-shadow: 0 0 8px 0 #2196f3;
        padding-top: 10px;
        padding-bottom: 10px;
		margin-bottom:10px;
    }
	.email-tabs li:hover
	{
        margin-left: -1.8rem;
        padding-left: 1.8rem;
        border-top-right-radius: 2rem;
        border-bottom-right-radius: 2rem;
        background-color: #2196f3;
        //box-shadow: 0 0 8px 0 #2196f3;
        padding-top: 10px;
        padding-bottom: 10px;
		margin-bottom:10px;
    }
	.email-tabs li:hover a
	{
        color:#fff;
    }
	.email-tabs li a
	{
        color:#000;
    }
	
	.email-tabs .active
	{
        margin-left: -1.8rem;
        padding-left: 1.8rem;
        border-top-right-radius: 2rem;
        border-bottom-right-radius: 2rem;
        background-color: #2196f3 !important;
        box-shadow: 0 0 8px 0 #2196f3;
        padding-top: 10px;
        padding-bottom: 10px;
    }
	.email-tabs .active a
	{
		color:#fff !important;
		width:100%;
	}
	
	
    td, th 
	{
        text-align: center;
    }
	
	.app-email .content-area
	{
		//width:100%;
	}
	
	.ql-editor.ql-blank::before 
	{
		font-size: 1.1rem;
		color: #000;
		position: absolute;
		font-style:normal;
		top: 0;
		left: 0;
		cursor: text;
		-webkit-transition: color .2s ease-out,-webkit-transform .2s ease-out;
		transition: color .2s ease-out,-webkit-transform .2s ease-out;
		transition: transform .2s ease-out,color .2s ease-out;
		transition: transform .2s ease-out,color .2s ease-out,-webkit-transform .2s ease-out;
		-webkit-transform: translateY(12px);
		-ms-transform: translateY(12px);
		transform: translateY(12px);
		-webkit-transform-origin: 0 100%;
		-ms-transform-origin: 0 100%;
		transform-origin: 0 100%;
		text-align: initial;
		color: #9e9e9e;
	}
	.input-field.col label
	{
		left:0px;
	}
	button, input, optgroup, select, textarea 
	{
		font-family: 'Avenir Next LT Pro', sans-serif!important;
	}
	input
	{
		text-transform:none;
	}
	.card-title
	{
		color:#2196f3;
		text-transform:uppercase;
		font-family: 'Questrial', sans-serif;
		font-weight:bold !important;
		font-size:20px !important;
	}
	
	.sidebar .sidebar-content .sidebar-header
	{
		height:90px;
	}	
	.sidebar .sidebar-content .sidebar-header
	{
		top:0;
	}
	.email-compose-sidebar
	{
		width: 35rem;
		right: 3.2rem;
	}
	.card .card-action
	{
		border:none
	}
	
	.modal-header 
	{		
		background-color: #fafafa !important;
		padding-top:25px;
		padding-left:24px;
	}
	
	.modal-header h4
	{
		//color: #2196f3;
		//padding: 4px 15px;
		font-family: 'Questrial', sans-serif;
		font-weight:bold !important;
		font-size:20px !important;
		text-transform:uppercase;
	}
	.modal-footer
	{			
		padding-right:24px !important;
	}
	
	.app-email-content .content-area .app-wrapper .email-header .subject .email-title
	{
		font-size:16px;
		font-weight:bold;
	}
	.app-email .content-area .app-wrapper .collection .collection-item .list-date 
	{
		font-size: 13px;
		color: #727272;
	}
	.app-email .content-area .app-wrapper .email-header .left-icons .action-icons
	{
		width:100px;
	}
	
	.not-viewed
	{
		color:#727272;
		font-size:13px;	
		//ext-transform:uppercase;
		//font-weight:bold;
	}
	.not-viewed i
	{
		color:#FF0800;
		opacity: 0.5;
	}
	.not-viewed-yes
	{
		color:#727272;
		font-size:13px;	
		//text-transform:uppercase;
		//font-weight:bold;
	}
	.not-viewed-yes i
	{
		color:#8bc34a;
		opacity: 1;
	}
	
	.cke_bottom
	{
		border-top:none;
		background: none;
	}
	
</style>
