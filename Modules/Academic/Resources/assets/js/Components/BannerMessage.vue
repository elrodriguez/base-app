<script setup>
import { Link } from '@inertiajs/vue3';
import { notification, message } from 'ant-design-vue';
import { onMounted, ref } from 'vue';

const coursesTeacherNullData = ref([]);

const getCoursesTeacherNull = () => {
    axios.get(route('courses_teacher_null')).then((res) => {
        coursesTeacherNullData.value = res.data.courses;
    });
}

onMounted(() => {
    getCoursesTeacherNull();
});
</script>

<template>
   <div v-if="coursesTeacherNullData.length > 0">
    <div class="aracode-message">
        <div class="aracode-message-notice">
            <div class="aracode-message-notice-content">
                <span role="img" aria-label="info-circle" class="aracodeicon aracodeicon-info-circle">
                    <svg focusable="false" data-icon="info-circle" width="1em" height="1em" fill="currentColor" aria-hidden="true" viewBox="64 64 896 896"><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm32 664c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V456c0-4.4 3.6-8 8-8h48c4.4 0 8 3.6 8 8v272zm-32-344a48.01 48.01 0 010-96 48.01 48.01 0 010 96z"></path></svg>
                </span>
                <span>Existen {{ coursesTeacherNullData.length }} cursos que no tienen DOCENTE asignado</span>
            </div>
        </div>
    </div>
   </div> 
</template>
<style>
.aracode-message {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    color: rgba(0, 0, 0, 0.88);
    font-size: 14px;
    line-height: 1.5714285714285714;
    list-style: none;
    font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';
    position: fixed;
    top: 8px;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    pointer-events: none;
    z-index: 999999;
}
.aracode-message{
    box-sizing: border-box;
}
.aracode-message-notice {
    padding: 8px;
    text-align: center;
}
.aracode-message-notice .aracode-message-notice-content {
    display: inline-block;
    padding: 9px 12px;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 6px 16px 0 rgba(0, 0, 0, 0.08),0 3px 6px -4px rgba(0, 0, 0, 0.12),0 9px 28px 8px rgba(0, 0, 0, 0.05);
    pointer-events: all;
}
.aracode-message-notice .aracode-message-loading .aracodeicon {
  color: #1677ff;
}
.aracode-message-notice .aracodeicon {
    vertical-align: text-bottom;
    margin-inline-end: 8px;
    font-size: 16px;
}
.aracodeicon {
    display: inline-block;
    color: #1677ff;
    font-style: normal;
    line-height: 0;
    text-align: center;
    text-transform: none;
    vertical-align: -0.125em;
    text-rendering: optimizeLegibility;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
</style>