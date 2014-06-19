<?php
namespace Crm\Model;

interface Moderated {

    const PENDING = 'pending';
    const APPROVED = 'approved';
    const REJECTED = 'rejected';

    public function approve();

    public function reject();

}