<?php
namespace Crm\Model\Storage;

use Crm\Logic\Logic;

class ProjectMySqlStorage extends MySqlStorage {

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getReader() {
        return Logic::getDbReader();
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getWriter() {
        return Logic::getDbWriter();
    }

}