<?php
	session_start();
	class User {
		function userSignOut($userMessage) {
			session_unset();
			session_destroy();
			return json_encode(array('logout' => $userMessage));
		}
	}
	if (isset($_POST)) {
		foreach ($_POST as $postKey => $postValue) {
			switch (strtoupper($postKey)) {
				case 'LOGOUT':
                    $userLogOut = new User();
                    echo $userLogOut->userSignOut($postValue);
                    break;
            }
		}
	}
?>
