<?php

wp_enqueue_style('tachyons', get_template_directory_uri() . '/tachyons.min.css');
wp_enqueue_style('style', get_stylesheet_uri());

if (!current_user_can('manage_options')) {
    add_filter('show_admin_bar', '__return_false');
}

add_filter('sdm_category_download_items_shortcode_output', 'custom_download_category_output', 10, 3);

function custom_download_category_output($output, $args, $files)
{
    $base = get_bloginfo('url') . '/?smd_process_download=1&download_id=';
    $output = '';

    $output .= <<<HTML
        <div class="overflow-auto">
            <table class="f6 w-100" cellspacing="0">
                <tbody>
    HTML;

    foreach($files as $file) {
        $output .= <<<HTML
            <tr class="striped--near-white">
                <td class="pa2 pl0">
                    <a href="{$base}{$file->ID}" class="link blue db dim">{$file->post_title}</a>
                </td>
            </tr>
        HTML;
    }

    $output .= <<<HTML
                </tbody>
            </table>
        </div>
    HTML;
    return $output;
}

add_action('wp_login_failed', 'custom_login_failed');
function custom_login_failed($username)
{
    $referrer = wp_get_referer();

    if ($referrer && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
        wp_redirect(add_query_arg(['login' => 'failed'], $referrer) . '#login');
        exit();
    }
}

add_filter('authenticate', 'custom_authenticate_username_password', 30, 3);
function custom_authenticate_username_password($user, $username, $password)
{
    if (is_a($user, 'WP_User')) {
        return $user;
    }

    if (empty($username) || empty($password)) {
        $error = new WP_Error();
        $user  = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: Invalid username or incorrect password.'));

        return $error;
    }
}
