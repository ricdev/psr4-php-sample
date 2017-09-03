<?php namespace App;

use PDO;

class UserController
{
  private $dao;
  public $data;
  public $json;
  
  // Create a new object
  // $obj = new MyClass;
  public function __construct()
  {
    //$database = new Database();
    $database = Database::connect();
    $this->dao = $database;
  }
 
  // Destroy the object
  // unset($obj);
  public function __destruct()
  {
      //echo 'The class "', __CLASS__, '" was destroyed.<br />';
  }

  public function find($id)
  {
    $stmt = $this->dao->prepare('
              SELECT 
                id,
                email, 
                logkey
              FROM users
              WHERE id = :id
    ');
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\User');
    $results = $stmt->fetch();

    //$output= array_map('User',$results);
    //print_r( $output);

    $this->json = json_encode($results);
    $this->data = json_decode($this->json);

    return $results;
  }

  public function findAll()
  {
    $stmt = $this->dao->query('
              SELECT 
                id,
                email, 
                logkey
              FROM users
    ');

    $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'App\User');
    $results = $stmt->fetchAll();
    
    $this->json = json_encode($results);
    $this->data = json_decode($this->json);

    return $results;
  }

  public function save(User $user)
  {
    $created_at = date('Y-m-d H:i:s');

    try
    { 
      // If the ID is set, we're updating an existing record
      if (isset($user->id)) {
        return $this->update($user);
      }

      $stmt = $this->dao->prepare('
              INSERT INTO users (email, logkey)
              VALUES
                (:email, :logkey);
      ');
      $stmt->bindParam(':email', $user->email);
      $stmt->bindParam(':logkey', $user->logkey);

      return $stmt->execute();
    }
    catch(PDOException $ex)
    {
      echo $ex->getMessage();
    }
  }

  public function update(User $user)
  {
    $updated_at = date('Y-m-d H:i:s');
    
    try
    { 
      if (!isset($user->id)) {
        // We can't update a record unless it exists...
        throw new \LogicException(
          'Cannot update record that does not yet exist in the database.'
        );
      }

      $stmt = $this->dao->prepare('
              UPDATE users
              SET email = :email, 
                  logkey = :logkey
              WHERE id = :id
      ');
      $stmt->bindParam(':id', $user->id);
      $stmt->bindParam(':email', $user->email);
      $stmt->bindParam(':logkey', $user->logkey);
      
      return $stmt->execute();
    }
    catch(PDOException $ex)
    {
      echo $ex->getMessage();
    }
  }

  private function runQuery($sql)
  {
    $stmt = $this->dao->prepare($sql);
    return $stmt;
  }

  public function lasdID()
  {
    $stmt = $this->dao->lastInsertId();
    return $stmt;
  }

}