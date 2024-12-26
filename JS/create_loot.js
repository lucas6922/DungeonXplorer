document.addEventListener("DOMContentLoaded", function () {
    let itemIndex = 1;

    const addItemButton = document.getElementById('add-item-btn');
    const itemsContainer = document.getElementById('items-container');

    addItemButton.addEventListener('click', function () {
        const newItem = document.createElement('div');
        newItem.classList.add('item-entry');
        newItem.innerHTML = `
            <label for="item_name_${itemIndex}">Nom de l'item :</label>
            <input type="text" id="item_name_${itemIndex}" name="items[${itemIndex}][name]" placeholder="Nom de l'item" >

            <label for="item_quantity_${itemIndex}">Quantité de l'item :</label>
            <input type="number" id="item_quantity_${itemIndex}" name="items[${itemIndex}][quantity]" placeholder="Quantité de l'item" >
        `;
        itemsContainer.appendChild(newItem);
        itemIndex++;
    });
});
