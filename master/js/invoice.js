let date_time = new Date();
let invo_date = document.getElementById('invoice-date');
let invo_time = document.getElementById('invoice-time');

invo_date.value = `${date_time.getFullYear()}-${date_time.getMonth() + 1}-${date_time.getDate()}`;

let h = date_time.getHours();

if( h > 12 ){
    invo_time.value = `${h - 12}:${date_time.getMinutes()}:${date_time.getSeconds()} pm`;
}
else{
    invo_time.value = `${h}:${date_time.getMinutes()}:${date_time.getSeconds()} am`;
}

/*************************************************/

let pat_sel = document.getElementById('pat-id');
let mob_th = document.getElementById('mob');
let age_th = document.getElementById('age');
let treat_td = document.getElementById('t-d');

// get mobile 
// function getMob(){
//     let pat_ID = pat_sel.value;
//     let dataRequest = new XMLHttpRequest;
//     if( pat_ID == 'start' ){
//         mob_th.innerHTML = "";
//     }
//     else{
//         dataRequest.onreadystatechange = function(){
//             if( this.readyState == 4 && this.status ==  200){
//                 mob_th.innerHTML = this.responseText;
//             }
//         }
//         dataRequest.open("GET", "getmob.php?q="+ pat_ID, true);
//         dataRequest.send();
//     }
// }
// pat_sel.addEventListener("change", getMob);

// get age
// function getAge(){
//     let pat_ID = pat_sel.value;
//     let dataRequest = new XMLHttpRequest;
//     if( pat_ID == 'start' ){
//         age_th.innerHTML = "";
//     }
//     else{
//         dataRequest.onreadystatechange = function(){
//             if( this.readyState == 4 && this.status ==  200){
//                 age_th.innerHTML = this.responseText;
//             }
//         }
//         dataRequest.open("GET", "getage.php?q="+ pat_ID, true);
//         dataRequest.send();
//     }
// }
// pat_sel.addEventListener("change", getAge);

// // get treatment doctor
// function getTreat(){
//     let pat_ID = pat_sel.value;
//     let dataRequest = new XMLHttpRequest;
//     if( pat_ID == 'start' ){
//         treat_td.innerHTML = "";
//     }
//     else{
//         dataRequest.onreadystatechange = function(){
//             if( this.readyState == 4 && this.status ==  200){
//                 treat_td.innerHTML = this.responseText;
//             }
//         }
//         dataRequest.open("GET", "gettreat.php?q="+ pat_ID, true);
//         dataRequest.send();
//     }
// }
// pat_sel.addEventListener("change", getTreat);


function pat_info(){
    let pat_ID = pat_sel.value;
    let dataRequest = new XMLHttpRequest;
    if( pat_ID == 'start' ){
        mob_th.innerHTML = "";
    }
    else{
        dataRequest.onreadystatechange = function(){
            if( this.readyState == 4 && this.status ==  200){
               let json_text = this.responseText;
               let js_obj = JSON.parse(json_text);
               console.log(js_obj);
               mob_th.innerHTML = js_obj[pat_ID]["pat_phone"];
               age_th.innerHTML = js_obj[pat_ID]["pat_age"];
               treat_td.innerHTML = js_obj[pat_ID]["treat_name"];
            }
        }
        dataRequest.open("GET", "pat.json", true);
        dataRequest.send();
    }
}
pat_sel.addEventListener("change", pat_info);



// get price 
let all_exam_select = document.querySelectorAll('tbody select');
let all_price = document.querySelectorAll(".p");
let all_discount = document.querySelectorAll(".d");
let all_amount = document.querySelectorAll(".a");
let total = document.getElementById('to');

for( let i = 0; i < all_exam_select.length; i++ ){
    all_exam_select[i].onchange = function(){
        let examID = all_exam_select[i].value;
        let dataRequest = new XMLHttpRequest;
        console.log(examID);
        if( examID == 'start' ){
            all_price[i].value = 0;
            all_discount[i].value = 0;
            all_amount[i].value = 0;
        }
        else{
            dataRequest.onreadystatechange = function(){
                if( this.readyState == 4 && this.status == 200 ){
                    all_price[i].value = this.responseText;
                    all_discount[i].value = 0;
                    all_amount[i].value = parseFloat(all_price[i].value) - parseFloat(all_discount[i].value);
                    let t = 0;
                    for( let a = 0; a < all_amount.length; a++){
                        t += parseFloat(all_amount[a].value);
                    }
                    total.value = t;
                }
            }
            dataRequest.open("GET", "getprice.php?q=" + examID, true);
            dataRequest.send();
        }
    }
}

// calc discount
for ( let i = 0; i < all_discount.length; i++ ){
    all_discount[i].onchange = function(){
        all_amount[i].value = parseFloat(all_price[i].value) - parseFloat(all_discount[i].value);
        let t = 0;
            for( let a = 0; a < all_amount.length; a++){
                t += parseFloat(all_amount[a].value);
            }
            total.value = t;
        }
}