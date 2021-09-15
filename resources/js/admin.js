require('./bootstrap');

const deleteForm = document.querySelectorAll('.delete-post-form');

deleteForm.forEach(item => {
    item.addEventListener('submit', function(e){
        
        const resp = confirm('Confermare la cancellazione del dato?');

        if(!resp){
            e.preventDefault();
        }
    })
    
});