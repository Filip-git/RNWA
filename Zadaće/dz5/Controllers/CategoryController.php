<?php


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $data['categories'] = $categories;
        self::CreateView('CategoryIndexView', $data);
    }

    public function create()
    {
        self::CreateView('CategoryAddView');
    }


    public function store($request)
    {
        Category::save($request['CategoryName'], $request['Description']);
        $this->index();
    }

    public function edit($request)
    {
        $category = Category::find($request['CategoryID']);
        $data['category'] = $category;
        self::CreateView('CategoryEditView', $data);
    }


    public function update($request)
    {
        Category::update($request['CategoryID'], $request['CategoryName'], $request['Description']);
        $this->index();
    }

    public function delete($request)
    {
        Category::delete($request['CategoryID']);
        $this->index();
    }
}