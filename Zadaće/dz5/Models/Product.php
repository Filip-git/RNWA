<?php


class Product
{
    public $ProductID;
    public $ProductName;
    public $SupplierID;
    public $CategoryID;
    public $CompanyName;
    public $CategoryName;

    /**
     * Product constructor.
     * @param $ProductID
     * @param $ProductName
     * @param $SupplierID
     * @param $CategoryID
     * @param $CompanyName
     * @param $CategoryName
     */
    public function __construct($ProductID, $ProductName, $SupplierID, $CategoryID, $CompanyName, $CategoryName)
    {
        $this->ProductID = $ProductID;
        $this->ProductName = $ProductName;
        $this->SupplierID = $SupplierID;
        $this->CategoryID = $CategoryID;
        $this->CompanyName = $CompanyName;
        $this->CategoryName = $CategoryName;
    }




    public static function all() {
        $list = [];
        $req = Database::query("SELECT p.*, c.CategoryName, s.CompanyName FROM products p JOIN suppliers s ON p.SupplierID = s.SupplierID JOIN categories c ON p.CategoryID = c.CategoryID");
        foreach($req as $product) {
            $list[] = new Product($product['ProductID'], $product['ProductName'], $product['SupplierID'], $product['CategoryName'], $product['CompanyName'], $product['CategoryName']);
        }
        return $list;
    }

    public static function find($ProductID) {
        //$ProductID = intval($ProductID);
        $req = Database::query("SELECT p.*, c.CategoryName, s.CompanyName FROM products p JOIN suppliers s ON p.SupplierID = s.SupplierID JOIN categories c ON p.CategoryID = c.CategoryID WHERE p.ProductID = '$ProductID'");
        $product = $req[0];
        return new Product($product['ProductID'], $product['ProductName'], $product['SupplierID'], $product['CategoryID'], $product['CompanyName'], $product['CategoryName']);
    }

    public static function save($ProductName, $SupplierID, $CategoryID)
    {
        return Database::query("INSERT INTO products (ProductName, SupplierID, CategoryID) VALUES ('$ProductName', $SupplierID, $CategoryID)");
    }

    public static function update($ProductID, $ProductName, $SupplierID, $CategoryID)
    {
        return Database::query("UPDATE products SET ProductID = '$ProductID', ProductName = '$ProductName', SupplierID = $SupplierID, CategoryID = $CategoryID  WHERE ProductID = '$ProductID'");
    }

    public static function delete($ProductID)
    {
        return Database::query("DELETE FROM products WHERE ProductID = '$ProductID'");
    }


}