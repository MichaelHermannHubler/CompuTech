<?php
include '../../model/AccountingRecord.php';

Class AccountingRecordDAO extends AbstractDAO
{

    function __construct() { }

    function getAccountingRecords($id, $warehouseLocationSrc, $warehouseLocationDest, $articleID, $type)
    {
        $this->doConnect();
        $stmt = $this->conn->prepare(
            "SELECT ID, WarehouseLocationSrc, WarehouseLocationDest, ArticleID, QuantityMoved, Type
             from warehouselocation 
             where 
                ID = coalesce(?, id)
                and warehouseLocationSrc = coalesce(?, warehouseLocationSrc)
                and warehouseLocationDest = coalesce(?, warehouseLocationDest)
                and articleID = coalesce(?, articleID)
                and type = coalesce(?, type)");
        $stmt->bind_param("iiiis", $id, $warehouseLocationSrc, $warehouseLocationDest, $articleID, $type);
        
        $stmt->execute();

        $quantityMoved = 0;
        $stmt->bind_result($id, $warehouseLocationSrc, $warehouseLocationDest, $articleID, $quantityMoved, $type);

        $accountingRecordArray = array();
        if($stmt->fetch())
        {
            $accountingRecord = new AccountingRecord($id, $warehouseLocationSrc, $warehouseLocationDest, $articleID, $type, $quantityMoved);
            array_push($accountingRecordArray, $accountingRecord);
        }

        $this->closeConnect();
        return $accountingRecordArray;
    }

}
