<?php

namespace ExternalApplication\Repository;

use Core\Database\DB;


class ExternalApplicationRepository extends \Core\Repository
{

    public function __construct()
    {
        $this->archiveMode = static::ArchiveMode_OnlyExisting;
    }

    public function defaultTable(): string
    {
        return 'external_application';
    }

    public function getDataTable($options)
    {
        $start = (int)$options->start;
        $limit = (int)$options->limit;
        $sqlOrder = $this->getOrderSQL($options);
        $idUser = \Authorization\Authorization::getUserId();
        $rows = DB::get("SELECT * FROM external_application WHERE id_user = ? $sqlOrder LIMIT $start,$limit", [$idUser]);
        $total = DB::get("SELECT count(*) as count FROM external_application WHERE id_user = ?", [$idUser])[0]->count;
        return ['rows' => $rows, 'total' => $total];
    }

    private function getOrderSQL($options)
    {
        if (empty($options->sort))
            return "";
        else {
            $mapping = ['name' => 'name'];
            if (empty($mapping[$options->sort->col]))
                throw new Exception();
            return ' ORDER BY '.DB::safeKey($mapping[$options->sort->col]).' '.($options->sort->desc ? 'DESC' : 'ASC').' ';
        }
    }

    public function getUserId(int $id)
    {
        return DB::get("SELECT id_user FROM external_application WHERE id = ?", [$id])->id_user;
    }

    public function getByToken(string $token)
    {
        return DB::get("SELECT ea.*
FROM external_application ea
    JOIN  external_application_token eat ON eat.id_external_application = ea.id
    WHERE token = ?", [$token])[0]??null;
    }
}