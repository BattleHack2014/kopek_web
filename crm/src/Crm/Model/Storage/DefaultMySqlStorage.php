<?php
namespace Crm\Model\Storage;

use Crm\Logic\Logic;

class DefaultMySqlStorage extends MySqlStorage {

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getReader() {
        return Logic::getDbDefault();
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getWriter() {
        return Logic::getDbDefault();
    }

}