import AppForm from '../app-components/Form/AppForm';

Vue.component('palabra-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                nombre:  '' ,
                slug:  '' ,
                descripcion:  '' ,
                estado:  false ,
                link:  '' ,
                categoria_id:  '' ,
                
            }
        }
    }

});