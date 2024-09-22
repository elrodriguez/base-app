import { defineStore } from 'pinia';

export const useSharedStore = defineStore('shared', {
    state: () => ({
        notification: null,
        showDiv: false,
    }),
    actions: {
        updateChatBox(newNotification) {
            this.notification = newNotification;
            this.persistData();  // Guardar en localStorage cada vez que se actualice el chat
        },
        toggleChatBoxVisibility() {
            this.showDiv = !this.showDiv;
            this.persistData();  // Guardar en localStorage cada vez que se cambie la visibilidad
        },
        // Método para guardar el estado en localStorage
        persistData() {
            localStorage.setItem('sharedStore', JSON.stringify(this.$state));
        },
        // Método para cargar el estado desde localStorage
        loadPersistedData() {
            const data = localStorage.getItem('sharedStore');
            if (data) {
                this.$state = JSON.parse(data);  // Cargar el estado guardado
            }
        }
    }
});
