function openForm() {

    // Display overlay
    displayOverlay(true);

    // Display Form
    document.querySelector(".form_popup_wrap").style.display = "flex";
    console.log("The openForm function has run!");

  }
  
function closeForm() {

    // Hide overlay
    displayOverlay(false);

    // Hide Form
    document.querySelector(".form_popup_wrap").style.display = "none";
    console.log("The closeForm function has run!");

}

function displayOverlay(displayBool) {

    // If passed 'true', display overlay
    if ( displayBool != false ) {

        console.log("Displaying overlay...");

        // Show overlay
        document.querySelector(".bg-overlay_full-screen").style.display = "block";
        document.querySelector(".bg-overlay_full-screen").style.visibility = "visible";

    } else {

        console.log("Hiding overlay...");

        // Hide overlay
        document.querySelector(".bg-overlay_full-screen").style.display = "none";
        document.querySelector(".bg-overlay_full-screen").style.visibility = "hidden";

    }

}