<template>
  <CRow>
    <CCol col="12" lg="6">
      <CCard no-header>
        <CCardBody>
          <h3>
            Crear software
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
            <CInput label="Url del sitio(colocar direccion compla con http://)" type="text" placeholder="Sitio" v-model="software.url"></CInput>
             <h4>Asignar Lenguajes:</h4>
              <CInputCheckbox
                v-for="(lenguaje,index) in lenguajes"
                v-bind:key="lenguaje"
                :label="lenguaje"
                @update:checked="checkLenguajeCheckbox(index)"
              />
              <h4>Asignar Funcionalidades:</h4>
               <CInputCheckbox
                v-for="(funcionalidad,index) in funcionalidades"
                v-bind:key="funcionalidad"
                :label="funcionalidad"
                @update:checked="checkFuncionalidadCheckbox(index)"
              />
             <CInputFile
                type="file"
                placeholder="NuevaImagen"
                v-on:change="onFileChange"
            />
            <img
              label="Preview"
              v-if="software.imagen" :src="software.imagen"
              class="c-avatar-img "
            />
          <CButton color="primary" @click="store()">Create</CButton>
          <CButton color="primary" @click="goBack">Back</CButton>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'
export default {
  name: 'CreateSoftware',
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
          imagen: '',
          lenguaje: [],
          funcionalidad: [],
          url: '',
        },
        lenguajes: [],
        funcionalidades: [],
        imagen_file:null,
        statuses: [],
        message: '',
        dismissSecs: 7,
        dismissCountDown: 0,
        showDismissibleAlert: false
    }
  },
  methods: {
    goBack() {
      this.$router.go(-1)

    },
    onFileChange(files,e) {
      this.imagen_file=files[0];
    },
     checkLenguajeCheckbox(idLenguaje){
       //Si lo descheckea lo saca del array , caso contrario los deja
      if(this.software.lenguaje.indexOf(idLenguaje)!=-1){
        this.software.lenguaje.splice(this.software.lenguaje.indexOf(idLenguaje), 1 );
      }else{
        this.software.lenguaje.push(idLenguaje);
      }
    },
    checkFuncionalidadCheckbox(idFuncionalidad){
       //Si lo descheckea lo saca del array , caso contrario los deja
      if(this.software.funcionalidad.indexOf(idFuncionalidad)!=-1){
        this.software.funcionalidad.splice(this.software.funcionalidad.indexOf(idFuncionalidad), 1 );
      }else{
        this.software.funcionalidad.push(idFuncionalidad);
      }
    },
    uploadImage(id){
            let self = this;
          const URL =  'api/software/uploadImage/' + id  + '?token=' + localStorage.getItem("api_token"); 
            let data = new FormData();
            data.append('imagen',this.imagen_file);
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
                if(self.software.imagen==!""){
                  self.message = 'Imagen subida correctamente';
                }
                 
                this.imagen_file=null;
              }
            )
    },
    store() {
        let self = this;
        console.log(self.software);
        axios.post(  '/api/software?token=' + localStorage.getItem("api_token"),
          self.software
        )
        .then(function (response) {
          //Seteo las propiedades a vacio
            self.software = {
              nombre: '',
              descripcion: '',
              imagen: '',
              url: '',
              lenguaje: [],
              funcionalidad: []
            };
            self.funcionalidades=[];
            self.lenguajes=[];
            //Recibo el id del software para subir la imagen 
            self.uploadImage(response.data.id);
            self.message = 'Software creado correctamente';
            self.showAlert();
        }).catch(function (error) {
            if(error.response.data.message == 'The given data was invalid.'){
              self.message = '';
              for (let key in error.response.data.errors) {
                if (error.response.data.errors.hasOwnProperty(key)) {
                  self.message += error.response.data.errors[key][0] + '  ';
                }
              }
              self.showAlert();
            }else{
              self.$router.push({ path: 'login' }); 
            }
        });
    },
    countDownChanged (dismissCountDown) {
      this.dismissCountDown = dismissCountDown
    },
    showAlert () {
      this.dismissCountDown = this.dismissSecs
    },
  },
  mounted: function(){
    // Carga la pagina se hace el llamado correspondiente para obtener los datos necesarios para el create
    let self = this;
    axios.get(  '/api/software/create?token=' + localStorage.getItem("api_token"))
    .then(function (response) {
      console.log("response",response);
      //Asigno el listado de lenguajes y funcionalidades  a un array para listarlos checkbox
        self.lenguajes=response.data.lenguajes;
        self.funcionalidades=response.data.funcionalidades;
    }).catch(function (error) {
        console.log(error);
        self.$router.push({ path: 'login' });
    });
  }
}

</script>
