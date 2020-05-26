let errores = {
    setError: function(elemento){
        elemento.classList.add('is-invalid');

        elemento.addEventListener('keypress',()=>{
            elemento.classList.remove('is-invalid');
        });
        elemento.addEventListener('change',()=>{
            elemento.classList.remove('is-invalid');
        });
    },
    isEmpty: function(elemento){
        return elemento.value == '' ? true : false;
    },
    count_errors: function(){
        return document.getElementsByClassName('is-invalid').length;
    },
    setById: function(id){
        this.setError(document.getElementById(id));
    }
}