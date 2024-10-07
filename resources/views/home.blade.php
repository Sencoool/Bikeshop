@extends('layouts.master')
@section('title')
    BikeShop | อุปกรณ์จักยาน, อะไหล่, ชุดแข่ง, และอุปกรณ์ตกแต่ง
@endsection
@section('content')
    <div class="container" ng-app="app" ng-controller="ctrl">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item" ng-class="{'active': category == null}"
                        ng-click="getProductList(null)">ทั้งหมด</a>
                    <a href="#" class="list-group-item" ng-repeat="c in categories" ng-click="getProductList(c)"
                        ng-class="{'active': category.id == c.id}">@{c.name}</a>
                </div>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" ng-model="query"ng-keyup="searchProduct($event)"
                    style="width:190px" placeholder="พิมพ์ชื่อสินค้าเพื่อค้นหา">
                <div class="row">
                    <div class="col-md-3" ng-repeat="p in products">
                        <!-- product card -->
                        <div class="panel panel-default bs-product-card">
                            <img ng-src="@{p.image_url}" class="img-responsive">
                            <div class="panel-body">
                                <h4><a href="#">@{ p.name }</a></h4>

                                <div class="form-group">
                                    <div>คงเหลือ: @{p.stock_qty}</div>
                                    <div>ราคา <strong>@{p.price|number:2}</strong> บาท</div>                                    
                                </div>
                                @guest
                                @else
                                    <a href="#" class="btn btn-success btn-block" ng-click="addToCart(p)">
                                    <i class="fa fa-shopping-cart"></i> หยิบใส่ตะกร้า</a>@endguest

                            </div>
                        </div>

                        <!-- end product card -->
                    </div>
                </div>
            </div>
            <h3 ng-if="!products.length">ไม่พบข้อมูลสินค้า </h3>
        </div>
    </div>


    <script type="text/javascript">
        var app = angular.module('app', []).config(function($interpolateProvider) {
            $interpolateProvider.startSymbol('@{').endSymbol('}');
        });


        app.service('productService', function($http) {
            this.getProductList = function(category_id) {
                if (category_id) {
                    return $http.get('/api/product/' + category_id);
                }
                return $http.get('/api/product');
            };
            this.getCategoryList = function() {
                return $http.get('/api/category');
            }
            this.searchProduct = function(query) {
                return $http({
                    url: '/api/product/search',
                    method: 'post',
                    data: {
                        'query': query
                    },
                });
            }
        });

        app.controller('ctrl', function($scope, productService) {
            $scope.products = [];

            $scope.getProductList = function() {
                productService.getProductList().then(function(res) {
                    if (!res.data.ok) return;
                    $scope.products = res.data.products;
                });
            };
            $scope.getProductList();

            $scope.getCategoryList = function() {
                productService.getCategoryList().then(function(res) {
                    if (!res.data.ok) return;
                    $scope.categories = res.data.categories;
                });
            };
            $scope.getCategoryList();

            $scope.getProductList = function(category) {
                $scope.category = category;
                category_id = category != null ? category.id : '';
                productService.getProductList(category_id).then(function(res) {
                    if (!res.data.ok) return;
                    $scope.products = res.data.products;
                });
            };
            $scope.getProductList(null);

            $scope.searchProduct = function(e) {
                productService.searchProduct($scope.query).then(function(res) {
                    if (!res.data.ok) return;
                    $scope.products = res.data.products;
                });
            };
            $scope.searchProduct();

            $scope.addToCart = function(p) {
                window.location.href = '/cart/add/' + p.id;
            }
        });
    </script>
@endsection
