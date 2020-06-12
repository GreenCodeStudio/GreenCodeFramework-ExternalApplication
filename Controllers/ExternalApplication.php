<?php

namespace ExternalApplication\Controllers;

use Authorization\Permissions;
use Core\Exceptions\NotFoundException;
class ExternalApplication extends \Common\PageStandardController
{

    function index()
    {
        $this->will('ExternalApplication', 'show');
        $this->addView('ExternalApplication', 'ExternalApplicationList');
        $this->pushBreadcrumb(['title' => 'ExternalApplication', 'url' => '/ExternalApplication']);

    }

    /**
     * @param int $id
     * @OfflineDataOnly
     */
    function edit(int $id)
    {
        $this->will('ExternalApplication', 'edit');
        $this->addView('ExternalApplication', 'ExternalApplicationEdit', ['type' => 'edit']);
        $this->pushBreadcrumb(['title' => 'ExternalApplication', 'url' => '/ExternalApplication']);
        $this->pushBreadcrumb(['title' => 'Edycja', 'url' => '/ExternalApplication/edit/'.$id]);
    }

    function edit_data(int $id)
    {
        $this->will('ExternalApplication', 'edit');
        $ExternalApplication = new \ExternalApplication\ExternalApplication();
        $data = $ExternalApplication->getById($id);
        if ($data == null)
            throw new NotFoundException();
        return ['ExternalApplication' => $data];
    }

    /**
     * @OfflineConstant
     */
    function add()
    {
        $this->will('ExternalApplication', 'add');
        $this->addView('ExternalApplication', 'ExternalApplicationEdit', ['type' => 'add']);
        $this->pushBreadcrumb(['title' => 'ExternalApplication', 'url' => '/ExternalApplication']);
        $this->pushBreadcrumb(['title' => 'Dodaj', 'url' => '/ExternalApplication/add']);
    }
    
}
