<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/account.js"></script>

<?php
try {
    $dsn = "mysql:host=localhost;port=8889;dbname=dd102g4;charset=utf8";
    $user = "root";
    $password = "root";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE => PDO::CASE_NATURAL);
    $pdo = new PDO($dsn, $user, $password, $options);
    $sql = "select* from mem_main";
    $memberMain = $pdo->prepare($sql);
    $memberMain->execute();

    // if ($memberMain->rowCount() == 0) { //找不到
    //     //傳回空的JSON字串
    //     echo "{}";
    // } else { //找得到
    //     //取回一筆資料
    //     $memberMainRow = $memberMain->fetchAll(PDO::FETCH_ASSOC);
    //     //送出json字串
    //     echo json_encode($memberMainRow);
    // }
} 
catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">En-galaxy</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">帳號管理</a>
            </li>
            <!--麵包屑-->
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">會員編號</th>
                        <th scope="col">英文等級</th>
                        <th scope="col">會員姓名</th>
                        <th scope="col">角色名稱</th>
                        <th scope="col">虛擬幣</th>
                        <th scope="col">會員帳號</th>
                        <th scope="col">會員密碼</th>
                        <th scope="col">會員信箱</th>
                        <th scope="col">會員電話</th>
                        <th scope="col">會員狀態</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($memberMainRow = $memberMain->fetch(PDO::FETCH_ASSOC)) {

                        ?>
                        <tr>
                            <td><?= $memberMainRow["mem_no"] ?></td>
                            <td><?= $memberMainRow["level_no"] ?></td>
                            <td><?= $memberMainRow["mem_name"] ?></td>
                            <td><?= $memberMainRow["set_nickname"] ?></td>
                            <td><?= $memberMainRow["mem_money"] ?></td>
                            <td><?= $memberMainRow["mem_id"] ?></td>
                            <td><?= $memberMainRow["mem_psw"] ?></td>
                            <td><?= $memberMainRow["mem_email"] ?></td>
                            <td><?= $memberMainRow["mem_cell"] ?></td>
                            <td><label class="switch switch-pill switch-label switch-outline-success-alt switchMemStatus">
                                <input type="checkbox" class="switch-input" checked="<?= $memberMainRow["mem_status"] ?>">
                                <span class="switch-slider" data-checked="正常" data-unchecked="停權"></span>
                            </label></td>
                            <td></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </ol>
    </nav>
</div>