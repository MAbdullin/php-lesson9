<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.10.2017
 * Time: 18:24
 */

namespace Controllers;

use Models\Product;

class ProductController
{
    public function execute($method, $action, $id)
    {
        $_product = new Product();
        if ($method === 'GET') {
            if ($action === 'view' || $action === 'edit') {
                // Отдаем views/products.php
                $product = $_product->getOne($id);
                if (!$product) {
                    print_r('Товар не найден');
                    die();
                }
                $editable = false;
                if ($action === 'edit') {
                    $editable = true;
                }
                include_once dirname(__FILE__) . '/../views/products.php';
            }
        } else if ($method === 'POST') {
            if ($action === 'edit') {
                $_product->update($id, $_POST);
            } else if ($action === 'delete') {
                $_product->delete($id, $_POST);
            } else if ($action === 'create') {
                $_product->create($id, $_POST);
            }
            header('location:/15_1/');
        }
    }
}