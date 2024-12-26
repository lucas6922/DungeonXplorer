document.addEventListener('DOMContentLoaded', function () {
    let itemIndex = 1;  // Index pour identifier chaque nouvel item ajouté
    const addItemBtn = document.getElementById('add-item-btn');
    const itemsContainer = document.getElementById('items-container');

    addItemBtn.addEventListener('click', function () {
        // Cloner la première entrée d'item
        const newItem = document.querySelector('.item-entry').cloneNode(true);

        // Mettre à jour les attributs des nouveaux champs de formulaire
        newItem.querySelector('label[for="item_name_1"]').setAttribute('for', `item_name_${itemIndex}`);
        newItem.querySelector('select[id="item_name_1"]').setAttribute('id', `item_name_${itemIndex}`);
        newItem.querySelector('select[name="items[0][ite_id]"]').setAttribute('name', `items[${itemIndex}][ite_id]`);  // Mettre ite_id

        newItem.querySelector('label[for="item_quantity_1"]').setAttribute('for', `item_quantity_${itemIndex}`);
        newItem.querySelector('input[id="item_quantity_1"]').setAttribute('id', `item_quantity_${itemIndex}`);
        newItem.querySelector('input[name="items[0][quantity]"]').setAttribute('name', `items[${itemIndex}][quantity]`);

        // Ajouter le nouvel item dans le conteneur
        itemsContainer.appendChild(newItem);

        // Incrémenter l'index pour le prochain item
        itemIndex++;
    });
});
