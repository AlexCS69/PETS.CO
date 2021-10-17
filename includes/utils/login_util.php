<?php
require_once "dbhandler.php";
require_once "common_util.php";

function EmptyInputLogin($username, $pwd) { return empty($username) or empty($pwd); }

function LoginUser($conn, $loginName, $pwd)
{
  $memberDetail = UIDExists($conn, $loginName);

  if ($memberDetail === false)
  {
    header("location: ../login.php?error=wronglogin");
    exit();
  }

  $pwdHashed = $memberDetail["Password"];
  $checkPwd = password_verify($pwd, $pwdHashed);

  if ($checkPwd === false)
  {
    header("location: ../login.php?error=wronglogin");
    exit();
  } 
  if ($checkPwd === true)
  {
    session_start();
    require_once "../includes/data/member.data.php";
    $member = new Member(
      $memberDetail["MemberID"],
      $memberDetail["Username"],
      $memberDetail["Email"],
      $memberDetail["PrivilegeLevel"],
      $conn
    );

    $res = mysqli_query($conn, "Select count(*) as countUser, MemberID from Members WHERE Username = '$username' and Password = '$pwd';");
    $result = mysqli_fetch_array($res);
    $memberid = $result["MemberID"];
    
    if ($result > 0)
    {
      $memberid = $result["MemberID"];

      if ( isset($_POST["rememberme"]) ) 
      {
        // Set cookie variables
        $value = encryptCookie($memberid);

        // 8 days cookies
        setcookie ( "rememberme", $value, time() + (30 * 24 * 1000) ); 
      }
    }
    $_SESSION["MemberID"] = $memberid;
    $_SESSION["Member"] = $member;
    header("location: ../index.php");
    exit();

    // $_SESSION["MemberID"] = $memberDetail["MemberID"];
    // $_SESSION["Username"] = $memberDetail["Username"];
    // $_SESSION["Email"] = $memberDetail["Email"];
    // $_SESSION["PrivilegeLevel"] = $memberDetail["PrivilegeLevel"];
  }
}

function EncryptCookie($memberID)
{
  $key = hex2bin(openssl_random_pseudo_bytes(4));
  $ciphertype = "aes-256-cbc";
  $ivlen = openssl_cipher_iv_length($ciphertype);
  $iv = openssl_random_pseudo_bytes($ivlen);

  $ciphertext = openssl_encrypt($memberID, $ciphertype, $key, 0, $iv);

  return ( base64_encode($ciphertext . '::' . $iv. '::' .$key) );
}

function DecryptCookie($ciphertext)
{
  $ciphertype = "aes-256-cbc";
  list($encrypted_data, $iv, $key) = explode('::', base64_decode($ciphertext));

  return openssl_decrypt($encrypted_data, $ciphertype, $key, 0, $iv);
}

