<?php
$article = $d['article'];
$tags = $d['tags'];
$persons = $d['persons'];

include 'articleEditorScripts.php';

?>
<a name="form"></a>
<form method="POST" action="admin.php<?=PhotoArticleManager::createUrl('saveArticle');?>" name="frm" class="Fform" enctype="multipart/form-data">
    <input type="hidden" name="type" value="photoarticles" />
    <input type="hidden" name="action" value="saveArticle" />

    <table width="100%">
        <tr>
            <td><label for="title">�������� ����-������</label></td>
            <td><input type="text" name="title" id="title" size="90%" value="" /></td>
        </tr>
        <tr>
            <td valign="top">����</td>
            <td>
                <a class="add-tag" href="#">�������� ���</a>
                <div id="tag-block">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="top">�������</td>
            <td>
                <a class="add-person" href="#">�������� �������</a>
                <div id="person-block">
                </div>
            </td>
        </tr>
        <tr>
            <td valign="top">����������</td>
            <td>
                <a class="add-photo" href="#">�������� ����������</a>
                <div id="photo-block"></div>
            </td>
        </tr>
    </table>

    <table cellspacing="3" width="100%">
        <tr>
            <td><input tabindex=60 type="submit" value="���������" class="button" style="font-weight:700"></td>
            <td><input tabindex=61 type="reset" value="�������� ���������" class="button"></td>
            <td align="right" width="100%"></td>
        </tr>
    </table>
</form>