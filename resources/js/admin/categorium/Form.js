import AppForm from '../app-components/Form/AppForm';

Vue.component('categorium-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                nombre:  '' ,
                slug:  '' ,
                descripcion:  '' ,
                estado:  false ,
                
            }
        }
    }

});