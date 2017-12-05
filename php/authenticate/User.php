<?php
require_once '../include/Connection.php';

class User {

	private $db;

	function __construct($dbIn) {
		$this->db = $dbIn;
	}

	public function storeUser($username, $password, $account_type) {
		$encrypted_password = password_hash($password, PASSWORD_DEFAULT);

		$stmt = $this->db->prepare("INSERT INTO users(username, encrypted_password, account_type) VALUES(?, ?, ?)");
        $result = $stmt->bind_param("sss", $username, $encrypted_password, $account_type);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
	}

	public function checkPassword($username, $password) {
		$stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");

		$stmt->bind_Param("s", $username);

		if ($stmt->execute()) {
			$user = $stmt->get_result()->fetch_assoc();
			$stmt->close();

			$encrypted_password = $user['encrypted_password'];
			if (password_verify($password, $encrypted_password)) {
				return $user;
			} else {
				return NULL;
			}
		}
	}

	public function isUserExist($username) {
		$stmt = $this->db->prepare("SELECT username from users WHERE username = ?");

		$stmt->bind_param("s", $username);

		$stmt->execute();

		$stmt->store_result();

		if ($stmt->num_rows > 0) {
			$stmt->close();
			return true;
		} else {
			$stmt->close();
			return false;
		}
	}
}