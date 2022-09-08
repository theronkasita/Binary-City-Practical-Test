<?php

include '../database.php';

//intialize query -->
$sql = 'SELECT * FROM `links`';

//get number of rows representing the data -->
$num_rows = $mydb->getRows($sql);

//check if data exist -->
if ($num_rows > 0) :

    //get client data -->
    $data = $mydb->getData($sql);

    //display each row -->
    foreach ($data as $results) :

        //intialize query -->
        $sql = 'SELECT * FROM contacts WHERE id = "' . $results['contact'] . '" ORDER BY surname ASC;';

        //get client data -->
        $result = $mydb->getSingleData($sql);

        $sqls = 'SELECT * FROM clients WHERE id = "' . $results['client'] . '" ORDER BY name ASC;';

        //get client data -->
        $res = $mydb->getSingleData($sqls);

        //display each row -->
        if ($result && $res) :
            $id = $result['id'];
            $name = $result['name'];
            $surname = $result['surname'];
            $email_address = $result['email_address'];

            $cid = $res['id'];
            $cname = $res['name'];
            $client_code = $res['client_code'];


            echo '
             <tr>
                <td class="text-left">' . $client_code . '</td>
                <td class="text-left">' . $cname . '</td>
                <td class="text-left">' . $name . '</td>
                <td class="text-left">' . $surname . '</td>
                <td class="text-left">' . $email_address . '</td>
                <td class="text-center text-danger"> 
                
                    <a onclick="modal_confirm_' . $id . '()"> <i class="fa fa-link" aria-hidden="true"></i> </a>
                
                    <div class="modal modal_confirm" id="modal_confirm_' . $id . '">
                        <div class="p-5" id="zindex-modal-backdrop">
                            <div class="modal-dialog modal-dialog-centered bg-white border border-dark rounded">
                                <div class="modal-content">
                                    <div class="modal-header">
                                            <h3 class="modal-title text-danger fs-6"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Wanrning</h3>
                                        </div>
                                        <div class="modal-body">
                                            <span>
                                                <h6>Are you sure you want to Unlink ' .  $cname . ' from  ' .  $email_address . '?</h4>
                                            </span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" onclick="hide()">No</button>
                                            <a type="button" onclick="unlink(' . $cid . ',' . $id . ')" class="btn btn-success" href="#">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>                     
                        </div>
                    </div>

                    <script>
                        function modal_confirm_' . $id . '() {
                            $("#modal_confirm_' . $id . '").show();
                        }
                    </script> 

                </td>
         
             </tr>';
        endif;


    endforeach;
else :

    // display No client(s) found -->
    echo '  <tr class="m-auto text-center">

        <td colspan="6"> No link(s) found </td>

        </tr>';

endif;
