<?php
class UserRegister{
    private $jsonFile = './users.json';
 
    private function getData(){ // Получаем данные пользователей
       if(file_exists($this->jsonFile)){ // Проверка естли такой файл
          $jsonData = file_get_contents($this->jsonFile); // Получаем содержимое файла 
          $data = json_decode($jsonData, true)['users']; // Преобразуем в массив
           
          if(!empty($data)){  // Проверка пусто ли в данных
              usort($data, function($a, $b) { // Сортировка данных
                  return $b['id'] - $a['id']; 
              }); 
          } 
           
          return !empty($data) ? $data : false; // Если данные есть то вернет данные иначе false
      } 
      return false; 
    }

    private function uniquenessCheck($data, $login, $email){ // Проверка на уникальность email login
        $data = $this->getData(); 
        foreach($data as $user){
           if ($user['login'] == $login && $user['email'] == $email) return $user['id'];
        }
        return false;
    }
 
    public function getSingle($id) { // Получаем нужного пользователя
       $data = $this->getData(); // Метод вернет массив данных пользователей
       $singleData = array_filter($data, function ($var) use ($id) {  // Фильтрация по id
          return (!empty($var['id']) && $var['id'] == $id); 
      }); 
      $singleData = array_values($singleData)[0]; 
      return !empty($singleData) ? $singleData : false; 
    }
 
    public function insert($newData){ // Добавление нового пользователя
       if(!empty($newData)){ 
           $id = time(); 
           $newData['id'] = $id; 
            
           $data = $this->getData();
            
           $data = !empty($data)?array_filter($data):$data; 
           if(!$this->uniquenessCheck($data, $newData['login'], $newData['email'])){ 
               array_push($data, $newData); 
               $insert = file_put_contents($this->jsonFile, json_encode(['users'=>$data]));             
               return $insert ? $id : false; 
            } 
       }
       return false; 
   } 

   public function input($newData){ // Проверка логин пороль
    $data = $this->getData();
    $userId = null;
    if (!empty($data)) {        
        foreach($data as $user){
            if ($user['login'] == $newData['login'] && $user['password'] == md5($newData['password'])) {
                $userId = $user['id'];   
            }
        }
        
    }
    return $userId; 
   }

   public function authUser($userId, $userLogin){ // Авторизация
        if (!empty($userId)) {
            session_start();
            setcookie('userId', $userId, time()+3600);
            setcookie('userLogin', $userLogin, time()+3600);
            return true;
        }
        return false;
    }
}

$message = 'test';

if (!empty($_POST['type']) && $_POST['type'] == 'signup') {
    $message = 'Error2';
    $signup = new UserRegister;
    $userId = $signup->insert(['name'=>$_POST['name'], 'login'=>$_POST['login'], 'password'=>md5($_POST['password']), 'email'=>$_POST['email']]);
    if ($userId) {
        $signup->authUser($userId, $_POST['login']);
        $message = 'signUp';
    }
} 
elseif (!empty($_POST['type']) && $_POST['type'] == 'signin') {
    $signin = new UserRegister;
    $userId = $signin->input(['login'=>$_POST['login'], 'password'=>$_POST['password']]);
    $message = 'Error1';
    if ($userId) {
        $userLogin = $_POST['login'];
        $signin->authUser($userId, $userLogin);
        $message = 'signin';
    }    
}
elseif (!empty($_POST['type']) && $_POST['type'] == 'auth') {
    $authUser = new UserRegister;
    if ($authUser->getSingle($_POST['id'])) {
        session_start();
        setcookie('userId', $_POST['id'], time()+3600);
        setcookie('userLogin', $_POST['login'], time()+3600);
        $message = 'Authorization was successful.';
    }
}
elseif (!empty($_POST['type']) && $_POST['type'] == 'exit') {
    setcookie('userId', 'id', time()-3600);
    setcookie('userLogin', 'login', time()+3600);
    $message = 'Exit';
}

$response = ['message' => $message];

if ($message == 'Error1') {
    // 
    // Не закрывать форму
    // сгенерировать ошибку
    $response['error'] = 'Hеправильный логин или пороль попробуйте еще раз';
} elseif($message == 'Error2'){
    // Пользователь с таким логином или емайл уже существует
    // не закрывать форму
    // сгенерировать ошибку
    $response['error'] = 'Пользователь с таким логином или емайл уже существует';
}

header('Content-type: application/json');
echo json_encode($response);
?>

