<?php

use RapidRoute\CompiledRouter;
use RapidRoute\Pattern;

return CompiledRouter::generate(
    __DIR__ . '/compiled/rr.php',
    function (\RapidRoute\RouteCollection $routes) {
        $routes->param('page_slug', Pattern::ALPHA_NUM_DASH);
        $routes->param('post_slug', Pattern::ALPHA_NUM_DASH);
        $routes->param('category_id', Pattern::DIGITS);
        $routes->param('product_id', Pattern::DIGITS);
        $routes->param('filter_by', Pattern::ALPHA);

        $routes->get('/', ['name' => 'home']);
        $routes->get('/page/{page_slug}', ['name' => 'page.show']);
        $routes->get('/about-us', ['name' => 'about-us']);
        $routes->get('/contact-us', ['name' => 'contact-us']);
        $routes->post('/contact-us', ['name' => 'contact-us.submit']);

        $routes->get('/blog', ['name' => 'blog.index']);
        $routes->get('/blog/recent', ['name' => 'blog.recent']);
        $routes->get('/blog/post/{post_slug}', ['name' => 'blog.post.show']);
        $routes->post('/blog/post/{post_slug}/comment', ['name' => 'blog.post.comment']);

        $routes->get('/shop', ['name' => 'shop.index']);

        $routes->get('/shop/category', ['name' => 'shop.category.index']);
        $routes->get('/shop/category/search/{filter_by}:{filter_value}', ['name' => 'shop.category.search']);
        $routes->get('/shop/category/{category_id}', ['name' => 'shop.category.show']);
        $routes->get('/shop/category/{category_id}/product', ['name' => 'shop.category.product.index']);
        $routes->get('/shop/category/{category_id}/product/search/{filter_by}:{filter_value}', ['name' => 'shop.category.product.search']);

        $routes->get('/shop/product', ['name' => 'shop.product.index']);
        $routes->get('/shop/product/search/{filter_by}:{filter_value}', ['name' => 'shop.product.search']);
        $routes->get('/shop/product/{product_id}', ['name' => 'shop.product.show']);

        $routes->get('/shop/cart', ['name' => 'shop.cart.show']);
        $routes->put('/shop/cart', ['name' => 'shop.cart.add']);
        $routes->delete('/shop/cart', ['name' => 'shop.cart.empty']);
        $routes->get('/shop/cart/checkout', ['name' => 'shop.cart.checkout.show']);
        $routes->post('/shop/cart/checkout', ['name' => 'shop.cart.checkout.process']);

        $routes->get('/admin/login', ['name' => 'admin.login']);
        $routes->post('/admin/login', ['name' => 'admin.login.submit']);
        $routes->get('/admin/logout', ['name' => 'admin.logout']);
        $routes->get('/admin', ['name' => 'admin.index']);

        $routes->get('/admin/product', ['name' => 'admin.product.index']);
        $routes->get('/admin/product/create', ['name' => 'admin.product.create']);
        $routes->post('/admin/product', ['name' => 'admin.product.store']);
        $routes->get('/admin/product/{product_id}', ['name' => 'admin.product.show']);
        $routes->get('/admin/product/{product_id}/edit', ['name' => 'admin.product.edit']);
        $routes->add(['PUT', 'PATCH'], '/admin/product/{product_id}', ['name' => 'admin.product.update']);
        $routes->delete('/admin/product/{product_id}', ['name' => 'admin.product.destroy']);

        $routes->get('/admin/category', ['name' => 'admin.category.index']);
        $routes->get('/admin/category/create', ['name' => 'admin.category.create']);
        $routes->post('/admin/category', ['name' => 'admin.category.store']);
        $routes->get('/admin/category/{category_id}', ['name' => 'admin.category.show']);
        $routes->get('/admin/category/{category_id}/edit', ['name' => 'admin.category.edit']);
        $routes->add(['PUT', 'PATCH'], '/admin/category/{category_id}', ['name' => 'admin.category.update']);
        $routes->delete('/admin/category/{category_id}', ['name' => 'admin.category.destroy']);
    }
);