function avaaLisays() {
    if (document.getElementById("lisaa").style.display == "block") {
        document.getElementById("lisaa").style.display = "none";
        document.getElementById("lista").style.display = "block";
    } else {
        document.getElementById("lisaa").style.display = "block";
        document.getElementById("lista").style.display = "none";
    }
}

function avaaMuokkaus(id) {
    var elements = document.querySelectorAll(".form.open");
    [].forEach.call(elements, function (element) {
        if (element.id != id) {
            element.classList.remove("open");
        }
    });
    if (document.getElementById(id).classList.contains("open")) {
        document.getElementById(id).classList.remove("open");
    } else {
        document.getElementById(id).classList.add("open");
    }
}

function avaaEvents(id) {
    
}
