jQuery(document).ready(function(){
    
    var siteKey = jQuery('#fr_key_site').val();
    var recaptchaSwitch = jQuery('#fr_recaptcha_switch').val();

    jQuery('#form_reach_mail').submit(function(event){
        // Empêcher l'affichage par défaut du formulaire
        event.preventDefault();
        var form = jQuery('#form_reach_mail');
        

        if (recaptchaSwitch != 1) {
        // La protection reCAPTCHA V3 est désactivée, envoyez les données du formulaire directement

            var serializeDataArray = form.serializeArray();

            jQuery.ajax({
                type: "POST",
                url: "/wp-content/plugins/form-reach/process/validation.php",
                data: serializeDataArray,
                beforeSend: function beforeSend() {
                    jQuery('#submitContent').hide()
                    jQuery('#spinner').show()
                },
                success: function (data) {
                    if (data=="recaptchaValidation=false"){
                        jQuery('#spinner').hide()
                        jQuery('#submitContent').show()
                        jQuery('#error_message').fadeIn(500).delay(5000).fadeOut(500)
                        document.getElementById('form_reach_mail').reset()
                    }else{
                        jQuery('#spinner').hide()
                        jQuery('#submitContent').show()
                        jQuery('#success_message').fadeIn(500).delay(5000).fadeOut(500)
                        document.getElementById('form_reach_mail').reset()
                    }
                },
                error: function error() {
                    jQuery('#spinner').hide()
                    jQuery('#submitContent').show()
                    jQuery('#error_message').fadeIn(500).delay(5000).fadeOut(500)
                    document.getElementById('form_reach_mail').reset()
                }
            });
        } else {
        // La protection reCAPTCHA V3 est activée, vérifiez la réponse du serveur

            grecaptcha.ready(function () {
                grecaptcha.execute(siteKey, {action: 'submit'}).then(function (token) {
                    jQuery('#g-recaptcha-response').val(token);

                    var serializeDataArray = form.serializeArray();

                    jQuery.ajax({
                        type: "POST",
                        url: "/wp-content/plugins/form-reach/process/validation.php",
                        data: serializeDataArray,
                        beforeSend: function beforeSend() {
                            jQuery('#submitContent').hide()
                            jQuery('#spinner').show()
                        },
                        success: function (data) {
                            if (data=="recaptchaValidation=false"){
                                jQuery('#spinner').hide()
                                jQuery('#submitContent').show()
                                jQuery('#error_message').fadeIn(500).delay(5000).fadeOut(500)
                                document.getElementById('form_reach_mail').reset()
                            }else{
                                jQuery('#spinner').hide()
                                jQuery('#submitContent').show()
                                jQuery('#success_message').fadeIn(500).delay(5000).fadeOut(500)
                                document.getElementById('form_reach_mail').reset()
                            }
                        },
                        error: function error() {
                            jQuery('#spinner').hide()
                            jQuery('#submitContent').show()
                            jQuery('#error_message').fadeIn(500).delay(5000).fadeOut(500)
                            document.getElementById('form_reach_mail').reset()
                        }
                    });
                });
            });
        }
    });

    jQuery('#form_reach_whatsapp').submit(function(event){
        // Empêcher l'affichage par défaut du formulaire
        event.preventDefault();
        var form = jQuery('#form_reach_whatsapp');

        if (recaptchaSwitch != 1) {
        // La protection reCAPTCHA V3 est désactivée, envoyez les données du formulaire directement
            var serializeDataArray = form.serializeArray();

            jQuery.ajax({
                type: "POST",
                url: "/wp-content/plugins/form-reach/process/whatsapp.php",
                data: serializeDataArray,
                beforeSend: function beforeSend() {
                    jQuery('#submitContentWhatsapp').hide()
                    jQuery('#spinnerWhatsapp').show()
                },
                success: function (data) {
                    if (data=="recaptchaValidation=false"){
                        jQuery('#spinnerWhatsapp').hide()
                        jQuery('#submitContentWhatsapp').show()
                        jQuery('#error_message').fadeIn(500).delay(5000).fadeOut(500)
                        document.getElementById('form_reach_whatsapp').reset()
                    }else{
                        jQuery('#spinnerWhatsapp').hide()
                        jQuery('#submitContentWhatsapp').show()
                        jQuery('#success_message').fadeIn(500).delay(5000).fadeOut(500)
                        document.getElementById('form_reach_whatsapp').reset()
                        var options = "width=600,height=400,left=" + ((screen.width - 600) / 2) + ",top=" + ((screen.height - 400) / 2);
                        window.open(data, '_blank', options);
                    }
                },
                error: function error() {
                    jQuery('#spinnerWhatsapp').hide()
                    jQuery('#submitContentWhatsapp').show()
                    jQuery('#error_message').fadeIn(500).delay(5000).fadeOut(500)
                    document.getElementById('form_reach_whatsapp').reset()
                }
            });
        } else {
        // La protection reCAPTCHA V3 est activée, vérifiez la réponse du serveur
            grecaptcha.ready(function () {
                grecaptcha.execute(siteKey, {action: 'submit'}).then(function (token) {
                    jQuery('#g-recaptcha-response').val(token);

                    var serializeDataArray = form.serializeArray();
                    
                    jQuery.ajax({
                        type: "POST",
                        url: "/wp-content/plugins/form-reach/process/whatsapp.php",
                        data: serializeDataArray,
                        beforeSend: function beforeSend() {
                            jQuery('#submitContentWhatsapp').hide()
                            jQuery('#spinnerWhatsapp').show()
                        },
                        success: function (data) {
                            if (data=="recaptchaValidation=false"){
                                jQuery('#spinnerWhatsapp').hide()
                                jQuery('#submitContentWhatsapp').show()
                                jQuery('#error_message').fadeIn(500).delay(5000).fadeOut(500)
                                document.getElementById('form_reach_whatsapp').reset()
                            }else{
                                jQuery('#spinnerWhatsapp').hide()
                                jQuery('#submitContentWhatsapp').show()
                                jQuery('#success_message').fadeIn(500).delay(5000).fadeOut(500)
                                document.getElementById('form_reach_whatsapp').reset()
                                var options = "width=600,height=400,left=" + ((screen.width - 600) / 2) + ",top=" + ((screen.height - 400) / 2);
                                window.open(data, '_blank', options);
                            }
                        },
                        error: function error() {
                            jQuery('#spinnerWhatsapp').hide()
                            jQuery('#submitContentWhatsapp').show()
                            jQuery('#error_message').fadeIn(500).delay(5000).fadeOut(500)
                            document.getElementById('form_reach_whatsapp').reset()
                        }
                    });
                });
            });
        }
    });
});