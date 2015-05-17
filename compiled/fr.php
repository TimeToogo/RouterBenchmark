<?php return array (
  0 => 
  array (
    'GET' => 
    array (
      '/' => 
      array (
        'name' => 'home',
      ),
      '/about-us' => 
      array (
        'name' => 'about-us',
      ),
      '/contact-us' => 
      array (
        'name' => 'contact-us',
      ),
      '/blog' => 
      array (
        'name' => 'blog.index',
      ),
      '/blog/recent' => 
      array (
        'name' => 'blog.recent',
      ),
      '/shop' => 
      array (
        'name' => 'shop.index',
      ),
      '/shop/category' => 
      array (
        'name' => 'shop.category.index',
      ),
      '/shop/product' => 
      array (
        'name' => 'shop.product.index',
      ),
      '/shop/cart' => 
      array (
        'name' => 'shop.cart.show',
      ),
      '/shop/cart/checkout' => 
      array (
        'name' => 'shop.cart.checkout.show',
      ),
      '/admin/login' => 
      array (
        'name' => 'admin.login',
      ),
      '/admin/logout' => 
      array (
        'name' => 'admin.logout',
      ),
      '/admin' => 
      array (
        'name' => 'admin.index',
      ),
      '/admin/product' => 
      array (
        'name' => 'admin.product.index',
      ),
      '/admin/product/create' => 
      array (
        'name' => 'admin.product.create',
      ),
      '/admin/category' => 
      array (
        'name' => 'admin.category.index',
      ),
      '/admin/category/create' => 
      array (
        'name' => 'admin.category.create',
      ),
    ),
    'POST' => 
    array (
      '/contact-us' => 
      array (
        'name' => 'contact-us.submit',
      ),
      '/shop/cart/checkout' => 
      array (
        'name' => 'shop.cart.checkout.process',
      ),
      '/admin/login' => 
      array (
        'name' => 'admin.login.submit',
      ),
      '/admin/product' => 
      array (
        'name' => 'admin.product.store',
      ),
      '/admin/category' => 
      array (
        'name' => 'admin.category.store',
      ),
    ),
    'PUT' => 
    array (
      '/shop/cart' => 
      array (
        'name' => 'shop.cart.add',
      ),
    ),
    'DELETE' => 
    array (
      '/shop/cart' => 
      array (
        'name' => 'shop.cart.empty',
      ),
    ),
  ),
  1 => 
  array (
    'GET' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/page/([a-zA-Z0-9\\-]+)|/blog/post/([a-zA-Z0-9\\-]+)()|/shop/category/search/([a-zA-Z]+)\\:([^/]+)()|/shop/category/(\\d+)()()()|/shop/category/(\\d+)/product()()()()|/shop/category/(\\d+)/product/search/([a-zA-Z]+)\\:([^/]+)()()()|/shop/product/search/([a-zA-Z]+)\\:([^/]+)()()()()()|/shop/product/(\\d+)()()()()()()()|/admin/product/(\\d+)()()()()()()()()|/admin/product/(\\d+)/edit()()()()()()()()()|/admin/category/(\\d+)()()()()()()()()()()|/admin/category/(\\d+)/edit()()()()()()()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 
            array (
              'name' => 'page.show',
            ),
            1 => 
            array (
              'page_slug' => 'page_slug',
            ),
          ),
          3 => 
          array (
            0 => 
            array (
              'name' => 'blog.post.show',
            ),
            1 => 
            array (
              'post_slug' => 'post_slug',
            ),
          ),
          4 => 
          array (
            0 => 
            array (
              'name' => 'shop.category.search',
            ),
            1 => 
            array (
              'filter_by' => 'filter_by',
              'filter_value' => 'filter_value',
            ),
          ),
          5 => 
          array (
            0 => 
            array (
              'name' => 'shop.category.show',
            ),
            1 => 
            array (
              'category_id' => 'category_id',
            ),
          ),
          6 => 
          array (
            0 => 
            array (
              'name' => 'shop.category.product.index',
            ),
            1 => 
            array (
              'category_id' => 'category_id',
            ),
          ),
          7 => 
          array (
            0 => 
            array (
              'name' => 'shop.category.product.search',
            ),
            1 => 
            array (
              'category_id' => 'category_id',
              'filter_by' => 'filter_by',
              'filter_value' => 'filter_value',
            ),
          ),
          8 => 
          array (
            0 => 
            array (
              'name' => 'shop.product.search',
            ),
            1 => 
            array (
              'filter_by' => 'filter_by',
              'filter_value' => 'filter_value',
            ),
          ),
          9 => 
          array (
            0 => 
            array (
              'name' => 'shop.product.show',
            ),
            1 => 
            array (
              'product_id' => 'product_id',
            ),
          ),
          10 => 
          array (
            0 => 
            array (
              'name' => 'admin.product.show',
            ),
            1 => 
            array (
              'product_id' => 'product_id',
            ),
          ),
          11 => 
          array (
            0 => 
            array (
              'name' => 'admin.product.edit',
            ),
            1 => 
            array (
              'product_id' => 'product_id',
            ),
          ),
          12 => 
          array (
            0 => 
            array (
              'name' => 'admin.category.show',
            ),
            1 => 
            array (
              'category_id' => 'category_id',
            ),
          ),
          13 => 
          array (
            0 => 
            array (
              'name' => 'admin.category.edit',
            ),
            1 => 
            array (
              'category_id' => 'category_id',
            ),
          ),
        ),
      ),
    ),
    'POST' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/blog/post/([a-zA-Z0-9\\-]+)/comment)$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 
            array (
              'name' => 'blog.post.comment',
            ),
            1 => 
            array (
              'post_slug' => 'post_slug',
            ),
          ),
        ),
      ),
    ),
    'PUT' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/admin/product/(\\d+)|/admin/category/(\\d+)())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 
            array (
              'name' => 'admin.product.update',
            ),
            1 => 
            array (
              'product_id' => 'product_id',
            ),
          ),
          3 => 
          array (
            0 => 
            array (
              'name' => 'admin.category.update',
            ),
            1 => 
            array (
              'category_id' => 'category_id',
            ),
          ),
        ),
      ),
    ),
    'PATCH' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/admin/product/(\\d+)|/admin/category/(\\d+)())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 
            array (
              'name' => 'admin.product.update',
            ),
            1 => 
            array (
              'product_id' => 'product_id',
            ),
          ),
          3 => 
          array (
            0 => 
            array (
              'name' => 'admin.category.update',
            ),
            1 => 
            array (
              'category_id' => 'category_id',
            ),
          ),
        ),
      ),
    ),
    'DELETE' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/admin/product/(\\d+)|/admin/category/(\\d+)())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 
            array (
              'name' => 'admin.product.destroy',
            ),
            1 => 
            array (
              'product_id' => 'product_id',
            ),
          ),
          3 => 
          array (
            0 => 
            array (
              'name' => 'admin.category.destroy',
            ),
            1 => 
            array (
              'category_id' => 'category_id',
            ),
          ),
        ),
      ),
    ),
  ),
);