<div class="content">

<div class="container">
    <meta id="user-data" hidden>
    <div class="row align-items-stretch justify-content-center no-gutters">
        <div class="col-md-7 col-sm-12">
            <div class="card">
                <div class="card-body">
                <div style="margin:0 auto; text-align: center;">
           <img id="appLogo" width=80  style="object-fit:fill; height: 50px; margin-top: 1rem"/>
       </div>
                    <div class="form h-100 contact-wrap pt-4">
                        <h3 class="text-center">Passwordless Login</h3>
                        <div class="row mt-4">
                            <div class="col-12">
                                <p class="mb-1"><span class="mr-2"><i class="far fa-clock"></i></span><b>Request
                                        Time</b></p>
                                <h6 style="font-size: 14px;" id="reqTime"></h6>
                            </div>
                        </div>
                        <hr class="my-1">
                        <div class="row">
                            <div class="col-12">
                                <p class="mb-1"><span class="mr-2"><i class="fas fa-tv"></i></span><b>Requesting
                                        Device</b></p>
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
                                <button class="btn btn-block btn-outline-primary rounded-0 py-2 px-4" id="declineButton">Decline</button>
                            </div>
                            <div class="col-6 form-group text-center">
                                <button class="btn btn-block btn-primary rounded-0 py-2 px-4" id="approveButton" style="color: #fff;">Approve</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
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
<input id="client-id" value="<?php echo $client?>"></input>
<input id="base-url" value="<?php echo $base?>"></input>
<input id="login-url" value="<?php echo wp_login_url(); ?>">
</div>

<script>
const url = window.location.href;
const token = url.split('?token=/')[1];


const verifyToken = async (token) => {
   
    try {
        const response = await fetch(
            `https://api.passwordless.com.au/v1/verifyToken/${token}`);

        const data = await response.json();

        return data;
    } catch (error) {
 
        throw error;
    }
};

document.addEventListener("DOMContentLoaded", async () => {
    try {


        const data = await verifyToken(token);
        const {
            reqTime,
            device,
            longitude,
            latitude
        } = data;
        document.getElementById("reqTime").innerText = reqTime;
        document.getElementById("device").innerText = device;
        document.getElementById("map").src =
            `https://www.google.com/maps?q=${data.latitude},${data.longitude}&zoom=15&output=embed`;
        document.getElementById("user-data").dataset.username = data.username;
        document.getElementById("user-data").dataset.id = data.id;
        document.getElementById("user-data").dataset.type = data.type;


    } catch (error) {
        alert(error);
    }
})

</script>