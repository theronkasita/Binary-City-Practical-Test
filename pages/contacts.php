<div class="container-fluid p-5">

    <!-- Tabs navs -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <h4 class=""> Contacts <span id="selected"></span> </h4>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="showTab(4)">View</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="showTab(5)">General</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="showTab(6)">Client(s)</a>
        </li>
    </ul>

    <!-- Tab1 -->
    <div id="tab4" class="tabcontent">
        <?php include "contacts/view_contact.php" ?>
    </div>

    <!-- Tab2 -->
    <div id="tab5" class="tabcontent">
        <?php include "contacts/add_contact.php" ?>
    </div>

    <!-- Tab3 -->
    <div id="tab6" class="tabcontent">
        <?php include "contacts/show_client.php" ?>
    </div>

</div>