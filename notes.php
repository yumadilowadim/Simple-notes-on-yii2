<?php
use app\models\Notes;
use yii\helpers\Url;
$this->title = "Notes";

$user_id = Yii::$app->user->identity->id;
$date_create = date('Y').'-'.date('m').'-'.date('d');
$thishref = Url::to(['/generator/notes']);

// date, uid, name, text
$date = isset($_GET['date']) ? $_GET['date'] : null;
$uid = isset($_GET['uid']) ? $_GET['uid'] : null;
$theme = isset($_GET['theme']) ? $_GET['theme'] : null;
$text = isset($_GET['text']) ? $_GET['text'] : null;
?>
<div class="col-lg-12 ol-md-12 col-sm-12 col-xs-12 noteadd_main">
<?
if ($date != '' && $uid == $user_id && $theme != '' && $text != '') {

Yii::$app->db->createCommand()->insert('notes', [
    'uid' => $uid,
    'theme' => $theme,
	'text' => $text,
	'date' => $date
])->execute();

$script_note = <<<JS
$('.noteadd_main').html('<p class="bg-success" style="padding:15px;">Note is succesfully added!</p>');
setTimeout(function() {
location.href = '$thishref';
}, 3000);
JS;
$this->registerJs($script_note, yii\web\View::POS_READY);

}
else {
?>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="position:relative;">
<form method="GET" style="position:fixed;width:350px;display:block;">
<input type="hidden" value="<? echo $user_id; ?>" name="uid" />
<input type="hidden" value="<? echo $date_create; ?>" name="date" />
<div>
<label>Тема: </label> <input type="text" value="<? echo $date_create; ?>" name="theme" placeholder="Theme" class="form-control" required="" />
<br/><br/>
<label>Заметка: </label> <textarea name="text" placeholder="Note" class="form-control" required="" rows="4" autofocus=""></textarea>
<div style="text-align:left;padding-top:40px;">
<button class="btn btn-default" type="submit">Add note</button>
</div>
</div>
</form>
</div>
<?
$notes_user_count = Notes::find()->where(['uid'=>$user_id])->count();
echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">';
if ($notes_user_count > 0) {
$notes_user = Notes::find()->where(['uid'=>$user_id])->all();
foreach ($notes_user as $note_user):
$theme_enter = $note_user->theme;
$text_enter = $note_user->text;
$date_enter = $note_user->date;

echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 note">
<h3>'.$theme_enter.'</h3>
<span>'.$date_enter.'</span>
<p>'.$text_enter.'</p>
</div>'; 

endforeach;
}
else {
echo 'Notes not found.';	
}
echo '</div>';

} ?>
</div>
<style>
.checkbox {
}
textarea {
	resize:none;
}
.users .checkbox {
    display: inline-block;
    padding-right: 15px;
    width: 49%;
    text-align: left;
}

.note {
	border-radius: 6px;
    background: #f9f9f9;
    padding-left: 15px;
    padding-bottom: 15px;
    margin-bottom: 10px;
    border: 1px solid #d0d0d0;
}
.note span {
	color:#969696;
}
</style>