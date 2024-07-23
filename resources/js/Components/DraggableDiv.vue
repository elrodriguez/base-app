<template>
    <div
        v-show="isVisible"
        ref="draggableDiv"
        class="draggable bottom-0 left-4 w-full max-w-md bg-gray-900 rounded-md shadow-lg p-4 bg-[#0e1726]/90 text-white text-2xl"
        :class="['draggable', isDragging ? 'dragging' : '']"
        @mousedown="dragStart"
        @mouseup="dragEnd"
        @mousemove="drag"
    >
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-100">
            <slot name="title" />
            </h2>
            <button class="text-gray-100 hover:text-gray-50" @click="handleClose()" >
                <IconX />
            </button>
        </div>
        <div class="mt-4">
            <slot name="content" />
        </div>
    </div>
</template>
  

<script>
import IconX from '@/Components/vristo/icon/icon-x.vue';

export default {
    name: 'DraggableDiv',
    props: {
        isVisible: {
            type: Boolean,
            default: false
        },
        onClose: {
            type: Function,
            default: null
        }
    },
    data() {
        return {
        isDragging: false,
        isMouseDown: false,
        currentX: null,
        currentY: null,
        initialX: null,
        initialY: null,
        xOffset: 0,
        yOffset: 0,
        };
    },
    methods: {
        dragStart(e) {
            if (e.target === this.$refs.draggableDiv || e.target.classList.contains('text-gray-100')) {
                this.isMouseDown = true;
                this.initialX = e.clientX - this.xOffset;
                this.initialY = e.clientY - this.yOffset;
                this.isDragging = true;
            }
        },
        dragEnd(e) {
            this.isMouseDown = false;
            this.initialX = this.currentX;
            this.initialY = this.currentY;
            this.isDragging = false;
        },
        drag(e) {
            if (this.isMouseDown && this.isDragging) {
                e.preventDefault();

                this.currentX = e.clientX - this.initialX;
                this.currentY = e.clientY - this.initialY;

                this.xOffset = this.currentX;
                this.yOffset = this.currentY;

                this.setTranslate(this.currentX, this.currentY, this.$refs.draggableDiv);
            }
        },
        setTranslate(xPos, yPos, el) {
            el.style.transform = `translate3d(${xPos}px, ${yPos}px, 0)`;
        },
        handleClose() {
            if (this.onClose) {
                this.onClose();
            }
        }
    },
    components: {
        IconX,
    },
};

</script>

<style scoped>
    .draggable {
        position: absolute;
        cursor: move;
        z-index: 10000000 !important;
    }
    .dragging {
        background-color: rgba(14, 23, 38, 0.75); /* Ajusta el color según tus preferencias */
    }
</style>
