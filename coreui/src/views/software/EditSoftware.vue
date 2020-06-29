<template>
  <CRow>
    <CCol col="12" lg="6">
      <CCard>
        <CCardBody>
          <h3>
            Edit Software id:  {{ $route.params.id }}
          </h3>
          <CAlert
            :show.sync="dismissCountDown"
            color="primary"
            fade
          >
            ({{dismissCountDown}}) {{ message }}
          </CAlert>
             <CInput label="Nombre" type="text" placeholder="Nombre" v-model="software.nombre"></CInput>
            <CInput label="Descripcion" type="text" placeholder="Descripcion" v-model="software.descripcion"></CInput>
               <h4>Asignar Lenguajes:</h4>
               <CInputCheckbox
                v-for="lenguaje in lenguajes"
                v-bind:key="lenguaje.nombre"
                :label="lenguaje.nombre"
                 value="true"
                :checked="lenguajesArray[lenguaje.id]"
                @update:checked="checkLenguajeCheckbox(lenguaje.id)"
              />
               <h4>Asignar Funcionalidades:</h4>
               <CInputCheckbox
                v-for="funcionalidad in funcionalidades"
                v-bind:key="funcionalidad.id"
                :label="funcionalidad.nombre"
                 value="true"
                :checked="funcionalidadesArray[funcionalidad.id]"
                @update:checked="checkFuncionalidadCheckbox(funcionalidad.id)"
              />
          
              <CInputFile
                type="file"
                v-on:change="onFileChange"
                placeholder="NuevaImagen"
            />
            <div class="c-avatar">
            <img
              label="Preview"
              v-if="software.imagen" :src="software.imagen"
              class="c-avatar-img "
            />
          </div>
          <CButton color="primary" @click="update()">Save</CButton>
          <CButton color="primary" @click="goBack">Back</CButton>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'
export default {
  name: 'EditSoftware',
  props: {
    caption: {
      type: String,
      default: 'Software id'
    },
  },
  data: () => {
    return {
       software: {
          nombre: '',
          descripcion: '',
          imagen:'',
          lenguaje:[],
          funcionalidad:[]
        },
        lenguajesArray: [],
        lenguajes: [],
        funcionalidadesArray: [],
        funcionalidades: [],
        imagen_file:null,
        message: '',
        dismissSecs: 7,
        dismissCountDown: 0,
    }
  },
  methods: {
    goBack() {
      this.$router.go(-1)
      
    },
   checkLenguajeCheckbox(idLenguaje){
        // Quito o agrego el id del lenguaje del array para luego hacer el save 
      if(this.software.lenguaje.indexOf(idLenguaje)!=-1){
        this.software.lenguaje.splice(this.software.lenguaje.indexOf(idLenguaje), 1 );
      }else{
        this.software.lenguaje.push(idLenguaje);
      }
    },
    checkFuncionalidadCheckbox(idFuncionalidad){
        // Quito o agrego el id del lenguaje del array para luego hacer el save 
      if(this.software.funcionalidad.indexOf(idFuncionalidad)!=-1){
        this.software.funcionalidad.splice(this.software.funcionalidad.indexOf(idFuncionalidad), 1 );
      }else{
        this.software.funcionalidad.push(idFuncionalidad);
      }
    },
    onFileChange(files,e) {
       // En caso que cambie la imagen , se muestra el preview 
      this.imagen_file=files[0];
    },
    uploadImage(){
      // Subo la imagen con form-data , lo ideal hubiece sido setear el Content-type del axios , pero no encontré la forma 
        let self = this;
          const URL =  'api/software/uploadImage/' +  self.$route.params.id  + '?token=' + localStorage.getItem("api_token"); 
            let data = new FormData();
            // Paso la imagen a un campo imagen dentro del nuevo formulario
            data.append('imagen', this.imagen_file);
            let config = {
              headers : {
                'Content-Type' : 'multipart/form-data'
              }
            }
            axios.post(
              URL, 
              data,
              config
            ).then(
              response => {
                // Retorno la url de la imagen subida para hacer el preview
                self.software.imagen=response.data.path;
                
              }
            )
    },
    update() {
        let self = this;
        axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
        axios.post(  '/api/software/' + self.$route.params.id + '?token=' + localStorage.getItem("api_token"),
       // Paso las variables a un objeto
       {
          
            _method: 'PUT',
            nombre:            self.software.nombre,
            descripcion:          self.software.descripcion,
            imagen:          self.software.imagen,
            lenguaje:      self.software.lenguaje,
            funcionalidad:      self.software.funcionalidad
        })
        .then(function (response) {
          //Despues de actualizar los registros , subo la imagen ,dentro de la funcion está el id 
          // de software
            self.uploadImage();
            self.message = 'Software actualizado correctamente.';
            self.showAlert();
        }).catch(function (error) {
          // Dta invalido
            if(error.response.data.message == 'Data invalido.'){
              self.message = '';
              for (let key in error.response.data.errors) {
                if (error.response.data.errors.hasOwnProperty(key)) {
                  self.message += error.response.data.errors[key][0] + '  ';
                }
              }
              self.showAlert();
            }else{
              self.$router.push({ path: '/login' }); 
            }
        });
    },
    showAlert () {
      this.dismissCountDown = this.dismissSecs
    },
  },
  mounted: function(){
    let self = this;
    axios.get(  '/api/software/' + self.$route.params.id + '/edit?token=' + localStorage.getItem("api_token"))
    .then(function (response) {
      //Obtener Lenguaje Seleccionado
      self.software = response.data.software;
       let lenguajesSeleccionado =  response.data.lenguajeSeleccionado;
       let funcionalidadesSeleccionado =  response.data.funcionalidadSeleccionado;
        self.lenguajes = response.data.lenguajes;
        self.funcionalidades = response.data.funcionalidades;
        //Dejo vacio el arrego de lenguajes
        self.software.lenguaje=[];
        self.software.funcionalidad=[];
        self.lenguajesArray = [];
        self.funcionalidadesArray = [];
         for(let i=0; i<self.lenguajes.length; i++){
           //Busco que lenguajes está seleccionado 
             let existe = lenguajesSeleccionado.find(function(lenguaje, index) {
              if(lenguaje.lenguaje_id == self.lenguajes[i].id)
                return true;
            });
           if( typeof existe !="undefined"){
             //Dejo el lenguaje seleccionado en un arreglo, que es parte de la propiedad
              self.software.lenguaje.push(self.lenguajes[i].id);
              self.lenguajesArray[self.lenguajes[i].id] = true;     
           }else{
             //Lenguaje no seleccionado
             self.lenguajesArray[self.lenguajes[i].id] = false;
           }
        }
         for(let i=0; i<self.funcionalidades.length; i++){
           //Busco que funcionalidades está seleccionado 
             let existe = funcionalidadesSeleccionado.find(function(funcionalidad, index) {
              if(funcionalidad.funcionalidad_id == self.funcionalidades[i].id)
                return true;
            });
           if( typeof existe !="undefined"){
             //Dejo funcionalidad seleccionado en un arreglo, que es parte de la propiedad
              self.software.funcionalidad.push(self.funcionalidades[i].id);
              self.funcionalidadesArray[self.funcionalidades[i].id] = true;     
           }else{
             //Lenguaje no seleccionado
             self.funcionalidadesArray[self.funcionalidades[i].id] = false;
           }
        }
           
    }).catch(function (error) {
        console.log(error);
        self.$router.push({ path: '/login' });
    });
  }
}


</script>
