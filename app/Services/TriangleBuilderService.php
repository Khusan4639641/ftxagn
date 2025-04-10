<?php

namespace App\Services;

class TriangleBuilderService
{
    /**
     * @param int $count
     * @return array|string
     */
    public function build(int $count)
    {
        $level = 1;
        $total = 0;

        // Подсчитываем количество строк, которое можно построить
        while ($total + $level <= $count) {
            $total += $level;
            $level++;
        }

        // Если не получилось ровно N элементов — ошибка
        if ($total !== $count) {
            return 'Невозможно построить треугольник';
        }

        // Строим треугольник
        $current = 1;
        $result = [];
        for ($i = 1; $i < $level; $i++) {
            $line = [];
            for ($j = 0; $j < $i; $j++) {
                $line[] = $current++;
            }
            $result[] = $line;
        }

        return $result;
    }
}
