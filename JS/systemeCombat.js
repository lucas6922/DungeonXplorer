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
    "nom, id_classe, pvMax, pv, mana, force, initiative, armure, arme_principale, arme_secondaire, bouclier, liste_sorts"
)




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

function attaquer(attaquant, cible){
    console.log(attaquant);
    let degats = tirerDe(6) + attaquant.force + attaquant.arme_principale; //TODO Gérer arme secondaire
    let defense = 0;
    //TODO
}

let  michel = new combattant('Michel', 0, 100, 100, 0, 6, 5, 2, 0, 0, 0, []);
let  darkMichel = new combattant('DarkMichel', 0, 80, 80, 0, 4, 3, 0, 0, 0, 0, []);
console.log(darkMichel.initiative);
attaquer(darkMichel, michel);
console.log(darkMichel.pv);