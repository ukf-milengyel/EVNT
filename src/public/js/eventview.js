async function deleteImage(node, id){
    // confirm deletion
    if (! confirm("Chcete odstrániť túto fotografiu?"))
        return;

    // delete image from current view
    node.remove();

    // send request
    await fetch('http://localhost:8080/event/image/delete', {
        method: 'POST',
        mode: 'cors',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
            'id': id,
        }),
    }).then( (response) => {
        console.log(response.text());
    });
}
