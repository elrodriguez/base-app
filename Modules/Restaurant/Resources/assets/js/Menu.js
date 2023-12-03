import { faBellConcierge } from "@fortawesome/free-solid-svg-icons";

const menuRestaurant = {
    status: false,
    text: "Restaurante",
    icom: faBellConcierge,
    route: null,
    permissions: "res_dashboard",
    items: [
        {
            route: route("res_comandas_list"),
            status: false,
            text: "Comandas",
            permissions: "res_comandas",
        },
    ],
};

export default menuRestaurant;
