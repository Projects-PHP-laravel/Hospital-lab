
document.getElementById('go').onclick = function(){
    let all_links = document.querySelectorAll(".links")[0];
    let data_div = document.querySelectorAll(".page-data")[0];
    let all_nav = document.querySelectorAll("nav a");
    let p_title = document.querySelectorAll(".pro-title")[0];
    all_links.classList.toggle("w-none");
    data_div.classList.toggle("w-100");
    p_title.classList.toggle("hide");
    for(let i = 0; i < all_nav.length; i++){
        all_nav[i].classList.toggle("hide")
    }
}

document.getElementById('set').onclick = function(){
    document.getElementById('sub-ul').classList.toggle("hide");
    document.getElementById('icon-arrow').classList.toggle("ro");
}

// change act clas with hover 
let links_title = [
    "Dashboard",
    "Section",
    "Treatment Doctor",
    "Patient",
    "Job",
    "Department",
    "Employee",
    "Examination",
    "Invoice",
    "Item",
    "Cart"
]

let all_links = document.querySelectorAll('nav a');

let page_title = document.getElementsByClassName('page-title')[0];

for( let i = 0; i < links_title.length; i++ ){
    if( page_title.innerHTML.includes(links_title[i]) ){
        for( let a = 0; a < all_links.length; a++ ){
            all_links[a].classList.remove("act");
            all_links[i].classList.add("act");
        }
    }
}