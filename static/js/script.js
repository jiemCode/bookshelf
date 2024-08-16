
var loadFile = function(event) {
	var image = document.getElementById('image-output');
	image.src = URL.createObjectURL(event.target.files[0]);
};

// myButton.addEventListener(
//     "click",
//     function () {
//         myPopup.classList.add("show");
//     }
// );
// closePopup.addEventListener(
//     "click",
//     function () {
//         myPopup.classList.remove(
//             "show"
//         );
//     }
// );
// window.addEventListener(
//     "click",
//     function (event) {
//         if (event.target == myPopup) {
//             myPopup.classList.remove(
//                 "show"
//             );
//         }
//     }
// );


function showSuccessMessage(msg, color) {
    const messageElement = document.getElementById('successMessage');
    messageElement.innerHTML = msg;
    messageElement.style.backgroundColor = color;
    messageElement.classList.add('show');

    // Masquer le message après 3 secondes
    setTimeout(() => {
        messageElement.classList.remove('show');
    }, 3000);
}


var success = "#4CAF50";
var error = "#ba0000"

const urlParams = new URLSearchParams(window.location.search);
if (urlParams.get('trigger') === 'success') {
    msg = urlParams.get('msg')
    showSuccessMessage(msg, success);
} else if (urlParams.get('trigger') === 'error') {
    msg = urlParams.get('msg')
    showSuccessMessage(msg, error);
}
urlParams.delete('trigger');
urlParams.delete('msg');
const newUrl = `${window.location.pathname}?${urlParams.toString()}`;
window.history.replaceState({}, '', newUrl);