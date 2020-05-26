const alerta = {
    outTime: 2000,
    type: 'danger',
    setType: function(type){
        this.type = type;
    },
    create: function(){
        let div = document.createElement('div');
        div.classList.add('alert',`alert-${this.type}`);
        return div;
    },
    show: function(message,type){
        this.setType(type);
        let alerta = this.create();
        alerta.innerHTML = message;
        document.body.appendChild(alerta);
        setTimeout(()=>this.hide(alerta),this.outTime);
    },
    hide: function(element){
        document.body.removeChild(element);
    }
}