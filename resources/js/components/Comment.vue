<template>
  <div :class="['row', userId === comment.user_id ? 'justify-content-end' : '']">
    <div class="col-md-6">
      <small class="text-muted">
        <strong>{{ comment.user.name }} | </strong>
      </small>
      <small class="text-muted float-right">
        {{ comment.time }}
      </small>
      <div :class="['alert', userId === comment.user_id ? 'alert-primary' : 'alert-secondary']" role="alert">
        {{ comment.message }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    userId: {
      type: Number,
      required: true,
    },
    comment: {
      type: Object,
      required: true,
    },
  },
};
</script>