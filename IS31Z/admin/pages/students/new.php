<?php

$groups = dbSelect('SELECT id, name FROM groups ORDER BY name');

if(!empty($_POST['first_name']) && !empty($_POST['last_name'])){
    $queryString = "
      INSERT INTO students 
        (first_name, last_name, group_id, anul_editie, denumire, pagini) 
      VALUES 
        (
        '{$_POST['first_name']}', 
        '{$_POST['last_name']}', 
        {$_POST['group_id']}
        {$_POST['anul_editie']}
        {$_POST['denumire']}
        {$_POST['pagini']}
        )";
    if(mysqli_query($APP['connections']['default'], $queryString)) {
        $message = 'Add success';
    }else{
        $message = 'Add error';
    }
}
?>
<? if(empty($message)){?>

<form action="" method="post">
    <table border="1">
        <tr>
            <td>First name</td>
            <td><input type="text" name="first_name"></td>
        </tr>
        <tr>
            <td>Last name</td>
            <td><input type="text" name="last_name"></td>
        </tr>
        <tr>
            <td>Costul cartei</td>
            <td>
                <select name="group_id">
                    <option value="0">select costul</option>
                    <? foreach ($groups as $group) {?>
                        <option value="<?=$group['id'];?>"><?=$group['name']?></option>
                    <?}?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Anul editie</td>
            <td>
                <input type="int" name="anul_editie">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="add">
            </td>
        </tr>
    </table>
</form>
<? }else{?>
    <strong><?=$message;?></strong>
<? }?>
