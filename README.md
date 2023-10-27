# Castlegate IT WP Disable Mail

Castlegate IT WP Disable Mail replaces `wp_mail()` with a function that returns true without sending mail to prevent a WordPress website from sending mail. Any other plugins that replace the `wp_mail()` function should be disabled while this plugin is active.

If the constant `CGIT_WP_DISABLE_MAIL_LOG` has been defined, the plugin will log all attempts to send mail to this file.

``` php
define('CGIT_WP_DISABLE_MAIL_LOG', '/path/to/mail.log');
```

## License

Released under the [MIT License](https://opensource.org/licenses/MIT). See [LICENSE](LICENSE) for details.
