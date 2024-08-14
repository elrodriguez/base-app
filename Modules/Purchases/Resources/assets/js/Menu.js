import { faCartShopping, faFile } from "@fortawesome/free-solid-svg-icons";

const menuPurchases = {
    status: false,
    text: "Compras",
    icom: faCartShopping,
    route: 'module',
    permissions: "purc_dashboard",
    items: [
        {
            route: route("purc_documents_list"),
            status: false,
            text: "Documentos",
            permissions: "purc_documentos_listado",
            icom: faFile,
        },
        // {
        //     route: route("clients.index"),
        //     status: false,
        //     text: "Reporte",
        //     permissions: "purc_reporte",
        //     icom: faCartShopping,
        // },
    ],
};
export default menuPurchases;
