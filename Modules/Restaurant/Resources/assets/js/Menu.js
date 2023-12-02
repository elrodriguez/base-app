import { faBellConcierge } from "@fortawesome/free-solid-svg-icons";

const menuRestaurant = {
    status: false,
    text: "Restaurante",
    icom: faBellConcierge,
    route: null,
    permissions: "res_dashboard",
    items: [
        {
            route: route("aca_institutions_list"),
            status: false,
            text: "Categorías",
            permissions: "res_categorias",
        },
        {
            route: route("aca_teachers_list"),
            status: false,
            text: "Comandas",
            permissions: "res_comandas",
        },
    ],
};

export default menuRestaurant;
