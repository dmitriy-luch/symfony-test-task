<?php

/**
 * Override of sfValidatorDoctrineUnique  to include I18n
 */
class sfValidatorDoctrineUniqueI18n extends sfValidatorDoctrineUnique
{
  /**
   * Overrode method to use Translation table
   *
   * @see sfValidatorDoctrineUnique
   */
  protected function doClean($values)
  {
    $originalValues = $values;
    $table = Doctrine_Core::getTable($this->getOption('model'));
    if (!is_array($this->getOption('column')))
    {
      $this->setOption('column', array($this->getOption('column')));
    }
    //if $values isn't an array, make it one
    if (!is_array($values))
    {
      //use first column for key
      $columns = $this->getOption('column');
      $values = array($columns[0] => $values);
    }

    $q = Doctrine_Core::getTable($this->getOption('model'))
        ->createQuery('a')
        ->leftJoin('a.Translation t');

    foreach ($this->getOption('column') as $column)
    {
      $colName = $table->getColumnName($column);
      if (!array_key_exists($column, $values))
      {
        // one of the column has be removed from the form
        return $originalValues;
      }

      $q->addWhere('t.' . $colName . ' = ?', $values[$column]);
    }

    $object = $q->fetchOne();

    // if no object or if we're updating the object, it's ok
    if (!$object || $this->isUpdate($object, $values))
    {
      return $originalValues;
    }

    $error = new sfValidatorError($this, 'invalid', array('column' => implode(', ', $this->getOption('column'))));

    if ($this->getOption('throw_global_error'))
    {
      throw $error;
    }

    $columns = $this->getOption('column');

    throw new sfValidatorErrorSchema($this, array($columns[0] => $error));
  }
}