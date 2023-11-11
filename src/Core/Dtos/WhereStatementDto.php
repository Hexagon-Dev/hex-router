<?php

namespace HexagonDev\Core\Dtos;

class WhereStatementDto
{
    public function __construct(public string $column, public string $operator = '=', public mixed $value = null)
    {
    }
}