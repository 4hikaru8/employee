
<?php 
	$page_name = '社員一覧ページ';
    // require_once 'check/token_checker.php';
    require_once 'check/login_checker.php';
	require_once __DIR__ . '/inc/header.php'; 	//ヘッダーを読み込む
	require_once __DIR__ . '/check/input_checker.php';
	require_once __DIR__ . '/check/replacement_checker.php';
	require_once __DIR__ . '/dataaccess/employeePDO.php';

	$statement = employee_list(db_open());
?>
	<section id="main">
			<table border="1">
				<tr>
					<th>更新</th>
					<th>社員ID</th>
					<th>氏名</th>
					<th>所属</th>
					<th>役職</th>
					<th>性別</th>
					<th>基本情報処理資格</th>
					<th>応用情報処理資格</th>
					<th>入社年月日</th>
				</tr>
				<?php while($row = $statement->fetch()): ?>
					<tr>
						<td class="center"><a href="edit.php?id=<?php echo $row['id'] ?>">更新</a></td>
						<td class="center"><?php echo invaliXss($row['id'])?></td>
						<td class="center"><?php echo invaliXss($row['name'])?></td>
						<td class="center"><?php echo invaliXss($row['bkcode'])?></td>
						<td class="center"><?php echo invaliXss($row['position'])?></td>
						<td class="center"><?php echo gender_replacement($row['gender'])?></td>
						<td class="center"><?php echo hasfe_replacement($row['hasfe'])?></td>
						<td class="center"><?php echo hasap_replacement($row['hasap'])?></td>
						<td class="center"><?php echo invaliXss($row['hire_date'])?></td>
					</tr>
				<?php endwhile; ?>
			</table>
	</section>

<?php require_once  'inc/footer.php';	//フッターを読み込む ?>