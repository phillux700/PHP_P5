<?php 
namespace Philippe\Blog\Model\Entities;
class PostEntity
{
    private $id;
    private $title;
    private $chapo;
    private $intro;
    private $content;
    private $author;
    private $creation_date;
    private $last_updated;
    private $file_extension;
    private $category;

    /*
     * Méthode de construction
     */
    public function __construct($datas) 
    {
        $this->hydrate($datas);
    }

    /*
     * Methode d'hydratation
     */
    public function hydrate($datas) 
    {
          /*foreach ($data as $key => $value) {
              $method = 'set'.ucfirst($key);
              
              if (method_exists($this, $method)) {
                  $this->$method($value);
              }
          }*/
          $this->setId($datas['id']);
          $this->setTitle($datas['title']);
          $this->setChapo($datas['chapo']);
          $this->setIntro($datas['intro']);
          $this->setContent($datas['content']);
          $this->setAuthor($datas['author']);
          $this->setCreationDate($datas['creation_date_fr']);
          $this->setLastUpdated($datas['last_updated_fr']);
          $this->setFileExtension($datas['file_extension']);
          $this->setCategory($datas['category_id']);
    }

    public function setId($id)
    {
        $id = (int)$id;
        if($id > 0) {
            $this->id = $id;
        }  
    }
    public function setTitle($title)
    {
        if (is_string($title)) {
            $this->title = $title;
        }
    }
    public function setChapo($chapo)
    {
        if (is_string($chapo)) {
            $this->chapo = $chapo;
        }
    }
    public function setIntro($intro)
    {
        if (is_string($intro)) {
            $this->intro = $intro;
        }
    }
    public function setContent($content)
    {
        if (is_string($content)) {
            $this->content = $content;
        }
    }
    public function setAuthor($author)
    {
        if (is_string($author)) {
            $this->author = $author;
        }
    }
    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }
    public function setLastUpdated($last_updated)
    {
        $this->last_updated = $last_updated;
    }
    public function setFileExtension($file_extension)
    {
        if (is_string($file_extension)) {
            $this->file_extension = $file_extension;
        }
    }
    public function setCategory($category)
    {
        $category = (int)$category;
        if($category > 0) {
            $this->category = $category;
        }  
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getChapo()
    {
        return $this->chapo;
    }
    public function getIntro()
    {
        return $this->intro;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getAuthor()
    {
        return $this->author;
    }
    public function getCreationDate()
    {
        return $this->creation_date;
    }
    public function getLastUpdated()
    {
        return $this->last_updated;
    }
    public function getFileExtension()
    {
        return $this->file_extension;
    }
    public function getCategory()
    {
        return $this->category;
    }
}