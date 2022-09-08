<?php

include '../database.php';

// check if data exist -->
if (isset($_GET['id'])) :

    $ids = $_GET['id'];

    // intialize query -->
    $sql = 'SELECT * FROM `links` WHERE client = "' . $ids . '" ;';

    // get number of rows representing the data -->
    $num_rows = $mydb->getRows($sql);

    // check if data exist -->
    if ($num_rows > 0) :

        // get client data -->
        $data = $mydb->getData($sql);

        // display each row -->
        foreach ($data as $results) :

            // intialize query -->
            $sql = 'SELECT * FROM contacts WHERE id = "' . $results['contact'] . '" ORDER BY surname ASC;';

            // get client data -->
            $result = $mydb->getSingleData($sql);

            // display each row -->
            if ($result) : $id = $result['id'];
                $contact_name =  $result['name'];
                $contact_surname =   $result['surname'];
                $contact_email_address =   $result['email_address'];

                echo '  <tr>
                            <td class="text-left"> ' . $contact_name . ' </td>
                            <td class="text-left">' . $contact_surname . ' </td>
                            <td class="text-left">' . $contact_email_address . '</td>
                            <td class="text-center text-danger"> <a onclick="modal_confirm' . $id . '()"> <i class="fa fa-link" aria-hidden="true"></i> Unlink </a>                            
                            
							<div class="modal modal_confirm" id="modal_confirm' . $id . '">
                                <div class="p-5" id="zindex-modal-backdrop">
                                    <div class="modal-dialog modal-dialog-centered bg-white border border-dark rounded">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                    <h3 class="modal-title text-danger fs-6"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Wanrning</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <span>
                                                        <h6>Are you sure you want to Unlink ' .  $contact_surname . '?</h4>
                                                    </span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" onclick="hide()">No</button>
                                                    <input id="clientId" value="' . $ids . '" hidden>
                                                    <a type="button" onclick="unlink_contact(' . $id . ')" class="btn btn-success" href="#">Yes</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                     
                                </div>
                            </div>
                            
                            <script>
                                function modal_confirm' . $id . '() {
                                    $("#modal_confirm' . $id . '").show();
                                }
                            </script>                        
                            
                            </td>
                        </tr>';

            endif;

        endforeach;
    else :

        // display No client(s) found -->
        echo '  <tr class="m-auto text-center">

        <td colspan="5"> No contact(s) found </td>

        </tr>';

    endif;
else :

    // display No client(s) found
    echo '  <tr class="m-auto text-center">

    <td colspan="5"> No contact(s) found </td>

    </tr>';

endif;
