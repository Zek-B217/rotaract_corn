for (const container of document.getElementsByClassName("sectionContainer")) {
    container.addEventListener("click", e => {showSelection(container.parentNode)});
}

function showSelection(element){
    const ARROW_ELEMENT = element.querySelector(".arrow");
    ARROW_ELEMENT.classList.toggle("down");
    ARROW_ELEMENT.classList.toggle("right");
    element.querySelector(".modificationContainer").classList.toggle("showModifications") //toggle aggiunge la classe se non c'è ma la elimina se c'è già
}