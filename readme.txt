=== Passwordless User Auth ===
Contributors: ![Passwordless Team](htts://www.passwordless.com.au)
Tags:  oauth, sso, authentication, encryption, ssl, secure, security, strong, harden, signup, sign in, login, log in, sign out, lock, unlock, alert,  wp-login, 2 step authentication, two-factor , two step, two factor, 2-Factor, 2fa, two, tfa, mfa, qr, multi-factor, multifactor
Requires at least: 4.7.0
Tested up to: 5.9
Stable tag: 1.0.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

 Go passwordless authentication and eliminate security risks.

== Description ==

Passworldess’s passwordless authentication Plugin enables your WordPress user to login into wordpress site without having to enter a password.

== Benefits: ==
Privacy:
  – Biometric information never leaves your device (based on FIDO/FIDO2 principles), not stored in the cloud.
  - No tracking of customers.
Convenience: 
  - Eliminate the need for your users to enter a password when they log in to your website from their primary device.
  - Reduce your user abandonment rates by making transactions as seamless as possible.
Compliance: 
  - FIDO/FIDO2 is aligned with the GDPR and PSD2 principals around the use of strong authentication.
Security:
  - Boost your website’s security through the use of multifactor authentication with strong public/private key credentials.

For more information on how the passwordless authentication plugin works, please view our [documentation](https://docs.passwordless.com.au/).

== Tell us how we’re doing. ==
Have the plugin in production? Tell us about your site on [help@passwordless.com.au](help@passwordless.com.au) and we’ll post on our social channels!

== Installation ==

1. Upload to the `/wp-content/plugins/` directory.
2. Activate the plugin.
3. Visit Settings > Passworldess to configure this plugin.

== Frequently Asked Questions ==

== How do I set up the plugin? ==

An answer to that question.

Once you install the plugin, click on ‘Configure’. Here, you have two setup options:

*Let Passworldess do the work for you (estimated time: 15s to 30s)*

1. Login to your WordPress developer dashboard
2. Install the passworldess authentication plugin
3. First need to create account on https://www.passwordless.com.au/
4. Go to dashboard, click on add application and create on Web/WordPress app and get the details such as clientId and baseUrl
5. Come back to wordpress developer setting you'll see the passworldess menu
6. fill the details that is base url, client Id, after login url path and after register url path.
7. save the settings
8. Three pages are generated user register, user login and user remote auth.
9. If pages unable to create due to other plugin conflict, you can create manually using short codes that is 'user-register', 'user-login' and 'user-remote-auth'.
10. Done 
11. add button to your login page and register page.

== Screenshots ==



== For whome this plugin for? ==
This plugin only for the wordpress site,  this plugin authenticate the wordpress site users to authenticate them.

== I need to customize the plugin or I need support and help? ==
Please email us at [help@passwordless.com.au](help@passwordless.com.au)

== Where can I report bugs or leave feedback? ==
Please email us at [help@passwordless.com.au](help@passwordless.com.au) 

== I have other queries or need additional support. ==
For any other queries or if you need additional support, please email us at [help@passwordless.com.au](help@passwordless.com.au) 
= Error: ClientId and BaseUrl is not added =
This error means that the plugin is unable to verify the validity of the login or register claim. This can often be resulted from a bad baseURL and api key combination. Please double check your Base URL and clinetId API Key parameters in the plugin settings against your credentials on the Passwordless's dashboard.



= 1.0.0 =
Initial Version. 

Features: 
- Same Platform login (Biometric, face, pin)
-Appless QR login(for remote login)
- In applogin (through passwordless's custom android and ios app)
- multi device support

== Upgrade Notice ==
Not applicable at the moment