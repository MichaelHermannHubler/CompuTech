<?php



Class AddressDAO extends AbstractDAO {

    function __construct() {
        
    }

    function setAddress($id, $street, $city, $postCode, $countryCode) {
        $this->doConnect();

        if ($id == null) {
            $stmt = $this->conn->prepare("insert into address (Street, City, PostalCode, CountryCode) values (?,?,?,?)");
            $stmt->bind_param("ssis", $street, $city, $postCode, $countryCode);
        } else {
            $stmt = $this->conn->prepare("update address set Street = ?, City = ?, PostalCode = ?, CountryCode = ? where ID = ?");
            $stmt->bind_param("ssisi", $street, $city, $postCode, $countryCode, $id);
        }

        $stmt->execute();

        if ($id == null && $stmt->fetch()) {
            $id = mysqli_insert_id($stmt);
        }

        $this->closeConnect();
        return $id;
    }

    function getAddress($id) {
        $this->doConnect();

        $stmt = $this->conn->prepare("select ID, Street, City, PostalCode, CountryCode from address where ID = ?");

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $stmt->bind_result($ID, $street, $city, $postalCode, $countryCode);

        if ($stmt->fetch()) {
            $address = new Address($ID, $street, $city, $postalCode, $countryCode);
        }

        $this->closeConnect();
        return $address;
    }

    function getAllAddresses() {
        $this->doConnect();

        $stmt = $this->conn->prepare("select ID, Street, City, PostalCode, CountryCode from address");

        $stmt->execute();

        $stmt->bind_result($id, $street, $city, $postCode, $countryCode);

        $addresses = array();
        while ($stmt->fetch()) {
            $address = new Address($id, $street, $city, $postCode, $countryCode);
            array_push($addresses, $address);
        }

        $this->closeConnect();

        return $addresses;
    }

}
