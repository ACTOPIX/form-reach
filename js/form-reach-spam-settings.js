document.addEventListener("DOMContentLoaded", () => {
    const [formreach_checkbox, formreach_siteKey, formreach_secretKey, formreach_score] = ["formreach_recaptcha_switch", "formreach_key_site", "formreach_key_secret", "formreach_recaptcha_score"].map(id => document.getElementById(id));
    const formreach_toggle = () => { [formreach_siteKey, formreach_secretKey, formreach_score].forEach(input => input.required = formreach_checkbox.checked);};
    formreach_toggle(),formreach_checkbox.addEventListener("change", formreach_toggle);
});