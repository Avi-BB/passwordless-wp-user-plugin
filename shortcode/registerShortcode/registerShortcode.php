

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">

    <script src=https://cdn.jsdelivr.net/npm/passwordless-bb@2.0.7/index.min.js></script>


<style> 

  .reg-content
  {
    box-shadow: 0px 0px  10px #ccc;
    background-color: #fff;
    border-radius: 5px;
    padding: 2rem;
    
  }
  .content{
    text-align: left;
  }
.center{
  color: #006dff;
  font-size: 45px;
  font-weight: 600;
  padding: 20px 20px;
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
  border: 1px solid #006dff;
    width: 100%;
    margin: 10px;
    border-radius: 3px;
    color: grey;
}
.reg-control
{
  border: 1px solid #006dff!important;
    width: 100%;
    margin: 10px!important;
    border-radius: 3px!important;
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
  cursor: pointer;
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
   
   
    <title>Register</title>
  </head>
  <body>
  

  <div class="reg-content">
       <div> 
          <div > 
            <h3 class="center">Register </h3>
            <hr class="border-bottom">
            <form c method="post" id="contactForm" name="contactForm">
              <div >
                <div >
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
              
              <div >
                <div class="reg-button" onclick="registerFun()">
                    <a style="color:white;" >Register</a>
                    
                </div>
              </div>


              <div >
                <div class="reg-button" >
                    <a style="color:white;" onclick="addDevice()" >Add Another Device</a>
                </div>
              </div>
              

              <div class="row reg-row justify-content-center mt-3">
                  <p>Already registered? <a href="/login" class="blue-color"><b>Login Here</b></a></p>
              </div>
            </form>
        </div>


  </div>
  <div class="modal" id="RegisterModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
          <!-- <button type="button" class="close p-3 text-right" data-dismiss="modal">&times;</button> -->
  
        <!-- Modal body -->
        <div class="modal-body">
          <div class="row d-flex justify-content-center">
            <!-- <img src="https://www.blue-bricks.com/wp-content/uploads/2021/06/logo_transparent-1.png" style="width: 18rem;"> -->
        </div>
        <h3 class="text-center mt-4">Verify It's You</h3>
        <p class="text-center">Scan the code below using your phones camera</p>
        <div class="row d-flex justify-content-center">
         <img src="" id="qrImg" style="width: 18rem;">
      </div>
        </div>
  
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
		 $path = $result->path;

    }
 ?>
  
  

 <script>     
//console.log("<%= sessionId %>")
  const baseUrl =  "<?php  echo $base; ?>";
  const clientId =  "<?php  echo $client; ?>";
  const re =  "<?php  echo $re; ?>";
  const pa =  "<?php  echo $path; ?>";
  console.log({baseUrl,clientId,re,pa});



const fido = new passwordless(
  baseUrl,
  clientId
);

console.log(fido);

function registerFun() {
  const qrImg = document.getElementById("qrImg");
  qrImg.src = "#";

  const username = this.username.value;
  const auth = this.authMethod.value;
  console.log({username});
  console.log({auth});
  if (this.authMethod.value == 1) {
    fido
      .register({username})
      .then(async (response) => {
        if (response.verified) {

          window.location.href = re;
        } 
      })
      .catch(async (error) => {
		console.log({response});
        alert(error);
      });
  } else if (this.authMethod.value == 2) {
	generateQR(username, 1, "web");
  } else if (this.authMethod.value == 3) {
	generateQR(username, 1, "app");
    $("#RegisterModal").modal("show");
  } else alert("Please select Username and proper option");
}



function generateQR(username, type, platform = "web", id){
  console.log(username, type, platform, id)
  const qrImg = document.getElementById("qrImg");
  qrImg.src = "#";
  function success(position){
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;
	console.log(position);
    //const ua = detect.parse(navigator.userAgent);
	
	let userAgent = navigator.userAgent;
    let browserName;
         
         if(userAgent.match(/chrome|chromium|crios/i)){
             browserName = "chrome";
           }else if(userAgent.match(/firefox|fxios/i)){
             browserName = "firefox";
           }  else if(userAgent.match(/safari/i)){
             browserName = "safari";
           }else if(userAgent.match(/opr\//i)){
             browserName = "opera";
           } else if(userAgent.match(/edg/i)){
             browserName = "edge";
           }else{
             browserName="No browser detection";
           }
		   
		   
		   var OSName="Unknown OS";
			if (navigator.appVersion.indexOf("Win")!=-1) OSName="Windows";
			if (navigator.appVersion.indexOf("Mac")!=-1) OSName="MacOS";
			if (navigator.appVersion.indexOf("X11")!=-1) OSName="UNIX";
			if (navigator.appVersion.indexOf("Linux")!=-1) OSName="Linux";
		   console.log(OSName,browserName);
	
    const reqTime = new Date().toLocaleDateString("en-US", {
      year: "numeric",
      month: "long",
      day: "numeric",
      hour: "numeric",
      minute: "numeric",
      second: "numeric",
    });
    let path;
	
	
    if (type == 1) path = `${location.origin}`+pa+`/PasswordlessPlugin/registerdetails.php`;
    else if (type == 2) path = `${location.origin}/passwordless/wp-content/plugins/PasswordlessPlugin/logindetails.php`;
    else path = `${location.origin}/addDevice`;
    
	const userDetails = {
      latitude,
      longitude,
      device: OSName,browserName,
      username,
      type,
      platform,
      id,
      reqTime,
      path,
    };
    console.log(userDetails);

    fido
      .generateQR(userDetails)
      .then((response) => {
        //console.log(response);
        qrImg.src = response.url;
		
        console.log({accessToken:response.accessToken});

        //if (type === 2) $("#loginModal").modal("show");
        //else $("#RegisterModal").modal("show");
		
		
		
		
		
      })
      .catch((error) => alert(error));
	  
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

const addDevice = async (sessionId) => {
  //console.log("regn session id",sessionId);
  const qrImg = document.getElementById("qrImg");
  qrImg.src = "#";

  const username = this.username.value;
  //console.log(username);
  if (this.authMethod.value == 1) {
    fido
      .addDevice(username)
      .then(async (response) => {
        if (response.verified) {
          await AddToAudit(response.userId, 3, "success");

          alert("new device added successfully");
        } else await AddToAudit(response.userId, 3, "error");
      })
      .catch(async (error) => {
        alert(error);
      });
  } else if (this.authMethod.value == 2) {
    generateQR(username, 3, "web", sessionId);
  
  } else if (this.authMethod.value == 3) {
    generateQR(username, 3, "app", sessionId);
    $("#RegisterModal").modal("show");
   
  } else alert("not done yet");
};


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