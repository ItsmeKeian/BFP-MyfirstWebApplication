// Get the modal and buttons
var modal = document.getElementById("large-modal");
var openModalBtn = document.getElementById("view");
var closeModalBtn = document.getElementById("close");

// Open the modal
openModalBtn.onclick = function() {
    modal.style.display = "block";
}

// Close the modal
closeModalBtn.onclick = function() {
    modal.style.display = "none";
}

// Close the modal if the user clicks outside of it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}