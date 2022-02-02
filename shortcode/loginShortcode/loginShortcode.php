<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">
    <script src=https://cdn.jsdelivr.net/npm/passwordless-bb@2.0.5/index.min.js></script>

    <title>Login</title>
    <style>
  .reg-content
  {
    background-color: white;
    border-radius: 20px;
    padding: 40px;
    
  }
  .content{
    text-align: left;
  }
.center{
  color: #006dff;
  font-size: 45px;
  font-weight: 600;
  padding: 30px 20px;
  text-align: center;
}
.border-bottom
{
  border-bottom: 3px solid #006dff ;
  width: 50%;
text-align: left;
margin-bottom: 10px;
}

.reg-control
{
  border: 1px solid #006dff!important;
    width: 100%;
    margin: 10px!important;
    border-radius: 5px!important;
    color: grey;
}
.reg-button
{
  color: white !important;
  background-color: #006dff;
  border-radius: 3px;
  padding: 0.3rem 0.5rem;
  margin:1rem auto;
  text-align: center;
  width: 50%;
}
.reg-row
{
  margin-top: 40px;
}
.scanLogo
{
  height: 50px;
  margin: 0px 10px;
}
</style>
  </head>
  <body>
  <div class="reg-content">
            <div>
              <p>
                <?php $first_name
                ?>
                </p>
                <div >
          <div >
            <h3 class="center">Login</h3>
            <hr class="border-bottom">
            <form  method="post" id="contactForm" name="contactForm">
              <div>
                <div >
                  <input type="text" class="reg-control" name="username" id="username" placeholder="Username">
                </div>
              </div>
              <div class="form-group">
                <select class="reg-control" id="authMethod" name="authMethod" >
                  <option selected>Select Options For Login</option>
                  <option value="1">Same Platform</option>
                  <option value="2">Appless QR</option>
                  <option value="3">InApp QR</option>
                  <!-- <option value="4">Push</option> -->
                </select>
              </div>
              </form>
              
              <div>
                <div class="reg-button">
                    <a   onclick="loginFun()" style="color: #fff;">Login</a>
                </div>
              </div>
             
              <div id="viewQR" style="margin-top:0 auto;display:none; width:100%; text-align:center;">
          <div style="margin:0 auto">
            <p>Scan QR from phone</p>
          </div>
          <img src="" alt="" width="200px" height="200px" id="qrImg">
        </div>
              <div >
                  <p>Not registered yet? <a href="/shortcode/registerShortcode/registerShortcode.php" class="blue-color"><b>Register Here</b></a></p>
              </div>
            </form>
        </div>
        </div>
  </div>
 
    
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.3/socket.io.js" integrity="sha512-PU5S6BA03fRv1Q5fpwXjg5nlRrgdoguZ74urFInkbABMCENyx5oP3hrDzYMMPh3qdLdknIvrGj3yqZ4JuU7Nag==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <?php 
 global $wpdb;
$sql = "SELECT * FROM wp_passwordlesstable";
$results = $wpdb->get_results($sql);
$base ;
    foreach( $results as $result ) {

         $base = $result->base_url;
		 $client = $result->client_id;
		 $re = $result->re;
		 $lo = $result->lo;
		 $path = $result->path;

    }
 ?>
  <script>
  const baseUrl =  "<?php  echo $base; ?>";
  const clientId =  "<?php  echo $client; ?>";
  const re =  "<?php  echo $re; ?>";
  const lo =  "<?php  echo $lo; ?>";
  const pa =  "<?php  echo $path; ?>";
  console.log({baseUrl,clientId,re,pa, lo});

  Passwordless.init(
    baseUrl,
    clientId
);
async function loginFun(){
  
  const username = this.username.value;
  const qrImg = document.getElementById("qrImg");
  console.log({username, baseUrl, clientId, re, pa, lo});
  qrImg.src = "#";
      let authMethod = document.getElementById("authMethod").value;
      if (authMethod == "1") {
        try {
          // console.log("Passwordless same Platform method called");
          const response = await Passwordless.login({ username });
  
          if (response.verified) {
            window.location.href = lo;    
          }
        } catch (error) {
          alert(error.message);
        }
      } else if (authMethod == "2") {
        generateQR(username, 2, "web");
      } else if (authMethod == "3") {
        generateQR(username, 2, "app");
      } else if (authMethod == "4") {
        generateQR(username, 2, "app", "push");
      }
}
function generateQR(username, type, platform = "web", id){
  return alert("success")
}
// function generateQR(username, type, platform = "web", id){
//   console.log(username, type, platform, id)
//   const qrImg = document.getElementById("qrImg");
//   qrImg.src = "#";
//   function success(position){
//     const latitude = position.coords.latitude;
//     const longitude = position.coords.longitude;
// 	console.log(position);
	
// 	let userAgent = navigator.userAgent;
//     let browserName;
         
//          if(userAgent.match(/chrome|chromium|crios/i)){
//              browserName = "chrome";
//            }else if(userAgent.match(/firefox|fxios/i)){
//              browserName = "firefox";
//            }  else if(userAgent.match(/safari/i)){
//              browserName = "safari";
//            }else if(userAgent.match(/opr\//i)){
//              browserName = "opera";
//            } else if(userAgent.match(/edg/i)){
//              browserName = "edge";
//            }else{
//              browserName="No browser detection";
//            }
		   
		   
// 		   var OSName="Unknown OS";
// if (navigator.appVersion.indexOf("Win")!=-1) OSName="Windows";
// if (navigator.appVersion.indexOf("Mac")!=-1) OSName="MacOS";
// if (navigator.appVersion.indexOf("X11")!=-1) OSName="UNIX";
// if (navigator.appVersion.indexOf("Linux")!=-1) OSName="Linux";
// 		   console.log(OSName,browserName);
	
//     const reqTime = new Date().toLocaleDateString("en-US", {
//       year: "numeric",
//       month: "long",
//       day: "numeric",
//       hour: "numeric",
//       minute: "numeric",
//       second: "numeric",
//     });
//     let path;

//     if (type == 1) path = `${location.origin}`+pa+`/PasswordlessPlugin/registerdetails.php`;
//     else if (type == 2) path = `${location.origin}`+pa+`/PasswordlessPlugin/logindetails.php`;
//     else path = `https://home.passwordless.com.au/addDevice`;

//     const userDetails = {
//       latitude,
//       longitude,
//       device: OSName,browserName,
//       username,
//       type,
//       platform,
//       id,
//       reqTime,
//       path,
//     };
//     console.log(userDetails);

//     fido
//       .generateQR(userDetails)
//       .then((response) => {
//         qrImg.src = response.url;

//         console.log({accessToken:response.accessToken});
//       })
//       .catch((error) => alert(error));
	  
// 	  }
//    function error() {
//     alert("Unable to retrieve your location");
//   }

//   if (!navigator.geolocation) {
//     alert("Geolocation is not supported by your browser");
//   } else {
//     navigator.geolocation.getCurrentPosition(success, error, {
//       enableHighAccuracy: true,
//     });
//   }
// }

    </script>

  </body>
</html>
