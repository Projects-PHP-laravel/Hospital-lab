let search_inp = document.getElementById('treat');
let result = document.getElementById('search-result');
search_inp.onkeyup = function(){
    let search_value = search_inp.value;
    console.log(search_value)
    let dataRequest = new XMLHttpRequest;
    dataRequest.onreadystatechange = function(){
        if( this.readyState == 4 && this.status == 200 ){
            result.innerHTML = this.responseText
        }
    }

    dataRequest.open("GET", "treat_search.php?q=" + search_value, true);
    dataRequest.send();
}