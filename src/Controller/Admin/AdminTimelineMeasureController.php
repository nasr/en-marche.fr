<?php

namespace AppBundle\Controller\Admin;

use A2lix\I18nDoctrineBundle\Annotation\I18nDoctrine;
use Sonata\AdminBundle\Controller\CRUDController as Controller;

class AdminTimelineMeasureController extends Controller
{
    public function listAction()
    {
        return parent::listAction();
    }
}
