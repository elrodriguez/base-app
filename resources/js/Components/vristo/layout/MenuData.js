import { 
    faPoll, 
    
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
import menuOnlineshop from 'Modules/Onlineshop/Resources/assets/js/Menu.js';

const MenuData = ref([
    {
        status: false,
        text: 'Dashboard',
        icom: faPoll,
        route: route('dashboard'),
        permissions: 'dashboard',
    },
    menuConfig,
    menuPurchases,
    menuSales[0],
    menuSales[1],
    menuOnlineshop,
    // menuHelpdesk,
    menuCMS,
    menuHealth,
    menuAcademic,
    // menuRestaurant,
    // menuSocialevents,
    menuCRM
]);
export default MenuData;
