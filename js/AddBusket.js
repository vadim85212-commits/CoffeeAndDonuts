function AddBusket(elem){
    let data = { id: elem };
    let params = new FormData();
    for (i in data){
        params.append(i, data[i]);
    }

    fetch('./php/busket.php', {
        method: 'POST',
        mode: 'cors',
        body: params,
    })

    .then((data) => {
        console.log('Success:', data);
      })
    .catch((error) => {
        console.error('Error:', error);
      });
        let str = 'add-'+elem;
        console.log(str);
        let add = document.getElementById(str);
        add.style.display = 'block';
        setTimeout(function(){
            add.style.display = 'none';
        }, 1000)
}


