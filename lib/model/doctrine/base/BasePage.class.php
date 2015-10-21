<?php

/**
 * BasePage
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $title
 * @property varchar $url
 * @property varchar $meta_description
 * @property varchar $meta_keywords
 * @property string $content
 * 
 * @method string  getTitle()            Returns the current record's "title" value
 * @method varchar getUrl()              Returns the current record's "url" value
 * @method varchar getMetaDescription()  Returns the current record's "meta_description" value
 * @method varchar getMetaKeywords()     Returns the current record's "meta_keywords" value
 * @method string  getContent()          Returns the current record's "content" value
 * @method Page    setTitle()            Sets the current record's "title" value
 * @method Page    setUrl()              Sets the current record's "url" value
 * @method Page    setMetaDescription()  Sets the current record's "meta_description" value
 * @method Page    setMetaKeywords()     Sets the current record's "meta_keywords" value
 * @method Page    setContent()          Sets the current record's "content" value
 * 
 * @package    shop
 * @subpackage model
 * @author     Dmitriy
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePage extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('page');
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('url', 'varchar', 255, array(
             'type' => 'varchar',
             'unique' => true,
             'length' => 255,
             ));
        $this->hasColumn('meta_description', 'varchar', 255, array(
             'type' => 'varchar',
             'length' => 255,
             ));
        $this->hasColumn('meta_keywords', 'varchar', 255, array(
             'type' => 'varchar',
             'length' => 255,
             ));
        $this->hasColumn('content', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $i18n0 = new Doctrine_Template_I18n(array(
             'fields' => 
             array(
              0 => 'title',
              1 => 'content',
             ),
             ));
        $this->actAs($timestampable0);
        $this->actAs($i18n0);
    }
}