<?php

namespace App\Repositories\Front\Interfaces;

interface ProductRepositoryInterface
{
    public function findAll(array $options = []);
    public function findById($id);
    public function delete($id);  // <- Tambahkan ini
}