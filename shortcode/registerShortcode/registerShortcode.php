<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">

  <script src=https://cdn.jsdelivr.net/npm/passwordless-bb@2.0.5/index.min.js></script>


  <style>
    .reg-content {
      box-shadow: 0px 0px 10px #ccc;
      background-color: #fff;
      border-radius: 5px;
      padding: 2rem;

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
  </style>


  <title>Register</title>
</head>

<body>


  <div class="reg-content">
    <div>
      <div>
        <h3 class="center">Register </h3>
        <hr class="border-bottom">
        <form c method="post" id="contactForm" name="contactForm">
          <div>
            <div>
              <input type="text" class="reg-control" name="username" id="username" placeholder="Username" required>
            </div>
          </div>
          <div class="form-group">
            <select class="reg-control dropdownOption" aria-label="Default select example" name="authMethod" id="authMethod">
              <option selected>Select Options For Registration</option>
              <option value="1">Same Platform</option>
              <option value="2">Appless QR</option>
              <option value="3">InApp QR</option>
              <!-- <option value="4">Call Based (IVRS)</option> -->
            </select>
          </div>
        </form>

        <div>
          <div class="reg-button" onclick="registerFun()">
            <a style="color:white;">Register</a>

          </div>
        </div>


        <div>
          <div class="reg-button">
            <a style="color:white;" onclick="addDevice()">Add Another Device</a>
          </div>
        </div>
        <div id="viewQR" style="margin-top:0 auto;display:none; width:100%; text-align:center;">
          <div style="margin:0 auto">
            <p>Scan QR from phone</p>
          </div>
          <img src="" alt="" width="200px" height="200px" id="qrImg">
        </div>

        <div class="row reg-row justify-content-center mt-3">
          <p>Already registered? <a href="/login" class="blue-color"><b>Login Here</b></a></p>
        </div>
        </form>
      </div>


    </div>
    <div style="display:none">
<input id="redirect-url" value="<?php echo get_site_url()?>"></input>
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
      $path = $result->path;
    }
    ?>



    <script>
      //console.log("<%= sessionId %>")
      const baseUrl = "<?php echo $base; ?>";
      const clientId = "<?php echo $client; ?>";
      const re = "<?php echo $re; ?>";
      const pa = "<?php echo $path; ?>";
      console.log({
        baseUrl,
        clientId,
        re,
        pa
      });



      Passwordless.init(
        baseUrl,
        clientId
      );

      // new changes
      async function registerFun() {
        const qrImg = document.getElementById("qrImg");
        qrImg.src = "#";
        const username = this.username.value;
        const authMethod = this.authMethod.value;
        console.log({
          username,
          authMethod
        });
        if (authMethod == "1") {
          try {
            // console.log("Passwordless same Platform method called");
            const response = await Passwordless.register({
              username
            });

            if (response.verified) {

              window.location.href = re;
              alert("Success Register")
            } else {
              alert(response.errorMessage);
            }

            // console.log(response.data);
          } catch (error) {
            alert(error.message);
          }
        }

        if (authMethod == "2") {
          generateQR(username, 1, "web");
        } else if (authMethod == "3") {
          generateQR(username, 1, "app");
        }
      }


      // function registerFun1() {
      //   const qrImg = document.getElementById("qrImg");
      //   qrImg.src = "#";

      //   const username = this.username.value;
      //   const auth = this.authMethod.value;
      //   console.log({username});
      //   console.log({auth});
      //   if (this.authMethod.value == 1) {
      //     fido
      //       .register({username})
      //       .then(async (response) => {
      //         if (response.verified) {

      //           window.location.href = re;
      //         } 
      //       })
      //       .catch(async (error) => {
      // 		console.log({response});
      //         alert(error);
      //       });
      //   } else if (this.authMethod.value == 2) {
      // 	generateQR(username, 1, "web");
      //   } else if (this.authMethod.value == 3) {
      // 	generateQR(username, 1, "app");
      //     $("#RegisterModal").modal("show");
      //   } else alert("Please select Username and proper option");
      // }



      function generateQR(username, type, platform = "web") {
        console.log(username, type, platform,)
        const qrImg = document.getElementById("qrImg");
        qrImg.src = "#";
        async function success(position) {
          const latitude = position.coords.latitude;
          const longitude = position.coords.longitude;
          console.log(position);
          //const ua = detect.parse(navigator.userAgent);

          let userAgent = navigator.userAgent;
          let browserName;

          if (userAgent.match(/chrome|chromium|crios/i)) {
            browserName = "chrome";
          } else if (userAgent.match(/firefox|fxios/i)) {
            browserName = "firefox";
          } else if (userAgent.match(/safari/i)) {
            browserName = "safari";
          } else if (userAgent.match(/opr\//i)) {
            browserName = "opera";
          } else if (userAgent.match(/edg/i)) {
            browserName = "edge";
          } else {
            browserName = "No browser detection";
          }


          const ua = detect.parse(navigator.userAgent);

          const reqTime = new Date().toLocaleDateString("en-US", {
            year: "numeric",
            month: "long",
            day: "numeric",
            hour: "numeric",
            minute: "numeric",
            second: "numeric",
          });
     


        

          const userDetails = {
            latitude,
            longitude,
            device: `${ua.os.name},${ua.browser.name}`,
            browserName,
            username,
            type,
            platform,
            reqTime,
            path:  `${
        document.getElementById("redirect-url").value
      }/authenticate?token=`,
      email: username,
          };
          console.log(userDetails);
          try {
            remoteResponse = await Passwordless.generateQR(userDetails);
            qrImg.src = remoteResponse.url;
            if (type == 1) {
              document.getElementById("viewQR").style.display = "block";
            } else {
              document.querySelector(".modal").classList.add("show");
              document.querySelector(".modal").style.display = "block";
            }
            console.log({
              url: remoteResponse.url
            });

            const { transactionId } = remoteResponse;
      console.log({ remoteResponse });
      const transactionResponse =
        await Passwordless.getTransactionStatusOnChange(transactionId);

      if (transactionResponse.status == "SUCCESS") {
        if (type == 1) {
          document.getElementById("viewQR").style.display = "none";
          document.getElementById("qrImg").src = "#";
          alert("Registration Succssful");
          window.location.href = re;
        } else {
          let nonce = document.getElementById("nonce").value;
          let token = transactionResponse.accessToken;
          console.log({token});
          const payload = { token, nonce };
          
        }
      } else if (transactionResponse.status == "FAILED") {
        transactionResponse.message
          ? alert(transactionResponse.message)
          : alert("Authentication Failed");
      } else {
        alert("Something went wrong");
      }
          } catch (error) {
            alert(error.message);
          }

        }

        function error() {
          alert("Unable to retrieve your location");
        }

        if (!navigator.geolocation) {
          alert("Geolocation is not supported by your browser");
        } else {
          navigator.geolocation.getCurrentPosition(success, error, {
            enableHighAccuracy: true,
          });
        }

      }



      // Get the modal
      var modal = document.getElementById('id01')

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    </script>

</body>

</html>