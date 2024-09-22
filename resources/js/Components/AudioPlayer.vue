<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import IconPlay from '@/Components/vristo/icon/icon-play.vue';
import IconPause from '@/Components/vristo/icon/icon-pause.vue';
// Props
const props = defineProps({
    position: {
        type: String,
        default: 'right'
    },
    audioSrc: {
        type: String,
        required: true, // Ruta del archivo de audio
    }
});

// Refs y variables
const audioElement = ref(null); // Para manejar el elemento audio
const isPlaying = ref(false); // Estado de reproducción
const currentTime = ref(0); // Tiempo actual de reproducción
const duration = ref(0); // Duración total del audio
const progress = ref(0); // Progreso del input range

// Función para reproducir o pausar el audio
const togglePlayPause = () => {
    if (!audioElement.value) return;

    if (isPlaying.value) {
        audioElement.value.pause();
    } else {
        audioElement.value.play();
    }
};

// Función para actualizar el progreso y el tiempo restante
const updateProgress = () => {
    if (audioElement.value) {
        currentTime.value = audioElement.value.currentTime;
        progress.value = (audioElement.value.currentTime / audioElement.value.duration) * 100;
    }
};

// Manejar el evento "play" y "pause" para actualizar el ícono
onMounted(() => {
    if (audioElement.value) {
        audioElement.value.addEventListener('play', () => {
            isPlaying.value = true;
        });

        audioElement.value.addEventListener('pause', () => {
            isPlaying.value = false;
        });

        audioElement.value.addEventListener('timeupdate', updateProgress);
        audioElement.value.addEventListener('loadedmetadata', () => {
            duration.value = audioElement.value.duration;
        });

        audioElement.value.addEventListener('ended', () => {
            isPlaying.value = false;
            progress.value = 0;
            currentTime.value = 0;
        });
    }
});

// Limpiar los eventos cuando se desmonta el componente
onUnmounted(() => {
    if (audioElement.value) {
        audioElement.value.removeEventListener('timeupdate', updateProgress);
    }
});

// Función para formatear el tiempo
const formatTime = (time) => {
    const minutes = Math.floor(time / 60);
    const seconds = Math.floor(time % 60);
    return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
};
</script>

<template>
    <div class="flex items-center space-x-2 rtl:space-x-reverse">
        <!-- Botón de Play/Pause -->
        <button 
            @click="togglePlayPause"
            type="button"
            :class="position == 'right' ? 'bg-gray-200 hover:bg-gray-200 text-blue-500' : 'bg-blue-500 hover:bg-blue-700 text-gray-200'"
            class="inline-flex self-center items-center p-2 text-sm font-medium text-center rounded-lg focus:ring-4 focus:outline-none focus:ring-gray-50"
        >
            <!-- Icono de Play/Pause -->
            <icon-play v-if="!isPlaying" class="w-4 h-4" />
            
            <icon-pause v-else class="w-4 h-4"  />
        </button>

        <!-- Barra de progreso -->
        <div>
            <input
                type="range"
                :value="progress"
                class="w-full h-2 rounded-lg appearance-none cursor-pointer dark:bg-gray-100"
                :class="position == 'right' ? 'bg-gray-200' : 'bg-blue-500 '"
            />
        </div>

        <!-- Tiempo restante -->
        <span
            :class="position == 'right' ? 'text-white' : 'text-blue-800'"
            class="inline-flex self-center items-center p-2 text-sm font-medium"
        >
            {{ formatTime(duration - currentTime) }}
        </span>
    </div>

    <!-- Elemento de audio oculto -->
    <audio ref="audioElement" :src="audioSrc"></audio>
</template>
