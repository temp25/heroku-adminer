toastr.options = {
   "closeButton": true,
   "debug": false,
   "newestOnTop": true,
   "progressBar": true,
   "positionClass": "toast-bottom-right",
   "preventDuplicates": true,
   "onclick": null,
   "showDuration": "300",
   "hideDuration": "1000",
   "timeOut": "1000",
   "extendedTimeOut": "1000",
   "showEasing": "swing",
   "hideEasing": "linear",
   "showMethod": "fadeIn",
   "hideMethod": "fadeOut"
}

function changeTheme() {
   var skinManager = document.getElementById("themes")
   var skin = skinManager.options[skinManager.selectedIndex].text;
   console.log("Theme change to "+skin+" request initiated");
   makePostRequest("changeTheme.php", "selectedTheme="+skin);
}

function makePostRequest(url, payload) {
   var xHttpRequest = new XMLHttpRequest();
   xHttpRequest.open('POST', url, true);
   
   //send proper header information along with the request
   xHttpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

   xHttpRequest.onreadystatechange = function() {

      if(xHttpRequest.readyState == 4) {
         if(xHttpRequest.status == 200) {
            var response = JSON.parse(xHttpRequest.responseText);
            console.info(response);
            document.getElementById("currentTheme").innerHTML = response.currentTheme;
            toastr.info(response.status);
         } else {
            console.error(response);
            toastr.error(response.status);
         }
      }

   };

   xHttpRequest.send(payload);

}

function themeChangeListener(selectElement) {
   var skin = selectElement.options[selectElement.selectedIndex].text;
   console.log("themeChangeListener  ===> Selected Skin: "+skin);
}