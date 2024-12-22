/*Credit to https://dev.to/joelbonetr/structs-in-javascript-1p9l */

function makeStruct(keys) {
    if (!keys) return null;
    const k = keys.split(', ');
    const count = k.length;
  
    /** @constructor */
    function constructor() {
      for (let i = 0; i < count; i++) this[k[i]] = arguments[i];
    }
    return constructor;
  }

let combattant = new makeStruct(
    "nom, id_classe, pvMax, pv, manaMax, mana, force, initiative, armure, arme_principale, arme_secondaire, bouclier, liste_sorts"
)

let potion = new makeStruct(
    "id_potion, nom, val" //id_potion = 0 pour potion de vie, 1 pour potion de mana
)

let sort = new makeStruct(
    "id_sort, nom, val"
)

let boutonAttaquePhysique = document.getElementById("attaqueP");
let boutonAttaqueMagique = document.getElementById("attaqueM");
let boutonPotion = document.getElementById("potion");
let consoleCombat = document.getElementById("console");
let herosDiv = document.getElementById("heros");
let ennemiDiv = document.getElementById("ennemi");
let nTour = 1;




function tirerDe(n){
    return Math.floor(Math.random() * n) + 1;
}

function calculInitiative(joueur, ennemi){
    initJoueur = tirerDe(6) + joueur.initiative;
    initEnnemi = tirerDe(6) + ennemi.initiative;
    if (initJoueur > initEnnemi){
        return joueur
    }
    //TODO : Les voleurs ont l'initiative en cas d'égalité
    return ennemi
}

function prendreDegats(combattant, degats){
    if (degats <= 0){
        return;
    }
    if (combattant.pv - degats <= 0){
        combattant.pv = 0;
        finDeCombat(combattant);
    }
    else{
        combattant.pv -= degats;
    }
}

function soigner(combattant, valSoin){
    if (valSoin <= 0){
        return;
    }
    if (combattant.pv + valSoin >= combattant.pvMax){
        combattant.pv = combattant.pvMax; 
    }
    else{
        combattant.pv += valSoin;
    }
}

function regenererMana(combattant, valReg){
    if (valReg <= 0){
        return;
    }
    if (combattant.mana + valReg >= combattant.manaMax){
        combattant.mana = combattant.manaMax; 
    }
    else{
        combattant.mana += valReg;
    }
}

function attaquerPhysique(attaquant, cible){
    let degats = tirerDe(6) + attaquant.force + attaquant.arme_principale; //TODO Gérer arme secondaire
    let defense = tirerDe(6) + Math.floor(cible.force / 2) + cible.armure;//TODO Gere en fonction de la classe
    prendreDegats(cible, degats - defense);
    
}

function attaquerMagique(attaquant, cible, manaSort){
    let degats = tirerDe(6) + tirerDe(6) + manaSort;
    let defense = tirerDe(6) + Math.floor(cible.force / 2) + cible.armure;//TODO Gere mana insuffisant
    attaquant.mana -= manaSort;
    prendreDegats(cible, degats - defense);
}

function boirePotion(cible, idPotion, val){//TODO supprimer une potion de l'inventaire
    if (idPotion == 0){
        soigner(cible, val);
    }
    else if (idPotion == 1){
        regenererMana(cible, val);
    }
}

function finDeCombat(combattant){
    consoleCombat.innerHTML += "Fini !<br>" + combattant.nom + " a perdu<br>";

    boutonAttaquePhysiqueClone = boutonAttaquePhysique.cloneNode(true);
    boutonAttaquePhysique.parentNode.replaceChild(boutonAttaquePhysiqueClone, boutonAttaquePhysique);

    boutonAttaqueMagiqueClone = boutonAttaqueMagique.cloneNode(true);
    boutonAttaqueMagique.parentNode.replaceChild(boutonAttaqueMagiqueClone, boutonAttaqueMagique);

    boutonPotionClone = boutonPotion.cloneNode(true);
    boutonPotion.parentNode.replaceChild(boutonPotionClone, boutonPotion);
}


