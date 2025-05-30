  <?php

  require_once('database.php');

  class User {

      public function get_all_users() {
          $db = db_connect();
          $statement = $db->prepare("select * from users;");
          $statement->execute();
          $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
          return $rows;
      }

    public function create_user( $username, $password) {
    $db = db_connect();
    $statement = $db->prepare("inseart into users (username, password) values (?, ?);");
      
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;

  }
  }