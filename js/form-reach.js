jQuery(document).ready(function(){
    
    var siteKey = jQuery('#fr_key_site').val();
    var recaptchaSwitch = jQuery('#fr_recaptcha_switch').val();
    
    function handleFormSubmit(event, formId, url, successMessageSelector, spinnerSelector, submitContentSelector) {
        event.preventDefault();
        var form = jQuery(formId);

        var processData = function(data){
            jQuery(spinnerSelector).hide();
            jQuery(submitContentSelector).show();

            if(data == "recaptchaValidation=false"){
                jQuery('#error_message').fadeIn(500).delay(5000).fadeOut(500);
            } else {
                jQuery(successMessageSelector).fadeIn(500).delay(5000).fadeOut(500);
                if(formId === '#form_reach_whatsapp' && data != "recaptchaValidation=false"){
                    var options = "width=600,height=400,left=" + ((screen.width - 600) / 2) + ",top=" + ((screen.height - 400) / 2);
                    window.open(data, '_blank', options);
                }
            }
            form[0].reset();
        };

        var performAjaxSubmit = function(){
            var serializeDataArray = form.serializeArray();

            jQuery.ajax({
                type: "POST",
                url: url,
                data: serializeDataArray,
                beforeSend: function beforeSend() {
                    jQuery(submitContentSelector).hide();
                    jQuery(spinnerSelector).show();
                },
                success: processData,
                error: function(){
                    jQuery(spinnerSelector).hide();
                    jQuery(submitContentSelector).show();
                    jQuery('#error_message').fadeIn(500).delay(5000).fadeOut(500);
                    form[0].reset();
                }
            });
        };

        if (recaptchaSwitch != 1) {
            performAjaxSubmit();
        } else {
            grecaptcha.ready(function () {
                grecaptcha.execute(siteKey, {action: 'submit'}).then(function (token) {
                    jQuery('#g-recaptcha-response').val(token);
                    performAjaxSubmit();
                });
            });
        }
    }

    jQuery('#form_reach_mail').submit(function(event){
        handleFormSubmit(event, '#form_reach_mail', '/wp-content/plugins/form-reach/process/validation.php', '#success_message', '#spinner', '#submitContent');
    });

    jQuery('#form_reach_whatsapp').submit(function(event){
        handleFormSubmit(event, '#form_reach_whatsapp', '/wp-content/plugins/form-reach/process/whatsapp.php', '#success_message', '#spinnerWhatsapp', '#submitContentWhatsapp');
    });
});

document.querySelectorAll('input[type="email"]').forEach(function(emailField) {
    emailField.addEventListener('input', function() {
		var emailValue = this.value;
		var isValidEmail = emailValue.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/);
		var feedbackElement = this.nextElementSibling; // Assumer que la div de feedback est juste après l'input

		// Étape 3: Afficher ou cacher la div d'erreur
		if (isValidEmail) {
			if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
				feedbackElement.style.display = 'none';
			}
		} else {
			if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
				feedbackElement.style.display = 'block';
			}
		}
    });
});