function tour(heros, ennemi){
    
    consoleCombat.innerHTML += ("<br>---------------------------------------------------------<br><br>");
    consoleCombat.innerHTML += ("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + heros.nom   + " vs " + ennemi.nom + "<br><br>");
    consoleCombat.innerHTML += (heros.nom   + " : PV " + heros.pv + "<br>");
    consoleCombat.innerHTML += (ennemi.nom   + " : PV " + ennemi.pv + "<br><br>");
    actualiseAffichagePV(ennemi, 0);
    actualiseAffichagePV(heros, 1);
 
    boutonAttaquePhysique.addEventListener('click', () => {
        let j1 = ennemi;
        let j2 = heros;
        if (calculInitiative(heros, ennemi) == heros){
            j1 = heros;
            j2 = ennemi;
        }
        consoleCombat.innerHTML += ("-----------------------Tour n°" + nTour + "-----------------------<br>");
        consoleCombat.innerHTML += (j1.nom + " attaque " + j2.nom + " !<br>");
        attaquerPhysique(j1, j2);
        if(j2.pv > 0){
            consoleCombat.innerHTML += ("PV " + j2.nom + " : " + j2.pv + "<br><br>");
            consoleCombat.innerHTML += (j2.nom + " attaque " + j1.nom + " !<br>");
            attaquerPhysique(j2, j1);
            if(j1.pv > 0){
                consoleCombat.innerHTML += ("PV " + j1.nom + " : " + j1.pv + "<br><br>");
            }
        }
        actualiseAffichagePV(ennemi, 0);
        actualiseAffichagePV(heros, 1);
        nTour++;
    })
    boutonPotion.addEventListener('click', () => { //TODO verifier dans bdd si potion
        let j1 = ennemi;
        let j2 = heros;
        if (calculInitiative(heros, ennemi) == heros){
            j1 = heros;
            j2 = ennemi;
        }
        let valPotion =  15; //TODO recuperer la valeur de la potion
        consoleCombat.innerHTML += ("-----------------------Tour n°" + nTour + "-----------------------<br>");
        if (j1 == heros){

            consoleCombat.innerHTML += (heros.nom + " se soigne !<br>");
            boirePotion(heros, 0, valPotion);
            consoleCombat.innerHTML += ("PV " + heros.nom + " : " + heros.pv + "<br><br>");

            consoleCombat.innerHTML += (j2.nom + " attaque " + j1.nom + " !<br>");
            attaquerPhysique(j2, j1);
            if(j1.pv > 0){
                consoleCombat.innerHTML += ("PV " + j1.nom + " : " + j1.pv + "<br><br>");
            }
        }
        else{
            consoleCombat.innerHTML += (j1.nom + " attaque " + j2.nom + " !<br>");
            attaquerPhysique(j1, j2);
            if(j2.pv > 0){
                consoleCombat.innerHTML += ("PV " + j2.nom + " : " + j2.pv + "<br><br>");
                consoleCombat.innerHTML += (heros.nom + " se soigne !<br>");
                boirePotion(heros, 0, valPotion);
                consoleCombat.innerHTML += ("PV " + heros.nom + " : " + heros.pv + "<br><br>");
            }
        }
        actualiseAffichagePV(ennemi, 0);
        actualiseAffichagePV(heros, 1);
        nTour++;
    })
    boutonAttaqueMagique.addEventListener('click', () => {
        let boutonsSorts = document.getElementById("sorts");
        boutonsSorts.innerHTML = "Sorts :<br>"
        heros.liste_sorts.forEach((i) => {
            let sort = document.createElement("BUTTON");
            sort.appendChild(document.createTextNode(i.nom + " (mana : " + i.val + ")"));


            sort.addEventListener('click', () => {
                let j1 = ennemi;
                let j2 = heros;
                if (calculInitiative(heros, ennemi) == heros){
                    j1 = heros;
                    j2 = ennemi;
                }
                let valSort =  i.val;
                consoleCombat.innerHTML += ("-----------------------Tour n°" + nTour + "-----------------------<br>");
                if (j1 == heros){

                    consoleCombat.innerHTML += (heros.nom + " fait le sort " + i.nom + " !<br>");
                    attaquerMagique(heros, ennemi, valSort)
                    consoleCombat.innerHTML += ("PV " + ennemi.nom + " : " + ennemi.pv + "<br><br>");
        
                    consoleCombat.innerHTML += (j2.nom + " attaque " + j1.nom + " !<br>");
                    attaquerPhysique(j2, j1);
                    consoleCombat.innerHTML += ("PV " + j1.nom + " : " + j1.pv + "<br><br>");
                }
                else{
                    consoleCombat.innerHTML += (j1.nom + " attaque " + j2.nom + " !<br>");
                    attaquerPhysique(j1, j2);
                    consoleCombat.innerHTML += ("PV " + j2.nom + " : " + j2.pv + "<br><br>");
                    consoleCombat.innerHTML += (heros.nom + " fait le sort " + i.nom + " !<br>");
                    attaquerMagique(heros, ennemi, valSort)
                    consoleCombat.innerHTML += ("PV " + ennemi.nom + " : " + ennemi.pv + "<br><br>");
                }
                actualiseAffichagePV(ennemi, 0);
                actualiseAffichagePV(heros, 1);
                nTour++;
            })


            boutonsSorts.appendChild(sort);
        })
    })
}

function actualiseAffichagePV(combattant, estHeros){
    if(estHeros){
        herosDiv.innerHTML = combattant.nom + " PV : " + combattant.pv + "/" + combattant.pvMax;
    }
    else{
        ennemiDiv.innerHTML = combattant.nom + " PV : " + combattant.pv + "/" + combattant.pvMax;
    }
}



function charger(){
    let  michel = new combattant('Michel', 0, 30, 30, 0, 0, 10, 5, 0, 0, 0, 0, [new sort(0,"Boule de feu 4 Elexir",4), new sort(1,"orage.jpg",20),new sort(2,"hein ?",0)]);
    let  darkMichel = new combattant('darkMichel', 0, 30, 30, 0, 0, 10, 5, 0, 0, 0, 0, []);//TODO Charger les persos dans la bdd
    tour(michel, darkMichel);
}

//nom, id_classe, pvMax, pv, manaMax, mana, force, initiative, armure, arme_principale, arme_secondaire, bouclier, liste_sorts

charger();