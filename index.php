<?php

require_once __DIR__ . '/entity/Customer.php';
require_once __DIR__ . '/entity/Product.php';
require_once __DIR__ . '/repository/CustomerRepository.php';
require_once __DIR__ . '/repository/ProductRepository.php';

use repository\CustomerRepository;
use repository\ProductRepository;

print_r(CustomerRepository::findById('1'));
print_r(ProductRepository::findById('A101'));
