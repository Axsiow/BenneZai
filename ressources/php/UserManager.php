<?php


class UserManager
{
    private $_db;

    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }

    /**
     * @param mixed $db
     */
    public function setDb($db): void
    {
        $this->_db = $db;
    }

    public function add(User $perso)
    {
        $query = $this->_db->prepare('INSERT INTO user(user, password) VALUES(:user,:password)');
        $query->bindValue(':user', $perso->getUsername() ) ;
        $query->bindValue(':password', $perso->getPassword() ) ;

        $query->execute();

    }

    public function count()
    {
        $query = $this->_db->prepare('SELECT count(*) FROM user');
        $query->execute();
        $result = $query->fetch();

        return $result[0];

    }

    public function exist($name)
    {
        if (is_numeric($name)) {
            $query = $this->_db->prepare('select count(*) from user where id = :id');
            $query->execute(array(':id' => $name));
            $result = $query->fetch();

            return $result[0];



        } else {
            $query = $this->_db->prepare('select count(*) from user where user = :user');
            $query->execute(array(':user' => $name));
            $result = $query->fetch();
            return $result[0];
        }

    }



}