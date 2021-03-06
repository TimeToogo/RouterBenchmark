<?php

use RapidRoute\RapidRouteException;

return function ($method, $uri) {
    if($uri === '') {
        return [0];
    } elseif ($uri[0] !== '/') {
        throw new RapidRouteException("Cannot match route: non-empty uri must be prefixed with '/', '{$uri}' given");
    }

    $segments = explode('/', substr($uri, 1));

    switch (count($segments)) {
        case 1:
            list($s0) = $segments;
            if ($s0 === '') {
                switch ($method) {
                    case 'GET':
                    case 'HEAD':
                        return [2, ['name' => 'home'], []];
                    default:
                        $allowedHttpMethods[] = 'GET';
                        $allowedHttpMethods[] = 'HEAD';
                        break;
                }
            }
            if ($s0 === 'about-us') {
                switch ($method) {
                    case 'GET':
                    case 'HEAD':
                        return [2, ['name' => 'about-us'], []];
                    default:
                        $allowedHttpMethods[] = 'GET';
                        $allowedHttpMethods[] = 'HEAD';
                        break;
                }
            }
            if ($s0 === 'contact-us') {
                switch ($method) {
                    case 'GET':
                    case 'HEAD':
                        return [2, ['name' => 'contact-us'], []];
                    case 'POST':
                        return [2, ['name' => 'contact-us.submit'], []];
                    default:
                        $allowedHttpMethods[] = 'GET';
                        $allowedHttpMethods[] = 'HEAD';
                        $allowedHttpMethods[] = 'POST';
                        break;
                }
            }
            if ($s0 === 'blog') {
                switch ($method) {
                    case 'GET':
                    case 'HEAD':
                        return [2, ['name' => 'blog.index'], []];
                    default:
                        $allowedHttpMethods[] = 'GET';
                        $allowedHttpMethods[] = 'HEAD';
                        break;
                }
            }
            if ($s0 === 'shop') {
                switch ($method) {
                    case 'GET':
                    case 'HEAD':
                        return [2, ['name' => 'shop.index'], []];
                    default:
                        $allowedHttpMethods[] = 'GET';
                        $allowedHttpMethods[] = 'HEAD';
                        break;
                }
            }
            if ($s0 === 'admin') {
                switch ($method) {
                    case 'GET':
                    case 'HEAD':
                        return [2, ['name' => 'admin.index'], []];
                    default:
                        $allowedHttpMethods[] = 'GET';
                        $allowedHttpMethods[] = 'HEAD';
                        break;
                }
            }
            return isset($allowedHttpMethods) ? [1, $allowedHttpMethods] : [0];
            break;
        
        case 2:
            list($s0, $s1) = $segments;
            if ($s0 === 'page' && ctype_alnum(str_replace('-', '', $s1))) {
                switch ($method) {
                    case 'GET':
                    case 'HEAD':
                        return [2, ['name' => 'page.show'], ['page_slug' => $s1]];
                    default:
                        $allowedHttpMethods[] = 'GET';
                        $allowedHttpMethods[] = 'HEAD';
                        break;
                }
            }
            if ($s0 === 'blog' && $s1 === 'recent') {
                switch ($method) {
                    case 'GET':
                    case 'HEAD':
                        return [2, ['name' => 'blog.recent'], []];
                    default:
                        $allowedHttpMethods[] = 'GET';
                        $allowedHttpMethods[] = 'HEAD';
                        break;
                }
            }
            if ($s0 === 'shop') {
                if ($s1 === 'category') {
                    switch ($method) {
                        case 'GET':
                        case 'HEAD':
                            return [2, ['name' => 'shop.category.index'], []];
                        default:
                            $allowedHttpMethods[] = 'GET';
                            $allowedHttpMethods[] = 'HEAD';
                            break;
                    }
                }
                if ($s1 === 'product') {
                    switch ($method) {
                        case 'GET':
                        case 'HEAD':
                            return [2, ['name' => 'shop.product.index'], []];
                        default:
                            $allowedHttpMethods[] = 'GET';
                            $allowedHttpMethods[] = 'HEAD';
                            break;
                    }
                }
                if ($s1 === 'cart') {
                    switch ($method) {
                        case 'GET':
                        case 'HEAD':
                            return [2, ['name' => 'shop.cart.show'], []];
                        case 'PUT':
                            return [2, ['name' => 'shop.cart.add'], []];
                        case 'DELETE':
                            return [2, ['name' => 'shop.cart.empty'], []];
                        default:
                            $allowedHttpMethods[] = 'GET';
                            $allowedHttpMethods[] = 'HEAD';
                            $allowedHttpMethods[] = 'PUT';
                            $allowedHttpMethods[] = 'DELETE';
                            break;
                    }
                }
            }
            if ($s0 === 'admin') {
                if ($s1 === 'login') {
                    switch ($method) {
                        case 'GET':
                        case 'HEAD':
                            return [2, ['name' => 'admin.login'], []];
                        case 'POST':
                            return [2, ['name' => 'admin.login.submit'], []];
                        default:
                            $allowedHttpMethods[] = 'GET';
                            $allowedHttpMethods[] = 'HEAD';
                            $allowedHttpMethods[] = 'POST';
                            break;
                    }
                }
                if ($s1 === 'logout') {
                    switch ($method) {
                        case 'GET':
                        case 'HEAD':
                            return [2, ['name' => 'admin.logout'], []];
                        default:
                            $allowedHttpMethods[] = 'GET';
                            $allowedHttpMethods[] = 'HEAD';
                            break;
                    }
                }
                if ($s1 === 'product') {
                    switch ($method) {
                        case 'GET':
                        case 'HEAD':
                            return [2, ['name' => 'admin.product.index'], []];
                        case 'POST':
                            return [2, ['name' => 'admin.product.store'], []];
                        default:
                            $allowedHttpMethods[] = 'GET';
                            $allowedHttpMethods[] = 'HEAD';
                            $allowedHttpMethods[] = 'POST';
                            break;
                    }
                }
                if ($s1 === 'category') {
                    switch ($method) {
                        case 'GET':
                        case 'HEAD':
                            return [2, ['name' => 'admin.category.index'], []];
                        case 'POST':
                            return [2, ['name' => 'admin.category.store'], []];
                        default:
                            $allowedHttpMethods[] = 'GET';
                            $allowedHttpMethods[] = 'HEAD';
                            $allowedHttpMethods[] = 'POST';
                            break;
                    }
                }
            }
            return isset($allowedHttpMethods) ? [1, $allowedHttpMethods] : [0];
            break;
        
        case 3:
            list($s0, $s1, $s2) = $segments;
            if ($s0 === 'blog' && $s1 === 'post' && ctype_alnum(str_replace('-', '', $s2))) {
                switch ($method) {
                    case 'GET':
                    case 'HEAD':
                        return [2, ['name' => 'blog.post.show'], ['post_slug' => $s2]];
                    default:
                        $allowedHttpMethods[] = 'GET';
                        $allowedHttpMethods[] = 'HEAD';
                        break;
                }
            }
            if ($s0 === 'shop') {
                if (ctype_digit($s2)) {
                    if ($s1 === 'category') {
                        switch ($method) {
                            case 'GET':
                            case 'HEAD':
                                return [2, ['name' => 'shop.category.show'], ['category_id' => $s2]];
                            default:
                                $allowedHttpMethods[] = 'GET';
                                $allowedHttpMethods[] = 'HEAD';
                                break;
                        }
                    }
                    if ($s1 === 'product') {
                        switch ($method) {
                            case 'GET':
                            case 'HEAD':
                                return [2, ['name' => 'shop.product.show'], ['product_id' => $s2]];
                            default:
                                $allowedHttpMethods[] = 'GET';
                                $allowedHttpMethods[] = 'HEAD';
                                break;
                        }
                    }
                }
                if ($s1 === 'cart' && $s2 === 'checkout') {
                    switch ($method) {
                        case 'GET':
                        case 'HEAD':
                            return [2, ['name' => 'shop.cart.checkout.show'], []];
                        case 'POST':
                            return [2, ['name' => 'shop.cart.checkout.process'], []];
                        default:
                            $allowedHttpMethods[] = 'GET';
                            $allowedHttpMethods[] = 'HEAD';
                            $allowedHttpMethods[] = 'POST';
                            break;
                    }
                }
            }
            if ($s0 === 'admin') {
                if ($s1 === 'product') {
                    if ($s2 === 'create') {
                        switch ($method) {
                            case 'GET':
                            case 'HEAD':
                                return [2, ['name' => 'admin.product.create'], []];
                            default:
                                $allowedHttpMethods[] = 'GET';
                                $allowedHttpMethods[] = 'HEAD';
                                break;
                        }
                    }
                    if (ctype_digit($s2)) {
                        switch ($method) {
                            case 'GET':
                            case 'HEAD':
                                return [2, ['name' => 'admin.product.show'], ['product_id' => $s2]];
                            case 'PUT':
                            case 'PATCH':
                                return [2, ['name' => 'admin.product.update'], ['product_id' => $s2]];
                            case 'DELETE':
                                return [2, ['name' => 'admin.product.destroy'], ['product_id' => $s2]];
                            default:
                                $allowedHttpMethods[] = 'GET';
                                $allowedHttpMethods[] = 'HEAD';
                                $allowedHttpMethods[] = 'PUT';
                                $allowedHttpMethods[] = 'PATCH';
                                $allowedHttpMethods[] = 'DELETE';
                                break;
                        }
                    }
                }
                if ($s1 === 'category') {
                    if ($s2 === 'create') {
                        switch ($method) {
                            case 'GET':
                            case 'HEAD':
                                return [2, ['name' => 'admin.category.create'], []];
                            default:
                                $allowedHttpMethods[] = 'GET';
                                $allowedHttpMethods[] = 'HEAD';
                                break;
                        }
                    }
                    if (ctype_digit($s2)) {
                        switch ($method) {
                            case 'GET':
                            case 'HEAD':
                                return [2, ['name' => 'admin.category.show'], ['category_id' => $s2]];
                            case 'PUT':
                            case 'PATCH':
                                return [2, ['name' => 'admin.category.update'], ['category_id' => $s2]];
                            case 'DELETE':
                                return [2, ['name' => 'admin.category.destroy'], ['category_id' => $s2]];
                            default:
                                $allowedHttpMethods[] = 'GET';
                                $allowedHttpMethods[] = 'HEAD';
                                $allowedHttpMethods[] = 'PUT';
                                $allowedHttpMethods[] = 'PATCH';
                                $allowedHttpMethods[] = 'DELETE';
                                break;
                        }
                    }
                }
            }
            return isset($allowedHttpMethods) ? [1, $allowedHttpMethods] : [0];
            break;
        
        case 4:
            list($s0, $s1, $s2, $s3) = $segments;
            if ($s0 === 'blog' && $s1 === 'post' && $s3 === 'comment' && ctype_alnum(str_replace('-', '', $s2))) {
                switch ($method) {
                    case 'POST':
                        return [2, ['name' => 'blog.post.comment'], ['post_slug' => $s2]];
                    default:
                        $allowedHttpMethods[] = 'POST';
                        break;
                }
            }
            if ($s0 === 'shop') {
                if ($s1 === 'category') {
                    if ($s2 === 'search' && preg_match('/^([a-zA-Z]+)\\:(.+)$/', $s3, $matches1)) {
                        switch ($method) {
                            case 'GET':
                            case 'HEAD':
                                return [2, ['name' => 'shop.category.search'], ['filter_by' => $matches1[1], 'filter_value' => $matches1[2]]];
                            default:
                                $allowedHttpMethods[] = 'GET';
                                $allowedHttpMethods[] = 'HEAD';
                                break;
                        }
                    }
                    if ($s3 === 'product' && ctype_digit($s2)) {
                        switch ($method) {
                            case 'GET':
                            case 'HEAD':
                                return [2, ['name' => 'shop.category.product.index'], ['category_id' => $s2]];
                            default:
                                $allowedHttpMethods[] = 'GET';
                                $allowedHttpMethods[] = 'HEAD';
                                break;
                        }
                    }
                }
                if ($s1 === 'product' && $s2 === 'search' && preg_match('/^([a-zA-Z]+)\\:(.+)$/', $s3, $matches2)) {
                    switch ($method) {
                        case 'GET':
                        case 'HEAD':
                            return [2, ['name' => 'shop.product.search'], ['filter_by' => $matches2[1], 'filter_value' => $matches2[2]]];
                        default:
                            $allowedHttpMethods[] = 'GET';
                            $allowedHttpMethods[] = 'HEAD';
                            break;
                    }
                }
            }
            if ($s0 === 'admin' && $s3 === 'edit' && ctype_digit($s2)) {
                if ($s1 === 'product') {
                    switch ($method) {
                        case 'GET':
                        case 'HEAD':
                            return [2, ['name' => 'admin.product.edit'], ['product_id' => $s2]];
                        default:
                            $allowedHttpMethods[] = 'GET';
                            $allowedHttpMethods[] = 'HEAD';
                            break;
                    }
                }
                if ($s1 === 'category') {
                    switch ($method) {
                        case 'GET':
                        case 'HEAD':
                            return [2, ['name' => 'admin.category.edit'], ['category_id' => $s2]];
                        default:
                            $allowedHttpMethods[] = 'GET';
                            $allowedHttpMethods[] = 'HEAD';
                            break;
                    }
                }
            }
            return isset($allowedHttpMethods) ? [1, $allowedHttpMethods] : [0];
            break;
        
        case 6:
            list($s0, $s1, $s2, $s3, $s4, $s5) = $segments;
            if ($s0 === 'shop' && $s1 === 'category' && $s3 === 'product' && $s4 === 'search' && ctype_digit($s2) && preg_match('/^([a-zA-Z]+)\\:(.+)$/', $s5, $matches5)) {
                switch ($method) {
                    case 'GET':
                    case 'HEAD':
                        return [2, ['name' => 'shop.category.product.search'], ['category_id' => $s2, 'filter_by' => $matches5[1], 'filter_value' => $matches5[2]]];
                    default:
                        $allowedHttpMethods[] = 'GET';
                        $allowedHttpMethods[] = 'HEAD';
                        break;
                }
            }
            return isset($allowedHttpMethods) ? [1, $allowedHttpMethods] : [0];
            break;
        
        default:
            return [0];
    }
};
