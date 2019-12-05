<template>
  <v-container fluid>
    <v-toolbar>
        <v-toolbar-title>Departamentos</v-toolbar-title>
        <v-spacer></v-spacer>        
        <v-divider
          class="mx-2"
          inset
          vertical
        ></v-divider>
        <v-toolbar-title>
          <v-text-field
              v-model="search"
              append-icon="search"
              label="Buscar"
              single-line
              hide-details
              width="20px"
            ></v-text-field>
        </v-toolbar-title>
        <v-divider
          class="mx-2"
          inset
          vertical
        ></v-divider>
        <Form :bus="bus"/>
        <RemoveItem :bus="bus"/>
    </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="table"
      :search="search"
      class="elevation-1"
      :loading="loading" 
      loading-text="Cargando... Espere por favor"
    >
      <template v-slot:item.action="{ item }">
        <v-icon
          small
          class="mr-2"
          @click="editItem(item)"
        >
          edit
        </v-icon>
        <v-icon
          small
          @click="removeItem(item)"
        >
          delete
        </v-icon>
      </template>
      <v-alert slot="no-results" :value="true" color="error" icon="fa fa-times">
        Tu Busqueda de "{{ search }}" no encontró resultados.
      </v-alert>
      <template slot="no-data">
        <v-alert slot="no-results" :value="true" color="info" icon="fa fa-times">
          Sin resultados.
        </v-alert>
      </template>
    </v-data-table>
  </v-container>
</template>
<script type="text/javascript">
import Vue from "vue";
import axios from 'axios'
import RemoveItem from "../RemoveItem";
import Form from "./Form";

export default {
  components: {
    RemoveItem,
    Form,
  },
  data: () => ({
    bus: new Vue(),
    headers: [
      {
        text: "Nombre",
        value: "nombre",
        align: "center"
      },
      {
        text: "Opciones",
        align: "center",
        sortable: false,
        value: "action"
      }
    ],
    table: [],
    search: "",
    loading: true
  }),
  computed: {},
  mounted() {
    this.getTable();
    this.bus.$on("closeDialog", () => {
      this.getTable();
    });
  },
  methods: {
    async getTable() {
      try {
        let res = await axios.get("api/ciudad")
        this.table = res.data;
        this.loading = false
      } catch (e) {
        console.log(e);
      }
    },
    editItem(item) {
      this.bus.$emit("openDialog", item);
    },
    async removeItem(item) {
      this.bus.$emit("openDialogRemove", `api/ciudad/${item.id}`);      
    },
  }
};
</script>
