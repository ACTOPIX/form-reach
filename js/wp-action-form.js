$(document).ready(function(){
 
    $('#action_form_mail').submit(function(event){
            
    // Empêcher l'affichage par défaut du formulaire
    event.preventDefault();

            var form = $('#action_form_mail');

            grecaptcha.ready(function () {
                grecaptcha.execute('6LcYu_gaAAAAANJVIQPE35j97DxUCXXozlLiXhpK', {action: 'submit'}).then(function (token) {
                    $('#g-recaptcha-response').val(token);

                    var serializeDataArray = form.serializeArray();
                        
                        $.ajax({
                            type: "POST",
                            url: "/wp-content/plugins/wp-action-form/process/validation.php",
                            data: serializeDataArray,
                            beforeSend: function beforeSend() {
                                $('#submitContent').hide()
                                $('#spinner').show()
                            },
                            success: function (data) {
                                    if (data=="recaptchaValidation=false"){
                                        $('#spinner').hide()
                                        $('#submitContent').show()
                                        $('#error_message').fadeIn(500).delay(5000).fadeOut(500)
                                        document.getElementById('action_form_mail'). reset()
                                    }else{
                                        $('#spinner').hide()
                                        $('#submitContent').show()
                                        $('#success_message').fadeIn(500).delay(5000).fadeOut(500)
                                        document.getElementById('action_form_mail'). reset()
                                    }
                                },
                            error: function error() {
                                $('#spinner').hide()
                                $('#submitContent').show()
                                $('#error_message').fadeIn(500).delay(5000).fadeOut(500)
                                document.getElementById('action_form_mail'). reset()
                            }
                        });

                });
            
            });
        });
});

$(document).ready(function(){
 
    $('#action_form_whatsapp').submit(function(event){
            
    // Empêcher l'affichage par défaut du formulaire
    event.preventDefault();

            var form = $('#action_form_whatsapp');

            grecaptcha.ready(function () {
                grecaptcha.execute('6LcYu_gaAAAAANJVIQPE35j97DxUCXXozlLiXhpK', {action: 'submit'}).then(function (token) {
                    $('#g-recaptcha-response').val(token);

                    var serializeDataArray = form.serializeArray();
                        
                        $.ajax({
                            type: "POST",
                            url: "/wp-content/plugins/wp-action-form/process/whatsapp.php",
                            data : serializeDataArray,
                            beforeSend: function beforeSend() {
                                $('#submitContentWhatsapp').hide()
                                $('#spinnerWhatsapp').show()
                            },
                            success: function (data) {
                                    if (data=="recaptchaValidation=false"){
                                        $('#spinnerWhatsapp').hide()
                                        $('#submitContentWhatsapp').show()
                                        $('#error_message').fadeIn(500).delay(5000).fadeOut(500)
                                        document.getElementById('action_form_whatsapp'). reset()
                                    }else{
                                        $('#spinnerWhatsapp').hide()
                                        $('#submitContentWhatsapp').show()
                                        $('#success_message').fadeIn(500).delay(5000).fadeOut(500)
                                        document.getElementById('action_form_whatsapp'). reset()
                                        window.location = data;
                                    }
                                },
                            error: function error() {
                                $('#spinnerWhatsapp').hide()
                                $('#submitContentWhatsapp').show()
                                $('#error_message').fadeIn(500).delay(5000).fadeOut(500)
                                document.getElementById('action_form_whatsapp'). reset()
                            }
                        });

                });
            
            });
        });
});