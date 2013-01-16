<?php

namespace Model;
use Doctrine\DBAL\Connection;

abstract class DbObject
{
  const TABLE_NAME = '';
  
  protected $db;

  public $id;
  public $data;


  function __construct(Connection $db, $id = null)
  {
    $this->db = $db;
    if (!empty($id)) {
      $this->id = $id;
      $this->get();
    }
  }
  

  /**
   * Remplit l'objet courant avec ses données récupérées en base
   */
  private function get() {
    if (empty($this->id))
        return;
    
    $sql = "SELECT  o.*
            FROM    " . static::TABLE_NAME . " AS o
            WHERE   o.id = ?";
    $row = $this->db->fetchAssoc($sql, array($this->id));
    
    if(empty($row))
      $this->id = null; 
    else {
      // Remplir l'objet avec les données
      foreach ($row as $field => $value) {
        if ($field == 'data')
            $value = json_decode($value);
        $this->$field = $value;
      }
    }
  }

  /**
   * Crée l'objet avec les attributs passés en paramètres
   */
  static public function create(Connection $db, $attributes) {
    // Si il manque un attribut requis, on renvoie false
    // foreach (explode(',', static::REQUIRED_ATTRIBUTES) as $name) {
    //       $value = $formAttributes->get($name); if (empty($value)) return false;
    //     }
    
    // Insertion des données en base
    $db->insert(static::TABLE_NAME, $attributes);

    $id = isset($attributes['id']) ? $attributes['id'] : $db->lastInsertId();
    
    // Instanciation de l'objet nouvellement créé
    $object = new static($db, $id);

    return $object;
  }


  /**
   * Exécute une requête update sur l'objet courant
   * @param ParameterBag OR array $formAttributes : les champs à mettre à jour et leurs nouvelles valeurs
   * @return DbObject
   */
  public function update($attributes) {
    
    // Mise à jour de la bdd pour l'objet courant
    $this->db->update(static::TABLE_NAME, $attributes, array('id' => $this->id));
    // Renvoyer l'objet
    return $this;
  }
  

  /**
   * Supprime toute trace de l'objet courante en base
   */
  public function delete()
  {
    $this->db->delete(static::TABLE_NAME, array('id' => $this->id));
  }


  /**
   * Renvoie une liste d'objets
   * @param Connection $db
   * @param array $params : paramètres => sort_by, offset, limit, exclude_id
   * @return
   */
  static public function fetchList(Connection $db, $params = array())
  {
    // Tri
    switch (isset($params['sort_by']) ? $params['sort_by'] : '') {
      default:         $orderBy  = "ORDER BY o.id DESC"; break;
    }

    // Limit
    if (empty($params['limit'])) $limit = "";
    elseif (empty($params['offset'])) $limit = "LIMIT " . intval($params['limit']);
    else $limit = "LIMIT " . intval($params['offset']) . ", " . intval($params['limit']);

    // Requête
    $sql = "SELECT    o.id
            FROM      " . static::TABLE_NAME . " AS o
            $where
            $orderBy
            $limit";
    $res = $db->fetchAll($sql);
    
    $objectsArray = array();
    foreach($res as $row) {
      $objectsArray[] = new static($db, $row['id']);
    }
    return $objectsArray;
  }
  
}

