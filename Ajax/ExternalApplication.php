<?php
namespace ExternalApplication\Ajax;

class ExternalApplication extends \Core\AjaxController
{
    public function getTable($options)
    {
        $this->will('ExternalApplication', 'show');
        $ExternalApplication = new \ExternalApplication\ExternalApplication();
        return $ExternalApplication->getDataTable($options);
    }

    public function update($data)
    {
        $this->will('ExternalApplication', 'edit');
        $ExternalApplication = new \ExternalApplication\ExternalApplication();
        $ExternalApplication->update($data->id, $data);
    }

    public function insert($data)
    {
        $this->will('ExternalApplication', 'add');
        $ExternalApplication = new \ExternalApplication\ExternalApplication();
        $id = $ExternalApplication->insert($data);
    }
}