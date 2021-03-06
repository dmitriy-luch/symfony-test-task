<?php

/**
 * BaseCatalogue
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $cat_id
 * @property string $name
 * @property string $source_lang
 * @property string $target_lang
 * @property integer $date_created
 * @property integer $date_modified
 * @property string $author
 * @property Doctrine_Collection $transUnit
 * 
 * @method integer             getCatId()         Returns the current record's "cat_id" value
 * @method string              getName()          Returns the current record's "name" value
 * @method string              getSourceLang()    Returns the current record's "source_lang" value
 * @method string              getTargetLang()    Returns the current record's "target_lang" value
 * @method integer             getDateCreated()   Returns the current record's "date_created" value
 * @method integer             getDateModified()  Returns the current record's "date_modified" value
 * @method string              getAuthor()        Returns the current record's "author" value
 * @method Doctrine_Collection getTransUnit()     Returns the current record's "transUnit" collection
 * @method Catalogue           setCatId()         Sets the current record's "cat_id" value
 * @method Catalogue           setName()          Sets the current record's "name" value
 * @method Catalogue           setSourceLang()    Sets the current record's "source_lang" value
 * @method Catalogue           setTargetLang()    Sets the current record's "target_lang" value
 * @method Catalogue           setDateCreated()   Sets the current record's "date_created" value
 * @method Catalogue           setDateModified()  Sets the current record's "date_modified" value
 * @method Catalogue           setAuthor()        Sets the current record's "author" value
 * @method Catalogue           setTransUnit()     Sets the current record's "transUnit" collection
 * 
 * @package    shop
 * @subpackage model
 * @author     Dmitriy
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCatalogue extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('catalogue');
        $this->hasColumn('cat_id', 'integer', 8, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             'length' => 8,
             ));
        $this->hasColumn('name', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('source_lang', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('target_lang', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));
        $this->hasColumn('date_created', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('date_modified', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('author', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));


        $this->index('cat_id', array(
             'fields' => 
             array(
              0 => 'cat_id',
             ),
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('TransUnit as transUnit', array(
             'local' => 'cat_id',
             'foreign' => 'cat_id'));
    }
}