<?php


class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        $data['suppliers'] = $suppliers;
        self::CreateView('SupplierIndexView', $data);
    }

    public function create()
    {
        self::CreateView('SupplierAddView');
    }


    public function store($request)
    {
        Supplier::save($request['CompanyName'], $request['City'], $request['Country'], $request['Phone']);
        $this->index();
    }

    public function edit($request)
    {
        $supplier = Supplier::find($request['SupplierID']);
        $data['supplier'] = $supplier;
        self::CreateView('SupplierEditView', $data);
    }


    public function update($request)
    {
        Supplier::update($request['SupplierID'], $request['CompanyName'], $request['City'], $request['Country'], $request['Phone']);
        $this->index();
    }

    public function delete($request)
    {
        Supplier::delete($request['SupplierID']);
        $this->index();
    }
}