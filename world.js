window.onload = function() {
    var lookupButton = document.getElementById('lookup');
    var input = document.getElementById('country');
    var result = document.getElementById('result');
    var rhttp;
    
    lookupButton.addEventListener("click", function(element){
        element.preventDefault();
    
        rhttp = new XMLHttpRequest();
        var url = "http://localhost/info2180-lab5/world.php?country="+input.value;
        rhttp.onreadystatechange = loadList;
        rhttp.open('GET', url);
        rhttp.send();
    });
    
    
    function loadList(){
        if (rhttp.readyState == XMLHttpRequest.DONE && rhttp.status == 200){
            var response = rhttp.responseText;
            result.innerHTML = response;
        }
    }
    
}