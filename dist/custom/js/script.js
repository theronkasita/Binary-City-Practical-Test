// hide tabs when page starts
hideTabs();

// hiding and showing dropdown when page starts
sidebarDropdowns();

// Show all client data 
showClientTable();

// Show all contact data 
showContactTable();

// Show all link data 
showLinkTable();

// Show number of client data
showClientNo();

// Show number of contact data
showContactNo();

// Show number of link data
showLinkNo();

$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    $('#sidebarCollapse').on('click', function () {
        $('#content').toggleClass('content');
    });

    /* Initialization all datatables */

    $('#client-table').DataTable({});

    $('#client-link-table').DataTable({});

    $('#contact-table').DataTable({});

    $('#contact-link-table').DataTable({});

    $('#link-table').DataTable({});

    // create new client
    $(document).on('click', '#sub_client', function () {

        if ($("#client_name").val() != '') {
            $.post($("#client_form").attr("action"), $("#client_form :input").serializeArray(), function (info) {
                if (info == '0') {
                    alert('Failed to Create Client');
                } else if (info == '2') {
                    alert('Client already exist.');
                } else {
                    $("#client_code").val(info);
                    alert('Client Created Successfully');
                }

                showClientTable();

            });
        } else {
            alert('Enter Client Name.');
        }

        return;

    });

    // create new contact
    $(document).on('click', '#sub_contact', function () {

        if ($("#contact_name").val() != '' && $("#contact_surname").val() != '' && $("#email_address").val() != '') {
            $.post($("#contact_form").attr("action"), $("#contact_form :input").serializeArray(), function (info) {
                if (info == '1') {
                    alert('Contact Created Successfully');
                } else if (info == '2') {
                    alert('Contact Already Exist');
                } else {
                    alert('Failed to Create Contact' + info);
                }
                showContactTable();

            });
        } else {
            alert('Enter all details.');
        }

        return;

    });

    // update client
    $(document).on('click', '#update_client', function (e) {

        if ($("#new_client_name").val() != '') {
            $.post($("#new_client_form").attr("action"), $("#new_client_form :input").serializeArray(), function (info) {
                if (info == '0') {
                    alert('Failed to Update Client');
                } else if (info == '2') {
                    alert('Change Client Name to Update.');
                } else {
                    $("#new_client_code").val(info);
                    alert('Client Updated Successfully');
                }

                showClientTable();
                e.preventDefault();
            });
        } else {
            alert('Enter Client Name.');
        }

        return;

    });

    // update contact
    $(document).on('click', '#update_contact', function (e) {

        if ($("#new_contact_name").val() != '' && $("#new_contact_surname").val() != '' && $("#new_email_address").val() != '') {
            $.post($("#new_contact_form").attr("action"), $("#new_contact_form :input").serializeArray(), function (info) {
                if (info == '0') {
                    alert('Failed to Update Contact');
                } else if (info == '2') {
                    alert('Change Contact Details to Update.');
                } else {
                    $("#new_contact_code").val(info);
                    alert('Contact Updated Successfully');
                }

                showContactTable();
                e.preventDefault();
            });

        } else {
            alert('Enter all details.');
        }

        return;

    });

    // link client
    $(document).on('click', '#sub_link_contact', function () {

        var contact = $("#contact");

        if (contact.val() == 0) {
            alert('No Contact selected.');
        }

        if (contact.val() != 0) {

            $.post($("#link_form").attr("action"), $("#link_form :input").serializeArray(), function (info) {

                if (info == '1') {
                    alert('Contact Linked Successfully');
                    showClientTable();

                } else {
                    alert('Failed to Create Contact');
                }

            });
        }
        return;
    });

    // link contact
    $(document).on('click', '#sub_link_client', function () {

        var client = $("#client");

        if (client.val() == 0) {
            alert('No Client selected.');
        }

        if (client.val() != 0) {

            $.post($("#link_form").attr("action"), $("#link_form :input").serializeArray(), function (info) {

                if (info == '1') {
                    alert('Client Linked Successfully');
                    showContactTable();

                } else {
                    alert('Failed to Create Client');
                }

            });
        }
        return;
    });

})



// toggle between hiding and showing dropdown
function sidebarDropdowns() {
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
}

// Hide All tabs
function hideTabs() {
    $('.tabcontent').hide();
    $('.maintab').hide();
}

// show tab content
function showTab(tab, main) {

    if (main == 1)
        showClient();

    if (main == 2)
        showContact();

    $('.tabcontent').hide();
    $('#tab' + tab).show();
}

// show client tab
function showClient() {
    $('.maintab').hide();
    $('#clienttab').show();
    showClientTable();
}

// show contact tab
function showContact() {
    $('.maintab').hide();
    $('#contacttab').show();
    showContactTable();

}

// show link tab
function showLink() {
    $('.maintab').hide();
    $('#linktab').show();
    showLinkTable();
}

// highlight selected row
function selectRow(no) {
    $('.rows').css("background", "NONE");
    $('#row' + no).css("background", "#add8e6");
    linkUpdate(no);
}

// update links
function linkUpdate(no) {
    showLinkClient(no);
    showLinkContact(no);
    selectedContact(no);
    selectedClient(no);
    showContactLinkList(no);
    showClientLinkList(no);
    showLinkNo();
}

