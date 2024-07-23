import { 
    faCube, 
    faGlobe
} from "@fortawesome/free-solid-svg-icons";

const menuOnlineshop = {
    status: false,
    text: 'Ventas en línea',
    icom: faGlobe,
    route: 'module',
    permissions: 'onli_dashboard',
    items: [
        {
            route: route('onlineshop_items'),
            status: false,
            text: 'Productos & servicios',
            permissions: 'onli_items',
            icom: faCube,
        },
        {
            route: route('onlineshop_sales'),
            status: false,
            text: 'Pedidos',
            permissions: 'onli_pedidos',
            icom: faGlobe,
        },
    ]
};
export default menuOnlineshop;
