import { App } from 'vue';
declare function install(app: App): void;
import './assets/main.scss';
declare const _default: {
    install: typeof install;
};
export default _default;
export * from './components';
export * from './utils';
export * from './composables';
