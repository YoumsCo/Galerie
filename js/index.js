let items = document.querySelectorAll(`.${'container-items'}`);

for (let i = 0; i < items.length; i++) {
    items[i].addEventListener("mouseenter", function() {
        let container_download = document.querySelectorAll(".container-download");
        setTimeout(function() {
            container_download[i].classList.add('show');   
        }, 1);
    });
    items[i].addEventListener("mouseleave", function() {
        let container_download = document.querySelectorAll(".container-download");
        container_download[i].classList.remove('show');
    });
}

let button = document.querySelectorAll('.download');
let image = document.querySelectorAll('.img');

for (let j = 0; j < button.length; j++) {
    button[j].addEventListener("click", function() {
        let a = document.createElement("a");
        for (let k = 0; k < image.length; k++) {
            if (k == j) {
                let img = image[k].getAttribute("src");
                let img_title = image[k].getAttribute("title");
                a.href = img;
                a.download = "youms_x_yc_" + img_title;
                a.click();
            }
        }
    });        
}


// **********************************************************************************
//  Gestion du changement de thème
// **********************************************************************************

let theme = document.querySelector('#parent');
let style = document.querySelector('.style');
let style_href = style.getAttribute("href");


theme.addEventListener("click", function() {
    let icon = document.querySelector("#child");
    let icon_class = document.querySelector("#icone");

    
    icon.classList.toggle("change");
    if (icon_class.classList.contains("fa-moon-o")) {
        icon_class.classList.replace("fa-moon-o", "fa-sun-o");
        
        document.cookie = "mode=light; expires= fri, 31 Dec 9999 23:59:00 GMT";
        
        if(style_href.indexOf('dark')) {
            let active_mode = style_href.substr(style_href.indexOf('dark'), 4);
            let new_href = style_href.replace(active_mode, "light");
            style.setAttribute("href", new_href);
        }
    }
    else {
        icon_class.classList.replace("fa-sun-o", "fa-moon-o");

        document.cookie = "mode=dark; expires= fri, 31 Dec 9999 23:59:00 GMT";
        
        if(style_href.indexOf('dark')) {
            let active_mode = style_href.substr(style_href.indexOf('dark'), 4);
            let new_href = style_href.replace(active_mode, "dark");
            style.setAttribute("href", new_href);
        }
    }
});

window.addEventListener("load", function() {
    let icon = document.querySelector("#child");
    let icon_class = document.querySelector("#icone");
    if (document.cookie.match(/mode=([^;]*)/)) {
        let cookie = document.cookie;

        if (cookie.indexOf("light") !== -1) {
            icon.classList.toggle("change");
            icon_class.classList.replace("fa-moon-o", "fa-sun-o");
            let active_mode = style_href.substr(style_href.indexOf('dark'), 4);
            let new_href = style_href.replace(active_mode, "light");
            style.setAttribute("href", new_href);
        }
        else {
            icon.classList.remove("change");
            icon_class.classList.replace("fa-sun-o", "fa-moon-o");
            let active_mode = style_href.substr(style_href.indexOf('dark'), 4);
            let new_href = style_href.replace(active_mode, "dark");
            style.setAttribute("href", new_href);
        }
    }
    else {
        if(window.matchMedia("(prefers-color-scheme: dark)").matches) {
            icon.classList.remove("change");
            icon_class.classList.replace("fa-sun-o", "fa-moon-o");
            let active_mode = style_href.substr(style_href.indexOf('dark'), 4);
            let new_href = style_href.replace(active_mode, "dark");
            style.setAttribute("href", new_href);
        }
        else {
            icon.classList.toggle("change");
            icon_class.classList.replace("fa-moon-o", "fa-sun-o");
            let active_mode = style_href.substr(style_href.indexOf('dark'), 4);
            let new_href = style_href.replace(active_mode, "light");
            style.setAttribute("href", new_href);
        }
    }
});


// **********************************************************************************
//  Gestion des categories
// **********************************************************************************

let links = document.querySelectorAll(".links");
let containers = ["Landscape", "Cars", "Towns", "Other"];
let links_tab = links;

for (let i = 0; i < links.length; i++) {
    const link = links[i];
    link.addEventListener("click", function() {
        for(let j = 0; j < containers.length; j++) {
            if (link.textContent.indexOf(containers[j]) !== -1) {
                link.classList.add('show');
                document.querySelector(`.${containers[j]}`).classList.add("initial");
                document.querySelector(`.${containers[j]}`).classList.remove("transform");
            }
            else {
                function check(tab, element) {
                    var found = false;
                    for(let k = 0; k < tab.length; k++) {
                        if (tab[k].textContent === element) {
                            tab[k].classList.remove('show');
                            found = true;
                            break;
                        }
                    }
                    return found;
                }
                check(links_tab, containers[j]);
                document.querySelector(`.${containers[j]}`).classList.add("transform");
            }
        }
    });
        
}

// **********************************************************************************
//  Gestion de la fenetre de changeent de la photo de profile
// **********************************************************************************

let camera = document.querySelector(".fa-camera");
let close = document.querySelector(".fa-close");

camera.addEventListener("click", function() {
    document.querySelector("#container-change-picture").classList.remove("change-picture-shide");
});

close.addEventListener("click", function() {
    document.querySelector("#container-change-picture").classList.add("change-picture-shide");
});

// **********************************************************************************
//  Gestion du changement de la photo de profile
// **********************************************************************************

let type_file = document.querySelector("[type='file']");
// let close = document.querySelector(".fa-close");

type_file.addEventListener("change", function() {
    let imgChecked = this.files[0];
    let type_accepted = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
    if (imgChecked) {
        if (type_accepted.includes(imgChecked.type)) {
            let reader = new FileReader();
            reader.addEventListener("load", function() {
                let img = document.querySelectorAll(".photo");
                let container_span = document.querySelector("#buttons");
                let mouse_click = new MouseEvent("click", {
                    bubbles: true,
                    cancelable: true,
                    view: window
                });
                let span = document.createElement("span");
                container_span.appendChild(span);
                
                span.style.position = "absolute";
                span.style.transform = "translateY(-30px)";
                span.style.color = "whitesmoke";
                span.style.fontWeight = "bolder";
                span.style.fontSize = "13pt";
                span.innerText = "Importation du profile";
                img.forEach(i => {
                    setTimeout(function() {
                        i.setAttribute("src", reader.result);
                        span.style.color = "bisque";
                        span.innerText = "Profile importé";
                        setTimeout(function() {
                            span.innerText = "";
                            let ajouter = document.querySelector("#ajouter");
                            ajouter.dispatchEvent(mouse_click);
                        }, 2000);
                    }, 3000);
                });
            });
            reader.readAsDataURL(imgChecked);
        }
        else {
            alert("Fichier invalide");
        }
    }
    
});


// **********************************************************************************
//  Données du developpeur
// **********************************************************************************

fetch('../controllers/DataController.php')
.then(response => response.json())
.then(datas => {
    console.log("Type de données : " + datas["Data-type"]);
    console.log("Nom : " + datas["first_name"]);
    console.log("Prénom : " + datas["last_name"]);
    console.log("Email : " + datas["email"]);
    console.log("Téléphone : " + datas["telephone"]);
})
.catch(console.error);

// **********************************************************************************
//  Autres
// **********************************************************************************

window.addEventListener("resize", function() {
    if (window.matchMedia("(orientation:landscape)").matches && window.matchMedia("(max-width: 500px)").matches) {
        screen.orientation.lock('portrait');
    }
});

window.addEventListener("wheel", function(event) {
    if(event.ctrlKey) {
        event.preventDefault();
    }
},
{passive: false}
);