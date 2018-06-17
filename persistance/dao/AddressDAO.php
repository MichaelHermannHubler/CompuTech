<?php



Class AddressDAO extends AbstractDAO {

    function __construct() {
        
    }

    function setAddress($id, $street, $city, $postCode, $countryCode, $name) {
        $this->doConnect();

        if ($id == null) {
            $stmt = $this->conn->prepare("insert into address (Street, City, PostalCode,`Country`, `name`) values (?,?,?,?,?)");
            $stmt->bind_param("ssiss", $street, $city, $postCode, $countryCode, $name);
        } else {
            $stmt = $this->conn->prepare("update address set Street = ?, City = ?, PostalCode = ?, `Country` = ?, `name` = ? where ID = ?");
            $stmt->bind_param("ssissi", $street, $city, $postCode, $countryCode, $name, $id);
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

        $stmt = $this->conn->prepare("select ID, Street, City, PostalCode, CountryCode, name from address where ID = ?");

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $stmt->bind_result($ID, $street, $city, $postalCode, $countryCode, $name);

        if ($stmt->fetch()) {
            $address = new Address($ID, $street, $city, $postalCode, $countryCode);
        }

        $this->closeConnect();
        return $address;
    }

    function getAllAddresses() {
        $this->doConnect();

        $stmt = $this->conn->prepare("select ID, Street, City, PostalCode, CountryCode, name from address");

        $stmt->execute();

        $stmt->bind_result($id, $street, $city, $postCode, $countryCode, $name);

        $addresses = array();
        while ($stmt->fetch()) {
            $address = new Address($id, $street, $city, $postCode, $countryCode, $name);
            array_push($addresses, $address);
        }

        $this->closeConnect();

        return $addresses;
    }

}
