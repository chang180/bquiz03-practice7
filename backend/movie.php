<a href="?do=add_movie"><button>新增電影</button></a>
<hr>
<?php
$rows=$Movie->all([], "ORDER BY rank DESC");
foreach($rows as $row){
    ?>
<div style="display:flex">
<div><img src="img/<?=$row['poster'];?>" style="width:68px;height:100px"></div>
<div>分級：<img src="icon/<?=$row['level'];?>.png"></div>
<div>
    <div style="display:flex">
<div>片名：<?=$row['name'];?></div>
<div>片長：<?=$row['length'];?></div>
<div>上映日期：<?=$row['date'];?></div>
</div>
    <div><a href="?do=edit_movie&id=<?=$row['id'];?>"><button>編輯電影</button></a><a href="?do=del_movie&id=<?=$row['id'];?>"><button>刪除電影</button></a></div>
    <div>劇情介紹：<?=$row['intro'];?></div>
</div>
</div>
<hr>
    <?php
}
?>