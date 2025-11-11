const SELEZIONE_LATERALE = document.getElementById("selezioneLaterale");
const OSCURATORE = document.getElementById("oscuratore");
const FPS = 60;
const ROOT = document.querySelector(":root");
const VARIABILI_CSS = getComputedStyle(ROOT);

function mostraSelezioneLaterale(){
    SELEZIONE_LATERALE.style.display = "block";
    OSCURATORE.style.display = "block";

    animazioneLaterale(1);
}

function nascondiSelezioneLaterale(){
    SELEZIONE_LATERALE.style.display = "none";
    OSCURATORE.style.display = "none";

    /*Resetto i valori di default di opacità e posizione utilizzandoli dalle variabili assegnate nel css*/
    ROOT.style.setProperty("--posizioneCorrenteSelezioneLaterale", VARIABILI_CSS.getPropertyValue("--posizioneInizialeSelezioneLaterale"));
    ROOT.style.setProperty("--opacitaCorrenteOscuratore", VARIABILI_CSS.getPropertyValue("--opacitaInizialeOscuratore"));
}

//Animo l'oscuramento della pagina e lo spostamento della selezioneLaterale
function animazioneLaterale(secondiAnimazioni){
    let cicliAnimazione = FPS * secondiAnimazioni;
    let ctr = 0;
    let aumentoOpPerCiclo = VARIABILI_CSS.getPropertyValue("--opacitaFinaleOscuratore") / cicliAnimazione; //Quanto aumentare l'opacità a ogni ciclo
    let aumentoRPerCiclo = (
            parseFloat(VARIABILI_CSS.getPropertyValue("--posizioneFinaleSelezioneLaterale")) - 
            parseFloat(VARIABILI_CSS.getPropertyValue("--posizioneCorrenteSelezioneLaterale"))
        ) / cicliAnimazione; //Quanto spostare a ogni ciclo
    let valoreOpCorrente = parseFloat(VARIABILI_CSS.getPropertyValue("--opacitaCorrenteOscuratore")); //Valore opacità corrente
    let valoreRCorrente = parseFloat(VARIABILI_CSS.getPropertyValue("--posizioneCorrenteSelezioneLaterale"));; //Valore right corrente

    let id = setInterval(frame,60 / FPS); //Avvio l'animazione

    //Funzione che regola l'animazione. Viene eseguita fino alla chiamata di clearInterval
    function frame(){
        if (ctr < cicliAnimazione){
            //Animazione oscuramento
            valoreOpCorrente += aumentoOpPerCiclo;
            ROOT.style.setProperty("--opacitaCorrenteOscuratore", valoreOpCorrente);

            //Animazione posizione
            valoreRCorrente += aumentoRPerCiclo;
            ROOT.style.setProperty("--posizioneCorrenteSelezioneLaterale", valoreRCorrente + "vw");

            ctr++;
        }else {
            clearInterval(id);
            /*Arrotonda i valori*/
            ROOT.style.setProperty("--posizioneCorrenteSelezioneLaterale", VARIABILI_CSS.getPropertyValue("--posizioneFinaleSelezioneLaterale"));
            ROOT.style.setProperty("--opacitaCorrenteOscuratore", VARIABILI_CSS.getPropertyValue("--opacitaFinaleOscuratore"));
        }
    }
}