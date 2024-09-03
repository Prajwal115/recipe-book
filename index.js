// List/Array in the form of [name, description, imagelink, tag]

const ul = document.getElementById('myUL');

items=window.itemList;
items.forEach(item => {
    
    const li = document.createElement('li');

    const a = document.createElement('a');
    a.href = "recipe.html"; 
    
    const h2 = document.createElement('h2');
    h2.textContent = item[0]; 

    
    const h3 = document.createElement('h3');
    h3.textContent = item[1]; 

    
    const img = document.createElement('img');
    img.src = item[2]; 

    const p=document.createElement('p');
    p.textContent=item[3];


    a.appendChild(h2);
    a.appendChild(h3);
    a.appendChild(p);
    a.appendChild(img);

    a.addEventListener('click', function(event) {
        // Using LocalStorage to transfer data from index.js to main.js
        event.preventDefault();
        localStorage.setItem('itemCode', JSON.stringify(item[4]));
 
        window.location.href = "recipe.html";
    });

    li.appendChild(a);

    ul.appendChild(li);
    console.log(ul);
});


function myFunction() {
    const data = [];
    var c = 0
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("sea");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
            data.push(li[i])
        } else {
            li[i].style.display = "none";
        }
        if (data.length == 0) {
            document.getElementById("noite").style.display = "block";
        }
        else {
            document.getElementById("noite").style.display = "none";
        }
    }
    console.log(data.length)
    if (data.length == 0) {
        document.getElementById("noite").style.display = "block";
    }
    else {
        document.getElementById("noite").style.display = "none";
    }

}
