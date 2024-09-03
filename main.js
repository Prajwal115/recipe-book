window.addEventListener('DOMContentLoaded', (event) => {
    // Retrieve the item code from localStorage
    const itemCode = JSON.parse(localStorage.getItem('itemCode'));

    if (itemCode) {
        console.log(itemCode);

    } else {
        console.log('No item code found');
    }

    entireData=window.things;

    procedure = entireData[itemCode]['procedure']
    procedure.forEach(step => {
        const p = document.createElement('p');
        p.textContent = step;
        document.getElementById("main").append(p);
    });

    document.getElementById("foodname").textContent = entireData[itemCode]['name'];

    document.getElementById("desc").textContent = entireData[itemCode]['desc'];
    document.getElementById("time").textContent = entireData[itemCode]['time'];
    document.getElementById("ingr").textContent = entireData[itemCode]['ing'];
    image = document.getElementById("homeimage");
    nam = "IMG/" + itemCode + ".jpg";
    image.setAttribute('src', nam);
});

