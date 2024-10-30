<template>
  <div class="input-group">
    <input
      v-model="comment"
      type="text"
      class="form-control"
      placeholder="Comentario..."
      autocomplete="off"
    />
    <div class="input-group-append">
      <button @click="sendComment" class="btn btn-primary" type="button">Enviar</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    rootUrl: {
      type: String,
      required: true,
    },
    serviceId: {
      type: Number,
      required: true,
    },
    chatId: {
      type: Number,
      required: true,
    }
  },
  data() {
    return {
      comment: '',
    };
  },
  mounted() {
  console.log("Component mounted");
  
  },
  methods: {
    async commentRequest(comment, serviceId, chatId) {
      try {
      // Axios es una librería de JavaScript que se utiliza para hacer solicitudes HTTP desde el navegador (o Node.js). 
      // Permite interactuar con APIs o servidores remotos enviando solicitudes HTTP como GET, POST, PUT, DELETE, etc., y recibir las respuestas correspondientes. //
        await axios.post(`${this.rootUrl}/comment`, { comment, serviceId, chatId });
      } catch (err) {
        console.error(err.comment);
      }
    },
    sendComment() {
      if (this.comment.trim() === '') {
        alert('Por favor ingrese un comentario válido!');
        return;
      }
 
      this.commentRequest(this.comment, this.serviceId, this.chatId);
      this.comment = '';
    },
  },
};
</script>