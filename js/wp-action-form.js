$(document).ready(function(){
 
    $('#action_form').submit(function(event){
            
    // Empêcher l'affichage par défaut du formulaire
    event.preventDefault();

            var form = $('#action_form');

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
                                        document.getElementById('action_form'). reset()
                                    }else{
                                        $('#spinner').hide()
                                        $('#submitContent').show()
                                        $('#success_message').fadeIn(500).delay(5000).fadeOut(500)
                                    document.getElementById('action_form'). reset()
                                    }
                                },
                            error: function error() {
                                $('#spinner').hide()
                                $('#submitContent').show()
                                $('#error_message').fadeIn(500).delay(5000).fadeOut(500)
                               document.getElementById('action_form'). reset()
                            }
                        });

                });
            
            });
        });
});