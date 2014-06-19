<?php
namespace Crm\Model\Storage;

use Crm\Model\Model;

interface Storage {

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getWriter();

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getReader();

}