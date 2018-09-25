<?php

$groups = dbSelect('SELECT id, name FROM groups ORDER BY name');

$students = dbSelect("
    SELECT
        students.id,
        first_name, 
        last_name,
        groups.name AS group_name,
        groups.id AS group_id
    FROM
        students
        JOIN groups ON groups.id = students.group_id
    WHERE
      students.id = {$_GET['id']} 
");
$student = current($students);

if(!empty($_POST['first_name']) && !empty($_POST['last_name'])){
    $queryString = "
      UPDATE students 
      SET 
        first_name = '{$_POST['first_name']}', 
        last_name = '{$_POST['last_name']}', 
        group_id = {$_POST['group_id']}
      WHERE id = {$_GET['id']}
        ";
    if(mysqli_query($APP['connections']['default'], $queryString)) {
        $message = 'Update success';
    }else{
        $message = 'Update error';
    }

}
?>
<? if(empty($message)){?>

<form action="" method="post">
    <table border="1">
        <tr>
            <td>First name</td>
            <td><input type="text" name="first_name" value="<?=$student['first_name'];?>"></td>
        </tr>
        <tr>
            <td>Last name</td>
            <td><input type="text" name="last_name" value="<?=$student['last_name'];?>"></td>
        </tr>
        <tr>
            <td>Group</td>
            <td>
                <select name="group_id">
                    <option value="0">select group</option>
                    <? foreach ($groups as $group) {?>
                        <option value="<?=$group['id'];?>" <? if($group['id'] === $student['group_id']) echo 'selected'?>><?=$group['name']?></option>
                    <?}?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="save">
            </td>
        </tr>
    </table>
</form>
<? }else{?>
    <strong><?=$message;?></strong>
<? }?>
