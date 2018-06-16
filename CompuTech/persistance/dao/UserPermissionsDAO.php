<?php


/**
 * Description of UserPermissionsDAO
 *
 * @author lkrei_a8sds9s
 */
class UserPermissionsDAO extends AbstractDAO{
   
    function __construct() {
        
    }
    
    function getPermissions($user){
        
        $this->doConnect();
        
        $stmt = $this->conn->prepare("Select PermissionCode from userpermission where UserID = ?");
        
        $stmt->bind_param("i", $user);
        
        $stmt->execute();
        
        $stmt->bind_result($perm);
        
        if($stmt->fetch()){
            $perm = $perm;
        }
        
        $this->closeConnect();
        return $perm;
    }
    
}
