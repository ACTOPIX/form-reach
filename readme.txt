=== Form Reach ===
Tags: contact, form, whatsapp, logs, email
Requires at least: 6.1
Tested up to: 6.7
Stable Tag: 1.0
License: GPLv2
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html

Custom Contact Form Builder for WhatsApp, Email, and more!

== Description ==

Form Reach is a powerful WordPress form builder extension that allows you to create contact forms for various messaging platforms, including WhatsApp, email, and more. With Form Reach, you can effortlessly manage multiple contact forms and customize their content using simple shortcodes. The plugin supports Ajax form submission and integrates seamlessly with reCAPTCHA for enhanced security. Additionally, Form Reach automatically stores all submitted messages, ensuring that you never miss important user inquiries.

### Key Features:
1. **Easy Form Building** – Create professional contact forms for WhatsApp, email, and more within minutes.
2. **Multi-platform Support** – Reach your audience through various messaging platforms with ease.
3. **Customization Options** – Personalize the content of your forms and emails using simple shortcodes.
4. **Ajax Form Submission** – Seamlessly submit forms without refreshing the page, providing a smoother user experience.
5. **Enhanced Security** – Integrate reCAPTCHA to prevent spam submissions and ensure data integrity.
6. **Message Storage** – Store and access all user-submitted messages conveniently for reference and follow-ups.

Experience the convenience and versatility of Form Reach for your WordPress website. Simplify your contact form management and engage with your users effectively.

## Documentation & Support

You can find [documentation](https://form-reach.com/docs/), [FAQ](https://form-reach.com/faq/), and more detailed information about Form Reach on [form-reach.com](https://form-reach.com/). 

If you need further assistance, visit the [support forum](https://wordpress.org/support/plugin/formreach/) on WordPress.org. If you cannot find an existing topic that relates to your issue, feel free to post a new one.

---

## Privacy Notice

With the default configuration, this plugin **does not**:

* Track users without their consent;
* Store any user personal data in the database;
* Send any user data to external servers;
* Use cookies.

If you activate certain features, the contact form submitter’s personal data, including their **IP address**, may be sent to third-party service providers. You should review their privacy policies before enabling these features.

### Services that may collect user data:
- **reCAPTCHA** ([Google](https://policies.google.com/?hl=en))  
  Used to protect forms from spam and bot submissions.

- **WhatsApp API** ([WhatsApp](https://www.whatsapp.com/legal/privacy-policy))  
  Used for sending form submissions to WhatsApp.

- **IP Geolocation Service (ipinfo.io)** ([ipinfo.io](https://ipinfo.io/privacy))  
  Used for detecting the user's country and pre-filling location-based fields.

---

## External Services Used

### WhatsApp API
This plugin integrates with the **WhatsApp API** to send messages when a user submits a form with WhatsApp as the selected contact method.

**What data is sent and when?**
- When a user submits a form that triggers a WhatsApp message, their **phone number and message content** are processed through the WhatsApp API.

**Service details:**
- API provider: [WhatsApp API](https://api.whatsapp.com)
- [WhatsApp Terms of Service](https://www.whatsapp.com/legal/terms-of-service)
- [WhatsApp Privacy Policy](https://www.whatsapp.com/legal/privacy-policy)

---

### Google reCAPTCHA
This plugin uses **Google reCAPTCHA** to prevent spam submissions.

**What data is sent and when?**
- When a user submits a form with **reCAPTCHA enabled**, their **IP address and browser-related data** are sent to Google for verification.

**Service details:**
- API provider: [Google reCAPTCHA](https://www.google.com/recaptcha)
- [Google reCAPTCHA Terms of Service](https://policies.google.com/terms)
- [Google reCAPTCHA Privacy Policy](https://policies.google.com/privacy)

---

### IP Geolocation (ipinfo.io)
This plugin uses **ipinfo.io** to detect the user’s country for auto-filling location-based fields.

**What data is sent and when?**
- When a form loads with country-based auto-detection enabled, the user’s **IP address** is sent to ipinfo.io to determine their country.

**Service details:**
- API provider: [ipinfo.io](https://ipinfo.io)
- [ipinfo.io Privacy Policy](https://ipinfo.io/privacy)

---

## Source Code

The source code for this plugin is available at:  
[GitHub Repository](https://github.com/ACTOPIX/form-reach)

---

## Installation

1. Upload the entire `form-reach` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the **Plugins** screen (**Plugins > Installed Plugins**).

You will find the **Form Reach** menu in your WordPress admin panel.

For usage instructions, visit the [official website](https://form-reach.com/).
