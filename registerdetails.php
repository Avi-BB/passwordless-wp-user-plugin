<!doctype html>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
    <script src="https://cdn.jsdelivr.net/npm/passwordless-bb@1.0.2/index.js"></script>

	<script type="text/javascript" src="../def.js"></script>
    
     <!-- Bootstrap CSS -->
<script>
const pa = localStorage.getItem('PA');
var link = document.createElement('link');

var head = document.getElementsByTagName('HEAD')[0]; 
        // set the attributes for link element 
        link.rel = 'stylesheet'; 
      
        link.type = 'text/css';
      
        link.href = pa+'/passwordlessPlugin/shortcode/css/bootstrap.min.css'; 
  
        // Append link element to HTML head
        head.appendChild(link);
</script>
    
    <!-- Style -->
 <script>
var link = document.createElement('link');

var head = document.getElementsByTagName('HEAD')[0]; 
        // set the attributes for link element 
        link.rel = 'stylesheet'; 
      
        link.type = 'text/css';
      
        link.href = pa+'/passwordlessPlugin/shortcode/css/style.css'; 
  
        // Append link element to HTML head
        head.appendChild(link);
</script>
  
    
    <title>Verify Registration Details</title>
    <style>
        .map-responsive{
    overflow:hidden;
    padding-bottom:50%;
    position:relative;
    height:0;
}
.map-responsive iframe{
    left:0;
    top:0;
    height:100%;
    width:100%;
    position:absolute;
}
    </style>
  </head>
  <body>
  
    

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>


  <div class="content">
    
    <div class="container">
      <div class="row align-items-stretch justify-content-center no-gutters">
        <div class="col-md-7 col-sm-12">
            <div class="card">
                <div class="card-body">
            <div class="row d-flex justify-content-center">
                <img src="https://www.blue-bricks.com/wp-content/uploads/2021/06/logo_transparent-1.png" style="width: 18rem;">
            </div>
          <div class="form h-100 contact-wrap pt-4">
            <h3 class="text-center">Passwordless Register</h3>
              <div class="row mt-4">
                  <div class="col-12">
                  <p class="mb-1"><span class="mr-2"><i class="far fa-clock"></i></span><b>Request Time</b></p>
                  <h6 style="font-size: 14px;" id="reqTime"> <h6>
                </div>
              </div>
              <hr class="my-1">
              <div class="row">
                <div class="col-12">
                <p class="mb-1"><span class="mr-2"><i class="fas fa-tv"></i></span><b>Requesting Device</b></p>
                <h6 style="font-size: 14px;" id="device"></h6>
              </div>
            </div>
            <hr class="my-1">
            <div class="row">
              <div class="col-12">
              <p class="mb-1"><span class="mr-2"><i class="fas fa-map-marker-alt"></i></span><b>Location</b></p>
              <div class="map-responsive">
                <iframe id="map" src="" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            </div>
          </div>
          <hr class="my-1">
              <div class="row justify-content-center mt-4">
                <div class="col-6 form-group text-center">
                    <a class="btn btn-block btn-outline-primary rounded-0 py-2 px-4" onclick="declineProcess('Resistration')">Decline</a>
                </div>
                <div class="col-6 form-group text-center">
                    <a class="btn btn-block btn-primary rounded-0 py-2 px-4" onclick="ar()" style="color: #fff;">Approve</a>
                </div>
              </div>
            </form>
        </div>
        </div>
        </div>
      </div>
    </div>

  </div>
    
    <script>
const wait1 = async () => {
  const data1 = await data;
    const latitude = data1.latitude
    const longitude = data1.longitude
};
wait1();

function ar(){

const baseUrl = localStorage.getItem('BASEURL');
const clientId = localStorage.getItem('CLIENTID'); 
const re = localStorage.getItem('RE'); 
const pa = localStorage.getItem('PA'); 

 const fido = new fido2auth(
  // "https://home.passwordless.com.au",
  // "vn1fRiexWN0lSFLQSFn2eDP2p_hMpuCtJ_Cx-DYhEJ27xtp4rC"
  baseUrl,
  clientId
);
	const wait1 = async () => {
	const data1 = await data;
	const username = data1.username
    const id = data1.id
	console.log(username , id)

	const Register = (username, id) => {
  //socket.emit("join", { id});
  fido
    .registerWithFido(username)
    .then(async (response) => {
      //socket.emit("registration-response", response);
      console.log("1--",response);
      if (response.verified) {
		console.log("2--",response);
        //await AddToAudit(response.userId, 1, "success");
        window.location.href = re;
      } 
    })
    .catch(async (error) => {
      //socket.emit("registration-response", error);

      alert(error);
    });
};

Register(username , id);


};
wait1();
}
      </script>

    
  <script>



const wait = async () => {
  const data1 = await data;
  

//const data1 = wait();

console.log(data1 )
	document.getElementById("reqTime").innerHTML = data1.reqTime;
	document.getElementById("device").innerHTML = data1.device;
    const lat = data1.latitude
    const long = data1.longitude
    document.getElementById("map").src = `https://www.google.com/maps/embed/v1/place?key=AIzaSyCQpzHi4jygLfaeksgPB3HSlKduF8YD5Hw&q=${lat},${long}&zoom=15`
};
wait();
     </script>
   

  </body>
</html>