<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">

  <title>Login</title>
  <style>
    .reg-content {
      background-color: white;
      border-radius: 0.2rem;
      padding: 2rem;

    }

    .content {
      text-align: left;
    }

    .center {
      color: #006dff;
      font-size: 45px;
      font-weight: 600;
      padding: 30px 20px;
      text-align: center;
    }

    .border-bottom {
      border-bottom: 3px solid #006dff;
      width: 50%;
      text-align: left;
      margin-bottom: 10px;
    }

    .reg-control {
      border: 1px solid #006dff !important;
      width: 100%;
      margin: 10px !important;
      border-radius: 2px !important;
      color: grey;
    }

    .reg-button {
      color: white !important;
      background-color: #006dff;
      border-radius: 3px;
      padding: 0.3rem 0.5rem;
      margin: 1rem auto;
      text-align: center;
      width: 50%;
    }

    .reg-row {
      margin-top: 40px;
    }

    .scanLogo {
      height: 50px;
      margin: 0px 10px;
    }

    #submit-btn {
      background-color: #00a0d2;
      color: white;
      border: none;
      border-radius: 0.2rem;
      padding: 0.3rem 0.7rem;
      font-size: 1.2rem;
      cursor: pointer;
    }

    .app-cnd {
    
      margin: 0 auto;
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="reg-content">
    <div>
      <div>

        <div>
          <div class="app-cnd">
            <div>
            <img id="appLogo" width=60 style="object-fit:cover; height: 60px; margin-top: 1rem; border-radius: 50%;" />

            </div>
            <span style="font-size: 1.5rem; text-transform: capitalize;  color: #006dff; font-family: 'Roboto', sans-serif;" id="appName"></span>
          </div>

          <h3 class="center">
            Login</h3>
          <hr class="border-bottom">
          <form id="contactForm" name="contactForm">
            <div>
              <div>
                <input type="text" class="reg-control" name="username" id="username" placeholder="Username">
              </div>
            </div>
            <div class="form-group">
              <select class="reg-control" name="type" id="authMethod" name="authMethod">
                <option selected>Select Options For Login</option>
                <option value="1">This Device(Biometric/PIN/Pattern)</option>
                <option value="2">Appless QR(Mobile/Web)</option>
                <option value="3">InApp QR(Mobile)</option>
                <!-- <option value="4">Push</option> -->
              </select>
            </div>

          </form>

          <div id="user-login-action" style="text-align: center;">
            <button id="submit-btn">Login</button>
          </div>


          <div id="viewQR" style="margin-top:0 auto;display:none; width:100%; text-align:center;">
            <div style="margin:0 auto">
              <p>Scan QR from phone</p>
            </div>
            <img width="200px" height="200px" id="qrImg">
          </div>
          <div style="text-align: center; margin-top:1rem; font-size:0.9rem;">
            <p>Not registered yet? <a href="<?php echo get_site_url() . '/user-register' ?>" class="blue-color"><b>Register Here</b></a></p>
          </div>

        </div>
      </div>
    </div>


    <?php
    global $wpdb;
    $sql = "SELECT * FROM wp_passwordlesstable";
    $results = $wpdb->get_results($sql);
    $base;
    foreach ($results as $result) {

      $base = $result->base_url;
      $client = $result->client_id;
      $re = $result->re;
      $lo = $result->lo;
      $path = $result->path;
    }
    ?>
    <div style="display:none">
      <input id="client-id" value="<?php echo esc_attr($client) ?>"></input>
      <input id="base-url" value="<?php echo esc_attr($base) ?>"></input>
      <input id="register-redirect" value="<?php echo esc_attr($re) ?>"></input>
      <input id="login-redirect" value="<?php echo esc_attr($lo) ?>"></input>
      <input id="login-url" value="<?php echo wp_login_url(); ?>">
      <input id="redirect-url" value="<?php echo get_site_url() ?>"></input>
    </div>

</body>

</html>