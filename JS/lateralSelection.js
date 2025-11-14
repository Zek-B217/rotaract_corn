const LATERAL_SELECTION = document.getElementById("lateralSelection");
const OBSCURER = document.getElementById("obscurer");
const FPS = 60;
const ROOT = document.querySelector(":root");
const CSS_VARIABLES = getComputedStyle(ROOT);

function showLateralSelection(){
    LATERAL_SELECTION.style.display = "block";
    OBSCURER.style.display = "block";

    lateralAnimation(1);
}

function hideLateralSelection(){
    LATERAL_SELECTION.style.display = "none";
    OBSCURER.style.display = "none";

    /*Resetto i valori di default di opacità e posizione utilizzandoli dalle variabili assegnate nel css*/
    ROOT.style.setProperty("--lateralSelectionCurrentPosition", CSS_VARIABLES.getPropertyValue("--lateralSelectionStartingPosition"));
    ROOT.style.setProperty("--obscurerCurrentOpacity", CSS_VARIABLES.getPropertyValue("--obscurerStartingOpacity"));
}

//Animo l'oscuramento della pagina e lo spostamento della selezioneLaterale
function lateralAnimation(secondiAnimazioni){
    let animationCycles = FPS * secondiAnimazioni;
    let ctr = 0;
    let opacityCycliclIncrease = CSS_VARIABLES.getPropertyValue("--obscurerFinalOpacity") / animationCycles; //Quanto aumentare l'opacità a ogni ciclo
    let positionRightCycliclIncrease = (
            parseFloat(CSS_VARIABLES.getPropertyValue("--lateralSelectionFinalPosition")) - 
            parseFloat(CSS_VARIABLES.getPropertyValue("--lateralSelectionCurrentPosition"))
        ) / animationCycles; //Quanto spostare a ogni ciclo
    let currentOpacityValue = parseFloat(CSS_VARIABLES.getPropertyValue("--obscurerCurrentOpacity")); //Valore opacità corrente
    let currentPositionRightValue = parseFloat(CSS_VARIABLES.getPropertyValue("--lateralSelectionCurrentPosition"));; //Valore right corrente

    let id = setInterval(frame,60 / FPS); //Avvio l'animazione

    //Funzione che regola l'animazione. Viene eseguita fino alla chiamata di clearInterval
    function frame(){
        if (ctr < animationCycles){
            //Animazione oscuramento
            currentOpacityValue += opacityCycliclIncrease;
            ROOT.style.setProperty("--obscurerCurrentOpacity", currentOpacityValue);

            //Animazione posizione
            currentPositionRightValue += positionRightCycliclIncrease;
            ROOT.style.setProperty("--lateralSelectionCurrentPosition", currentPositionRightValue + "vw");

            ctr++;
        }else {
            clearInterval(id);
            /*Arrotonda i valori*/
            ROOT.style.setProperty("--lateralSelectionCurrentPosition", CSS_VARIABLES.getPropertyValue("--lateralSelectionFinalPosition"));
            ROOT.style.setProperty("--obscurerCurrentOpacity", CSS_VARIABLES.getPropertyValue("--obscurerFinalOpacity"));
        }
    }
}