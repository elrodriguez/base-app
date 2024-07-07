import { 
    faPoll, 
    faBolt,
    faFileInvoice,
    faListOl,
    faListCheck,
    faFileExport
} from "@fortawesome/free-solid-svg-icons";
import { ref } from 'vue';
import menuAcademic from 'Modules/Academic/Resources/assets/js/Menu.js';
import menuRestaurant from 'Modules/Restaurant/Resources/assets/js/Menu.js';
import menuSales from 'Modules/Sales/Resources/assets/js/Menu.js';
import menuPurchases from 'Modules/Purchases/Resources/assets/js/Menu.js';
import menuConfig from 'Modules/Security/Resources/assets/js/Menu.js';
import menuCMS from 'Modules/CMS/Resources/assets/js/Menu.js';
import menuSocialevents from 'Modules/Socialevents/Resources/assets/js/Menu.js';
import menuHelpdesk from 'Modules/Helpdesk/Resources/assets/js/Menu.js';
import menuHealth from 'Modules/Health/Resources/assets/js/Menu.js';
import menuCRM from 'Modules/CRM/Resources/assets/js/Menu.js';

const MenuData = ref([
    {
        status: false,
        text: 'Dashboard',
        icom: faPoll,
        route: route('dashboard'),
        permissions: 'dashboard',
    },
    menuConfig,
    // menuPurchases,
    menuSales,
    // {
    //     status: false,
    //     text: 'Ventas en línea',
    //     icom: faGlobe,
    //     route: 'module',
    //     permissions: 'onli_dashboard',
    //     items: [
    //         {
    //             route: route('onlineshop_items'),
    //             status: false,
    //             text: 'Productos & servicios',
    //             permissions: 'onli_items',
    //         },
    //         {
    //             route: route('onlineshop_sales'),
    //             status: false,
    //             text: 'Pedidos',
    //             permissions: 'onli_pedidos',
    //         },
    //     ]
    // },
    {
        status:false,
        text: 'Facturación Electrónica',
        icom: faBolt,
        route: 'module',
        permissions: 'invo_dashboard',
        items: [
            {
                route: route('saledocuments_create'),
                status: false,
                text: 'Crear Documento',
                permissions: 'invo_documento',
                icom: faFileInvoice,
            },
            {
                route: route('saledocuments_list'),
                status: false,
                text: 'Lista de Documentos',
                permissions: 'invo_documento_lista',
                icom: faListOl,
            },
            {
                route: route('salesummaries_list'),
                status: false,
                text: 'Resumen',
                permissions: 'invo_resumenes_lista',
                icom: faListCheck,
            },
            {
                route: route('low_communication_list'),
                status: false,
                text: 'Comunicacion de Baja',
                permissions: 'invo_comunicacion_baja',
                icom: faFileExport,
            }
        ]
    },
    // menuHelpdesk,
    menuCMS,
    menuHealth,
    menuAcademic,
    // menuRestaurant,
    // menuSocialevents,
    menuCRM
]);
export default MenuData;
