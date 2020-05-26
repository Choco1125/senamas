const spinner = {
    create: function(){
        let div = document.createElement('div');
        div.classList.add('spinner-border','spinner-border-sm');
        div.setAttribute('id','loader');
        return div;
    },
    show: function(parent){
        let spinner = this.create();
        parent.setAttribute('disabled','');
        parent.appendChild(spinner);
    },
    hide: function(parent){
        let spinner = document.getElementById('loader');
        parent.removeAttribute('disabled');
        parent.removeChild(spinner);

    }
}