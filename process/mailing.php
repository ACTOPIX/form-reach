<?php
$nomDuSite = get_bloginfo('name');
$urlDuSite = get_bloginfo('url');

$contenuAdministrateur = '
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color: #f5f5f5; font-family: \'Lato\', sans-serif; font-size: 15px; line-height: 1.6;">
    <tr>
        <td align="center">
            <table width="600" border="0" cellpadding="20" cellspacing="0" style="margin: 20px 0; background-color: #ffffff;">
                <tr>
                    <td align="center" style="padding: 40px 0;">
                        <h1 style="color: #171719; font-size: 24px; font-weight: bold;"><a href="' . esc_url($urlDuSite) . '" target="_blank" style="color: #171719; text-decoration: none;">' . esc_html($nomDuSite) . '</a></h1>
                        <p>' . esc_html(str_replace("&#039;","'",esc_attr($wp_stored_meta_validation_mail["fr_email_admin_content"][0]))) . '</p>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="background-color: #f6f6f6; padding: 20px;">
                        <p style="color: #C0C0C0; font-size: 12px; text-align: center;">' . sprintf(esc_html__('Copyright © %s ', 'form-reach-domain'), date('Y')) . '<a href="' . esc_url($urlDuSite) . '" target="_blank" style="color: #333; text-decoration: none;">' . esc_html($nomDuSite) . '</a>, ' . esc_html__('All rights reserved.', 'form-reach-domain') . '
                        <br><br>' . esc_html__('You received this email because you are using the Form Reach plugin on WordPress.', 'form-reach-domain') . '</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>';
?>
