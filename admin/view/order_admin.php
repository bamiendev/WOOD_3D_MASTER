<?php
$html_show_order = show_order_admin($order_admin);

?>
<!-- Order -->
<main>
    <div class="header">
        <div class="row">
            <div class="col-12 col-lg-3">
                    <button type="button" class="btn btn-secondary">Secondary</button>
            </div>
        </div>

        <h1>Orders</h1>

        <nav>
            <a href="#" class="notif"> <i class='bx bx-bell'></i><span class="count">12</span></a>
        </nav>
    </div>
</main>

<main>
    <div class="bottom-data">
        <div class="orders">
            <div class="row">
                <?=$html_show_order?>
            </div>
        </div>
    </div>
</main>
