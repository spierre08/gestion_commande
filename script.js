let iconeA = document.querySelector(".menu_icon_1")
let iconeB = document.querySelector(".menu_icon")
let sliderBar = document.querySelector(".slide_bar") 

let header = document.querySelector(".header")
let main = document.querySelector(".main")
let sub_menu_item = document.querySelector(".subMenu_item")
let sub_menu_option = document.querySelector(".sub_option")

iconeA.addEventListener("click", ()=>{
    // Ajouter la classe redimenssionnable
    sliderBar.classList.add("redimenssionnable")
})


iconeB.addEventListener("click",()=>{
    //Faire apparaître et disparaître le slider bar  
    sliderBar.classList.toggle("slide")
    // Rédimenssion la taille du menu verticla
    header.classList.toggle("removable")
    //Rédimenssionner la taille du main
    main.classList.toggle("flip")
    //Réinitialiser ou remttre la valeur de la marge extérieure du
    //Sous menu droit du menu verticale
    sub_menu_item.classList.toggle("resize_marging")

    sub_menu_option.classList.toggle("activation")
})
//Effet clique pour enlever la classe redimenssionnable
sliderBar.onclick = ()=> sliderBar.classList.remove("redimenssionnable")

/*let dark_light = document.getElementById("dark_light")
let body = document.querySelector("body")

dark_light.addEventListener("click", ()=>{
    dark_light.style.cursor = "pointer"
    body.classList.toggle("sun")
})
*/