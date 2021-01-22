<?php

	require_once '../DBConnect.php';

    $conn = databaseConnect('Pet');
    try {
        $query = 'select [username] from users where [username] = ?';
        $queryStmt = sqlsrv_query($conn, $query, array($_POST['username']));
        if ($queryStmt === false) {
            foreach(sqlsrv_errors() as $errorKey => $errorValue) {
                echo json_encode(array('error' => 'Please contact administrator.'));
            }
        }
        if (sqlsrv_fetch_array($queryStmt, SQLSRV_FETCH_ASSOC) == null) {
            $query = 'insert into users (username, password, email) values (?,?,?)';
            $credentials = array();
            foreach ($_POST as $postKey => $postValue) {
                switch (strtoupper($postKey)) {
                    case 'USERNAME':
                        array_push($credentials, $postValue);
                        break;
                    case 'PASSWORD':
                        array_push($credentials, password_hash($postValue, PASSWORD_BCRYPT));
                        break;
                    case 'EMAIL':
                        array_push($credentials, $postValue);
                        break;
                }
            }
            $stmt = sqlsrv_prepare($conn, $query, $credentials);
            $execute = sqlsrv_execute($stmt);
            if ($execute) {
                echo json_encode(array('successful' => 'You have been successfully signed up. Please login with your credentials.'));
            } else {
                foreach (sqlsrv_errors() as $errorKey => $errorValue) {
                    echo json_encode(array('error' => 'An error has sadly encountered. Please try again later.'));
                }
            }
        } else {
            echo json_encode(json_decode('{"error": "Username already exists. Please try using a different username."}'));
        }
    } catch (Exception $e) {
        return 'Exception: ' . $e;
    } catch (Throwable $ee) {
        return 'Throwable: ' . $ee;
    }
    sqlsrv_close($conn);

?>
