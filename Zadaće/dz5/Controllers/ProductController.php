<?php


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $data['products'] = $products;
        self::CreateView('ProductIndexView', $data);
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $data['suppliers'] = $suppliers;
        $categories = Category::all();
        $data['categories'] = $categories;
        self::CreateView('ProductAddView', $data);
    }


    public function store($request)
    {
        Product::save($request['ProductName'], $request['SupplierID'], $request['CategoryID']);
        $this->index();
    }

    public function edit($request)
    {
        $product = Product::find($request['ProductID']);
        $data['product'] = $product;
        $suppliers = Supplier::all();
        $data['suppliers'] = $suppliers;
        $categories = Category::all();
        $data['categories'] = $categories;
        self::CreateView('ProductEditView', $data);
    }


    public function update($request)
    {
        Product::update($request['ProductID'], $request['ProductName'], $request['SupplierID'], $request['CategoryID']);
        $this->index();
    }

    public function delete($request)
    {
        Product::delete($request['ProductID']);
        $this->index();
    }
}