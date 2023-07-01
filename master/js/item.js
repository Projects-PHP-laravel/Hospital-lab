let all_span_add = document.querySelectorAll(".ad");
let all_span_remove = document.querySelectorAll(".rem");
let all_item_id = document.querySelectorAll(".item-id");
let result = document.getElementById('cart');
let cart_result = document.getElementById('cart_result');
function second (){
    let abc_request = new XMLHttpRequest;
    abc_request.onreadystatechange = function(){
        if( this.readyState == 4 && this.status == 200 ){
            cart_result.innerHTML = this.responseText;
            all_item_id = document.querySelectorAll(".item-id");
        }
    }
    abc_request.open("GET", "addcart2.php", true);
    abc_request.send();
}

function firtst(){
    let item_ID = parseInt(all_item_id[i].value);
    let dataRequest = new XMLHttpRequest;
    dataRequest.onreadystatechange = function(){
        if( this.readyState == 4 && this.status == 200 ){
            result.innerHTML =  this.responseText;
            second();
        }
    }
    dataRequest.open("GET", "addcart.php?q=" + item_ID, true);
    dataRequest.send();
    
}

for( let i = 0; i < all_span_add.length; i++ ){
    all_span_add[i].onclick = function(){
        let item_ID = parseInt(all_item_id[i].value);
        let dataRequest = new XMLHttpRequest;
        dataRequest.onreadystatechange = function(){
            if( this.readyState == 4 && this.status == 200 ){
                result.innerHTML =  this.responseText;
                second();
            }
        }
        dataRequest.open("GET", "addcart.php?q=" + item_ID, true);
        dataRequest.send();
    }
}