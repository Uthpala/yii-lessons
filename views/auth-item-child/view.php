<div class="auth-item-child-view">
    <ul>
    <?php 
        foreach( $rolePermissions as $rolePermission ){
            echo '<li>'.$rolePermission->child.'</li>';
        }
    ?>
    </ul>
</div>
