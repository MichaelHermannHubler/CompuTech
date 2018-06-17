<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/AbstractDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/AddressDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/UserPermissionsDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/PositionArticleDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/model/dto/ArticleListDTO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/dao_purchase/ArticleDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/dao_purchase/ArticleGroupDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/dao_purchase/OfferOrderDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/dao_purchase/PurchaseOrderDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/dao_purchase/SupplierDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/dao_sales/OrderArticleDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/dao_sales/OrderDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/dao_sales/UserDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/dao_sales/SalesOrderDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/dao_warehouse/AccountingRecordDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/dao_warehouse/PicklistDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/dao/dao_warehouse/WarehouseLocationDAO.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/model/Voucher.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/model/AccountingRecord.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/model/Address.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/model/Article.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/model/ArticleGroup.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/model/OfferOrders.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/model/Order.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/model/OrderArticle.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/model/Picklist.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/model/PositionArticles.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/model/PurchaseOrder.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/model/Supplier.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/model/User.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/CompuTech/persistance/model/WarehouseLocation.php';




/*include_once '../persistance/dao/AbstractDAO.php';
include_once '../persistance/dao/AddressDAO.php';
include_once '../persistance/dao/PositionArticleDAO.php';
include_once '../persistance/dao/dao_purchase/ArticleDAO.php';
include_once '../persistance/dao/dao_purchase/ArticleGroupDAO.php';
include_once '../persistance/dao/dao_purchase/OfferOrderDAO.php';
include_once '../persistance/dao/dao_purchase/PurchaseOrderDAO.php';
include_once '../persistance/dao/dao_purchase/SupplierDAO.php';
include_once '../persistance/dao/dao_sales/UserDAO.php';
include_once '../persistance/dao/dao_warehouse/AccountingRecordDAO.php';
include_once '../persistance/dao/dao_warehouse/PicklistDAO.php';
include_once '../persistance/dao/dao_warehouse/WarehouseLocationDAO.php';
include_once '../persistance/model/Voucher.php';
include_once '../persistance/model/AccountingRecord.php';
include_once '../persistance/model/Address.php';
include_once '../persistance/model/Article.php';
include_once '../persistance/model/ArticleGroup.php';
include_once '../persistance/model/OfferOrders.php';
include_once '../persistance/model/Picklist.php';
include_once '../persistance/model/PositionArticles.php';
include_once '../persistance/model/PurchaseOrder.php';
include_once '../persistance/model/Supplier.php';
include_once '../persistance/model/User.php';
include_once '../persistance/model/WarehouseLocation.php';*/

