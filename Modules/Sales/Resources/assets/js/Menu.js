import { faCashRegister } from "@fortawesome/free-solid-svg-icons";

const menuSales = {
    status: true,
    text: "Ventas",
    icom: faCashRegister,
    route: 'module',
    permissions: "sale_dashboard",
    items: [
        
        {
            status: false,
            route: null,
            text: "Administración",
            permissions: "productos",
            items: [
                {
                    status: false,
                    route: route("sale_brands_product_list"),
                    text: "Marcas",
                    permissions: "sale_marcas",
                },
                {
                    status: false,
                    route: route("sale_category_product_list"),
                    text: "Categoría",
                    permissions: "sale_categorias",
                },
                {
                    status: false,
                    route: route("products.index"),
                    text: "Productos",
                    permissions: "sale_marcas",
                },
                {
                    status: false,
                    route: route("sales_services"),
                    text: "Servicios",
                    permissions: "sale_servicios",
                },
            ]
        },
        {
            route: route("establishments.index"),
            status: false,
            text: "Tiendas",
            permissions: "sale_tienda",
        },
        {
            route: route("sales.index"),
            status: false,
            text: "Punto de venta (POS)",
            permissions: "punto_ventas",
        },
        {
            route: route("sale_physical_document_list"),
            status: false,
            text: "Documento Físico",
            permissions: "sale_documento_fisico",
        },
        {
            route: route("reports"),
            status: false,
            text: "Reportes",
            permissions: "sale_reportes",
        },
    ],
};
export default menuSales;
