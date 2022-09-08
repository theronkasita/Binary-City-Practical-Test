<div class="container-fluid refresher p-5">

    <!-- Tabs navs -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <h4 class=""> Clients <span id="selected"></span> </h4>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="showTab(1)">View</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="showTab(2)">General</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="showTab(3)">Contact(s)</a>
        </li>
    </ul>

    <!-- Tab1 -->
    <div id="tab1" class="tabcontent">
        <?php include "clients/view_client.php" ?>
    </div>

    <!-- Tab2 -->
    <div id="tab2" class="tabcontent">
        <?php include "clients/add_client.php" ?>
    </div>

    <!-- Tab3 -->
    <div id="tab3" class="tabcontent">
        <?php include "clients/show_contact.php" ?>
    </div>

</div>