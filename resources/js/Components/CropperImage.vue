<template>
    <div>
        <div v-if="isLoading">Cargando imagen...</div>
        <div v-else>
            <figure class="max-w-lg">
                <img v-if="imageSrc" :src="imageSrc" ref="image" alt="Image" class="h-auto max-w-full rounded-lg">
                <img v-else :src="imgDefault" class="h-auto max-w-full rounded-lg" >
                <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Captura de imagen</figcaption>
            </figure>
            <input type="file" ref="input" @change="onChange" class="form-input file:py-2 file:px-4 file:border-0 file:font-semibold p-0 file:bg-success/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-success">
        </div>
    </div>
</template>
<script>
import 'cropperjs/dist/cropper.css';
import Cropper from 'cropperjs';

export default {
  props: {
    aspectRatio: {
      type: Number,
      default: 10 / 10
    },
    viewMode: {
      type: Number,
      default: 2
    },
    imgDefault:{
      type: String,
      default: '/img/image-3@2x.jpg'
    }
  },
  data() {
    return {
      imageSrc: '',
      isLoading: false
    };
  },
  methods: {
    onChange(event) {
      const files = event.target.files;
      if (files && files.length > 0) {
        this.isLoading = true;
        const reader = new FileReader();
        reader.onload = () => {
          this.imageSrc = reader.result;
          this.isLoading = false;
          this.initCropper();
        };
        reader.readAsDataURL(files[0]);
      }
    },
    initCropper() {
      const image = new Image();
      image.src = this.imageSrc;
      image.onload = () => {
        this.cropper = new Cropper(this.$refs.image, {
          aspectRatio: this.aspectRatio,
          viewMode: this.viewMode,
          crop : (event) => {
            this.cropImage()
          }
        });
      };
    },
    cropImage() {
      const croppedCanvas = this.cropper.getCroppedCanvas();
      if (croppedCanvas) {
        this.$emit('onCrop',croppedCanvas.toDataURL());
      }
    },
    resetCropper() {
      this.imageSrc = '';
      if (this.cropper) {
        this.cropper.destroy();
        this.cropper = null;
      }
    }
  }
};
</script>
