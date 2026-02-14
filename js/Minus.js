function Minus(elem){
    let data = { id: elem };
    let params = new FormData();
    for (i in data){
        params.append(i, data[i]);
    }

    fetch('./php/QuantMinus.php', {
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
    Reload(time);
}