<?php

namespace HexagonDev\Core;

use HexagonDev\Core\Dtos\WhereStatementDto;

class Model {
    public string $table;
    public array $statements = [];

    public function getTable(): string
    {
        return $this->table ?? mb_strtolower(mb_basename($this::class)) . 's';
    }

    public static function query(): Model
    {
        $model = new static;

        $model->table = $model->getTable();

        return $model;
    }

    public function where(string $column, string $operator, mixed $value = null): static
    {
        if (!in_array($operator, ['<', '>', '=', '>=', '<=', '<>']) && is_null($value)) {
            $this->statements[] = new WhereStatementDto($column, '=', $operator);

            return $this;
        }

        $this->statements[] = new WhereStatementDto($column, $operator, $value);

        return $this;
    }

    public function buildQuery(): array
    {
        $query = '';
        $params = [];

        $whereStatements = array_filter($this->statements, function ($statement) {
            return $statement instanceof WhereStatementDto;
        });

        if (!empty($whereStatements)) {
            $query .= ' WHERE ';
            $firstStatement = true;

            foreach ($whereStatements as $statement) {
                if (!$firstStatement) {
                    $query .= ' AND ';
                }

                $query .= $statement->column . ' ' . $statement->operator . ' ?';
                $params[] = $statement->value;

                $firstStatement = false;
            }
        }

        return ['query' => $query, 'params' => $params];
    }

    public function first(): mixed
    {
        $data = $this->buildQuery();

        $query = 'SELECT * FROM ' . $this->table . ' ' . $data['query'] . ' LIMIT 1';

        return Database::first($query, $data['params']);
    }

    public function get(): array
    {
        $data = $this->buildQuery();

        $query = 'SELECT * FROM ' . $this->table . ' ' . $data['query'];

        return Database::get($query, $data['params']);
    }

    public function create($data): int
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO " . $this->table . " ($columns) VALUES ($placeholders)";

        return Database::create($sql, $data);
    }

    public function dd(): void
    {
        $data = $this->buildQuery();

        $query = 'SELECT * FROM ' . $this->table . ' ' . $data['query'];

        dd($query, $data['params']);
    }
}