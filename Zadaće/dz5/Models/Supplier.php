<?php


class Supplier
{
    public $SupplierID;
    public $CompanyName;
    public $City;
    public $Country;
    public $Phone;

    /**
     * Country constructor.
     * @param $SupplierID
     * @param $CompanyName
     * @param $City
     */
    public function __construct($SupplierID, $CompanyName, $City, $Country,  $Phone)
    {
        $this->SupplierID = $SupplierID;
        $this->CompanyName = $CompanyName;
        $this->City = $City;
        $this->Country = $Country;
        $this->Phone = $Phone;
    }


    public static function all() {
        $list = [];
        $req = Database::query("SELECT * FROM suppliers");
        foreach($req as $supplier) {
            $list[] = new Supplier($supplier['SupplierID'], $supplier['CompanyName'], $supplier['City'], $supplier['Country'], $supplier['Phone']);
        }
        return $list;
    }

    public static function find($SupplierID) {
        //$SupplierID = intval($SupplierID);
        $req = Database::query("SELECT * FROM suppliers WHERE SupplierID = '$SupplierID'");
        $supplier = $req[0];
        return new Supplier($supplier['SupplierID'], $supplier['CompanyName'], $supplier['City'], $supplier['Country'], $supplier['Phone']);
    }

    public static function save($CompanyName, $City, $Country,  $Phone)
    {
        return Database::query("INSERT INTO suppliers (CompanyName, City, Country, Phone) VALUES ('$CompanyName', '$City', '$Country', '$Phone')");
    }

    public static function update($SupplierID, $CompanyName, $City, $Country,  $Phone)
    {
        return Database::query("UPDATE suppliers SET SupplierID = '$SupplierID', CompanyName = '$CompanyName', City = '$City', Country = '$Country', Phone = '$Phone'  WHERE SupplierID = '$SupplierID'");
    }

    public static function delete($SupplierID)
    {
        return Database::query("DELETE FROM suppliers WHERE SupplierID = '$SupplierID'");
    }


}