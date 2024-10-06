<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Chat Box for {{ service.name }}</div>
        <div class="card-body" style="height: 500px; overflow-y: auto;">
          <div v-for="comment in comments" :key="comment.id">
            <Comment :user-id="user.id" :comment="comment" />
          </div>
          <span ref="scroll"></span>
        </div>
        <div class="card-footer">
          <CommentInput :root-url="rootUrl" :service-id="service.id" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import Comment from './Comment.vue';
import CommentInput from './CommentInput.vue';
import axios from 'axios';

export default {
  components: {
    Comment,
    CommentInput,
  },
  props: {
    rootUrl: {
      type: String,
      required: true,
    },
  },
  setup(props) {
    const userData = document.getElementById('main').getAttribute('data-user');
    const serviceData = document.getElementById('main').getAttribute('data-service');
    const user = JSON.parse(userData);
    const service = JSON.parse(serviceData);
    const webSocketChannel = `chat_7`;

    const comments = ref([]);
    const scroll = ref(null);

    const scrollToBottom = () => {
      if (scroll.value) {
        scroll.value.scrollIntoView({ behavior: 'smooth' });
      }
    };

    const getComments = async () => {
      try {
        const response = await axios.get(`${props.rootUrl}/comments`, {
          params: {
            service_id: service.id,
          },
        });
        comments.value = response.data;
        setTimeout(scrollToBottom, 0);
      } catch (err) {
        console.log(err.comment);
      }
    };

    const connectWebSocket = () => {
      window.Echo.private(webSocketChannel).listen('GotComment', async () => {
        await getComments();
      });
    };

    onMounted(() => {
      getComments();
      connectWebSocket();
    });

    onBeforeUnmount(() => {
      window.Echo.leave(webSocketChannel);
    });

    return {
      user,
      comments,
      scroll,
      rootUrl: props.rootUrl,
      service
    };
  },
};
</script>
