<?php
    session_start();
    require_once '../DBConnect.php';

    $conn = databaseConnect('Pet');
    try {

        $query = 'select [password] from users where [username] = ?';
        $credentials = array();
        foreach ($_POST as $postKey => $postValue) {
            switch (strtoupper($postKey)) {
                case 'USERNAME':
                    array_push($credentials, $postValue);
                    break;
            }
        }
        $stmt = sqlsrv_query($conn, $query, $credentials, array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
        if (sqlsrv_num_rows($stmt) > 0) {
            while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC)) {
                foreach ($_POST as $postKey => $postValue) {
                    $username;
                    switch (strtoupper($postKey)) {
                        case 'USERNAME':
                            $username = $postValue;
                            break;
                        case 'PASSWORD':
                            if (password_verify($postValue, $row[0])) {
                                $_SESSION['currentUser'] = $username;
                                echo json_encode(array('successful' => ''));
                            } else {
                                echo json_encode(json_decode('{"error": "Username or password is incorrect."}'));
                            }
                            break;
                    }
                }
            }
        } else {
            echo json_encode(json_decode('{"unknown": "This username doesn\'t exist."}'));
        }
    } catch (Exception $e) {
        return 'Exception: ' . $e;
    } catch (Throwable $ee) {
        return 'Throwable: ' . $ee;
    }
    sqlsrv_close($conn);


?>
