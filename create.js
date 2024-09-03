items=window.itemList;

x=document.getElementById("proceed");


x.addEventListener('click', function(event) {
    // Using LocalStorage to transfer data from index.js to main.js
    y=document.getElementById("foodid");
    u=y.value;
    flag=true;
    for (let z in items){
        console.log(z);
        if (u==items[z][4]){
            event.preventDefault();
            flag=false;
            alert("FoodID already exists. Try something else");
            break
        }
    }
    if (flag==true){
        window.vari=window.u;
        
        window.location.href='doit.php';
    }

    
});
