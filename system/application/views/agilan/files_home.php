<?php

echo heading("My Files", 2);

echo form_open_multipart('files/upload');
echo form_hidden("MAX_FILE_SIZE",'12000000');
echo "<input type='file' name='userfile' id='userfile' size='20' />";
echo form_submit('upload','upload');
echo form_close();
echo br();


//time format!
$format = "%m/%d/%Y %h:%i %a";

if (count($results)){
	foreach ($results as $key => $list){
		echo $list->title . br();
		echo $list->description . br();
		$stamp = mysql_to_unix($list->created);
		echo  anchor("files/download/".$list->id, $list->title) . br();
		echo "<small>" . mdate($format,$stamp). br();
	
		if (isset($file_tags[$list->id]) && count($file_tags[$list->id])){
			echo implode(",",$file_tags[$list->id]);
		}
		echo "</small>";

		echo "<ol class='comments'>";
		if (isset($comments[$list->id]) && count($comments[$list->id]) > 0){
			foreach ($comments[$list->id] as $kk => $ll){
				$CID = $ll->user_id;
				$CU = $usernames[$ll->user_id];
				$stamp = mysql_to_unix($ll->created);
				echo "<li><small><b>".$CU . ":</b> " .
					$ll->comment . "<br/>".
					mdate($format,$stamp) . "</small></li>";
			}
		
		}else{
			echo nbs();
		}
		
		echo form_open('comments/index');
		$input = array('name' => 'comment', 'id' => 'comment', 'size'=> 15);
		echo form_input($input);
		echo form_hidden('object','files');
		echo form_hidden('object_id',$list->id);
		echo form_hidden('return_url','bookmarks/index');
		echo form_submit('add comment','comment');
		echo form_close();

		echo "</ol>";



		echo br(2);


	}

}

?>