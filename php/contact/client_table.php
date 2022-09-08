<?php

include '../database.php';

// check if data exist -->
if (isset($_GET['id'])) :

    $ids = $_GET['id'];

    // intialize query -->
    $sql = 'SELECT * FROM `links` WHERE contact = "' . $ids . '" ;';

    // get number of rows representing the data -->
    $num_rows = $mydb->getRows($sql);

    // check if data exist -->
    if ($num_rows > 0) :

        // get client data -->
        $data = $mydb->getData($sql);

        // display each row -->
        foreach ($data as $results) :

            // intialize query -->
            $sql = 'SELECT * FROM clients WHERE id = "' . $results['client'] . '" ORDER BY client_code ASC;';

            // get client data -->
            $result = $mydb->getSingleData($sql);

            // display each row -->
            if ($result) :
                $id = $result['id'];
                $client_name = $result['name'];
                $client_code = $result['client_code'];
                echo '  <tr>
                            <td class="text-left">' . $client_name . '</td>

                            <td class="text-left">' . $client_code . '</td>

                            <td class="text-center text-danger"> <a onclick="modal_confirm_link' . $id . '()"> <i class="fa fa-link" aria-hidden="true"></i> Unlink </a>                            
                            
							<div class="modal modal_confirm" id="modal_confirm_link' . $id . '">
                                <div class="p-5" id="zindex-modal-backdrop">
                                    <div class="modal-dialog modal-dialog-centered bg-white border border-dark rounded">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                    <h3 class="modal-title text-danger fs-6"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Wanrning</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <span>
                                                        <h6>Are you sure you want to Unlink ' .  $client_name . '?</h4>
                                                    </span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" onclick="hide()">No</button>
                                                    <input id="contactId" value="' . $ids . '" hidden>
                                                    <a type="button" onclick="unlink_client(' . $id . ')" class="btn btn-success" href="#">Yes</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                     
                                </div>
                            </div>
                            
                            <script>
                                function modal_confirm_link' . $id . '() {
                                    $("#modal_confirm_link' . $id . '").show();
                                }
                            </script>                        
                            
                            </td>
                        </tr>';

            endif;

        endforeach;
    else :

        // display No client(s) found -->
        echo '  <tr class="m-auto text-center">

        <td colspan="3"> No client(s) found </td>

        </tr>';

    endif;

else :

    // display No client(s) found -->
    echo '  <tr class="m-auto text-center">

    <td colspan="3"> No client(s) found </td>

    </tr>';

endif;
