<?php

include '../database.php';

// intialize query -->
$sql = 'SELECT * FROM `contacts` ORDER BY surname ASC;';

// get number of rows representing the data -->
$num_rows = $mydb->getRows($sql);

// check if data exist -->
if ($num_rows > 0) :

    // get contact data -->
    $data = $mydb->getData($sql);

    // display each row -->
    foreach ($data as $result) : $id = $result['id'];
        $name = $result['name'];
        $surname = $result['surname'];
        $email_address = $result['email_address'];
        $link = 'SELECT * FROM `links` WHERE contact = "' . $id . '" ;';
        echo '<tr  class="rows"  id="row' . $id . '" onclick="selectRow(' . $id . ')" title="click! to select ' .  $name . ' ">
                        <td class="text-left"><a class="nav-link" href="#">' . $surname . ' </a></td>
                        <td class="text-left"><a class="nav-link" href="#">' . $name . ' </a></td>
                        <td class="text-left"><a class="nav-link" href="#">' . $email_address . ' </a></td>
                        <td class="text-center"><a class="nav-link" href="#">' . $mydb->getRows($link) . '</td>
                        <td class="text-center d-flex"> 
                        
                            <a class="nav-link m-2 text-danger" onclick="modal_confirm' . $id . '()"> <i class="fa fa-trash" aria-hidden="true"></i> delete</a>
                                 
                            <a class="nav-link m-2 text-secondary" href="#" onclick="contact_modal_edit' . $id . '()"> <i class="fa fa-edit" aria-hidden="true"></i> Edit </a>                                                        
                                                            
                            <a class="nav-link m-2 text-success" href="#" onclick="client_link_list' . $id . '()"> <i class="fa fa-link" aria-hidden="true"></i> Link </a>

                            <div class="modal modal_confirm" id="modal_confirm' . $id . '">
                                <div class="p-5" id="zindex-modal-backdrop">
                                    <div class="modal-dialog modal-dialog-centered bg-white border border-dark rounded">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title text-danger fs-6"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Wanrning</h3>
                                            </div>
                                            <div class="modal-body">
                                                <span>
                                                        <h6>Are you sure you want to delete ' .  $name . '?</h4>
                                                    </span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" onclick="hide()">No</button>
                                                    <a type="button" onclick="delContact(' . $id . ' )" class="btn btn-success" href="#">Yes</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                            

                            <div class="modal modal_confirm" id="contact_modal_edit' . $id . '">
                                <div class="p-5" id="zindex-modal-backdrop">
                                    <div class="modal-dialog modal-dialog-centered bg-white border border-dark rounded">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title text-danger fs-6"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Wanrning</h3>
                                            </div>
                                            <form class="mx-1 mx-md-4" id="new_contact_form" action="php/save.php" method="post">

                                                <div class="modal-body">
                                                    <div class="align-items-center mb-4">
                                                        <div class="form-outline flex-fill m-auto" style="max-width: 400px;">
                                                            <label class="form-label" for="form3Example1c">
                                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>Contact Name
                                                            </label>
                                                            <input type="text" id="new_contact_name" class="form-control" name="contact_name"  value="' .   $name . '"  />
                                                        </div>
                                                    </div>
                                                    <div class="align-items-center mb-4">
                                                        <div class="form-outline flex-fill m-auto" style="max-width: 400px;">
                                                            <label class="form-label" for="form3Example1c">
                                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>Contact Surname
                                                            </label>
                                                            <input type="text" id="new_contact_surname" class="form-control" name="contact_surname"  value="' .   $surname . '"  />
                                                        </div>
                                                    </div>
                                                    <div class="align-items-center mb-4">
                                                        <div class="form-outline flex-fill m-auto" style="max-width: 400px;">
                                                            <label class="form-label" for="form3Example1c">
                                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>Contact Email
                                                            </label>
                                                            <input type="text" id="new_contact_email" class="form-control" name="contact_email"  value="' .   $email_address . '"  />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" onclick="hide()">Cancel</button>
                                                    <input name="id" value="' . $id . '" hidden>
                                                    <input name="edit_contact" class="btn btn-success" value="Update" id="update_contact">
                                                </div>

                                            </form>                                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <ul 
                                onclick="hide()"
                                class="w-25 h-75 float-right list-group modal modal_confirm client_link_list link_list position-absolute" 
                                id="client_link_list' . $id . '" 
                                Style="margin-left:75%">                            
                            </ul>

                            <script>
                                function modal_confirm' . $id . '() {
                                    $("#modal_confirm' . $id . '").show();
                                }                                
                                
                                function client_link_list' . $id . '() {
                                    $("#client_link_list' . $id . '").show();
                                }

                                function contact_modal_edit' . $id . '() {
                                    $("#contact_modal_edit' . $id . '").show();
                                }
                            </script>

                        </td>
                    </tr>';

    endforeach;

else :

    // display No contact(s) found
    echo ' <tr class="m-auto text-center">

    <td colspan="5"> No contact(s) found </p>

        </tr>';

endif;
