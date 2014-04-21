<?php
/**
 * User: anubis
 * Date: 09.04.13
 * Time: 20:02
 */

class Notify {

    /**
     * @param $uid ���� ��������
     * @param $aid ��� �������
     * @param $title �������� �������/������/���
     * @param $link ���� �� �������/�����/���
     * @param $comment_link ���� �� �������
     */
    public static function toNotify($uid, $aid, $title, $link, $comment_link) {
        $o_n = new VPA_table_notifications();
        $notify = array(
            'uid'        => $uid,
            'aid'        => $aid,
            'title'      => $title,
            'title_link' => $link,
            'link'       => $comment_link
        );
        $o_n->add($ret, $notify);
    }

    public static function toEmail($subscriber, $ui, $roomName, $title, $link) {
        $tpl = new VPA_template();
        $tpl->_init();
        $tpl->tpl('', '/mail/', 'message.php');
        $tpl->assign('title', '����������� � ����� �����������');
        $tpl->assign(
            'message',
            sprintf(
                '%1$s<br>������������ %2$s ������� ����� ����������� � ������� "<a href="%3$s">%4$s</a>, �� ������� �� ������� (<a href="%3$s">%3$s</a>)<br><br>'.
                '���� �� ������ �� ������ �������� �����������, ����������, ��������� �� ������: <a href="http://www.popcornnews.ru/unsubs/%5$s">http://www.popcornnews.ru/unsubs/%5$s</a>',
                date('d/m/Y H:i'), $ui->user['nick'], $link, $title, $roomName
            )
        );
        $letter = $tpl->make();

        html_mime_mail::getInstance()->quick_send(
            sprintf('"%s" <%s>', htmlspecialchars($subscriber['nick']), $subscriber['email']),
            '����������� � ����� �����������',
            $letter
        );
    }

}