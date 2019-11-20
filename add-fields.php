<?php 

/**
 * Plugin Name: Add-fields
 * Description: Расширяет профиль пользователя дополнительными метаполями
 * Plugin URI:  https://github.com/snovavibor/plugiwp
 * Author URI:  https://github.com/snovavibor
 * Author:      chesnokit
 * Version:     1.0
 *
 * 
 */

add_action('show_user_profile', 'custom_fields_add');
add_action('edit_user_profile', 'custom_fields_add');


add_action('personal_options_update', 'custom_fields_update');
add_action('edit_user_profile_update', 'custom_fields_update');


define( 'FIELDS', [['address'=>'Адрес'],['phone'=>'Телефон'],['sex'=>'Пол'],['family_st'=>'Семейное положение']] );

function custom_fields_add(){
    global $user_id;
     
    ?>
    <h2>Кастомные поля</h2>
    
    <table class="form-table">
		
	
    <?php
    foreach(FIELDS as $key){ ?>              
        
        <tr>

        <?php
        foreach($key as $fild => $name){
            $user = get_user_meta($user_id,$fild);                         
        ?>
			<th><label for="<?= $fild ?>"><?= $name ?></label></th>
			<td>
				<input type="text" name="<?= $fild ?>" id="<?= $fild ?>" value="<?= base64_decode($user[0]) ? base64_decode($user[0]) : 'TOP SECRET' ?>"><br>
			</td>
		</tr>
        
        <?php
    }    
    }
    ?>
    </table>
    <?php
    
}

 function custom_fields_update()
{
    global $user_id;
    foreach(FIELDS as $key){
        foreach($key as $fild => $name){
           
       update_user_meta( $user_id, $fild, base64_encode($_POST[$fild])); 
    }
}
    
}

