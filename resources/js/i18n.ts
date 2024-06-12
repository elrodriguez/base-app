import { createI18n } from 'vue-i18n';
import es from '@/Locales/es';
import en from '@/Locales/en';

export default createI18n({
    legacy: false,
    allowComposition: true,
    locale: 'es',
    globalInjection: true,
    fallbackLocale: 'es',
    messages: {
        es,
        en
    }
});
