<div class="ct">
    <?php $row=$Ord->find(['no'=>$_GET['no']]);?>
    <div>感謝您的訂購，您的訂單編號是：<?=$row['no'];?></div>
    <div>電影名稱：<?=$row['name'];?></div>
    <div>日期：<?=$row['date'];?></div>
    <div>場次時間：<?=$row['session'];?></div>
    <div>
        座位：<br>
        <?php
foreach(unserialize($row['seat']) as $s) echo $s,",<br>";
        ?>
        共<?=$row['qt'];?>張電影票
    </div>
    <div class="ct"><button type="button" onclick="location.href='?'">確認</button></div>
</div>