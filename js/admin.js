document.addEventListener('DOMContentLoaded', function () {

    var admin_contant_ifram = document.getElementById('admin_contant');
    var manage_product_btn = document.getElementById('manage_product');
    var manage_client_btn = document.getElementById('manage_client');
    var manage_ordes_btn = document.getElementById('manage_ordes');
    var manage_commande_btn = document.getElementById('manage_commande');

    var home = document.getElementById('dashboard_admin');
    console.log(home);

    /// to change the contante of iframe
    home.addEventListener('click', () => {
        admin_contant_ifram.src = "./dashboard.php";
    })

    manage_product_btn.addEventListener('click', () => {
        admin_contant_ifram.src = "./manage_product.php";
    });

    manage_client_btn.addEventListener('click', () => {
        admin_contant_ifram.src = "./manage_client.php";
    });

    manage_ordes_btn.addEventListener('click', () => {
        admin_contant_ifram.src = "./manage_orders.php";
    });

    manage_commande_btn.addEventListener('click', () => {
        admin_contant_ifram.src = "./manage_commande.php";
    });
});