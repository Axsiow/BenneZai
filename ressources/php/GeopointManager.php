<?php


class GeopointManager
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

    public function add(Geopoint $geopoint, user $user)
    {
        $query = $this->_db->prepare('INSERT INTO geopoint(longitude, latitude, category_id, username ) VALUES(:longitude, :latitude, :category_name, :username)');
        $query->bindValue(':longitude', $geopoint->getUsername() ) ;
        $query->bindValue(':longitude', $geopoint->getUsername() ) ;
        $query->bindValue(':category_name', $geopoint->getCategory() ) ;
        $query->bindValue(':username', $user->getUsername() ) ;
        $query->execute();

    }




}