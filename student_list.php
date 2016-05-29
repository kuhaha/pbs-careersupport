<?php
include('page_header.php');  //画面出力開始
require_once('db_inc.php');  //データベース接続

echo "<h2>学生一覧</h2>";

$sql = "SELECT * FROM vw_gakusei " ;//検索条件を適用したSQL文を作成
if(isset($_SESSION['urole']) ){
	$uid = $_SESSION['uid'];
	if( $_SESSION['urole']==2){
		$lbid = $uid . 'lab';
		$sql .= " where slab='$lbid'";
	}
}
//echo $sql;
$rs = mysql_query($sql, $conn);
if (!$rs) die ('エラー: ' . mysql_error());
$row = mysql_fetch_array($rs) ;

echo '<table class="table table-striped table-hover">';
echo '<tr><th>学籍番号</th><th>氏名</th><th>性別</th><th>電話番号</th><th>所属研究室</th><th>現状</th></tr>';
while ($row) {
 echo '<tr>';
 echo '<td>' . $row['sid'] . '</td>';
 echo '<td>' . $row['sname']. '</td>';

 $i = $row['sex'];
 $sex = array(
 1=>"男",
 2=>"女",
 );

 echo '<td>' . $sex[$i] . '</td>';
 echo '<td>' . $row['tel'] . '</td>';
 echo '<td>' . $row['lbname'] . '</td>';


 $i = $row['status'];
 $status = array(
  1=>"現在、応募企業を選定中である。結果待ちはなし。",
  2=>"3月までは、数社受験していたが、現在活動休止中。",
  3=>"現在、両親と進路先について相談中。",
  4=>"活動終了。",
 );

 echo '<td>' . $status[$i] . '</td>';

 echo '</tr>';

 $row = mysql_fetch_array($rs) ;

}
echo '</table>';

include('page_footer.php');  //画面出力終了
?>