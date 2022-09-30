<?php
$form = $_POST;

if (count($form) == 2) {
   $login = $form["login"];
   $password = $form["password"];
   $response = ['message' => 'Some Error'];

   $fileName = "users.json";
   $file = fopen($fileName, "r+");
   $content = fread($file, filesize($fileName));
   $MyStdClass = json_decode($content);
   $users = $MyStdClass->users;
   foreach($users as $user){
      if ($user->login == $login && $user->password == md5($password)) {
         session_start();
         $userName = $user->name;
         $_SESSION['name'] = $user->name;
         $response = ['message' => "Authorization was successful."];
      }
   }

   fclose($file);
} elseif(count($form) == 5){
   $login = $form["login"];
   $password = $form["password"];
   $name = $form["password"];
   $email = $form["password"];
   $response = ['message' => 'User with this email or login already exists.'];
   $error = 0;

   $fileName = "users.json";
   $file = fopen($fileName, "r+");
   $content = fread($file, filesize($fileName));
   $MyStdClass = json_decode($content);
   $users = $MyStdClass->users;
   foreach($users as $user){
      if ($user->login == $login && $user->email == $email) return $error++;
   }

   if ($error == 0) {
      $users[count($users)] = ['id'=>count($users)+1, 'login'=>$login, 'password'=>md5($password), 'name'=>$name, 'email'=>$email];
      session_start();
      $userName = $user->name;
      $_SESSION['name'] = $user->name;
      $response = ['message' => "Authorization was successful."];

   }


   fclose($file);
}


// if ($_SESSION['name'] || session_is_registered()) {
//    $response = ['message'=> 'Session registered'];
// }

header('Content-type: application/json');
echo json_encode($response);
?>