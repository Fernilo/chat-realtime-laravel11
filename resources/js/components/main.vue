<template>
  <div>
    <ChatBox :root-url="rootUrl" />
  </div>
</template>

<script>
import ChatBox from './ChatBox.vue';

export default {
  components: {
    ChatBox,
  },
  data() {
    return {
      rootUrl: "http://localhost:80",
    };
  },
};
</script>