<template v-slot:top>
  <v-dialog v-model="dialog" max-width="900px" @keydown.enter="save()">
    <template v-slot:activator="{ on }">
      <v-icon large v-on="on">add_circle</v-icon>
    </template>
    <v-card>
      <v-card-title>
        <span class="headline">{{ formTitle }}</span>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-form ref="form" v-model="valid" lazy-validation @submit.prevent>
            <v-row>
              <v-col cols="12" sm="6" md="6">
                <v-text-field 
                  v-model="selectedItem.nombre" 
                  label="Nombre Completo"
                  :rules="[v => !!v || 'Requerido']">
                </v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="6">
                <v-text-field 
                  v-model="selectedItem.grado_academico" 
                  label="Grado Académico"
                  :rules="[v => !!v || 'Requerido']">
                </v-text-field>
              </v-col>
              <v-col cols="12" sm="12" md="12">
                <v-textarea
                  v-model="selectedItem.frase"
                  label="Frase llamativa"
                  :rules="[v => !!v || 'Requerido']"
                  hint="<span class='white--text'>Alguna frase que te motive</span>" persistent-hint>
                </v-textarea>
              </v-col>
              <v-col cols="12" sm="6" md="6">
                <v-text-field 
                  v-model="selectedItem.telefono" 
                  label="Teléfono - Celular"
                  :rules="[v => !!v || 'Requerido']">
                </v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="6">
                <v-text-field 
                  v-model="selectedItem.email" 
                  label="Corréo Electrónico"
                  :rules="[v => !!v || 'Requerido']">
                </v-text-field>
              </v-col>
              <v-col cols="12" sm="12" md="12">
                <v-textarea
                  v-model="selectedItem.biografia"
                  label="Biografía"
                  :rules="[v => !!v || 'Requerido']"
                  hint="<span class='white--text'>Un pequeño resumen y lo más relevante</span>" persistent-hint>
                </v-textarea>
              </v-col>
              <v-col cols="12" sm="4" md="4">
                <v-menu
                  v-model="menu"
                  :close-on-content-click="false"
                  :nudge-right="40"
                  transition="scale-transition"
                  offset-y
                  max-width="290px"
                  min-width="290px"
                >
                <template v-slot:activator="{ on }">
                  <v-text-field
                    v-model="birth_date_formatted"
                    label="Fecha de nacimiento"
                    prepend-icon="event"
                    readonly
                    v-on="on"
                    :rules="[v => !!v || 'Requerido']"
                    hint="<span class='blue--text'>*Requerido</span>" persistent-hint
                    class="mr-2"
                  ></v-text-field>
                </template>
                  <v-date-picker 
                    v-model="birth_date" 
                    no-title 
                    @input="menu = false" 
                    locale="ES"
                    ref="picker">
                  </v-date-picker>
                </v-menu>
              </v-col>
              <v-col cols="12" sm="4" md="4">
                <v-text-field 
                  v-model="selectedItem.carnet_identidad" 
                  label="Carnet de identidad"
                  :rules="[v => !!v || 'Requerido']">
                </v-text-field>
              </v-col>
              <v-col cols="12" sm="4" md="4">
                <v-select
                  v-model="selectedItem.ciudad_id"
                  :items="ciudades"
                  item-text="nombre"
                  item-value="id"
                  label="Ciudad de nacimiento"
                  :rules="[v => !!v || 'Requerido']">
                ></v-select>
              </v-col>
              <v-col cols="12" sm="6" md="6">
                <v-select
                  v-model="selectedItem.estado_civil"
                  :items="['Soltero', 'Casado', 'Viudo', 'Divorciado']"
                  label="Estado civil"
                  :rules="[v => !!v || 'Requerido']">
                ></v-select>
              </v-col>
              <v-col cols="12" sm="6" md="6">
                <v-file-input
                  v-model="selectedItem.fotografia"
                  :rules="[ value => !value || value.size < 2000000 || 'El archivo no debe ser mayor a 2Mb']"
                  accept="image/png, image/jpeg, image/bmp"
                  placeholder="Elija un archivo de imagen"
                  prepend-icon="mdi-camera"
                  label="Fotografía"
                ></v-file-input>
              </v-col>
            </v-row>
          </v-form>
        </v-container>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
        <v-btn color="blue darken-1" :disabled="!valid" text @click="save()">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'

export default {
  props: ["item", "bus"],  
  data() {
    return {      
      valid: true,
      dialog: false,
      selectedIndex: -1,     
      selectedItem: {},
      error: '',
      birth_date: null,
      menu: false,
      birth_date_formatted: null,
      ciudades: []
    };
  },
  watch: {
    birth_date(val){
      val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
      this.selectedItem.fecha_nacimiento = val
      this.birth_date_formatted = this.$moment(val).format("DD/MM/YYYY") || this.$moment().format("DD/MM/YYYY");
    },
  },
  created() {},  
  mounted() {
    this.bus.$on("openDialog", item => {
      this.selectedItem = item;
      this.dialog = true;
      this.selectedIndex = item;
    });
    this.getCiudades()
  },
  computed: {
    formTitle() {
      return this.selectedIndex === -1 ? 'Nuevo ' : 'Editar '
    }    
  },
  methods: {
    close() {
      this.dialog = false;
      this.$refs.form.reset()
      this.bus.$emit("closeDialog");
      this.selectedIndex = -1;
      this.selectedItem = {}
    },
    async save() {
      console.log(this.selectedItem)
      try {
        if (this.$refs.form.validate()) {
          if (this.selectedIndex != -1) {
            await axios.put("api/persona/"+this.selectedItem.id, this.selectedItem)
          } else {
            await axios.post("api/persona", this.selectedItem)
          }
          this.$toast.success('Correcto.')
          this.close();
        }
      } catch(e) {
        console.log(e)
      }
    },
    async getCiudades(){
      try{
        let res = await axios.get('api/ciudad')
        this.ciudades = res.data
      }
      catch(e){
        console.log(e)
      }
    }
  },  
};
</script>