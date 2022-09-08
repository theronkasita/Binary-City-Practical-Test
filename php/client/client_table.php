<?php

include '../database.php';

// intialize query -->
$sql = 'SELECT * FROM `clients` ORDER BY client_code ASC;';

// get number of rows representing the data -->
$num_rows = $mydb->getRows($sql);

// check if data exist -->
if ($num_rows > 0) :

    // get client data -->
    $data = $mydb->getData($sql);

    // display each row -->
    foreach ($data as $result) : $id = $result['id'];
        $name = $result['name'];
        $client_code = $result['client_code'];
        $link = 'SELECT * FROM `links` WHERE client = "' . $id . '" ;';
        echo '<tr  class="rows"  id="row' . $id . '" onclick="selectRow(' . $id . ')" >

                        <td class="text-left" title="click! to select ' .  $name . ' "><a class="nav-link" href="# ">' .  $name . ' </a></td>

                        <td class="text-left"><a class="nav-link" href="#">' .   $client_code . ' </a></td>

                        <td class="text-center"><a class="nav-link" href="#">' .   $mydb->getRows($link) . ' </a></td>

                        <td class="text-center d-flex">

                            <a class="nav-link m-2 text-danger" href="#" onclick="modal_confirm' . $id . '()"> <i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                 
                            <a class="nav-link m-2 text-secondary" href="#" onclick="modal_edit' . $id . '()"> <i class="fa fa-edit" aria-hidden="true"></i> Edit </a>
                                 
                            <a class="nav-link m-2 text-success" href="#" onclick="contact_link_list' . $id . '()"> <i class="fa fa-link" aria-hidden="true"></i> Link </a>

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
                                                <a type="button" onclick="delClient(' . $id . ')" class="btn btn-success" href="#">Yes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ul 
                                onclick="hide()"
                                class="w-25 h-75 float-right list-group modal modal_confirm contact_link_list link_list position-absolute" 
                                id="contact_link_list' . $id . '" 
                                Style="margin-left:75%">
                                
                            </ul>
                            
							<div class="modal modal_confirm" id="modal_edit' . $id . '">
                                <div class="p-5" id="zindex-modal-backdrop">
                                    <div class="modal-dialog modal-dialog-centered bg-white border border-dark rounded">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title text-danger fs-6"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Wanrning</h3>
                                            </div>

                                            <form class="mx-1 mx-md-4" id="new_client_form" action="php/save.php" method="post">
                                                <div class="modal-body">
                                                    <div class="align-items-center mb-4">
                                                        <div class="form-outline flex-fill m-auto" style="max-width: 400px;">
                                                            <label class="form-label" for="form3Example1c">
                                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>Client Name
                                                            </label>
                                                            <input type="text" id="new_client_name" class="form-control" name="client_name"  value="' .   $name . '"  />
                                                        </div>
                                                    </div>
                
                                                    <div class="align-items-center mb-4">
                                                        <div class="form-outline flex-fill m-auto" style="max-width: 400px;">
                                                            <label class="form-label" for="form3Example1c">
                                                            <i class="fa fa-id-badge fa-lg me-3 fa-fw" aria-hidden="true"></i>Client Code
                                                            </label>
                                                            <input type="text" id="new_client_code" class="form-control" name="client_code" value="' .   $client_code . '" disabled />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" onclick="hide()">Cancel</button>
                                                    <input name="id" value="' . $id . '" hidden>
                                                    <input name="edit_client" class="btn btn-success" value="Update" id="update_client">
                                                </div>
                
                                            </form>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function modal_confirm' . $id . '() {
                                    $("#modal_confirm' . $id . '").show();
                                }
                                
                                function contact_link_list' . $id . '() {
                                    $("#contact_link_list' . $id . '").show();
                                }

                                function modal_edit' . $id . '() {
                                    $("#modal_edit' . $id . '").show();
                                }

                            </script>                        
                        
                        </td>

                    </tr>';
    endforeach;

else :

    // display No client(s) found 
    echo '  <tr class="m-auto text-center">

            <td colspan="4"> No client(s) found </td>

        </tr>';

endif;
