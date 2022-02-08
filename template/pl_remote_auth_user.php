<style>
    .flex-row-cnd {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        margin-top: 2rem;
    }

    .content {
        background-color: #fff;
        width: fit-content;
        padding: 1rem;
    }
</style>

<div class="content">

    <div class="container">
        <meta id="user-data" hidden>
        <div class="row align-items-stretch justify-content-center no-gutters">
            <div class="col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div style="margin:0 auto; text-align: center;">
                            <div>
                                <img id="appLogo" width=60 style="object-fit:cover; height: 60px; margin-top: 1rem; border-radius: 50%;" />
                            </div>
                            <span style="font-size: 1.3rem; text-transform: capitalize;" id="appName"></span>
                        </div>
                        <div class="form h-100 contact-wrap pt-4">
                            <h3 style="margin:0 auto; text-align:center;  color: #006dff; ">Authenticate</h3>
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
                            <div class="flex-row-cnd">
                                <div class="col-6 form-group text-center">
                                    <button style="background-color:#595cff; color:#fff;" id="approveButton" style="color: #fff;">Approve</button>
                                </div>
                                <div class="col-6 form-group text-center">
                                    <button style="background-color:grey; color:white;" id="declineButton">Decline</button>
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

global $wpdb, $base, $client, $re, $path, $lo;
$sql = "SELECT * FROM wp_passwordlesstable";
$results = $wpdb->get_results($sql);
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