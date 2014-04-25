<?php
/**
 * User: anubis
 * Date: 4/22/13
 * Time: 12:34 PM
 */

$roomTypes = $d['roomTypes'];

function toggler($bool) {
    return $bool ? '���' : '����';
}

?>
<style>
    ul.rooms h3 {
        margin: 0;
        padding: 5px;
        background-color: #B8D1FF;
    }

    ul.rooms li {
        list-style: none;
        border: 1px solid #ddd;
        padding: 5px 5px;
        margin: 5px;
        margin-right: 20px;
    }

    ul.actions li {
        border: none;
        padding: 0;
        margin: 0;
    }

    ul.rooms {
        margin: 0;
        padding: 0;
    }

    .disabled {
        color: #ddd;
    }

    li.disabled h3 {
        background-color: #ccc;
    }

    li.disabled .actions {
        display: none;
    }
</style>
<ul class="rooms">
    <?php
    foreach($roomTypes as $roomType) {
        ?>
        <li<?= RoomConfig::getValue($roomType, 'close') ? ' class="disabled"' : ''; ?>>
            <h3><?= $roomType; ?> (<a href="<?=
                IMManager::createUrl('toggle',
                                     array(
                                          'roomType' => $roomType,
                                          'value'    => 'close'
                                     ));?>"><?= toggler(!RoomConfig::getValue($roomType, 'close')); ?></a>)</h3>
            <ul class="actions">
                <li>��������� �����: <a href="<?=
                    IMManager::createUrl('toggle',
                                         array(
                                              'roomType' => $roomType,
                                              'value'    => 'canComment'
                                         ));?>">
                        <?= toggler(RoomConfig::getValue($roomType, 'canComment')); ?>
                    </a></li>
                <li>��������: <a href="<?=
                    IMManager::createUrl('toggle',
                                         array(
                                              'roomType' => $roomType,
                                              'value'    => 'canSubscribe'
                                         ));?>">
                        <?= toggler(RoomConfig::getValue($roomType, 'canSubscribe')); ?>
                    </a></li>
                <li><strong>��������� ���������:</strong>
                    <ul>
                        <li>��������: <a href="<?=
                            IMManager::createUrl('toggle',
                                                 array(
                                                      'roomType' => $roomType,
                                                      'value'    => 'editorImages'
                                                 ));?>">
                                <?= toggler(RoomConfig::getValue($roomType, 'editorImages')); ?></a></li>
                    </ul>
                </li>
            </ul>
        </li>
    <?php
    }
    ?>
</ul>