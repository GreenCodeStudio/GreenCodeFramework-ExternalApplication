<?php

namespace ExternalApplication;

use Authorization\Authorization;
use Authorization\Exceptions\NoPermissionException;
use ExternalApplication\Repository\ExternalApplicationRepository;

class ExternalApplication extends \Core\BussinesLogic
{
    public function __construct()
    {
        $this->defaultDB = new ExternalApplicationRepository();
    }

    public function getDataTable($options)
    {
        return $this->defaultDB->getDataTable($options);
    }

    public function update(int $id, $data)
    {
        if (!$this->defaultDB->getUserId($id) != Authorization::getUserId())
            throw new NoPermissionException();

        $filtered = $this->filterData($data);
        $this->defaultDB->update($id, $filtered);
        \Core\WebSocket\Sender::sendToUsers(["ExternalApplication", "ExternalApplication", "Update", $id]);
    }

    protected function filterData($data)
    {
        $ret = [];
        $ret['name'] = $data->name;
        return $ret;
    }

    public function insert($data)
    {
        $filtered = $this->filterData($data);
        $filtered['id_user'] = Authorization::getUserId();
        $id = $this->defaultDB->insert($filtered);
        $this->generateNewToken($id);

        \Core\WebSocket\Sender::sendToUsers(["ExternalApplication", "ExternalApplication", "Insert", $id]);
    }
    public function generateNewToken(int $applicationId)
    {
        $token = bin2hex(random_bytes(24));
        $this->defaultDB->insertToken(['token' => $token, 'id_external_application' => $applicationId]);
    }

}
