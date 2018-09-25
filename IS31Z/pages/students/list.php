<?php
$queryString = "
    SELECT
        students.id,
        CONCAT(first_name, ' ', last_name) AS student_name,
        groups.name AS group_name
    FROM
        students
        JOIN groups ON groups.id = students.group_id
";

if(!empty($_POST['search']))
    $queryString .= "
    WHERE 
      students.first_name LIKE '%{$_POST['search']}%'
      OR 
      students.last_name LIKE '%{$_POST['search']}%'
    ";
echo $queryString;
$students = dbSelect($queryString);
?>


<strong><?=$message;?></strong>

<form action="" method="post">
    <input type="text" name="search">
    <input type="submit" value="search">
</form>


<? if(count($students)){?>
<table border="1">
    <thead>
        <tr>
            <th>Name</th>
            <th>Group</th>
        </tr>
    </thead>
    <tbody>
        <? foreach ($students as $student) {?>
        <tr>
            <td><?=$student['student_name'];?></td>
            <td><?=$student['group_name'];?></td>
        </tr>
        <? }?>
    </tbody>
</table>
<? }else{?>
    <strong>No records</strong>
<? }?>
