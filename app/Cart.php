<?php
/**
 * Created by PhpStorm.
 * User: MIDWAY
 * Date: 24/07/2015
 * Time: 14:17
 */

namespace App;


class Cart
{
    private $items;

    public function __construct()
    {
        $this->items = [];
    }

    /**
     * @param $id
     * @param $name
     * @param $price
     */
    public function add($id, $name, $price)
    {
        $this->items += [
            $id => [
                'qtd' => isset($this->items[$id]['qtd']) ? $this->items[$id]['qtd']++ : 1,
                'price' => $price,
                'name' => $name,
            ],
        ];

        return $this->items;
    }

    public function updateQtd($id, $qtd){
        $this->items[$id]['qtd'] = $qtd;
    }

    public function remove($id)
    {
        unset($this->items[$id]);
    }

    public function limpar()
    {
        $this->items = [];
    }

    public function all(){
        return $this->items;
    }

    public function getTotal()
    {
        $total = 0;
        foreach($this->items as $item){
            $total+= $item['qtd'] * $item['price'];
        }

        return $total;
    }
}