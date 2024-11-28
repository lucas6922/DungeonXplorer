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
    "nom, id_potion, val" //id_potion = 0 pour potion de vie, 1 pour potion de mana
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

function attaquer(attaquant, cible){
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

function utiliserPotion(cible, idPotion, val){
    if (idPotion == 0){
        soigner(cible, val);
    }
    else if (idPotion == 1){
        regenererMana(cible, val);
    }
}

//nom, id_classe, pvMax, pv, manaMax, mana, force, initiative, armure, arme_principale, arme_secondaire, bouclier, liste_sorts
let  michel = new combattant('Michel', 0, 100, 100, 40, 40, 6, 5, 10, 0, 0, 0, []);
let  darkMichel = new combattant('DarkMichel', 0, 80, 80, 60, 60, 50, 3, 0, 0, 0, 0, []);
attaquerMagique(darkMichel, michel, 20);
console.log(michel.pv);
utiliserPotion(michel, 0, 10);
console.log(michel.pv);