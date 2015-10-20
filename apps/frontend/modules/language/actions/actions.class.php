<?php

/**
 * language actions.
 *
 * @package    shop
 * @subpackage language
 * @author     Dmitriy
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class languageActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }

  public function executeChangeLanguage(sfWebRequest $request)
  {
    $oldCulture = $this->getUser()->getCulture();
    $form = new sfFormLanguage(
        $this->getUser(),
        array('languages' => array('en', 'ru'))
    );

    $form->process($request);
    $newCulture = $this->getUser()->getCulture();

    return $this->redirect(str_replace('/'.$oldCulture.'/', '/'.$newCulture.'/', $request->getParameter("redirect")));
  }
}
