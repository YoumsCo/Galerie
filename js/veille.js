let container = document.querySelector("#container-date");

window.addEventListener("load", function() {
    document.body.style.overflow = "hidden auto";
});

window.addEventListener("visibilitychange", function() {
    if (container.classList.contains("slide-up")) {
        setTimeout(function() {
            container.classList.remove("slide-up");
            this.document.body.style.overflow = "hidden";
        }, 60 * 1000);
    }
});

container.addEventListener("click", function() {
    container.classList.add("slide-up");
    document.body.style.overflow = "hidden auto";
});



function updateClock() {
    const now = new Date();
    const seconds = now.getSeconds();
    const minutes = now.getMinutes();
    const hours = now.getHours();
    const month = now.getMonth();
    const date = now.getDate();
    const year = now.getFullYear();
    const months = [
        'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mais', 'Juin', 
        'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre',
    ];
    const tags = [
        'month', 'date', 'year', 'hours', 'minutes', 'seconds',
    ];
    const values = [
        months[month], date, year,
        String(hours).padStart(2, "0"),
        String(minutes).padStart(2, "0"),
        String(seconds).padStart(2, "0"),
    ];

    for (let i = 0; i < tags.length; i++) {
        document.querySelector(`.${tags[i]}`).firstChild.nodeValue = values[i];
    }
}

setInterval(updateClock, 1);