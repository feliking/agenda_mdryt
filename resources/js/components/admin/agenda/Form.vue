<template v-slot:top>
  <v-dialog v-model="dialog" max-width="500px" @keydown.enter="save()">
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
              <v-col cols="12">
                <v-text-field 
                  v-model="selectedItem.nombre" 
                  label="Nombre"
                  :rules="[v => !!v || 'Requerido', v => (v && v.length <= 50) || 'No mayor a 50 caracteres']">
                </v-text-field>
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
      error: ''
    };
  },
  created() {},  
  mounted() {
    this.bus.$on("openDialog", item => {
      this.selectedItem = item;
      this.dialog = true;
      this.selectedIndex = item;
    });
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
      try {
        if (this.$refs.form.validate()) {
          if (this.selectedIndex != -1) {
            await axios.put("api/ciudad/"+this.selectedItem.id, this.selectedItem)
          } else {
            await axios.post("api/ciudad", this.selectedItem)
          }
          this.$toast.success('Correcto.')
          this.close();
        }
      } catch(e) {
        console.log(e)
      }
    },
    async codevalidate(){
      var params = {'codigo': this.selectedItem.codigo}
      let res = await axios.get('api/departamento/show_fill/'+JSON.stringify(params))
      if(res.data.length > 0){
        this.error = 'El codigo ya existe'
      }
      else{
        this.error = ''
      }
    },
    async getZonasProductivas() {
      let res = await axios.get("api/zona_autorizada")
      this.zonas_productivas = res.data
    },
  },  
};
</script>