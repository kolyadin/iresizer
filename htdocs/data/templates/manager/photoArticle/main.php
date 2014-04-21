<?php
$articles = $d['articles'];
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.remove-article').click(function(){
            return confirm('������� ������?');
        });

        $('.toggle-publish').click(function(){

        });
    });
</script>
<a name="topper"></a>
<table cellspacing="1" class="TableFiles">
    <tr>
        <td class="TFHeader" style="width: 50px;">ID</td>
        <td class="TFHeader" style="width: 150px">�������� ������</td>
        <td class="TFHeader" style="width: 80%;">�����</td>
        <td class="TFHeader" style="width: 20px;">�����������</td>
        <td class="TFHeader" style="width: 20px;">�������</td></tr>
    <?php
    foreach($articles as $article) {
        ?>
        <tr>
            <td><?=$article->getId();?></td>
            <td><a href="<?=PhotoArticleManager::createUrl('showArticle', array('articleId' => $article->getId()));?>">
                <?=$article->getTitle();?>
            </a></td>
            <td valign="top">
                <?php
                $c = $article->getPhotosCount() - 1;
                for($i = 0; $i < $c; $i++) {
                    ?>
                    <a href="<?=PhotoArticleManager::createUrl('showPhoto', array(
                                                                                 'photoId' => $article->getItem($i)->getId(),
                                                                                 'articleId' => $article->getId()
                                                                            ));?>">
                        <img src="<?=$this->getStaticPath($article->getItem($i)->getPhotoPathBySize('70'));?>" />
                    </a>
                    <?php } ?>
            </td>
            <td>
                <a href="<?=PhotoArticleManager::createUrl('publishArticle',
                                                           array(
                                                                'articleId' => $article->getId()
                                                           )
                );?>" class="toggle-publish"><?=$article->isPublished() ? '����� � ����������' : '������������';?></a>
            </td>
            <td>
                <a href="<?=PhotoArticleManager::createUrl('deleteArticle',
                                                           array(
                                                                'articleId' => $article->getId()
                                                           )
                );?>" class="remove-article">�������</a>
            </td>
        </tr>
        <?php
    }
    ?>
    <tr><td class="TFHeader" colspan="7" align="right">&nbsp;</td></tr>
</table><br />