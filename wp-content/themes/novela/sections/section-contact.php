<?php
wp_enqueue_script('validation');

$nameError = __( 'Please enter your name.', 'novela' );
$emailError = __( 'Please enter your email address.', 'novela' );
$emailInvalidError = __( 'You entered an invalid email address.', 'novela' );
$messageError = __( 'Please enter a message.', 'novela' );
?>

<section class="contact-information block-section" id="<?php echo esc_attr(sdesigns_get_sub_field('navigation_menu_anchor')); ?>" >

	<h1 class="section-heading"><?php echo wp_kses_post(sdesigns_get_sub_field('section_heading')); ?></h1>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">

				<form id="contact-form" method="post">
					<div class="row contact-info">

						<div class="col-sm-4 col-sm-offset-2">
							<div class="name-field">
								<input type="text" name="contactName" id="contactName" value="" class="required requiredField" placeholder="Name"/>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="email-field">
								<input type="text" name="email" id="email" value="" class="required requiredField email" placeholder="Email"/>
							</div>
						</div>
					</div><!-- end row -->
					<div class="row">
						<div class="col-sm-8 col-sm-offset-2">
							<div class="contact-textarea">
								<textarea name="comments" id="commentsText" rows="6" cols="20" class="required requiredField" placeholder="Write your message..."></textarea>
							</div>

							<div class="buttons">
								<input type="hidden" name="submitted" id="submitted" value="true" />
								<button type="submit" class="button submit-button"><i class="fa fa-envelope-o"></i><span><?php _e('Send', 'novela'); ?></span></button>
							</div>
						</div>
					</div>
				</form>

			</div><!-- end col-sm-12 -->
		</div><!-- end rows -->

		<div class="row">

			<?php
			if( sdesigns_have_rows('contact_information') ): ?>

				<?php while ( sdesigns_have_rows('contact_information') ) : the_row(); ?>

				<div class="col-sm-4">
					<div class="contact-box">
						<?php sdesigns_the_sub_field('icon'); ?>
						<span class="italics"><?php echo wp_kses_post(sdesigns_get_sub_field('description')); ?></span>
					</div>
				</div><!-- end col-sm-4 -->

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- end row -->

	</div><!-- end container -->

</section><!-- end contact-information -->

<script type="text/javascript">
jQuery(document).ready(function($){

	var $contactForm = $('#contact-form');

	$contactForm.validate({
		messages: {
			contactName: '<?php echo $nameError; ?>',
			email: {
				required: '<?php echo $emailError; ?>',
				email: '<?php echo $emailInvalidError; ?>'
			},
			message: '<?php echo $messageError; ?>'
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element);
		},
		submitHandler: function(form) {
			ajaxSubmit($contactForm);
		}
	});

	function ajaxSubmit($contactForm){

		var $submitButton = $('.submit-button');
		var sentHTML = '<div class="email-sent"><p><?php _e('Thanks, your email was sent successfully.', 'novela') ?></p></div>';
		var buttonText = $submitButton.find('span').text();

		$submitButton.find('span').text('<?php _e('Sending...', 'novela'); ?>');
		$submitButton.attr('disabled', 'disabled');
		$submitButton.css('opacity', 0.75);

		var name = $('#contactName').val();
		var email = $('#email').val();
		var message = $('#commentsText').val();
		var toEmail = '<?php sdesigns_the_sub_field("receiving_email") ?>';

			$.ajax({
				type: 'post',
				dataType: 'json',
				url: sdesignsAjax.ajaxurl,
				data: {
					action : 'sdesigns_ajax_mail_function',
					name : name,
					email : email,
					message : message,
					to_email : toEmail
				},
				success: function(html) {
					$('#contactName').val('');
					$('#email').val('');
					$('#commentsText').val('');

					$submitButton.find('span').text(buttonText);
					$submitButton.removeAttr('disabled');
					$submitButton.animate({'opacity': 1}, 300);
					$(sentHTML).hide().insertAfter('.buttons').fadeIn(400);
	        	}
			});

		return false;
	}


	

});
</script>