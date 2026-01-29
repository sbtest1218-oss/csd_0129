<?php

namespace App\Services;

class Calculator
{
    /**
     * 2つの数を足す
     */
    public function add($a, $b)
    {
        return $a + $b;
    }

    /**
     * 2つの数値を乗算する
     *
     * @param int|float $a 第1の乗数
     * @param int|float $b 第2の乗数
     * @return int|float 乗算結果
     */
    public function multiply(int|float $a, int|float $b): int|float
    {
        return $a * $b;
    }

    /**
     * 2つの数値を除算する
     *
     * @param int|float $a 被除数
     * @param int|float $b 除数
     * @return int|float 除算結果
     * @throws \InvalidArgumentException 除数が0の場合
     */
    public function divide(int|float $a, int|float $b): int|float
    {
        if ($b === 0) {
            throw new \InvalidArgumentException('0で割ることはできません');
        }

        return $a / $b;
    }
}
