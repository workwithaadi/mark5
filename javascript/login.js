const form=document.getElementById("form");

form.addEventListener('submit',function(e){
    e.preventDefault();

    const formdata= new FormData(this);

    fetch('login.php',{
        method:'POST',
        body:formdata
    }).then(function(response){
        return response.text();
    }).then(function(text){
        console.log(text);
    }).catch(function(error){
        console.error(error);        
    })
});