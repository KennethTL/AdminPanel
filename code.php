<?php
session_start();
include('dbcon.php');

if (isset($_POST['user_claims_btn'])) 
{
	$uid = $_POST['claims_user_id'];
	$roles = $_POST['role_as'];

	if ($roles == 'admin') 
	{
		$auth->setCustomUserClaims($uid, ['admin' => true]);
		$msg = "User role as Admin!";
	}
	elseif ($roles == 'super_admin') 
	{
		$auth->setCustomUserClaims($uid, ['super_admin' => true]);
		$msg = "User role as Super Admin!";
	}
	elseif ($roles == 'norole') 
	{
		$auth->setCustomUserClaims($uid, null);
		$msg = "User role has been removed!";
	}

	if ($msg) 
	{
		$_SESSION['status'] = "$msg";
		header("Location: user-edit.php?id=$uid");
		exit();
	}
	else
	{
		$_SESSION['status'] = "Password not updated!";
		header('Location: user-list.php');
		exit();
	}
}








if (isset($_POST['change_password_btn'])) 
{
	$new_password = $_POST['new_password'];
	$retype_password = $_POST['retype_password'];

	$uid = $_POST['change_pwd_user_id'];

	if ($new_password == $retype_password ) 
	{
		$updatedUser = $auth->changeUserPassword($uid, $new_password);
		if ($updatedUser) 
		{
			$_SESSION['status'] = "Password Updated!";
			header('Location: user-list.php');
			exit();
		}
		else
		{
			$_SESSION['status'] = "Password not updated!";
			header('Location: user-list.php');
			exit();
		}
	}
	else
	{
		$_SESSION['status'] = "New passwoord and retyped password don't match!";
		header("Location: user-edit.php?id=$uid");
		exit();
	}
}








if (isset($_POST['enable_disable_user_ac'])) 
{
	$disable_enable = $_POST['select_enable_disable'];
	$uid = $_POST['ena_dis_user_id'];

	if ($disable_enable == "disable") 
	{

		$updatedUser = $auth->disableUser($uid);
		$msg = "Account disabled!";
	}
	else
	{
		$updatedUser = $auth->enableUser($uid);
		$msg = "Account enabled!";
	}

	if ($updatedUser) 
	{
		$_SESSION['status'] = $msg;
		header('Location: user-list.php');
		exit();
	}
	else
	{
		$_SESSION['status'] = "Something went wrong!";
		header('Location: user-list.php');
		exit();
	}
}




if (isset($_POST['reg_user_delete_btn'])) 
{
	$uid = $_POST['reg_user_delete_btn'];

	try {
		$auth->deleteUser($uid);

		$_SESSION['status'] = 'User information deleted Successfully';
		header('Location: user-list.php');
		exit();
	} catch (Exception $e) {
		$_SESSION['status'] = 'No ID found.';
		header('Location: user-list.php');
		exit();
	}
	
}











if (isset($_POST['update_user_btn'])) 
{
	$displayName = $_POST['full_name'];
	$phone = $_POST['phone'];

	$uid = $_POST['user_id'];
	$properties = [
	    'displayName' => $displayName,
	    'phoneNumber' => $phoneNumber,
];

$updatedUser = $auth->updateUser($uid, $properties);
if ($updatedUser) 
{
	$_SESSION['status'] = 'User information Updated Successfully';
	header('Location: user-list.php');
	exit();
}
else
{
	$_SESSION['status'] = 'User information not updated';
	header('Location: user-list.php');
	exit();
}
}


if (isset($_POST['register_btn']))
{
	$fullname = $_POST['full_name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$password = $_POST['password'];

	$userProperties = [
    'email' => 'user@example.com',
    'emailVerified' => false,
    'phoneNumber' => '+254'.$phone,
    'password' => $password,
    'displayName' => $fullname,
    'disabled' => false,
	];

	$createdUser = $auth->createUser($userProperties);

	if ($createdUser)
	{
		$_SESSION['status'] = 'User Registered Successfully';
		header('Location: register.php');
		exit();
	}
	else
	{
		$_SESSION['status'] = 'User Registered Successfully';
		header('Location: register.php');
		exit();
	}
}



if (isset($_POST['delete_btn'])) 
{
	$del_id = $_POST['delete_btn'];

	$ref_table = 'product/Food'.$del_id;
	$deletequery_result = $database->getReference($ref_table)->remove();

	if ($deletequery_result) 
	{
		$_SESSION['status'] = "Product deleted successfully!";
		header('Location: index.php');	
	}
	else
	{
		$_SESSION['status'] = "Product not deleted.";
		header('Location: index.php');
	}
}




if (isset($_POST['update_product'])) 
{
	$key = $_POST['key'];
	$price = $_POST['price'];
	$quantity = $_POST['quantity'];
	$expiry_date = $_POST['epxpired'];
	$image = $_POST['image'];

	$updateData = [
		'price'=>$price,
		'quantity'=>$quantity,
		'epxpired'=>$expiry_date,
		'image'=>$image 
	];

	$ref_table = 'product/Food'.$key;
	$updatequery_result = $database->getReference()->update($updateData);

	if ($updatequery_result) 
	{
		$_SESSION['status'] = "Product updated successfully!";
		header('Location: index.php');	
	}
	else
	{
		$_SESSION['status'] = "Product not updated.";
		header('Location: index.php');
	}
}








if (isset($_POST['save_product']))
{
	$price = $_POST['price'];
	$quantity = $_POST['quantity'];
	$expiry_date = $_POST['epxpired'];
	$image = $_POST['image'];

	$postData = [
		'price'=>$price,
		'quantity'=>$quantity,
		'epxpired'=>$expiry_date,
		'image'=>$image 
	];

	$ref_table = "product/Food";
	$postRef_result = $database->getReference('$ref_table')->push($postData);

	if ($postRef_result) 
	{
		$_SESSION['status'] = "Product added successfully!";
		header('Location: index.php');	
	}
	else
	{
		$_SESSION['status'] = "Product not added.";
		header('Location: index.php');
	}
}

?>