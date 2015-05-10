<?php
/**
 * @author kazu22002
 * Copyright (c) 2015 kazu22002
 *
 * ディレクトリの配下のディレクトリ内のフォルダを
 * すべて名前を編集する。
 */

$dirName = "./";      // ディレクトリ
$fileName = "rename_"; // 基礎ファイル名
$count = 0;           // ファイル名の数字
$file_name_tmp = "";
$count_length = 3;
$new_name = "";

// 対応している拡張子リスト
$extension_array = array('jpeg', 'jpg', 'png');

//ディレクトリの存在チェック
if(is_dir($dirName)){
	$dir="";
	// ディレクトリを取得
	if($dir_array = scandir($dirName)){
		// ディレクトリにあるディレクトリを取得
		for($l = 0; $l < count($dir_array); $l++){
			if(is_dir($dir_array[$l])){
				if($file = scandir($dir_array[$l])){
			
					// ディレクトリにあるファイルを
					for($i = 0; $i < count($file); $i++){
						// 数字のある部分を抽出
						preg_match("/[0-9]+/", $file[$i], $file_name_tmp);

						// ファイルのデータを確認する
						$extension = pathinfo($file[$i]);
						// ファイル情報の中に拡張子データがあることを確認
						if(array_key_exists('extension', $extension)){
				
							// 対応している拡張子の配列番号を取得
							// 失敗している場合はfalseが返ってくる
							$array_number =  array_search($extension['extension'], $extension_array);
				
							// 拡張子を確認して拡張子にあったファイル名へ変更
							if($array_number !== false){
								//0パディング
								$count = sprintf('%03d', $file_name_tmp[0]);
								$new_name = $fileName.$count.".".$extension_array[$array_number];
						
								//リネームコマンド
								$cmd = "ren \"".$dir_array[$l].DIRECTORY_SEPARATOR.$file[$i]."\" ".$new_name;
								echo $cmd."\n";
								exec($cmd);
							}
						}
					}
				}
			}
		}
	}
}


?>
