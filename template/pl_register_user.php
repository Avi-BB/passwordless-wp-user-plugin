<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">



  <style>
    .reg-content {
      box-shadow: 0px 0px 10px #ccc;
      background-color: #fff;
      border-radius: 5px;
      padding: 2rem;
      padding-top: 0.1rem;

    }

    .content {
      text-align: left;
    }

    .center {
      color: #006dff;
      font-size: 45px;
      font-weight: 600;
      padding: 20px 20px;
      text-align: center;

    }

    .border-bottom {
      border-bottom: 3px solid #006dff;
      width: 50%;
      text-align: left;
      margin-bottom: 10px;
    }

    .reg-control {
      border: 1px solid #006dff;
      width: 100%;
      margin: 10px;
      border-radius: 3px;
      color: grey;
    }

    .reg-control {
      border: 1px solid #006dff !important;
      width: 100%;
      margin: 10px !important;
      border-radius: 3px !important;
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
      cursor: pointer;
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
      font-size: 1rem;
      cursor: pointer;
    }
  </style>


  <title>Register</title>
</head>

<body>


  <div class="reg-content">
    <div>

      <div>
        <div class="center">
          <div style="margin:0 auto; text-align: center;">
            <div>
              <img id="appLogo" width=80 style="object-fit:cover; height: 80px; margin-top: 1rem; border-radius: 50%;" />
            </div>
            <span style="font-size: 1.5rem; text-transform: capitalize;" id="appName"></span>
          </div>
          Register
        </div>
        <hr class="border-bottom">
        <form id="addDevice" name="addDevice">
          <div>
            <div>
              <input type="email" class="reg-control" name="username" id="username" placeholder="Username" required>
            </div>
          </div>
          <div class="form-group">
            <select class="reg-control dropdownOption" aria-label="Default select example" name="authMethod" id="authMethod">
              <option selected>Select Options For Registration</option>
              <option value="1">This Device(Biometric/PIN/Pattern)</option>
              <option value="2">Appless QR(Mobile/Web)</option>
              <option value="3">InApp QR(Mobile)</option>
              <!-- <option value="4">Call Based (IVRS)</option> -->
            </select>
          </div>



          <div style="text-align: center;">
            <input id="submit-btn" value="Register" type="submit">

          </div>

        </form>

        <div id="addTeamMemberDevice" style="text-align:center">
          <button id="submit-btn">Add Device</button>
        </div>

        <div id="viewQR" style="margin-top:0 auto;display:none; width:100%; text-align:center;">
          <div style="margin:0 auto">
            <p>Scan QR from phone</p>
          </div>
          <img width="200px" height="200px" id="qrImg">
        </div>

        <div class="row reg-row justify-content-center mt-1" style="text-align: center; font-size:0.9rem;">
          <p>Already registered? <a href="<?php echo get_site_url() . '/user-login' ?>" class="blue-color"><b>Login Here</b></a></p>
        </div>
        </form>
      </div>


    </div>
    <div style="display:none">
      <input id="redirect-url" value="<?php echo get_site_url() ?>"></input>
    </div>


    <?php
    global $wpdb, $client,  $re,  $path,  $lo;
    $sql = "SELECT * FROM wp_passwordlesstable";
    $results = $wpdb->get_results($sql);
    $base;
    foreach ($results as $result) {

      $base = $result->base_url;
      $client = $result->client_id;
      $re = $result->re;
      $path = $result->path;
      $lo = $result->lo;
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