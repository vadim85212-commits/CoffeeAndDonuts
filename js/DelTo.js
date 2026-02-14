function DelTo(elem){
    let data = { id: elem };
    let params = new FormData();
    for (i in data){
        params.append(i, data[i]);
    }

    fetch('php/Del.php', {
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