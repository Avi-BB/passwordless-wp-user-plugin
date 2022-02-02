Passwordless.init(
    document.getElementById("base-url")?.value,
    document.getElementById("client-id")?.value
  );
  
  
  const getAppDetails = async () => {
    const logoImage = document.getElementById("appLogo");
    try {
      const response = await Passwordless.getApplicationNameAndLogo();
      console.log(response);
      if (response.logo) {
        logoImage.src = response?.logo;
      }
    } catch (error) {
      console.log(error);
    }
  };
  getAppDetails();
  
  document
    .getElementById("contactForm")
    ?.addEventListener("submit", async function (e) {
      e.preventDefault();
  
      let username = document.getElementById("username").value;
      let password = document.getElementById("password").value;
  
      let type = document.querySelector('input[name="type"]:checked').value;
      let nonce = document.getElementById("nonce").value;
  
      if (type == "1") {
        let data = { nonce, username, type, password };
  
        createHiddenForm(data, document.getElementById("login-url").value);
      } else {
        let authMethod = document.getElementById("authMethod").value;
        if (authMethod == "1") {
          try {
            // console.log("Passwordless same Platform method called");
            const response = await Passwordless.login({ username });
            const token = response.accessToken;
            console.log({token});
            if (response.verified) {
              const payload = { token, nonce, type };
  
              // console.log(payload);
  
              createHiddenForm(
                payload,
                document.getElementById("login-url").value
              );
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
    });
  
  const createHiddenForm = (payload, url) => {
    const method = "POST";
    const hiddenForm = document.createElement("form");
    hiddenForm.setAttribute("action", url);
    hiddenForm.setAttribute("method", method);
    hiddenForm.style = "display: none;";
    for (const [key] of Object.entries(payload)) {
      const element = document.createElement("input");
      element.setAttribute("type", "hidden");
      element.setAttribute("name", key);
      element.setAttribute("value", payload[key]);
      hiddenForm.appendChild(element);
    }
  
    //console.log(hiddenForm);
    document.body.appendChild(hiddenForm);
    // hiddenForm.submit();
    document.createElement("form").submit.call(hiddenForm);
  };
  
  const generateQR = async (username, type, platform = "web", method = "qr") => {
    const qrImg = document.getElementById("qrImg");
    qrImg.src = "#";
    const success = async (position) => {
      const latitude = position.coords.latitude;
      const longitude = position.coords.longitude;
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
        username,
        type,
        platform,
        reqTime,
        path: `${
          document.getElementById("redirect-url").value
        }/authenticate?token=`,
        email: username,
       
      };
  
      let remoteResponse;
  
      try {
        if (method == "push") {
          remoteResponse = await Passwordless.sendPushNotification(userDetails);
          const device = remoteResponse?.devices?.join(", ");
          alert("push notification sent successfully to " + device);
        } else {
          remoteResponse = await Passwordless.generateQR(userDetails);
          qrImg.src = remoteResponse.url;
  
          if (type == 1) {
            document.getElementById("viewQR").style.display = "block";
          } else {
            document.querySelector(".modal").classList.add("show");
            document.querySelector(".modal").style.display = "block";
          }
        }
  
        const { transactionId } = remoteResponse;
        console.log({ remoteResponse });
        const transactionResponse =
          await Passwordless.getTransactionStatusOnChange(transactionId);
  
        if (transactionResponse.status == "SUCCESS") {
          if (type == 1) {
            document.getElementById("viewQR").style.display = "none";
            document.getElementById("qrImg").src = "#";
            alert("Registration Succssful");
          } else {
            let nonce = document.getElementById("nonce").value;
            let token = transactionResponse.accessToken;
            console.log({token});
            const payload = { token, nonce };
  
            createHiddenForm(payload, document.getElementById("login-url").value);
          }
        } else if (transactionResponse.status == "FAILED") {
          transactionResponse.message
            ? alert(transactionResponse.message)
            : alert("Authentication Failed");
        } else {
          alert("Something went wrong");
        }
      } catch (error) {
        // console.log(error);
        alert(error.message);
      }
    };
  
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
  };
  
  document.getElementById("addDevice")?.addEventListener("submit", async (e) => {
    e.preventDefault();
  
    // console.log({ clientId: document.getElementById("client-id").value });
  
    const username = document.getElementById("pwl-username").innerText;
    const authMethod = document.getElementById("authMethod").value;
    // console.log({ username, authMethod });
  
    if (authMethod == "1") {
      try {
        // console.log("Passwordless same Platform method called");
        const response = await Passwordless.register({ username });
  
        alert("Registration Successful");
  
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
  });
  
  document
    .getElementById("approveButton")
    ?.addEventListener("click", async (e) => {
      const { username, id, type } = document.getElementById("user-data").dataset;
      // console.log({ type });
      try {
        if (type == 1) {
          const response = await Passwordless.register({ username, id });
          // console.log(response);
          if (response.verified) {
            alert("Success");
          }
        } else {
          const response = await Passwordless.login({ username, id });
          // console.log(response);
          if (response.verified) {
            alert("Success");
          }
        }
      } catch (error) {
        alert(error.message);
      }
    });
  
  const decline = async (id) => {
    try {
      await Passwordless.declineTransaction(id);
    } catch (error) {
      alert(error.message);
    }
  };
  