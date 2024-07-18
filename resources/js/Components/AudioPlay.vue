
  
<script setup>

    const props = defineProps({
        audio: {
            type: String,
            default: null
        },
        stclass: {
            type: String,
            default: null
        }
    });
</script>
<template>
    <div class="audio-wrapper block w-full max-w-md mx-auto" >
      <audio controls :class="stclass == 'right' ? 'audio-right' : 'audio-left'">
        <source :src="audio" type="audio/mpeg">
      </audio>
    </div>
  </template>
  
<style>
audio{
    border-radius: 0.375rem;
}
.audio-right{
    border-bottom-right-radius: 0px;

}
.audio-left{
    border-bottom-left-radius: 0px;
}
</style>