// hide confirmation modal
function hide() {
    $('.modal_confirm').hide();
}


/*Show client table*/
function showClientTable() {
    $.ajax({
        url: "php/client/client_table.php",
        type: "POST",
        cache: false,
        success: function (data) {
            $('#client_table').html(data);
        }
    });
    showClientNo();
}

/*Show contact table*/
function showContactTable() {
    $.ajax({
        url: "php/contact/contact_table.php",
        type: "POST",
        cache: false,
        success: function (data) {
            $('#contact_table').html(data);
        }
    });
    showContactNo();
}

/*Show link table*/
function showLinkTable() {
    $.ajax({
        url: "php/link/link_table.php",
        type: "POST",
        cache: false,
        success: function (data) {
            $('#link_table').html(data);
        }
    });
    showLinkNo();
}

/* Show all contact linked to the selected client */
function showLinkClient(no) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            $('#client_link_table').html(this.responseText);
        }
    };
    xmlhttp.open("GET", "php/client/contact_table.php?id=" + no, true);
    xmlhttp.send();
}


/* Show all client linked to the selected contact */
function showLinkContact(no) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            $('#contact_link_table').html(this.responseText);
        }
    };
    xmlhttp.open("GET", "php/contact/client_table.php?id=" + no, true);
    xmlhttp.send();
}

/* display the selected client */
function selectedClient(no) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            $('#selected_client').html(this.responseText);
        }
    };
    xmlhttp.open("GET", "php/client/selected.php?id=" + no, true);
    xmlhttp.send();
}

/* display the selected contact */
function selectedContact(no) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            $('#selected_contact').html(this.responseText);
        }
    };
    xmlhttp.open("GET", "php/contact/selected.php?id=" + no, true);
    xmlhttp.send();
}


/* Delete client table */
function delClient(no) {
    if (no == "") {
        alert('Nothing selected');
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
                showClientTable();
            }
        };
        xmlhttp.open("GET", "php/remove.php?client_id=" + no, true);
        xmlhttp.send();
    }

}

/* Delete contact table */
function delContact(no) {
    if (no == "") {
        alert('Nothing selected');
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
                showContactTable();
            }
        };
        xmlhttp.open("GET", "php/remove.php?contact_id=" + no, true);
        xmlhttp.send();
    }

}

// Show link list
function showContactLinkList(no) {
    $.ajax({
        url: "php/client/select_contacts.php?id=" + no,
        type: "POST",
        cache: false,
        success: function (data) {
            $('.contact_link_list').html(data);
        }
    });
}

// Show link list
function showClientLinkList(no) {
    $.ajax({
        url: "php/contact/select_clients.php?id=" + no,
        type: "POST",
        cache: false,
        success: function (data) {
            $('.client_link_list').html(data);
        }
    });
}

// Create link list
function createLinkt(x, y) {
    $.ajax({
        url: "php/save.php?link_client=" + x + "&contact=" + y,
        type: "GET",
        cache: false,
        success: function (data) {
            if (data) {
                alert('successfully linked.');
                // Show all client data 
                showClientTable();
                // Show all contact data 
                showContactTable();
                // update link data 
                linkUpdate(x);
            }
            else
                alert('failed to link.' + data);
        }
    });
}

// unlick contact
function unlink_contact(str) {
    if (str == "") {
        alert('Nothing selected');
        return;
    } else {
        var id = $('#clientId').val()
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
                // Show all client data 
                showClientTable();
                // Show all contact data 
                showContactTable();
                // update link data 
                linkUpdate(id);
            }
        };
        xmlhttp.open("GET", "php/remove.php?contact=" + str + "&client=" + id, true);
        xmlhttp.send();
    }
}

// unlick client
function unlink_client(str) {
    if (str == "") {
        alert('Nothing selected');
        return;
    } else {
        var id = $('#contactId').val()
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
                // Show all client data 
                showClientTable();
                // Show all contact data 
                showContactTable();
                // update link data 
                linkUpdate(id);
            }
        };
        xmlhttp.open("GET", "php/remove.php?contact=" + id + "&client=" + str, true);
        xmlhttp.send();
    }
}

//unlink All
function unlink(cid, id) {
    if (id == "") {
        alert('Nothing selected');
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
                // Show all client data 
                showClientTable();
                // Show all contact data 
                showContactTable();
                // update link data 
                linkUpdate(id);
                // Show all link data 
                showLinkTable();
            }
        };
        xmlhttp.open("GET", "php/remove.php?contact=" + id + "&client=" + cid, true);
        xmlhttp.send();
    }
}

/*Show number of client*/
function showClientNo() {
    $.ajax({
        url: "php/show.php?client_count",
        type: "GET",
        cache: false,
        success: function (data) {
            $('#client-badge').html(data);
        }
    });
}

/*Show number of contact*/
function showContactNo() {
    $.ajax({
        url: "php/show.php?contact_count",
        type: "GET",
        cache: false,
        success: function (data) {
            $('#contact-badge').html(data);
        }
    });
}

/*Show number of link*/
function showLinkNo() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            $('#link-badge').html(this.responseText);
        }
    };
    xmlhttp.open("GET", "php/show.php?link_count=count", true);
    xmlhttp.send();
}