<?php

namespace HexagonDev\Core;

class Migration
{
    public function up()
    {
        //
    }

    public function down()
    {
        //
    }

    public function execute($sql): void
    {
        Database::execute($sql);
    }
}