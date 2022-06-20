<?php


class Category
{
    public $CategoryID;
    public $CategoryName;
    public $Description;

    /**
     * Country constructor.
     * @param $CategoryID
     * @param $CategoryName
     * @param $Description
     */
    public function __construct($CategoryID, $CategoryName, $Description)
    {
        $this->CategoryID = $CategoryID;
        $this->CategoryName = $CategoryName;
        $this->Description = $Description;
    }




    public static function all() {
        $list = [];
        $req = Database::query("SELECT * FROM categories");
        foreach($req as $category) {
            $list[] = new Category($category['CategoryID'], $category['CategoryName'],$category['Description']);
        }
        return $list;
    }

    public static function find($CategoryID) {
        //$CategoryID = intval($CategoryID);
        $req = Database::query("SELECT * FROM categories WHERE CategoryID = '$CategoryID'");
        $category = $req[0];
        return new Category($category['CategoryID'], $category['CategoryName'],$category['Description']);
    }

    public static function save($CategoryName, $Description)
    {
        return Database::query("INSERT INTO categories (CategoryName, Description) VALUES ('$CategoryName', '$Description')");
    }

    public static function update($CategoryID, $CategoryName, $Description)
    {
        return Database::query("UPDATE categories SET CategoryID = '$CategoryID', CategoryName = '$CategoryName', Description = '$Description'  WHERE CategoryID = '$CategoryID'");
    }

    public static function delete($CategoryID)
    {
        return Database::query("DELETE FROM categories WHERE CategoryID = '$CategoryID'");
    }


}