<!-- HeightTransition.vue -->
<template>
  <transition
    @before-enter="beforeEnter"
    @enter="enter"
    @after-enter="afterEnter"
    @before-leave="beforeLeave"
    @leave="leave"
    @after-leave="afterLeave"
  >
    <div v-show="show">
      <slot></slot>
    </div>
  </transition>
</template>

<script>
export default {
  data() {
    return {
      show: false,
    };
  },
  methods: {
    beforeEnter(el) {
      el.style.height = '0';
      el.style.opacity = '0';
      el.style.display = 'block';
    },
    enter(el) {
      el.style.transition = 'height 0.25s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.25s cubic-bezier(0.4, 0, 0.2, 1)';
      el.style.height = el.scrollHeight + 'px';
      el.style.opacity = '1';
    },
    afterEnter(el) {
      el.style.height = 'auto';
    },
    beforeLeave(el) {
      el.style.height = el.scrollHeight + 'px';
      el.style.opacity = '1';
    },
    leave(el) {
      el.style.transition = 'height 0.25s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.25s cubic-bezier(0.4, 0, 0.2, 1)';
      el.style.height = '0';
      el.style.opacity = '0';
    },
    afterLeave(el) {
      el.style.display = 'none';
    },
    toggle() {
      this.show = !this.show;
    },
  },
};
</script>

<style scoped>
/* No additional styles needed */
</style>
